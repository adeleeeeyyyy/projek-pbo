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
                <div class="mt-12 lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start xl:gap-x-16">
                    <section aria-labelledby="cart-heading" class="lg:col-span-7">
                        <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                            <div class="flex items-center">
                                <input type="checkbox" id="select-all" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer" onchange="toggleSelectAll(this)">
                                <label for="select-all" class="ml-2 text-sm text-slate-600 cursor-pointer">Select All</label>
                            </div>
                        </div>

                        {{-- Hidden forms for updates and deletion to avoid nesting --}}
                        @foreach ($cartItems as $item)
                            <form id="update-minus-{{ $item->id }}" action="{{ route('cart.update', $item->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                            </form>
                            <form id="update-plus-{{ $item->id }}" action="{{ route('cart.update', $item->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                            </form>
                            <form id="delete-form-{{ $item->id }}" action="{{ route('cart.destroy', $item->id) }}" method="POST" class="hidden">
                                @csrf
                                @method('DELETE')
                            </form>
                        @endforeach

                        <form id="checkout-form" action="{{ route('checkout.index') }}" method="GET">
                            <ul role="list" class="divide-y divide-gray-200">
                                @foreach ($cartItems as $item)
                                    <li class="flex py-6 sm:py-10 items-center">
                                        <div class="mr-4">
                                            <input type="checkbox" name="selected_items[]" value="{{ $item->id }}" 
                                                class="item-checkbox h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer" 
                                                checked onchange="updateTotal()">
                                        </div>
                                        <div class="flex-shrink-0">
                                            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}"
                                                class="w-24 h-24 rounded-md object-center object-cover sm:w-32 sm:h-32">
                                        </div>

                                        <div class="ml-4 flex-1 flex flex-col justify-between sm:ml-6">
                                            <div class="relative pr-9">
                                                <div>
                                                    <div class="flex justify-between">
                                                        <h3 class="text-sm">
                                                            <a href="#" class="font-medium text-slate-700 hover:text-slate-800">
                                                                {{ $item->product->name }}
                                                            </a>
                                                        </h3>
                                                    </div>
                                                    <p class="mt-1 text-sm text-slate-500">{{ $item->product->category }}</p>
                                                    <p class="mt-1 text-sm font-medium text-slate-900" data-price="{{ $item->product->price }}">IDR
                                                        {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                                </div>

                                                <div class="mt-4 flex items-center space-x-3">
                                                    <div class="flex items-center border border-slate-200 rounded-md">
                                                        <button type="submit" form="update-minus-{{ $item->id }}" @disabled($item->quantity <= 1) 
                                                            class="p-1 px-2 hover:bg-slate-50 text-slate-500 @if($item->quantity <= 1) opacity-50 cursor-not-allowed @endif">
                                                            -
                                                        </button>
                                                        
                                                        <span class="px-3 text-sm font-medium text-slate-900">{{ $item->quantity }}</span>
                                                        
                                                        <button type="submit" form="update-plus-{{ $item->id }}" class="p-1 px-2 hover:bg-slate-50 text-slate-500">
                                                            +
                                                        </button>
                                                    </div>

                                                    <button type="submit" form="delete-form-{{ $item->id }}" 
                                                        class="text-xs text-red-500 hover:text-red-700 font-medium">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </form>
                    </section>

                    <!-- Order summary -->
                    <section aria-labelledby="summary-heading"
                        class="mt-16 bg-slate-50 rounded-lg px-4 py-6 sm:p-6 lg:p-8 lg:mt-0 lg:col-span-5 border border-slate-100">
                        <h2 id="summary-heading" class="text-lg font-medium text-slate-900">Order summary</h2>

                        <dl class="mt-6 space-y-4">
                            <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                <dt class="text-base font-medium text-slate-900">Selected total</dt>
                                <dd class="text-base font-medium text-slate-900" id="cart-total">IDR
                                    {{ number_format($total, 0, ',', '.') }}</dd>
                            </div>
                        </dl>

                        <div class="mt-6">
                            <button type="submit" form="checkout-form"
                                class="w-full bg-blue-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-blue-500 transition-all active:scale-[0.98]">
                                Proceed to Checkout
                            </button>
                        </div>
                    </section>
                </div>

                <script>
                    function toggleSelectAll(source) {
                        checkboxes = document.getElementsByClassName('item-checkbox');
                        for (var i = 0; i < checkboxes.length; i++) {
                            checkboxes[i].checked = source.checked;
                        }
                        updateTotal();
                    }

                    function updateTotal() {
                        let total = 0;
                        const items = document.querySelectorAll('li.flex');
                        items.forEach(item => {
                            const checkbox = item.querySelector('.item-checkbox');
                            if (checkbox.checked) {
                                const priceText = item.querySelector('[data-price]').getAttribute('data-price');
                                const qty = parseInt(item.querySelector('span.px-3').innerText);
                                total += parseFloat(priceText) * qty;
                            }
                        });
                        document.getElementById('cart-total').innerText = 'IDR ' + new Intl.NumberFormat('id-ID').format(total);
                    }
                </script>
            @endif
        </div>
    </div>
</x-guest-layout>
