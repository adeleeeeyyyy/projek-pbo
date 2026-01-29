<x-guest-layout>
    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
                <!-- Image gallery -->
                <div class="flex-col-reverse">
                    <div class="hidden mt-6 w-full max-w-2xl mx-auto sm:block lg:max-w-none">
                        <div class="grid grid-cols-1 gap-6">
                            <div class="relative rounded-lg overflow-hidden bg-gray-100">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-center object-cover">
                            </div>
                        </div>
                    </div>

                    <div class="w-full aspect-w-1 aspect-h-1 rounded-lg overflow-hidden sm:hidden">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                            class="w-full h-full object-center object-cover">
                    </div>
                </div>

                <!-- Product info -->
                <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                    <h1 class="text-3xl font-extrabold tracking-tight text-slate-900">{{ $product->name }}</h1>

                    <div class="mt-3">
                        <h2 class="sr-only">Product information</h2>
                        <p class="text-3xl text-slate-900">IDR {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>

                    <div class="mt-6">
                        <h3 class="sr-only">Description</h3>

                        <div class="text-base text-slate-700 space-y-6">
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="text-sm text-slate-500">
                            <p>Category: {{ $product->category }}</p>
                            <p>Stock: {{ $product->stock }}</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="mt-4">
                                <label for="quantity" class="sr-only">Quantity</label>
                                <select id="quantity" name="quantity"
                                    class="max-w-full rounded-md border border-gray-300 py-1.5 text-base leading-5 font-medium text-gray-700 text-left shadow-sm focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    @for ($i = 1; $i <= min(10, $product->stock); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <button type="submit"
                                class="mt-8 w-full bg-slate-900 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900">Add
                                to cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>