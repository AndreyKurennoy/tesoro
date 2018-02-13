<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'category_id2',
        'brand_id',
        'collection_id',
        'title',
        'slug',
        'price',
        'price_1c',
        'price_old',
        'price_action',
        'publish',
        'description',
        'sort',
        'hits',
        'code',
        'code_1c',
        'code_1c_nom',
        'quantity',
        'quantity_all_1c',
        'quantity_nom',
        'quantity_excel',
        'novinka',
        'action',
        'skidka',
        'hit',
        'postav_id',
        'part_id',
        'zakaz',
    ];
}
