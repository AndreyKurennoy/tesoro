<?php
/**
 * Created by PhpStorm.
 * User: aser
 * Date: 09.02.2018
 * Time: 11:56
 */

namespace App\Services;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Collection;


class CollectionService
{
    public function getCategories($collection_id){
        return Collection::find($collection_id)->categories;
    }

    public function saveColectCategories($collection_id, $category_id){
        $collection = Collection::findOrFail($collection_id);
//        $category = Category::findOrFail($category_id);
        $collection->categories()->attach($category_id);
    }
}