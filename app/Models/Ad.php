<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $guarded = [];
    public function user() {
        return $this->belongsto(User::class);
    }
    public function images() {
        return $this->hasMany(Image::class);
    }
}
