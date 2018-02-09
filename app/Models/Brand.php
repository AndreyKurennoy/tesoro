<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'publish',
        'description',
        'image_main',
        'image_1',
        'image_2',
        'website',
        'facebook',
        'instagram',
        'sort',
        'for_order',
    ];

    public function categories() {
        return $this->belongsToMany('App\Models\Category');
    }
}
