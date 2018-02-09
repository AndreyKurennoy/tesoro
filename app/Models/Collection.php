<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'publish',
        'sort'
    ];

    public function categories() {
        return $this->belongsToMany('App\Models\Category');
    }
}
