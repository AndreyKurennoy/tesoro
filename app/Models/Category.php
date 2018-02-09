<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'main_categories';

    protected $fillable = [
        'parent',
        'publish',
        'title',
        'title_ua',
        'menu_title',
        'menu_title_ua',
        'slug',
        'order',
        'code_1c',
        'image'
    ];

    public function brands() {
        return $this->belongsToMany('App\Models\Brand');
    }

    public function collections() {
        return $this->belongsToMany('App\Models\Collection');
    }
}
