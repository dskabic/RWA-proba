<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::with(['user', 'images'])->latest()->paginate(5);
        return view('ads.index', ['ads' => $ads]);
    }

    public function short_view() {
        $ads = Ad::with(['user', 'images'])->latest()->take(3)->get();
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
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'price' => ['required'],
            'city' => ['required', 'min:3'],
            'province' => ['required', 'min:3'],
            'postal_code' => ['required', 'min:3'],
            'image.*' => ['file', 'nullable', 'max:10000'],
            'category' => ['required', 'min:3'],
            'state' => ['required', 'min:3'],
        ]);
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
            'price' => ['required'],
            'city' => ['required', 'min:3'],
            'province' => ['required', 'min:3'],
            'postal_code' => ['required', 'min:3'],

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
        return redirect('/profile/index/' . $ad->user_id);

    }
    public function destroy(Ad $ad) {
        $user = $ad->user_id;
        $ad->delete();
        return redirect('/profile/index/' . $user);
    }

}
