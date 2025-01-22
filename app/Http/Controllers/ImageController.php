<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function destroy(Ad $ad, image $image)
    {
        $image->delete();
        return redirect(url('/ads/' . $ad->id . '/edit'));
    }
}
