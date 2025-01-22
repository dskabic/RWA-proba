<form action="{{ url()->current() }}" method="GET" class="bg-gray-800 p-6 rounded-lg shadow-md space-y-4">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <!-- Min Price -->
        <div>
            <label for="min_price" class="block text-sm font-medium text-white">Min. Price</label>
            <input type="number" id="min_price" name="min_price" value="{{ request('min_price') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <!-- Max Price -->
        <div>
            <label for="max_price" class="block text-sm font-medium text-white">Max. Price</label>
            <input type="number" id="max_price" name="max_price" value="{{ request('max_price') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
    </div>

    <!-- Condition and Submit Button -->
    <fieldset class="space-y-2">
        <legend class="text-sm font-medium text-white">Condition</legend>
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="flex items-center">
                    <input type="radio" id="new" name="status" value="new" {{ request('status') == 'new' ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-500 focus:ring-blue-500 border-gray-300">
                    <label for="new" class="ml-2 text-sm text-white">New</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="used" name="status" value="used" {{ request('status') == 'used' ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-500 focus:ring-blue-500 border-gray-300">
                    <label for="used" class="ml-2 text-sm text-white">Used</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="old" name="status" value="old" {{ request('status') == 'old' ? 'checked' : '' }}
                    class="h-4 w-4 text-blue-500 focus:ring-blue-500 border-gray-300">
                    <label for="old" class="ml-2 text-sm text-white">Old</label>
                </div>
            </div>
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Apply Filters
            </button>
        </div>
    </fieldset>
</form>
