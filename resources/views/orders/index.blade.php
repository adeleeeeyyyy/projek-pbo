<x-guest-layout>
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:pb-24 lg:px-8">
            <div class="max-w-xl">
                <h1 class="text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">Order History</h1>
                <p class="mt-2 text-sm text-slate-500">Check the status of recent orders, manage returns, and download
                    invoices.</p>
            </div>

            <div class="mt-16">
                <h2 class="sr-only">Recent orders</h2>

                <div class="space-y-20">
                    @foreach ($orders as $order)
                                    <div>
                                        <div
                                            class="bg-gray-50 rounded-lg py-6 px-4 sm:px-6 sm:flex sm:items-center sm:justify-between sm:space-x-6 lg:space-x-8">
                                            <dl
                                                class="divide-y divide-gray-200 space-y-6 text-sm text-slate-600 flex-auto sm:divide-y-0 sm:space-y-0 sm:grid sm:grid-cols-3 sm:gap-x-6 lg:w-1/2 lg:flex-none lg:gap-x-8">
                                                <div class="flex justify-between sm:block">
                                                    <dt class="font-medium text-slate-900">Date placed</dt>
                                                    <dd class="sm:mt-1">
                                                        <time
                                                            datetime="{{ $order->created_at->format('Y-m-d') }}">{{ $order->created_at->format('M d, Y') }}</time>
                                                    </dd>
                                                </div>
                                                <div class="flex justify-between pt-6 sm:block sm:pt-0">
                                                    <dt class="font-medium text-slate-900">Order number</dt>
                                                    <dd class="sm:mt-1">#{{ $order->id }}</dd>
                                                </div>
                                                <div class="flex justify-between pt-6 font-medium text-slate-900 sm:block sm:pt-0">
                                                    <dt>Total amount</dt>
                                                    <dd class="sm:mt-1">IDR {{ number_format($order->total_price, 0, ',', '.') }}
                                                    </dd>
                                                </div>
                                                <div class="flex justify-between pt-6 sm:block sm:pt-0">
                                                    <dt class="font-medium text-slate-900">Payment</dt>
                                                    <dd class="sm:mt-1">{{ strtoupper($order->payment_method) }}</dd>
                                                </div>
                                            </dl>
                                            <div class="flex items-center space-x-4 mt-6 sm:mt-0">
                                                <div class="flex items-center">
                                                    <dt class="font-medium text-slate-900 mr-2">Status:</dt>
                                                    <dd class="inline-flex rounded-full px-3 py-1 text-xs font-semibold
                                                                            {{ $order->status === 'completed'
                        ? 'bg-green-100 text-green-800'
                        : ($order->status === 'cancelled'
                            ? 'bg-red-100 text-red-800'
                            : ($order->status === 'shipping'
                                ? 'bg-blue-100 text-blue-800'
                                : ($order->status === 'packing'
                                    ? 'bg-yellow-100 text-yellow-800'
                                    : 'bg-gray-100 text-gray-800'))) }}">
                                                        {{ ucfirst($order->status) }}
                                                    </dd>
                                                </div>
                                            </div>
                                        </div>

                                        <table class="mt-4 w-full text-gray-500 sm:mt-6">
                                            <caption class="sr-only">
                                                Products
                                            </caption>
                                            <thead class="sr-only text-sm text-gray-500 text-left sm:not-sr-only">
                                                <tr>
                                                    <th scope="col" class="sm:w-2/5 lg:w-1/3 pr-8 py-3 font-normal">Product</th>
                                                    <th scope="col" class="hidden w-1/5 pr-8 py-3 font-normal sm:table-cell">Price
                                                    </th>
                                                    <th scope="col" class="hidden pr-8 py-3 font-normal sm:table-cell">Status</th>
                                                    <th scope="col" class="w-0 py-3 font-normal text-right">Info</th>
                                                </tr>
                                            </thead>
                                            <tbody class="border-b border-gray-200 divide-y divide-gray-200 text-sm sm:border-t">
                                                @foreach ($order->items as $item)
                                                    <tr>
                                                        <td class="py-6 pr-8">
                                                            <div class="flex items-center">
                                                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}"
                                                                    class="w-16 h-16 object-center object-cover rounded mr-6">
                                                                <div>
                                                                    <div class="font-medium text-gray-900">{{ $item->product->name }}
                                                                    </div>
                                                                    <div class="mt-1 sm:hidden">IDR
                                                                        {{ number_format($item->price, 0, ',', '.') }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="hidden py-6 pr-8 sm:table-cell">IDR
                                                            {{ number_format($item->price, 0, ',', '.') }}
                                                        </td>
                                                        <td class="hidden py-6 pr-8 sm:table-cell">{{ ucfirst($order->status) }}
                                                        </td>
                                                        <td class="py-6 font-medium text-right whitespace-nowrap">
                                                            <a href="{{ route('products.show', $item->product->id) }}"
                                                                class="text-blue-600 hover:text-blue-500">View<span
                                                                    class="hidden lg:inline"> Product</span><span class="sr-only">,
                                                                    {{ $item->product->name }}</span></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>