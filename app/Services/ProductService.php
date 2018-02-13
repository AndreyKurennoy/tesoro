<?php
/**
 * Created by PhpStorm.
 * User: aser
 * Date: 09.02.2018
 * Time: 13:45
 */

namespace App\Services;
use App\Models\Product;

class ProductService
{
    public function getpPriceActionById($product_id){
        return Product::findOrFail($product_id)->first();
    }

    public function saveFrom1C($data){
        $product = new Product;
        $product->fill($data);
        $product->save();
        return $product->id;
    }

    public function updateFrom1CBy1cCode($code_1c,$data){
        $product = Product::where('code_1c', $code_1c)->first();
        $product->fill($data);
        $product->save();
    }
}