<x-admin-layout>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-slate-900">Edit Product</h3>
                <p class="mt-1 text-sm text-slate-600">Update the details of the product.</p>
            </div>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="shadow sm:overflow-hidden sm:rounded-md">
                    @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4 mx-4 mt-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="name" class="block text-sm font-medium text-slate-700">Product Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                                    required
                                    class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="category" class="block text-sm font-medium text-slate-700">Category</label>
                                <select id="category" name="category"
                                    class="mt-1 block w-full rounded-md border border-slate-300 bg-white py-2 px-3 shadow-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm">
                                    <option {{ old('category', $product->category) == 'Skincare' ? 'selected' : '' }}>
                                        Skincare</option>
                                    <option {{ old('category', $product->category) == 'Makeup' ? 'selected' : '' }}>Makeup
                                    </option>
                                    <option {{ old('category', $product->category) == 'Lips' ? 'selected' : '' }}>Lips
                                    </option>
                                    <option {{ old('category', $product->category) == 'Eyes' ? 'selected' : '' }}>Eyes
                                    </option>
                                    <option {{ old('category', $product->category) == 'Face' ? 'selected' : '' }}>Face
                                    </option>
                                    <option {{ old('category', $product->category) == 'Body' ? 'selected' : '' }}>Body
                                    </option>
                                </select>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="price_mask" class="block text-sm font-medium text-slate-700">Price (IDR)</label>
                                <div class="relative mt-1 rounded-md shadow-sm">
                                    <input type="text" id="price_mask"
                                        value="{{ number_format(old('price', $product->price), 0, ',', '.') }}" required
                                        class="block w-full rounded-md border-slate-300 pl-3 focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    <input type="hidden" name="price" id="price" value="{{ old('price', $product->price) }}">
                                </div>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="stock" class="block text-sm font-medium text-slate-700">Stock
                                    Quantity</label>
                                <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}"
                                    required
                                    class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            </div>

                            <div class="col-span-6">
                                <label class="block text-sm font-medium text-slate-700">Product Image</label>
                                <div class="mt-1 flex flex-col space-y-4">
                                    @if($product->image_url)
                                        <div class="flex items-center space-x-4">
                                            <img src="{{ $product->image_url }}" alt="Current Image"
                                                class="h-20 w-20 object-cover rounded-md">
                                            <span class="text-sm text-slate-500">Current Image</span>
                                        </div>
                                    @endif
                                    <div>
                                        <label for="image_file" class="block text-xs text-slate-500">Upload New
                                            File</label>
                                        <input type="file" name="image_file" id="image_file" accept="image/*"
                                            class="mt-1 block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    </div>
                                    <div class="relative flex items-center">
                                        <div class="flex-grow border-t border-gray-300"></div>
                                        <span class="flex-shrink-0 mx-4 text-gray-400 text-xs">OR</span>
                                        <div class="flex-grow border-t border-gray-300"></div>
                                    </div>
                                    <div>
                                        <label for="image_url" class="block text-xs text-slate-500">Image URL</label>
                                        <input type="url" name="image_url" id="image_url"
                                            value="{{ old('image_url', $product->image_url) }}"
                                            class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                            placeholder="https://example.com/image.jpg">
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label for="description"
                                    class="block text-sm font-medium text-slate-700">Description</label>
                                <div class="mt-1">
                                    <textarea id="description" name="description" rows="3" required
                                        class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('description', $product->description) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                        <button type="submit"
                            class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Update
                            Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>