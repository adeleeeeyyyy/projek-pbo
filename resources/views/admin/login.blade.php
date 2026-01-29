<x-guest-layout>
    <div class="min-h-[calc(100vh-4rem)] flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-slate-50">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-slate-900">Sign in to Admin Panel</h2>
            <p class="mt-2 text-center text-sm text-slate-600">
                Or <a href="{{ route('home') }}" class="font-medium text-blue-600 hover:text-blue-500">return to
                    catalog</a>
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10 border border-slate-200">
                <form class="space-y-6" action="{{ route('admin.authenticate') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700">Email address</label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="block w-full appearance-none rounded-md border border-slate-300 px-3 py-2 placeholder-slate-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" autocomplete="current-password"
                                required
                                class="block w-full appearance-none rounded-md border border-slate-300 px-3 py-2 placeholder-slate-400 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>

                    @if($errors->any())
                        <div class="rounded-md bg-red-50 p-4">
                            <div class="flex">
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">
                                        {{ $errors->first() }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div>
                        <button type="submit"
                            class="flex w-full justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Sign
                            in</button>
                    </div>
                </form>
            </div>

            <div class="mt-6 text-center text-xs text-slate-400">
                <p>Default credentials: admin@beauty.com / password</p>
            </div>
        </div>
    </div>
</x-guest-layout>