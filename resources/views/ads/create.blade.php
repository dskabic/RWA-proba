<x-layout>
    <x-slot:heading>Ads page</x-slot:heading>
    <h1>Create an ad</h1>
    <form action="/ads" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <input type="text" name="title" id="title" class="block min-w-0 grow py-3 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="Enter the title" required>
                            </div>
                            @error('title')
                            <p>{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-span-full">
                            <label for="about" class="block text-sm/6 font-medium text-gray-900">Description</label>
                            <div class="mt-2">
                                <textarea name="description" id="description" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required></textarea>
                            </div>
                            @error('description')
                            <p>{{$message}}</p>
                            @enderror
                            <p class="mt-3 text-sm/6 text-gray-600">Write a few sentences about product.</p>
                        </div>



                        <div class="col-span-full">
                            <label for="image" class="block text-sm/6 font-medium text-gray-900">Images</label>
                            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                <div class="text-center">
                                    <img id="image-preview" class="mx-auto mb-4 hidden size-24 rounded-md" alt="Image Preview" />
                                    <svg id="icon-placeholder" class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                                    </svg>
                                    <div class="mt-4 flex text-sm/6 text-gray-600">
                                        <label for="image" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                            <span>Upload images</span>
                                            <input id="image" name="image[]" type="file" class="sr-only" accept="image/*">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base/7 font-semibold text-gray-900">Personal Information</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Enter the location and important information about your product.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <div class="sm:col-span-2 sm:col-start-1">
                            <label for="city" class="block text-sm/6 font-medium text-gray-900">City</label>
                            <div class="mt-2">
                                <input type="text" name="city" id="city" autocomplete="address-level2" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required>
                            </div>
                            @error('city')
                            <p>{{$message}}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="province" class="block text-sm/6 font-medium text-gray-900">State / Province</label>
                            <div class="mt-2">
                                <input type="text" name="province" id="province" autocomplete="address-level1" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required>
                            </div>
                            @error('province')
                            <p>{{$message}}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="postal_code" class="block text-sm/6 font-medium text-gray-900">ZIP / Postal code</label>
                            <div class="mt-2">
                                <input type="text" name="postal_code" id="postal_code" autocomplete="postal_code" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required>
                            </div>
                            @error('postal_code')
                            <p>{{$message}}</p>
                            @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="price" class="block text-sm/6 font-medium text-gray-900">Price</label>
                            <div class="mt-2">
                                <input type="number" name="price" id="price" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required>
                            </div>
                            @error('price')
                            <p>{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <input type="radio" id="new" name="state" value="new" required/>
                        <label for="new">New</label>

                        <input type="radio" id="used" name="state" value="used" required/>
                        <label for="used">Used</label>

                        <input type="radio" id="old" name="state" value="old" required/>
                        <label for="old">Old</label>
                    </div>
                    @error('state')
                    <p>{{$message}}</p>
                    @enderror

                    <div>
                        <input type="radio" id="cars" name="category" value="cars" required/>
                        <label for="new">Cars</label>

                        <input type="radio" id="electronics" name="category" value="electronics" required/>
                        <label for="used">Electronics</label>

                        <input type="radio" id="hardware" name="category" value="hardware" required/>
                        <label for="old">Hardware</label>
                    </div>
                    @error('category')
                    <p>{{$message}}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/ads" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
    </form>
    <script>
        document.getElementById('image').addEventListener('change', function (event) {
            const file = event.target.files[0]; // Get the selected file
            const preview = document.getElementById('image-preview');
            const placeholder = document.getElementById('icon-placeholder');

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result; // Set the preview source
                    preview.classList.remove('hidden'); // Show the preview
                    placeholder.classList.add('hidden'); // Hide the placeholder
                };

                reader.readAsDataURL(file); // Read the file as a data URL
            } else {
                preview.src = ''; // Clear the preview source
                preview.classList.add('hidden'); // Hide the preview
                placeholder.classList.remove('hidden'); // Show the placeholder
            }
        });

    </script>

</x-layout>
