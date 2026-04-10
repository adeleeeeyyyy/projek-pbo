<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-slate-900">Dashboard Overview</h1>
        <p class="text-slate-500">Welcome back, Admin. Here's what's happening with your store.</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Card 1 -->
        <div class="bg-white overflow-hidden shadow rounded-lg border border-slate-200">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-blue-100 rounded-md p-3">
                            <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-slate-500 truncate">Total Products</dt>
                            <dd class="text-3xl font-semibold text-slate-900">{{ $totalProducts }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-slate-50 px-5 py-3">
                <div class="text-sm">
                    <a href="{{ route('admin.products.index') }}"
                        class="font-medium text-blue-700 hover:text-blue-900">View all</a>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white overflow-hidden shadow rounded-lg border border-slate-200">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-green-100 rounded-md p-3">
                            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-slate-500 truncate">Total Revenue</dt>
                            <dd class="text-3xl font-semibold text-slate-900">IDR
                                {{ number_format($totalRevenue, 0, ',', '.') }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-slate-50 px-5 py-3">
                <div class="text-sm">
                    <span class="text-slate-500">From paid orders</span>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white overflow-hidden shadow rounded-lg border border-slate-200">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-purple-100 rounded-md p-3">
                            <svg class="h-6 w-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-slate-500 truncate">Total Users</dt>
                            <dd class="text-3xl font-semibold text-slate-900">
                                {{ $totalUsers }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="bg-slate-50 px-5 py-3">
                <div class="text-sm">
                    <span class="text-slate-500">Registered users</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity / Quick Actions -->
    <div class="mt-8">
        <h2 class="text-lg font-medium leading-6 text-slate-900">Quick Actions</h2>
        <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <a href="{{ route('admin.products.create') }}"
                class="relative block rounded-lg border border-slate-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-slate-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 hover:bg-slate-50 transition-colors">
                <div class="flex-shrink-0">
                    <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-blue-100">
                        <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </span>
                </div>
                <div class="flex-1 min-w-0">
                    <span class="absolute inset-0" aria-hidden="true"></span>
                    <p class="text-sm font-medium text-slate-900">Add New Product</p>
                    <p class="text-sm text-slate-500 truncate">Create a new listing in catalog</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Additional Information -->
    <div class="mt-8">
        <h2 class="text-lg font-medium leading-6 text-slate-900">Additional Information</h2>
        <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <a href="{{ route('guest.about') }}"
                class="relative block rounded-lg border border-slate-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-slate-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 hover:bg-slate-50 transition-colors">
                <div class="flex-shrink-0">
                    <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-green-100">
                        <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h11M9 21V3m0 0l-6 6m6-6l6 6" />
                        </svg>
                    </span>
                </div>
                <div class="flex-1 min-w-0">
                    <span class="absolute inset-0" aria-hidden="true"></span>
                    <p class="text-sm font-medium text-slate-900">About</p>
                    <p class="text-sm text-slate-500 truncate">Learn more about our platform</p>
                </div>
            </a>

            <a href="{{ route('guest.contact') }}"
                class="relative block rounded-lg border border-slate-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-slate-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 hover:bg-slate-50 transition-colors">
                <div class="flex-shrink-0">
                    <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-purple-100">
                        <svg class="h-6 w-6 text-purple-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 8c0-1.657-1.343-3-3-3S10 6.343 10 8s1.343 3 3 3 3 1.343 3 3-1.343 3-3 3" />
                        </svg>
                    </span>
                </div>
                <div class="flex-1 min-w-0">
                    <span class="absolute inset-0" aria-hidden="true"></span>
                    <p class="text-sm font-medium text-slate-900">Contact</p>
                    <p class="text-sm text-slate-500 truncate">Get in touch with us</p>
                </div>
            </a>
        </div>
    </div>
</x-admin-layout>