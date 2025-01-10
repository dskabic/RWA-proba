<x-layout>
    <x-slot:heading>{{ $ad->title }}</x-slot:heading>

    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 space-y-6">
        <!-- Title and User -->
        <h1 class="text-2xl font-bold">{{ $ad->title }}</h1>
        <p class="text-gray-500">Posted by: {{ $ad->user->first_name }}</p>

        <!-- Description -->
        <p class="text-gray-700">{{ $ad->description }}</p>

        <!-- Location -->
        <p class="text-sm text-gray-500">
            Location: {{ $ad->city }}, {{ $ad->province }} ({{ $ad->postal_code }})
        </p>

        <!-- Price -->
        <p class="text-lg font-semibold text-green-600">
            Price: ${{ number_format($ad->price, 2) }}
        </p>

        <!-- Category and State -->
        <p class="text-sm text-gray-500">
            Category: {{ ucfirst($ad->category) }} | State: {{ ucfirst($ad->state) }}
        </p>
        <p class="text-gray-700">{{ $ad->user->first_name }} {{$ad->user->last_name}}</p>

        <!-- Images -->
        @if($ad->images->isNotEmpty())
            <div class="grid grid-cols-3 gap-4">
                @foreach($ad->images as $image)
                    <img src="{{ Storage::url($image->path) }}"
                         alt="Image for {{ $ad->title }}"
                         class="w-full h-48 object-cover rounded-lg">
                @endforeach
            </div>
        @else
            <p class="text-gray-400">No images available for this ad.</p>
        @endif
    </div>
</x-layout>
