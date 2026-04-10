<x-admin-layout>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-slate-900">Orders</h1>
                <p class="mt-2 text-sm text-slate-700">A list of all orders including customer, shipment details, and
                    current status.</p>
            </div>
        </div>
        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 sm:pl-6">
                                        Order ID</th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Customer</th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Total</th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Date</th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Payment</th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Status</th>
                                    <th scope="col"
                                        class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($orders as $order)
                                    <tr>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-slate-900 sm:pl-6">
                                            #{{ $order->id }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                                            {{ $order->user->name }}
                                            <div class="text-xs text-slate-400">{{ $order->user->email }}</div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                                            IDR {{ number_format($order->total_price, 0, ',', '.') }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                                            {{ $order->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                                            {{ strtoupper($order->payment_method) }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                                            <span
                                                class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 
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
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500">
                                            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" onchange="this.form.submit()"
                                                    class="mt-1 block w-full rounded-md border-gray-300 py-1 pl-3 pr-10 text-base focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm">
                                                    <option value="pending"
                                                        {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                                    </option>
                                                    <option value="packing"
                                                        {{ $order->status == 'packing' ? 'selected' : '' }}>Packing
                                                    </option>
                                                    <option value="shipping"
                                                        {{ $order->status == 'shipping' ? 'selected' : '' }}>Shipping
                                                    </option>
                                                    <option value="completed"
                                                        {{ $order->status == 'completed' ? 'selected' : '' }}>Completed
                                                    </option>
                                                    <option value="cancelled"
                                                        {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled
                                                    </option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
