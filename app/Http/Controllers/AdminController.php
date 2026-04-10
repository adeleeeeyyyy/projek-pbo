<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login()
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            Auth::logout();
            return back()->withErrors(['email' => 'You do not have admin access.']);
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    private function ensureAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
    }

    public function dashboard()
    {
        $this->ensureAdmin();

        $totalProducts = \App\Models\Product::count();
        $totalRevenue = \App\Models\Order::where('status', 'completed')->sum('total_price');
        $totalUsers = \App\Models\User::count();

        return view('admin.dashboard', compact('totalProducts', 'totalRevenue', 'totalUsers'));
    }

    public function index(Request $request)
    {
        $this->ensureAdmin();
        
        $query = \App\Models\Product::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $products = $query->latest()->get();
        $categories = \App\Models\Product::select('category')->distinct()->pluck('category');

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $this->ensureAdmin();
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $this->ensureAdmin();

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required',
            'description' => 'required',
            'image_file' => 'nullable|image|max:2048',
            'image_url' => 'nullable|url',
        ]);

        $imageUrl = null;
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('products', 'public');
            $imageUrl = '/storage/' . $path;
        } elseif ($request->filled('image_url')) {
            $imageUrl = $request->image_url;
        }

        \App\Models\Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
            'description' => $request->description,
            'image_url' => $imageUrl ?? 'https://via.placeholder.com/300',
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $this->ensureAdmin();
        $product = \App\Models\Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $this->ensureAdmin();

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required',
            'description' => 'required',
            'image_file' => 'nullable|image|max:2048',
            'image_url' => 'nullable|url',
        ]);

        $product = \App\Models\Product::findOrFail($id);

        $imageUrl = $product->image_url;
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('products', 'public');
            $imageUrl = '/storage/' . $path;
        } elseif ($request->filled('image_url')) {
            $imageUrl = $request->image_url;
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
            'description' => $request->description,
            'image_url' => $imageUrl,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $this->ensureAdmin();
        \App\Models\Product::destroy($id);
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }
}
