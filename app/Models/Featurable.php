<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Featurable extends Model
{
    protected $table = 'featurables';

    protected $fillable = [
        'product_id',
        'feature_id',
        'feature_value_id'
    ];

    public function products(){
        $this->belongsTo('App\Models\Product');
    }

    public function features(){
        $this->belongsTo('App\Models\Feature');
    }

    public function featureValues(){
        $this->belongsTo('App\Models\FeatureValue');
    }
}
