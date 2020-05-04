<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function($photo){

            Storage::disk('public')->delete($photo->url);   

        });
    }
}
