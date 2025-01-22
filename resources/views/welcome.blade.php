<x-layout>
    <x-slot:heading>Welcome to our Second Hand Shop</x-slot:heading>

    <!-- Top Cards Section -->

    <h2 class="text-2xl font-bold mb-6">Popular Categories</h2>
    <div class="grid grid-cols-4 gap-4 mb-6">
        <a href="/ads" class="rounded-lg overflow-hidden shadow-md hover:scale-105 transition-transform hover:border-blue-500 hover:border-2">
            <div class="relative w-full h-48">
                <img src="https://cdn-icons-png.flaticon.com/512/3867/3867208.png"
                     alt="Image for General Ads"
                     class="absolute inset-0 w-full h-full object-contain rounded-lg">
            </div>
        </a>
        <a href="/ads/category/cars" class="rounded-lg overflow-hidden shadow-md hover:scale-105 transition-transform hover:border-blue-500 hover:border-2">
            <div class="relative w-full h-48">
                <img src="https://cdn-icons-png.flaticon.com/512/55/55283.png"
                     alt="Image for Car Ads"
                     class="absolute inset-0 w-full h-full object-contain rounded-lg">
            </div>
        </a>
        <a href="/ads/category/electronics" class="rounded-lg overflow-hidden shadow-md hover:scale-105 transition-transform hover:border-blue-500 hover:border-2">
            <div class="relative w-full h-48">
                <img src="https://static.thenounproject.com/png/1180247-200.png"
                     alt="Image for Electronics Ads"
                     class="absolute inset-0 w-full h-full object-contain rounded-lg">
            </div>
        </a>

        <a href="/ads/category/hardware" class="rounded-lg overflow-hidden shadow-md hover:scale-105 transition-transform hover:border-blue-500 hover:border-2">
            <div class="relative w-full h-48">
                <img src="https://images.freeimages.com/fic/images/icons/1580/devine_icons_part_2/512/device_and_hardware.png"
                     alt="Image for Hardware Ads"
                     class="absolute inset-0 w-full h-full object-contain rounded-lg">
            </div>
        </a>
    </div>

    <!-- Main Content Section -->
    <h2 class="text-2xl font-bold mb-6">Recent Ads</h2>
    <div class="space-y-4">
        @foreach($ads as $ad)
            <a class="flex items-center p-4 bg-white shadow-md rounded-lg hover:border-blue-500 hover:border-2"
               href="/ads/{{$ad['id']}}">

                <!-- Ad Image -->
                @if($ad->images->isNotEmpty())
                    <div class="flex-shrink-0 w-1/3">
                        <img src="{{ Storage::url($ad->images->first()->path) }}"
                             alt="Image for {{ $ad->title }}"
                             class="w-full h-40 object-cover rounded-lg">
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
</x-layout>
