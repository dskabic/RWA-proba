<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function index($category = null)
    {
        // Start the query for ads
        $ads = Ad::with(['user', 'images'])->latest();

        // If a category is provided, filter the ads by category
        if ($category) {
            $ads = $ads->where('category', $category);
        }

        // Apply search filter if the search term exists
        if (request()->has('search') && request()->search) {
            $ads = $ads->where('title', 'like', '%' . request()->search . '%');
        }

        // Apply price filters
        if (request()->has('min_price') && request()->min_price) {
            $ads = $ads->where('price', '>=', request()->min_price);
        }

        if (request()->has('max_price') && request()->max_price) {
            $ads = $ads->where('price', '<=', request()->max_price);
        }

        // Apply status filter (state)
        if (request()->has('status') && request()->status) {
            $ads = $ads->where('state', request()->status);
        }

        // Paginate the results and append filter inputs to the pagination links
        return view('ads.index', [
            'ads' => $ads->paginate(5)->appends(request()->query()), // Include all query parameters in pagination links
            'category' => $category,
        ]);
    }





    public function short_view() {
        $ads = Ad::with(['user', 'images'])->latest()->take(3)->get();

        if(request()->has("search")) {
            $ads = $ads->filter(function($ad) {
                return stripos($ad->title, request()->search) !== false;
            });
        }

        return view('welcome', ['ads' => $ads]);
    }

    public function create() {
        if(Auth::guest()) {
            return redirect('/login');
        }
        return view('ads.create');
    }
    public function show(Ad $ad) {
        $ad->load('images'); // Explicitly load the images relationship
        return view('ads.show', ['ad' => $ad]);
    }

    public function store(Request $request) {
        //dd($request);
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'price' => ['required', 'numeric', 'min:0'],
            'city' => ['required', 'min:3'],
            'province' => ['required', 'min:3'],
            'postal_code' => ['required', 'min:3'],
            'image' => ['nullable', 'array'], // Ensure images are an array
            'image.*' => ['file', 'max:10240'], // Validate each file
            'category' => ['required', 'min:3'],
            'state' => ['required', 'min:3'],
        ]);
        //dd($request);
        $ad = Ad::create([
            'title' => request('title'),
            'description' => request('description'),
            'price' => request('price'),
            'city' => request('city'),
            'province' => request('province'),
            'postal_code' => request('postal_code'),
            'user_id' =>  auth()->id(),
            'category' => request('category'),
            'state' => request('state'),
        ]);
        //dd($request->file('image'));
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $filePath = $file->store('images', 'public');

                Image::create([
                    'ad_id' => $ad->id,
                    'user_id' => auth()->id(),
                    'path' => $filePath,
                ]);
            }
        }
        return redirect('/ads');
    }
    public function edit(Ad $ad) {
        if(Auth::guest()) {
            return redirect('/login');
        }
        if($ad->user->isNot(Auth::user())) {
            abort(403);
        }
        return view('ads.edit', ['ad' => $ad]);
    }
    public function update(Ad $ad, Request $request) {
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'price' => ['required', 'numeric', 'min:0'],
            'city' => ['required', 'min:3'],
            'province' => ['required', 'min:3'],
            'postal_code' => ['required', 'min:3'],
            'image' => ['nullable', 'array'], // Ensure images are an array
            'image.*' => ['file', 'max:10240'], // Validate each file
            'category' => ['required', 'min:3'],
            'state' => ['required', 'min:3'],
        ]);

        $ad->update([
            'title' => request('title'),
            'description' => request('description'),
            'price' => request('price'),
            'city' => request('city'),
            'province' => request('province'),
            'postal_code' => request('postal_code'),
            'category' => request('category'),
            'state' => request('state'),
        ]);
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $filePath = $file->store('images', 'public');

                image::create([
                    'ad_id' => $ad->id,
                    'user_id' => auth()->id(),
                    'path' => $filePath,
                ]);
            }
        }
        return redirect('/profile/index/');

    }
    public function destroy(Ad $ad) {
        $ad->delete();
        return redirect('/profile/index/');
    }

}
