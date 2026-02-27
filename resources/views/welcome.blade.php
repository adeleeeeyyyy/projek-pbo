<x-guest-layout>
    <div class="relative overflow-hidden bg-white">
        <div class="pt-16 pb-80 sm:pt-24 sm:pb-40 lg:pt-40 lg:pb-48">
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:static">
                <div class="sm:max-w-lg">
                    <h1 class="text-4xl font font-bold tracking-tight text-slate-900 sm:text-6xl">
                        Unveil Your Inner <span class="text-blue-600">Radiance</span>
                    </h1>
                    <p class="mt-4 text-xl text-slate-500">
                        Discover our curated collection of premium beauty essentials designed to enhance your natural
                        glow.
                    </p>
                </div>
                <div>
                    <div class="mt-10">
                        <!-- Decorative image grid -->
                        <div aria-hidden="true"
                            class="pointer-events-none lg:absolute lg:inset-y-0 lg:max-w-7xl lg:mx-auto lg:w-full">
                            <div
                                class="absolute transform sm:left-1/2 sm:top-0 sm:translate-x-8 lg:left-1/2 lg:top-1/2 lg:-translate-y-1/2 lg:translate-x-8">
                                <div class="flex items-center space-x-6 lg:space-x-8">
                                    <div class="flex-shrink-0 grid grid-cols-1 gap-y-6 lg:gap-y-8">
                                        <div class="w-44 h-64 rounded-lg overflow-hidden sm:opacity-0 lg:opacity-100">
                                            <img src="https://images.squarespace-cdn.com/content/v1/63052619b0f81122751533e9/14e284c7-9b7f-40ca-b184-4677877c2786/brand-photography-5th-ave-57.jpg"
                                                alt="" class="w-full h-full object-center object-cover">
                                        </div>
                                        <div class="w-44 h-64 rounded-lg overflow-hidden">
                                            <img src="https://img.freepik.com/free-photo/blonde-female-getting-new-hairstyle-hair-salon_181624-60087.jpg?w=360"
                                                alt="" class="w-full h-full object-center object-cover">
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 grid grid-cols-1 gap-y-6 lg:gap-y-8">
                                        <div class="w-44 h-64 rounded-lg overflow-hidden">
                                            <img src="https://images.unsplash.com/photo-1616683693504-3ea7e9ad6fec?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                                alt="" class="w-full h-full object-center object-cover">
                                        </div>
                                        <div class="w-44 h-64 rounded-lg overflow-hidden">
                                            <img src="https://images.pexels.com/photos/973403/pexels-photo-973403.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                                alt="" class="w-full h-full object-center object-cover">
                                        </div>
                                        <div class="w-44 h-64 rounded-lg overflow-hidden">
                                            <img src="https://images.pexels.com/photos/691166/pexels-photo-691166.jpeg?cs=srgb&dl=pexels-delphine-hourlay-91322-691166.jpg&fm=jpg"
                                                alt="" class="w-full h-full object-center object-cover">
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 grid grid-cols-1 gap-y-6 lg:gap-y-8">
                                        <div class="w-44 h-64 rounded-lg overflow-hidden">
                                            <img src="https://i0.wp.com/zaloraadmin.wpcomstaging.com/wp-content/uploads/2024/08/model-sanggul-modern-untuk-wisuda.png?fit=1200%2C620&ssl=1"
                                                alt="" class="w-full h-full object-center object-cover">
                                        </div>
                                        <div class="w-44 h-64 rounded-lg overflow-hidden">
                                            <img src="https://images.unsplash.com/photo-1611080626919-7cf5a9dbab5b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                                alt="" class="w-full h-full object-center object-cover">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold tracking-tight text-slate-900 mb-8">Latest Collection</h2>

            <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                @foreach ($products as $product)
                    <div class="group relative">
                        <div
                            class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                class="h-full w-full object-cover object-center group-hover:opacity-75 transition-opacity duration-300">
                        </div>
                        <div class="mt-4 flex justify-between">
                            <div>
                                <h3 class="text-sm text-slate-700 font-medium">
                                    {{ $product->name }}
                                </h3>
                                <p class="mt-1 text-sm text-slate-500">{{ $product->category }}</p>
                            </div>
                            <p class="text-sm font-medium text-slate-900">IDR
                                {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="mt-4">
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit"
                                    class="w-full bg-slate-900 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-guest-layout>
