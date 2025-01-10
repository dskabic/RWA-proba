<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    protected $guarded = [];
    public function user() {
        return $this->belongsto(User::class);
    }
    public function ads() {
        return $this->belongsto(Ad::class);
    }
}
