<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 13.02.18
 * Time: 12:15
 */

namespace App\Services;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Feature;

class FeatureService
{
    public function getCategories($feature_id){
        return Feature::find($feature_id)->categories;
    }

    public function saveFeatureCategories($feature_id, $category_id){
        $feature = Feature::findOrFail($feature_id);

        $feature->categories()->attach($category_id);
//        dd($feature, $category_id);
    }

}