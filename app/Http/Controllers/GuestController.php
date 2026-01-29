<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function about()
    {
        return view('guest.about');
    }

    public function contact()
    {
        return view('guest.contact');
    }

    public function show($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        return view('guest.products.show', compact('product'));
    }
}
