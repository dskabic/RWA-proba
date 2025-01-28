<x-layout>
    <x-slot:heading>
        @if($category)
            Category: {{ ucfirst($category) }}
        @else
            Ads page
        @endif
    </x-slot:heading>
    <div class="space-y-4">
        <!-- Filter Icon -->
        <div class="flex justify-end mb-4">
            <button
                id="toggleFilterButton"
                class="p-2 rounded-full bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300"
                aria-label="Toggle filter form">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 9a1 1 0 011-1h10a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zm14-7a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 01-1 1h-2a1 1 0 01-1-1V6z" />
                </svg>
            </button>
        </div>

        <!-- Filter Form -->
        <div id="filterForm" class=" bg-white shadow-md rounded-lg border border-gray-200 hidden">
            <x-form-filter />
        </div>

        <!-- Ads Listing -->
        @foreach($ads as $ad)
            <a class="flex items-center p-4 bg-white shadow-md rounded-lg hover:border-blue-500 hover:border-2"
               href="/ads/{{$ad['id']}}">

                <!-- Ad Image -->
                @if($ad->images->isNotEmpty())
                    <div class="flex-shrink-0 w-1/3">
                        <img src="{{ Storage::url($ad->images->first()->path) }}"
                             alt="Image for {{ $ad->title }}"
                             class="w-full h-40 object-contain rounded-lg">
                    </div>
                @else
                    <div class="flex-shrink-0 w-1/3">
                        <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-500">
                            No Image
                        </div>
                    </div>
                @endif

                <!-- Ad Details -->
                <div class="flex-1 pl-4">
                    <div class="font-bold text-xl text-blue-500">
                        {{ $ad->title }}
                    </div>
                    <p class="text-gray-600 mt-2">
                        Posted by: {{ $ad->user->first_name }} {{ $ad->user->last_name }}
                    </p>
                    <p class="text-gray-500 mt-2">
                        {{ Str::limit($ad->description, 100) }}
                    </p>
                    <p class="text-gray-400 text-sm mt-2">
                        Location: {{ $ad->city }}, {{ $ad->province }} ({{ $ad->postal_code }})
                    </p>
                    <p class="text-gray-400 text-sm mt-2">
                        Category: {{ ucfirst($ad->category) }} | State: {{ ucfirst($ad->state) }}
                    </p>
                </div>

                <!-- Price -->
                <div class="text-lg font-bold text-indigo-600 self-end pr-4">
                    ${{ number_format($ad->price, 2) }}
                </div>
            </a>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $ads->links() }}
    </div>
</x-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButton = document.getElementById('toggleFilterButton');
        const filterForm = document.getElementById('filterForm');

        toggleButton.addEventListener('click', function () {
            // Toggle the visibility of the filter form
            if (filterForm.classList.contains('hidden')) {
                filterForm.classList.remove('hidden');
                filterForm.classList.add('block');
            } else {
                filterForm.classList.remove('block');
                filterForm.classList.add('hidden');
            }
        });
    });
</script>
