<x-layout>
    <x-slot:heading>Ads page</x-slot:heading>
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8">
    <h1 class="text-center text-2xl font-bold">Create an Ad</h1>
    <form action="/ads" method="POST" enctype="multipart/form-data" class="max-w-2xl mx-auto">
        @csrf
        <div class="space-y-8">
            <div class="border-b border-gray-900/10 pb-6">
                <div class="grid grid-cols-1 gap-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-900">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full rounded-md border-gray-300 py-2 px-3 text-gray-900 placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter the title" required>
                        <x-form-error name="title"/>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-900">Description</label>
                        <textarea name="description" id="description" rows="3" class="w-full rounded-md border-gray-300 py-2 px-3 text-gray-900 placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Write a few sentences about the product." required>{{ old('description') }}</textarea>
                        <x-form-error name="description"/>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-900">Images</label>
                        <div id="image-container" class="mt-2 flex flex-col gap-4">
                            <!-- Dynamic image inputs and previews will be added here -->
                        </div>
                        <button type="button" id="add-image-btn" class="mt-4 rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-500">Add Image</button>
                        <x-form-error name="image"/>
                    </div>
                </div>
            </div>

            <div class="border-b border-gray-900/10 pb-6">
                <h2 class="text-base font-semibold text-gray-900">Personal Information</h2>
                <p class="mt-1 text-sm text-gray-600">Enter the location and important information about your product.</p>
                <div class="grid grid-cols-1 gap-y-4">
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-900">City</label>
                        <input type="text" name="city" id="city" value="{{ old('city') }}" class="w-full rounded-md border-gray-300 py-2 px-3 text-gray-900 placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500" required>
                        <x-form-error name="city"/>
                    </div>

                    <div>
                        <label for="province" class="block text-sm font-medium text-gray-900">State / Province</label>
                        <input type="text" name="province" id="province" value="{{ old('province') }}" class="w-full rounded-md border-gray-300 py-2 px-3 text-gray-900 placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500" required>
                        <x-form-error name="province"/>
                    </div>

                    <div>
                        <label for="postal_code" class="block text-sm font-medium text-gray-900">ZIP / Postal Code</label>
                        <input type="text" name="postal_code" id="postal_code" value="{{ old('postal_code') }}" class="w-full rounded-md border-gray-300 py-2 px-3 text-gray-900 placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500" required>
                        <x-form-error name="postal_code"/>
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-900">Price</label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" class="w-full rounded-md border-gray-300 py-2 px-3 text-gray-900 placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500" required>
                        <x-form-error name="price"/>
                    </div>

                    <div>
                        <fieldset>
                            <legend class="block text-sm font-medium text-gray-900">Condition</legend>
                            <div class="mt-2 space-y-2">
                                <div>
                                    <input type="radio" id="new" name="state" value="new"  {{ old('state') == 'new' ? 'checked' : '' }} required>
                                    <label for="new" class="ml-2 text-sm text-gray-900">New</label>
                                </div>
                                <div>
                                    <input type="radio" id="used" name="state" value="used" {{ old('state') == 'used' ? 'checked' : '' }} required>
                                    <label for="used" class="ml-2 text-sm text-gray-900">Used</label>
                                </div>
                                <div>
                                    <input type="radio" id="old" name="state" value="old" {{ old('state') == 'old' ? 'checked' : '' }} required>
                                    <label for="old" class="ml-2 text-sm text-gray-900">Old</label>
                                </div>
                            </div>
                        </fieldset>
                        <x-form-error name="state"/>
                    </div>

                    <div>
                        <fieldset>
                            <legend class="block text-sm font-medium text-gray-900">Category</legend>
                            <div class="mt-2 space-y-2">
                                <div>
                                    <input type="radio" id="cars" name="category" value="cars" {{ old('category') == 'cars' ? 'checked' : '' }} required>
                                    <label for="cars" class="ml-2 text-sm text-gray-900">Cars</label>
                                </div>
                                <div>
                                    <input type="radio" id="electronics" name="category" value="electronics" {{ old('category') == 'electronics' ? 'checked' : '' }} required>
                                    <label for="electronics" class="ml-2 text-sm text-gray-900">Electronics</label>
                                </div>
                                <div>
                                    <input type="radio" id="hardware" name="category" value="hardware" {{ old('category') == 'hardware' ? 'checked' : '' }} required>
                                    <label for="hardware" class="ml-2 text-sm text-gray-900">Hardware</label>
                                </div>
                            </div>
                        </fieldset>
                        <x-form-error name="category"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-4">
            <a href="/ads" class="text-sm font-semibold text-gray-900">Cancel</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus:ring-2 focus:ring-indigo-500">Save</button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const imageContainer = document.getElementById('image-container');
            const addImageBtn = document.getElementById('add-image-btn');
            let imageCount = 0;

            addImageBtn.addEventListener('click', () => {
                if (imageCount < 3) {
                    addImageInput();
                }
            });

            function addImageInput() {
                const inputWrapper = document.createElement('div');
                inputWrapper.className = 'relative';

                const input = document.createElement('input');
                input.type = 'file';
                input.name = `image[]`;
                input.accept = 'image/*';
                input.className = 'block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border file:border-gray-300 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100';

                const previewWrapper = document.createElement('div');
                previewWrapper.className = 'flex items-center gap-2 mt-2';

                const img = document.createElement('img');
                img.className = 'w-24 h-24 rounded-md';
                img.style.display = 'none';

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'absolute top-0 right-0 text-red-500 text-sm font-semibold';
                removeBtn.style.display = 'none';
                removeBtn.textContent = 'Remove';

                removeBtn.addEventListener('click', () => {
                    imageContainer.removeChild(inputWrapper);
                    imageCount--;
                    toggleAddButtonVisibility();
                });

                input.addEventListener('change', function (event) {
                    const file = event.target.files[0];

                    if (file) {
                        const reader = new FileReader();

                        reader.onload = function (e) {
                            img.src = e.target.result;
                            img.style.display = 'block';
                            removeBtn.style.display = 'inline';

                            // Hide the file input after an image is selected
                            input.style.display = 'none';

                            toggleAddButtonVisibility();
                        };

                        reader.readAsDataURL(file);
                    }
                });

                previewWrapper.appendChild(img);
                previewWrapper.appendChild(removeBtn);

                inputWrapper.appendChild(input);
                inputWrapper.appendChild(previewWrapper);

                imageContainer.appendChild(inputWrapper);

                imageCount++;
                toggleAddButtonVisibility();
            }

            function toggleAddButtonVisibility() {
                addImageBtn.style.display = imageCount < 3 ? 'block' : 'none';
            }

            // Initialize button visibility
            toggleAddButtonVisibility();
        });
    </script>
    </div>
</x-layout>
