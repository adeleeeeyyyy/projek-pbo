<x-guest-layout>
    <div class="bg-white">
        <div class="max-w-2xl mx-auto pt-16 pb-24 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Shopping Cart</h1>

            @if ($cartItems->isEmpty())
                <div class="mt-12 text-center">
                    <p class="text-lg text-slate-500">Your cart is empty.</p>
                    <a href="{{ route('home') }}" class="mt-6 inline-block text-blue-600 hover:text-blue-500 font-medium">
                        Continue Shopping <span aria-hidden="true"> &rarr;</span>
                    </a>
                </div>
            @else
                <form class="mt-12 lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start xl:gap-x-16">
                    <section aria-labelledby="cart-heading" class="lg:col-span-7">
                        <ul role="list" class="border-t border-b border-gray-200 divide-y divide-gray-200">
                            @foreach ($cartItems as $item)
                                <li class="flex py-6 sm:py-10">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}"
                                            class="w-24 h-24 rounded-md object-center object-cover sm:w-48 sm:h-48">
                                    </div>

                                    <div class="ml-4 flex-1 flex flex-col justify-between sm:ml-6">
                                        <div class="relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0">
                                            <div>
                                                <div class="flex justify-between">
                                                    <h3 class="text-sm">
                                                        <a href="#"
                                                            class="font-medium text-slate-700 hover:text-slate-800">
                                                            {{ $item->product->name }}
                                                        </a>
                                                    </h3>
                                                </div>
                                                <div class="mt-1 flex text-sm">
                                                    <p class="text-slate-500">{{ $item->product->category }}</p>
                                                </div>
                                                <p class="mt-1 text-sm font-medium text-slate-900">IDR
                                                    {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                            </div>

                                            <div class="mt-4 sm:mt-0 sm:pr-9">
                                                <label for="quantity-{{ $item->id }}" class="sr-only">Quantity,
                                                    {{ $item->product->name }}</label>
                                                <p class="text-slate-500">Qty: {{ $item->quantity }}</p>

                                                <div class="absolute top-0 right-0">
                                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="-m-2 p-2 inline-flex text-gray-400 hover:text-gray-500">
                                                            <span class="sr-only">Remove</span>
                                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                <path fill-rule="evenodd"
                                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </section>

                    <!-- Order summary -->
                    <section aria-labelledby="summary-heading"
                        class="mt-16 bg-slate-50 rounded-lg px-4 py-6 sm:p-6 lg:p-8 lg:mt-0 lg:col-span-5">
                        <h2 id="summary-heading" class="text-lg font-medium text-slate-900">Order summary</h2>

                        <dl class="mt-6 space-y-4">
                            <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                <dt class="text-base font-medium text-slate-900">Order total</dt>
                                <dd class="text-base font-medium text-slate-900">IDR
                                    {{ number_format($total, 0, ',', '.') }}</dd>
                            </div>
                        </dl>

                        <div class="mt-6">
                            <a href="{{ route('checkout.index') }}"
                                class="w-full bg-blue-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-blue-500 block text-center">Checkout</a>
                        </div>
                    </section>
                </form>
            @endif
        </div>
    </div>
</x-guest-layout>
