<x-layout>
    <x-slot:heading>Ads page</x-slot:heading>
    <div class="space-y-4">
        @foreach($ads as $ad)
            <a class="flex items-center p-4 bg-white shadow-md rounded-lg hover:border-blue-500 hover:border-2"
               href="/ads/{{$ad['id']}}">

                <!-- Ad Image -->
                @if($ad->images->isNotEmpty())
                    <div class="flex-shrink-0 w-1/3">
                        <img src="{{ Storage::url($ad->images->first()->path) }}"
                             alt="Image for {{ $ad->title }}"
                             class="w-full h-40 object-cover rounded-l-lg">
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
                    <!-- Title -->
                    <div class="font-bold text-xl text-blue-500">
                        {{ $ad->title }}
                    </div>

                    <!-- User Info -->
                    <p class="text-gray-600">
                        Posted by: {{ $ad->user->first_name }}
                    </p>

                    <!-- Description -->
                    <p class="text-gray-500 mt-2">
                        {{ Str::limit($ad->description, 100) }}
                    </p>

                    <!-- Location -->
                    <p class="text-gray-400 text-sm mt-2">
                        {{ $ad->city }}, {{ $ad->province }} ({{ $ad->postal_code }})
                    </p>

                    <!-- Category and State -->
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
