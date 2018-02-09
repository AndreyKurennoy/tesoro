<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureValue extends Model
{
    protected $fillable = [
        'feature',
        'value',
        'value_ua',
        'sort',
    ];
}
