<x-layout>
    <x-slot:heading>{{ $ad->title }}</x-slot:heading>

    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 space-y-8">
        <!-- Ad Title -->
        <h1 class="text-3xl font-bold text-gray-800">{{ $ad->title }}</h1>

        <!-- Carousel or Placeholder for Images -->
        @if($ad->images->isNotEmpty())
            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="false">
                <div class="carousel-indicators">
                    @foreach ($ad->images as $index => $image)
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{ $index }}"
                                class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner rounded-lg shadow-md">
                    @foreach ($ad->images as $index => $image)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100 rounded-lg img-fluid"
                                 alt="Image {{ $index + 1 }}" style="height: 400px; object-fit: cover;">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        @else
            <div class="h-64 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">
                No images available for this ad
            </div>
        @endif

        <!-- Ad Details -->
        <div class="space-y-4">
            <h2 class="text-xl font-semibold text-gray-700">Details</h2>
            <p class="text-gray-700">
                <span class="font-semibold">Description:</span> {{ $ad->description }}
            </p>
            <p class="text-gray-700">
                <span class="font-semibold">Category:</span> {{ ucfirst($ad->category) }}
            </p>
            <p class="text-gray-700">
                <span class="font-semibold">State:</span> {{ ucfirst($ad->state) }}
            </p>
            <p class="text-gray-700">
                <span class="font-semibold">Location:</span> {{ $ad->city }}, {{ $ad->province }}, ({{ $ad->postal_code }})
            </p>
            <p class="text-lg font-semibold text-green-600">
                <span class="font-semibold">Price:</span> ${{ number_format($ad->price, 2) }}
            </p>
        </div>

        <!-- User Information -->
        <div class="border-t pt-6 space-y-4">
            <h2 class="text-xl font-semibold text-gray-700">Seller Information</h2>
            <p class="text-gray-700">
                <span class="font-semibold">Name:</span> {{ $ad->user->first_name }} {{ $ad->user->last_name }}
            </p>
            <p class="text-gray-700">
                <span class="font-semibold">Email:</span> {{ $ad->user->email }}
            </p>
        </div>
    </div>
</x-layout>
