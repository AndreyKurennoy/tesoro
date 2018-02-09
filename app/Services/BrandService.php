<?php
/**
 * Created by PhpStorm.
 * User: aser
 * Date: 09.02.2018
 * Time: 0:16
 */

namespace App\Services;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;
class BrandService
{
    public function deleteBrandCategoriesById($brand_id, $category_id){
        $brand = Brand::findOrFail($brand_id);
        $brand->categories()->where('category_id', $category_id)->detach();
    }

    public function saveBrandCategories($brand_id, $category_id){
        $brand = Brand::findOrFail($brand_id);
//        $category = Category::findOrFail($category_id);
        $brand->categories()->attach($category_id);
    }

    public function getCategories($brand_id){
        return Brand::find($brand_id)->categories;
    }
}