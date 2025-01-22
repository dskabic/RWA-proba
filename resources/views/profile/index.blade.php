<x-layout>
    <x-slot:heading>Your ads page</x-slot:heading>
    <div class="space-y-4">
        @foreach($ads as $ad)
            <div class="flex items-center p-4 bg-white shadow-md rounded-lg hover:border-blue-500 hover:border-2">
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

                <!-- Edit and Delete Buttons -->
                <div class="flex flex-col items-end space-y-2 ml-4">
                    <!-- Edit Button -->
                    <a href="/ads/{{$ad->id}}/edit"
                       class="px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded hover:bg-blue-600">
                        Edit
                    </a>

                    <!-- Delete Button -->
                    <form action="/ads/{{ $ad->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this ad?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-500">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
</x-layout>
