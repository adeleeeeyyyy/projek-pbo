<x-guest-layout>
    <div class="bg-gray-50">
        <div class="max-w-2xl mx-auto pt-16 pb-24 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
            <h2 class="sr-only">Checkout</h2>

            <form action="{{ route('checkout.store') }}" method="POST"
                class="lg:grid lg:grid-cols-2 lg:gap-x-12 lg:items-start xl:gap-x-16">
                @csrf
                <div>
                    <div class="space-y-8">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900">Shipping Information</h2>

                            <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                                <div class="sm:col-span-2">
                                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                    <div class="mt-1">
                                        <textarea id="address" name="shipping_address" rows="3"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                            required placeholder="Enter your full delivery address">{{ old('shipping_address') }}</textarea>
                                    </div>
                                    @error('shipping_address')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div>
                            <h2 class="text-lg font-medium text-gray-900">Payment Method</h2>
                            <p class="text-sm text-slate-500 mt-1">Select how you would like to pay for your order.</p>

                            <div class="mt-4 grid grid-cols-1 gap-y-4">
                                <label class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none hover:border-blue-300 transition-colors">
                                    <input type="radio" name="payment_method" value="cod" class="mt-0.5 h-4 w-4 shrink-0 text-blue-600 border-slate-300 focus:ring-blue-500" {{ old('payment_method', 'cod') == 'cod' ? 'checked' : '' }}>
                                    <span class="ml-3 flex flex-col">
                                        <span class="block text-sm font-medium text-slate-900">Cash on Delivery (COD)</span>
                                        <span class="block text-sm text-slate-500">Pay when your order arrives.</span>
                                    </span>
                                </label>

                                <label class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none hover:border-blue-300 transition-colors">
                                    <input type="radio" name="payment_method" value="card" class="mt-0.5 h-4 w-4 shrink-0 text-blue-600 border-slate-300 focus:ring-blue-500" {{ old('payment_method') == 'card' ? 'checked' : '' }}>
                                    <span class="ml-3 flex flex-col">
                                        <span class="block text-sm font-medium text-slate-900">Credit / Debit Card</span>
                                        <span class="block text-sm text-slate-500">Secure payment via our encrypted gateway.</span>
                                    </span>
                                </label>
                            </div>
                            @error('payment_method')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    @foreach($cartItems as $item)
                        <input type="hidden" name="cart_item_ids[]" value="{{ $item->id }}">
                    @endforeach
                </div>

                <!-- Order summary -->
                <div class="mt-10 lg:mt-0">
                    <h2 class="text-lg font-medium text-gray-900">Order Summary</h2>

                    <div class="mt-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                        <ul role="list" class="divide-y divide-gray-200">
                            @foreach ($cartItems as $item)
                                <li class="flex py-6 px-4 sm:px-6">
                                    <div class="flex-shrink-0">
                                        <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}"
                                            class="w-20 h-20 rounded-md object-center object-cover">
                                    </div>

                                    <div class="ml-6 flex-1 flex flex-col">
                                        <div class="flex">
                                            <div class="min-w-0 flex-1">
                                                <h4 class="text-sm">
                                                    <a href="#" class="font-medium text-gray-700 hover:text-gray-800">
                                                        {{ $item->product->name }}
                                                    </a>
                                                </h4>
                                                <p class="mt-1 text-sm text-gray-500">{{ $item->product->category }}</p>
                                            </div>
                                        </div>

                                        <div class="flex-1 pt-2 flex items-end justify-between">
                                            <p class="mt-1 text-sm font-medium text-gray-900">IDR
                                                {{ number_format($item->product->price, 0, ',', '.') }} x
                                                {{ $item->quantity }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <dl class="border-t border-gray-200 py-6 px-4 space-y-6 sm:px-6">
                            <div class="flex items-center justify-between">
                                <dt class="text-base font-medium text-gray-900">Total</dt>
                                <dd class="text-base font-medium text-gray-900">IDR
                                    {{ number_format($total, 0, ',', '.') }}
                                </dd>
                            </div>
                        </dl>

                        <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
                            <button type="submit"
                                class="w-full bg-blue-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-blue-500">Confirm
                                Order</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>