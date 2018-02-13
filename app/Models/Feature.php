<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [
        'title',
        'title_ua',
        'publish',
        'code_1c',
    ];

    public function categories() {
        return $this->belongsToMany('App\Models\Category');
    }

    public function featurables() {
        return $this->hasMany('App\Models\Featurable');
    }

}
