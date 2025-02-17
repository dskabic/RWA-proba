<!DOCTYPE html>
<html lang="hr" class="h-full bg-gray-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Second Hand Shop</title>
    <style>
        /* Longer input */
        .long-input {
            width: 400px;  /* Makes input longer */
            padding: 10px;
            font-size: 16px;
            border-radius: 4px !important;;
            border: 1px solid #ccc;

        }
        /* Button Styling */
        .search-button {
            padding: 8px 16px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-button:hover {
            background-color: #0056b3;
        }
        .dropbtn {
            color: white; /* Match text color of nav links */
            padding: 4px 8px; /* Match padding of nav links */
            font-size: 14px; /* Match font size of nav links */
            font-weight: 500; /* Match font weight of nav links */
            border: none;
            background: none; /* Transparent background */
            cursor: pointer;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #374151; /* Match nav background color */
            color: white; /* White text for links */
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            border-radius: 8px; /* Subtle rounding for dropdown */
            z-index: 1;
        }

        .dropdown-content a {
            color: white; /* Match nav link text color */
            padding: 10px 16px; /* Match link spacing */
            text-decoration: none;
            font-size: 14px; /* Match font size of nav links */
            font-weight: 500; /* Consistent font weight */
            display: block;
            background-color: transparent; /* Ensure no background initially */
        }

        .dropdown-content a:hover {
            background-color: #4b5563; /* Slightly lighter hover effect */
            border-radius: 8px;
        }

        .dropdown:hover .dropdown-content {
            display: block; /* Show dropdown on hover */

        }

        .dropdown:hover .dropbtn {
            color: #9ca3af; /* Slightly lighter color on hover */
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50 h-full bg-gray-100">
<div class="min-h-full">
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="shrink-0">
                        <img class="size-8" src="https://cdn.prod.website-files.com/62e0e114e18a040ab2ea704f/6721b6e8212eb710c97110b6_mp.png" alt="Your Company">
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <x-link href="/" :active="request()->is('/')">Home</x-link>
                            <div class="dropdown">
                                <button class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-2 py-2 text-large font-medium">Ads</button>
                                <div class="dropdown-content">
                                    <a href="/ads">General</a>
                                    <a href="/ads/category/cars">Cars</a>
                                    <a href="/ads/category/electronics">Electronics</a>
                                    <a href="/ads/category/hardware">Hardware</a>
                                </div>
                            </div>
                            <x-link href="/about" :active="request()->is('about')">About</x-link>
                        </div>
                    </div>
                </div>
                @if(request()->is("ads") | request()->is("ads/category/*") | request()->is("/"))
                    <x-form-search/>
                @endif
                <div class="hidden md:block">
                    @guest()
                        <div class=" flex items-center md:ml-6">
                            <x-link href="/login" :active="request()->is('/login')">Log in</x-link>
                            <x-link href="/register" :active="request()->is('/register')">Register</x-link>
                        </div>
                    @endguest
                    @auth()
                        <div class=" flex items-center md:ml-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('users.ads.index')">
                                        {{ __('Your ads') }}
                                    </x-dropdown-link>


                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>


    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6 space-y-8">
                <div class="bg-gray-800 rounded-lg">
                    <h1 class="text-3xl font-bold text-white text-center py-4">{{ $ad->title }}</h1>
                </div>
                <!-- Carousel or Placeholder for Images -->
                @if($ad->images->isNotEmpty())
                    <div id="carouselExampleDark" class="carousel carousel-dark slide border-gray-800 border-2 rounded-xl" data-bs-ride="false">
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
                                         alt="Image {{ $index + 1 }}" style="height: 400px; object-fit: contain;">
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
        </div>
    </main>
</div>

</body>
</html>
