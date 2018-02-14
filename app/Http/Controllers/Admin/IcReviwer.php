<?php
/**
 * Created by PhpStorm.
 * User: aser
 * Date: 08.02.2018
 * Time: 19:41
 */

namespace App\Http\Controllers\Admin;


use App\Models\Featurable;
use App\Models\FeatureValue;
use App\Models\Product;
use App\Services\BrandService;
use App\Services\CategoryService;
use App\Services\CollectionService;
use App\Services\FeatureService;
use App\Services\ProductService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
//use Alexusmai\Ruslug\Slug;
use App\Http\Controllers\Admin\Slug as Slug;
//Models
use App\Models\Complect;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Collection;
use App\Models\Feature;
use App\Models\Image;

class IcReviwer
{
//    public $complect;
//    public $brandService;
//
//    public function __construct(Complect $complect)
//    {
//        $this->complect = $complect;
//    }
    public function translit($string)
    {
        $converter = array(
            ' ' => '-','"' => '',"'" => '', 'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => "",  'ы' => 'y',   'ъ' => "",
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => "",  'Ы' => 'Y',   'Ъ' => "",
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );
        return $this->clean_string(strtolower(strtr($string, $converter)));
    }

    public function translit_alias($str)
    {
        $str = preg_replace('/[^\w\s]/u', ' ', $str);
        $str=preg_replace("/  +/"," ",$str);
        $str=str_replace("\xC2\xA0", "", $str);
//        $str=translit(trim($str));
        $str = $this->translit(trim($str));
        $str=preg_replace('/[^a-z0-9-]/i','',$str);
        return $str;
    }

    public function clean_string($p)
    {
        $p=str_replace(array("'",'"'),'',$p);
        $p=htmlspecialchars(stripslashes($p));
        $p=str_replace(array('&','lt;','gt;','quot;','amp;'),'',$p);
        return $p;
    }

    public static function review(){
        set_time_limit(0);

        $featurableSite = Featurable::all();

        $ids_nom = [];
        $ids_nom1 = 0;
        $todelete_image = [];
        $pic = 0;
        $pids = [];
        $newids = [];
        $old_ids = [];
        $a = Product::all();
        foreach($a as $b)
        {
            $old_ids[]=$b->code_1c;
            $newids[$b->code_1c]=$b->id;
        }

        $slug = new Slug();
        /**
         * Select all categories from db in array key=>code_1c , value=>site_id
         */
        $siteCats = [];
        $siteCatsCollection = Category::all();
        foreach ($siteCatsCollection as $cat){
            $siteCats[$cat->code_1c] = $cat->id;
        }

        /**
         * Select all brands from db in array where key=>title, value=>site_id
         */
        $prz_site=array();
        $siteBrandCollection = Brand::all();
        foreach($siteBrandCollection as $brand) {
            $prz_site[mb_strtolower(trim($brand->title))] = $brand->id;
        }

        /**
         * Getting all site collections from db
         */
        $collection_site = [];
        $a = Collection::all();
        foreach($a as $b) {
            $collection_site[mb_strtolower(trim($b->title))] = $b->id;
        }

        /**
         * Getting all site collections from db
         */
        $images_site = [];
        $a = Image::all();
        foreach($a as $b) {
            $images_site[$b->product_id][] = $b->name;
        }

        /**
         * Getting content of import.xml
         */
        $importXml = Storage::disk('public')->get('import.xml');
        $import = simplexml_load_string($importXml);
        $import = json_encode($import);
        $import = json_decode($import,TRUE);

        /**
         * Getting content of offers.xml
         */
        $offersXml = Storage::disk('public')->get('offers.xml');
        $offersPre = simplexml_load_string($offersXml);
        $offersPre = json_encode($offersPre);
        $offersPre = json_decode($offersPre,TRUE);
        $offers = [];
        foreach($offersPre["ПакетПредложений"]["Предложения"]["Предложение"] as $p)
        {
            $offers[$p["Ид"]]=$p;
        }

        /**
         * Complects table filling after truncating
         */
        Complect::truncate();
        if(isset($import["КомплектыНоменклатур"]["Комплекты"]["Комплект"])) {
            foreach ($import["КомплектыНоменклатур"]["Комплекты"]["Комплект"] as $c) {
                $s = array();
                if (isset($c["НоменклатурыКомплекта"]["НоменклатураКомплекта"]))
                    foreach ($c["НоменклатурыКомплекта"]["НоменклатураКомплекта"] as $c1) {
                        if (isset($c1["Артикул"]))
                            $s[] = $c1["Артикул"];
                    }
                if (sizeof($s))
                    $complect = new Complect();
                $complect->value = '@' . implode("@", $s) . '@';
                $complect->save();
            }
        }
        /**
         * END Complects table filling after truncating
         */

        /**
         * Filling categories table
         */
        $categoriesInfo = [];
        $categoriesXml = [];

        foreach ($import["Классификатор"]["Группы"]["Группа"] as $item){
            $categoriesXml[$item["Ид"]]= $item;

            if(!isset($siteCats[$item["Ид"]])){

                $category = new Category();
                $category->parent = 0;
                $category->publish = 1;
                $category->title = $item["Наименование"];
                $category->slug = $slug->translit_alias($item["Наименование"]);
                $category->order = $item["ПорядокДляСайта"];
                $category->code_1c = $item["Ид"];
                $category->save();

                $siteCats[$item["Ид"]] = $category->id;

            }else{
                $category = Category::find($siteCats[$item["Ид"]]);
                $category->parent = 0;
                $category->title = $item["Наименование"];
                if(isset($item["ПорядокДляСайта"])){
                    $category->order = $item["ПорядокДляСайта"];
                }

                $category->save();

            }

            $categoriesInfo[$siteCats[$item["Ид"]]] = $item;

            if(!isset($item["Группы"])) continue;

            if(isset($item["Группы"]["Группа"]["Ид"])){
                $item["Группы"]["Группа"]=array($item["Группы"]["Группа"]);
            }

            foreach($item["Группы"]["Группа"] as $c1)
            {
                if(!isset($siteCats[$c1["Ид"]]))
                {
                    $category = new Category();
                    $category->parent = $siteCats[$item["Ид"]];
                    $category->publish = 1;
                    $category->title = $c1["Наименование"];
                    $category->slug = $slug->translit_alias($c1["Наименование"]);
                    if(isset($c1["ПорядокДляСайта"])) {
                        $category->order = $c1["ПорядокДляСайта"];
                    }
                    $category->code_1c = $c1["Ид"];
                    $category->save();
                    $siteCats[$c1["Ид"]] = $category->id;

                }else{

                    $category = Category::find($siteCats[$item["Ид"]]);
                    $category->parent = $siteCats[$c1["Ид"]];
                    $category->title = $c1["Наименование"];
                    if(isset($c1["ПорядокДляСайта"])){
                        $category->order = $c1["ПорядокДляСайта"];
                    }
                    $category->save();
                }
                $categoriesInfo[$siteCats[$c1["Ид"]]]=$c1;

                if(!isset($c1["Группы"])) continue;

                if(isset($c1["Группы"]["Группа"]["Ид"]))
                    $c1["Группы"]["Группа"]=array($c1["Группы"]["Группа"]);

                foreach($c1["Группы"]["Группа"] as $c2)
                {
                    $siteCats[$c2["Ид"]]=$c2;

                    if(!isset($siteCats[$c2["Ид"]]))
                    {
                        $category = new Category();
                        $category->parent = $siteCats[$c1["Ид"]];
                        $category->publish = 1;
                        $category->title = $c2["Наименование"];
                        $category->slug = $slug->translit_alias($c2["Наименование"]);
                        if(isset($c2["ПорядокДляСайта"])) {
                            $category->order = $c2["ПорядокДляСайта"];
                        }
                        $category->code_1c = $c2["Ид"];
                        $category->save();
                        $siteCats[$c2["Ид"]] = $category->id;

                    }
                    else
                    {
                        $category = Category::find($siteCats[$c1["Ид"]]);
                        $category->parent = $siteCats[$c1["Ид"]];
                        $category->title = $c2["Наименование"];
                        if(isset($c1["ПорядокДляСайта"])){
                            $category->order = $c2["ПорядокДляСайта"];
                        }
                        $category->save();
                    }

                    $categoriesInfo[$siteCats[$c2["Ид"]]]=$c2;

                }
            }
        }

        /**
         * END Filling categories table
         */

        /**
         * Filling brands table
         */

        $prz_cats=array();
        $i=0;
        /**
         * Foreach all products for extracting brands
         */
        foreach($import["Каталог"]["Товары"]["Товар"] as $p)
        {
            //If isn't exist brand name in xml - skip
            if(!isset($p["Бренд"]["Наименование"])) continue;

            $i++;

            $brand=$p["Бренд"]["Наименование"];

            $brand1=mb_strtolower(trim($brand));
            //If isn't exist in check array - add it to table
            if(!isset($prz_site[$brand1]))
            {
                $brandModel = new Brand();
                $brandModel->title = $brand;
                $brandModel->slug = $slug->translit_alias($brand);
                $brandModel->publish = 1;
                $brandModel->save();

                $prz_site[$brand1]=$brandModel->id;
            }

            $id=$prz_site[$brand1];

            if(!isset($prz_cats[$id])) $prz_cats[$id]=array();

            if(!isset($p["Группы"]["Ид"])) continue;

            if(is_array($p["Группы"]["Ид"]))
            {

                foreach($p["Группы"]["Ид"] as $c1) {
                    if (isset($siteCats[$c1])) {
                        $prz_cats[$id][$siteCats[$c1]] = $siteCats[$c1];
                    }
                }
            }
            else
            {

                if(isset($siteCats[$p["Группы"]["Ид"]]))
                    $prz_cats[$id][$siteCats[$p["Группы"]["Ид"]]]=$siteCats[$p["Группы"]["Ид"]];

            }

        }


        /**
         *Filling brand_categories relationship
         */
        foreach($prz_cats as $prz_id => $list)
        {
            //Getting existing brand->categories
            $brand = new BrandService();
            $ar = $brand->getCategories($prz_id);
            $siteBrandCats = [];
            foreach ($ar as $item){
                $siteBrandCats[$item->id] = $item->id;
            }
            //Adding category 'Нераспределенное' if does'nt exist in xml data
//            if(!in_array(211,$list)) $list[]=211;

            foreach($list as $catid)
            {
                //Check if the current category is in table, if not -> write it
                if(!in_array($catid,$siteBrandCats)){
                    $brand = new BrandService();
                    $brand->saveBrandCategories($prz_id, $catid);
                }
            }
        }

        /**
         * Filling collections table
         */

        $collection_cats=array();

        foreach($import["Каталог"]["Товары"]["Товар"] as $p)
        {

            if(!isset($p["Коллекция"]["Наименование"])) continue;

            $i++;

            $brand=$p["Коллекция"]["Наименование"];

            if(strpos($brand,"Пустое значение")!==false) continue;

            $brand1=mb_strtolower(trim($brand));

            if(!isset($collection_site[$brand1]))
            {
                $collection = new Collection();
                $collection->title = $brand;
                $collection->slug = $slug->translit_alias($brand);
                $collection->publish = 1;
                $collection->save();

                $collection_site[$brand1] = $collection->id;
            }

            $id=$collection_site[$brand1];

            if(!isset($collection_cats[$id])) $collection_cats[$id]=array();

            if(!isset($p["Группы"]["Ид"])) continue;

            if(is_array($p["Группы"]["Ид"]))
            {

                foreach($p["Группы"]["Ид"] as $c1)
                {

                    if(isset($siteCats[$c1]))
                        $collection_cats[$id][$siteCats[$c1]]=$siteCats[$c1];

                }

            }
            else
            {

                if(isset($siteCats[$p["Группы"]["Ид"]]))
                    $collection_cats[$id][$siteCats[$p["Группы"]["Ид"]]]=$siteCats[$p["Группы"]["Ид"]];

            }


        }

        /**
         *ManyToMany collection-category filling
         */

        foreach($collection_cats as $collection_id=>$list)
        {

            $collection = new CollectionService();
            $ar = $collection->getCategories($collection_id);
            $siteColCats = [];
            foreach ($ar as $item){
                $siteColCats[$item->id] = $item->id;
            }


            //Adding category 'Нераспределенное' if does'nt exist in xml data
//            if(!in_array(211,$list)) $list[]=211;

            foreach($list as $catid)
            {
                if(!in_array($catid,$siteColCats)) {
                    $collection = new CollectionService();
                    $collection->saveColectCategories($collection_id, $catid);
                }
            }
        }

        /**
         *Filling features and feature_values tables
         */

        $feature_site=array();
        $a = Feature::all();
        foreach($a as $b)
            $feature_site[$b->code_1c]=$b->id;

        $i=0;
        $feature_cats=array();
        $feature_products=array();
        $feature_values=array();

        $a = FeatureValue::all();
        foreach($a as $b)
            $feature_values[$b->feature][mb_strtolower(trim($b->value))]=$b->id;

        foreach($import["Каталог"]["Товары"]["Товар"] as $p)
        {

            if(!isset($p["СвойстваХарактеристики"]["СвойствоХарактеристики"])) continue;

            if(isset($p["СвойстваХарактеристики"]["СвойствоХарактеристики"]["Ид"]))
                $p["СвойстваХарактеристики"]["СвойствоХарактеристики"]=array($p["СвойстваХарактеристики"]["СвойствоХарактеристики"]);

            foreach($p["СвойстваХарактеристики"]["СвойствоХарактеристики"] as $f)
            {
                $brand=$f["Ид"];

                if(!isset($feature_site[$brand]))
                {
                    $feature = new Feature();
                    $feature->code_1c = $brand;
                    $feature->title = $f["Наименование"];
                    $feature->publish = 1;
                    $feature->save();

                    $new_id=$feature->id;
                    $feature_site[$brand]=$new_id;

                }
                else
                {

                    $feature = Feature::where('code_1c', $brand)->first();
                    $feature->title = $f["Наименование"];
                    $feature->save();
                }

                $id=$feature_site[$brand];



                if(!isset($f["Значение"]))
                    continue;

                $brand=$f["Значение"];

                if(!isset($feature_values[$id][mb_strtolower(trim($brand))]))
                {
                    $featureValue = new FeatureValue();
                    $featureValue->feature = $id;
                    $featureValue->value = $brand;
                    $featureValue->save();

                    $feature_values[$id][mb_strtolower(trim($brand))]=$featureValue->id;

                }
            }
        }

        /**
         *
         */


        $i1=0;
        foreach($import["Каталог"]["Товары"]["Товар"] as $p)
        {
            $a = [];
            $a["code_1c"]=$p["Ид"];
            $a["code"]=$p["Артикул"];
            $a["title"]=$p["Наименование"];
            $a["code_1c_nom"]=$p["ИдНоменклатуры"];
            $a["category_id"]=16;


            if(is_array($p["Группы"]["Ид"]))
            {
                $h=0;
                foreach($p["Группы"]["Ид"] as $c)
                {
                    if(isset($siteCats[$c]))
                    {
                        $h++;

                        if($siteCats[$c]!=261)
                            $a["category_id"]=$siteCats[$c];

                        if($siteCats[$c]==261)
                            $a["category_id2"]=$siteCats[$c];

                    }
                }
            }
            else
            {
                if(isset($siteCats[$p["Группы"]["Ид"]]))
                    $a["category_id"]=$siteCats[$p["Группы"]["Ид"]];
            }

            if(isset($p["Описание"]))
                $a["description"]=$p["Описание"];
            else
                $a["description"]="";

            if(isset($p["Бренд"]["Наименование"]))
                if(isset($prz_site[mb_strtolower(trim($p["Бренд"]["Наименование"]))]))
                    $a["brand_id"]=$prz_site[mb_strtolower(trim($p["Бренд"]["Наименование"]))];

            if(isset($p["Коллекция"]["Наименование"]))
                if(isset($collection_site[mb_strtolower(trim($p["Коллекция"]["Наименование"]))]))
                    $a["collection_id"]=$collection_site[mb_strtolower(trim($p["Коллекция"]["Наименование"]))];

            if(isset($offers[$a["code_1c"]]["Количество"]))
            {
                $a["quantity"]=$offers[$a["code_1c"]]["Количество"];
                $a["quantity_nom"]=$offers[$a["code_1c"]]["Количество"];
            }
            $a1 = [];
            if(isset($offers[$a["code_1c"]]["Цены"]["Цена"]["Представление"]))
            {
                $a["price_1c"]=preg_replace('/\D/', '', $offers[$a["code_1c"]]["Цены"]["Цена"]["Представление"]);
                $a1["price"]=preg_replace('/\D/', '', $offers[$a["code_1c"]]["Цены"]["Цена"]["Представление"]);
            }

            if(in_array($a["code_1c"],$old_ids))
            {
                $id = $newids[$a["code_1c"]];

                $nmn = new ProductService();
                $priceAction = $nmn->getpPriceActionById($id);
                if(isset($priceAction->price_action)) {
                    if ($priceAction->price_action > 0) {
                    } else {
                        $a['price'] =  $a1["price"];
                    }
            }

                $product = new ProductService();
                $product->updateFrom1CBy1cCode($a["code_1c"] ,$a);

//                echo "<br><b style='color:blue'>Обновляем</b><br>";

            }
            else
            {
                $a["slug"]=$slug->translit_alias($a["title"]);

                $a["publish"]=1;
                $product = new ProductService();
                $id = $product->saveFrom1C($a);
                $old_ids[]=$a["code_1c"];
                $newids[$a["code_1c"]]=$id;

            }

            $pids[$id]=$id;

            $ids_nom1++;
            $ids_nom[$id]=$ids_nom1;

            if(isset($p["СвойстваХарактеристики"]["СвойствоХарактеристики"]))
            {

                if(isset($p["СвойстваХарактеристики"]["СвойствоХарактеристики"]["Ид"]))
                    $p["СвойстваХарактеристики"]["СвойствоХарактеристики"]=array($p["СвойстваХарактеристики"]["СвойствоХарактеристики"]);

                foreach($p["СвойстваХарактеристики"]["СвойствоХарактеристики"] as $f)
                {

                    $brand=$f["Ид"];

                    $feature_id=$feature_site[$brand];

                    $feature_cats[$feature_id][$a["category_id"]]=$a["category_id"];

                    if(isset($a["category_id2"]))
                        if($a["category_id2"]>0)
                            $feature_cats[$feature_id][$a["category_id2"]]=$a["category_id2"];

                    if(!isset($f["Значение"]))
                        continue;

                    if(!isset($feature_values[$feature_id][trim(mb_strtolower($f["Значение"]))]))
                        echo "ERROR - нет значение<hr>";

                    $feature_products[$id][$feature_id][$feature_values[$feature_id][trim(mb_strtolower($f["Значение"]))]]=$feature_values[$feature_id][trim(mb_strtolower($f["Значение"]))];

                }

            }

            $i1++;
            $pic++;

//            echo "xxx".$pic."xxx";

            $iii=0;
            if(isset($p["Картинки"]["Картинка"]))
            {

                if(is_string($p["Картинки"]["Картинка"]))
                    $p["Картинки"]["Картинка"]=array($p["Картинки"]["Картинка"]);

                if(is_string($p["Картинки"]["НомерКартинки"]))
                    $p["Картинки"]["НомерКартинки"]=array($p["Картинки"]["НомерКартинки"]);

                if(is_string($p["Картинки"]["КартинкаИзменена"]))
                    $p["Картинки"]["КартинкаИзменена"]=array($p["Картинки"]["КартинкаИзменена"]);

                $images_array=array();
                $images_tochange=array();

                foreach($p["Картинки"]["Картинка"] as $uuu=>$src)
                {
                    $check = File::isDirectory(storage_path('app/public/products/' . $id ));
                    if(!$check) {
                        File::makeDirectory(storage_path('app/public/products/' . $id));
                    }

                    $image =  "app/public/" . $src;
//                    $jj1=explode("/",strtolower($image));
//                    $image_info['name']=end($jj1)  . ".jpg";
//                    copy($image, storage_path('app/public/products/' . $id .'/' . $image_info['name'] . ".jpg"));
//                    dd(is_file($image),$image);
                    $images_path = "/app/public/products/";
//                    dd($image, $id);
                    $no=0;

                    if(isset($p["Картинки"]["НомерКартинки"][$uuu]))
                        $no=$p["Картинки"]["НомерКартинки"][$uuu];

                    $images_array[$no]=$image;


                    $change=0;
                    if(isset($p["Картинки"]["КартинкаИзменена"][$uuu]))
                        if($p["Картинки"]["КартинкаИзменена"][$uuu]==="Истина")
                        {
                            $change=1;
                        }

                    if($change==1)
                        $images_tochange[$image]=1;

//echo "фото ".$image." - номер ".$no."<br>";


                }

                echo "<hr>";

                ksort($images_array);

                $images_array=array_reverse($images_array,true);

                foreach($images_array as $sort=>$image)
                {

                    if(isset($images_tochange[$image])) echo "<br><b style='color:red;'>ИЗМЕНИТЬ КАРТИНКУ - ".$image."</b><br>";

                    $image_info=array();

                    $jj=explode(".", strtolower($image));
                    $end=end($jj);
                    $jj1=explode("/",strtolower($image));
                    $image_info['name']=end($jj1);
                    $image_url=$images_path.$id."/".$image_info['name'];

                    $k=explode(".",$image_info['name']);
                    $image_info['name']=$k[0];

                    $image_url_jpg = $images_path . $id . "/" . $image_info['name'] . ".jpg";
                    $image_thumbnail250 = $images_path . $id . "/thumb_" . $image_info['name'] . ".jpg";
                    $image_thumbnail100 = $images_path . $id . "/thumb100_" . $image_info['name'] . ".jpg";
                    $image_thumbnail500 = $images_path . $id . "/thumb500_" . $image_info['name'] . ".jpg";
                    $image_thumbnail1200 = $images_path . $id . "/thumb1200_" . $image_info['name'] . ".jpg";
                    $image_thumbnail1200w = $images_path . $id . "/thumb1200w_" . $image_info['name'] . ".jpg";

                    if(isset($images_tochange[$image]))
                    {
                        $path = 'app/public/products/' . $id . "/" . $image_info['name'] . ".jpg";
                        if(File::exists(storage_path($path))){
                            File::delete(storage_path($path));
                        }

                        $path = 'app/public/products/' . $id . "/thumb_" . $image_info['name'] . ".jpg";
                        if(File::exists(storage_path($path))){
                            File::delete(storage_path($path));
                        }

                        $path = 'app/public/products/' .$id."/thumb100_".$image_info['name'].".jpg";
                        if(File::exists(storage_path($path))){
                            File::delete(storage_path($path));
                        }

                        $path= 'app/public/products/' .$id."/thumb500_".$image_info['name'].".jpg";
                        if(File::exists(storage_path($path))){
                            File::delete(storage_path($path));
                        }

                        $path = 'app/public/products/' .$id."/thumb1200_".$image_info['name'].".jpg";
                        if(File::exists(storage_path($path))){
                            File::delete(storage_path($path));
                        }

                        $path = 'app/public/products/' .$id."/thumb1200w_".$image_info['name'].".jpg";
                        if(File::exists(storage_path($path))){
                            File::delete(storage_path($path));
                        }

//     ??????           $q="DELETE FROM #_images WHERE image_product='".$id."' and image_src='".$image_info['name'].".jpg'";
                        $imageModel = Image::where(['product_id' => $id, 'name' => $image_info['name'].'.jpg']);
                        $imageModel->delete();

                    }

                    if(!File::exists(storage_path($image_thumbnail250)) || isset($images_tochange[$image]))
                        if(File::exists(storage_path($image))) {

                            $image_url = $images_path . $id . '/' . $image_info['name'] . '.jpg';

                            if (copy(storage_path($image), storage_path($image_url))) {
//                                dd(getimagesize($image_url));

                                list($x, $y, $t, $attr) = getimagesize(storage_path($image_url));
                                if ($t == IMAGETYPE_GIF)
                                    $big = imagecreatefromgif(storage_path($image_url));
                                else if ($t == IMAGETYPE_JPEG)
                                    $big = imagecreatefromjpeg(storage_path($image_url));
                                else if ($t == IMAGETYPE_PNG)
                                    $big = imagecreatefrompng(storage_path($image_url));


                                $scale = min(250 / $x, 250 / $y);
                                if ($scale > 1) {
                                    $scale = 1;
                                }
                                $xs = $x * $scale;
                                $ys = $y * $scale;
                                $crop_250 = imagecreatetruecolor($xs, $ys);
                                $white_background = imagecolorallocate($crop_250, 255, 255, 255);
                                imagefill($crop_250, 0, 0, $white_background);
                                $res = imagecopyresampled($crop_250, $big, 0, 0, 0, 0, $xs, $ys, $x, $y);

                                if (File::exists(storage_path($image_thumbnail250))) File::delete(storage_path($image_thumbnail250));
//imageantialias($crop_250,true);
                                imagejpeg($crop_250, storage_path($image_thumbnail250), 100);
                                imagedestroy($crop_250);


                                $scale = min(100 / $x, 100 / $y);
                                if ($scale > 1) {
                                    $scale = 1;
                                }
                                $xs = $x * $scale;
                                $ys = $y * $scale;
                                $crop_100 = imagecreatetruecolor($xs, $ys);
                                $white_background = imagecolorallocate($crop_100, 255, 255, 255);
                                imagefill($crop_100, 0, 0, $white_background);
                                $res = imagecopyresampled($crop_100, $big, 0, 0, 0, 0, $xs, $ys, $x, $y);

                                if (File::exists(storage_path($image_thumbnail100))) File::delete(storage_path($image_thumbnail100));
//imageantialias($crop_100,true);
                                imagejpeg($crop_100, storage_path($image_thumbnail100), 100);
                                imagedestroy($crop_100);


                                $scale = min(500 / $x, 500 / $y);
                                if ($scale > 1) {
                                    $scale = 1;
                                }
                                $xs = $x * $scale;
                                $ys = $y * $scale;
                                $crop_500 = imagecreatetruecolor($xs, $ys);
                                $white_background = imagecolorallocate($crop_500, 255, 255, 255);
                                imagefill($crop_500, 0, 0, $white_background);
                                $res = imagecopyresampled($crop_500, $big, 0, 0, 0, 0, $xs, $ys, $x, $y);

                                if (File::exists(storage_path($image_thumbnail500))) File::delete(storage_path($image_thumbnail500));
//imageantialias($crop_500,true);
                                imagejpeg($crop_500, storage_path($image_thumbnail500), 100);
                                imagedestroy($crop_500);


                                $scale = min(1200 / $x, 1200 / $y);
                                if ($scale > 1) {
                                    $scale = 1;
                                }
                                $xs = $x * $scale;
                                $ys = $y * $scale;
                                $crop_1200 = imagecreatetruecolor($xs, $ys);
                                $white_background = imagecolorallocate($crop_1200, 255, 255, 255);
                                imagefill($crop_1200, 0, 0, $white_background);
                                $res = imagecopyresampled($crop_1200, $big, 0, 0, 0, 0, $xs, $ys, $x, $y);

                                if (File::exists(storage_path($image_thumbnail1200))) File::delete(storage_path($image_thumbnail1200));
//imageantialias($crop_1200,true);
                                imagejpeg($crop_1200, storage_path($image_thumbnail1200), 100);
                                imagedestroy($crop_1200);


                                if (1 == 1 || $id == 1874) {

                                    $image2 = imagecreatefromjpeg(storage_path($image_thumbnail1200));
                                    $w = imagesx($image2);
                                    $h = imagesy($image2);

                                    if ($w > 900) {
//                                        $watermark = imagecreatefrompng(ROOT.'/images/watermark/logo1.png');
                                        $watermark = imagecreatefrompng(storage_path('app/public/watermark/logo1.png'));
                                        $ww = imagesx($watermark);
                                        $wh = imagesy($watermark);
                                        $img_paste_x = $w - 30 - $ww;
                                        if ($img_paste_x < 0) $img_paste_x = 0;
                                        $img_paste_y = $h - 30 - $wh;
                                        if ($img_paste_y < 0) $img_paste_y = 0;
                                        imagecopy($image2, $watermark, $img_paste_x, $img_paste_y, 0, 0, $ww, $wh);
                                        imagejpeg($image2, storage_path($image_thumbnail1200), "100");

                                        imagedestroy($image2);
                                        imagedestroy($watermark);

                                    }


                                    $scale = min(1200 / $x, 1200 / $y);
                                    if ($scale > 1) {
                                        $scale = 1;
                                    }
                                    $xs = $x * $scale;
                                    $ys = $y * $scale;
                                    $crop_1200w = imagecreatetruecolor($xs, $ys);
                                    $white_background = imagecolorallocate($crop_1200w, 255, 255, 255);
                                    imagefill($crop_1200w, 0, 0, $white_background);
                                    $res = imagecopyresampled($crop_1200w, $big, 0, 0, 0, 0, $xs, $ys, $x, $y);

                                    if (File::exists(storage_path($image_thumbnail1200w))) File::delete(storage_path($image_thumbnail1200w));
//imageantialias($crop_1200w,true);
                                    imagejpeg($crop_1200w, storage_path($image_thumbnail1200w), 100);
                                    imagedestroy($crop_1200w);

                                    $image2 = imagecreatefromjpeg(storage_path($image_thumbnail1200w));
                                    $w = imagesx($image2);
                                    $h = imagesy($image2);

                                    if ($w > 900) {
                                        $watermark = imagecreatefrompng(storage_path('app/public/watermark/logo1.png'));
                                        $ww = imagesx($watermark);
                                        $wh = imagesy($watermark);
                                        $img_paste_x = $w - 30 - $ww;
                                        if ($img_paste_x < 0) $img_paste_x = 0;
                                        $img_paste_y = $h - 30 - $wh;
                                        if ($img_paste_y < 0) $img_paste_y = 0;
                                        imagecopy($image2, $watermark, $img_paste_x, $img_paste_y, 0, 0, $ww, $wh);
                                    }

                                    $watermark = imagecreatefrompng(storage_path('app/public/watermark/polosa.png'));
                                    $ww = imagesx($watermark);
                                    $wh = imagesy($watermark);
                                    $img_paste_x = 0;
                                    while ($img_paste_x < $w) {
                                        $img_paste_y = $h / 2 - $wh / 2;
                                        if ($img_paste_y < 0) $img_paste_y = 0;
                                        imagecopy($image2, $watermark, $img_paste_x, $img_paste_y, 0, 0, $ww, $wh);
                                        $img_paste_x += $ww;
                                    }

                                    imagejpeg($image2, storage_path($image_thumbnail1200w), "100");

                                    imagedestroy($image2);
                                    imagedestroy($watermark);


                                }


                                $iii++;


                                $imageModel = new Image();
                                $imageModel->product_id = $id;
                                $imageModel->sort = $iii;
                                $imageModel->name = $image_info['name'] . ".jpg";
                                $imageModel->save();

                            }
                        }

                }

                $ar_im=array();

                foreach($p["Картинки"]["Картинка"] as $uuu=>$src)
                {

                    $no=0;

                    if(isset($p["Картинки"]["НомерКартинки"][$uuu]))
                        $no=$p["Картинки"]["НомерКартинки"][$uuu];

                    $image =  "app/public/" . $src;



                    $image_info=array();

                    $jj=explode(".", strtolower($image));
                    $end=end($jj);
                    $jj1=explode("/",strtolower($image));
                    $image_info['name']=end($jj1);

                    $k=explode(".",$image_info['name']);
                    $image_info['name']=$k[0];

                    $ar_im[]=$image_info['name'].".jpg";


                    /**
                     * не похоже значение сортировки на исходную таблицу тесоро
                     */
                    $imageModel = Image::where(['name' => $image_info['name'], 'product_id' => $id]);
                    $imageModel = Image::where(['name' => $image_info['name'].".jpg", 'product_id' => $id])->first();
                    $imageModel->sort = $uuu;
                    $imageModel->save();
                }

//                $rt=meadb_select("select * from #_images WHERE image_product='".$id."'");

                $rt = Image::where('product_id', $id)->get();

                foreach($rt as $im)
                {

                    $ifg=0;
                    foreach($ar_im as $im_yes)
                    {
                        if($im->name==$im_yes)
                        {
                            $ifg=1;
                        }
                    }

                    if($ifg==0)
                    {
                        $todelete_image[]=$im;
                    }
                }
            }
        }

        foreach($feature_cats as $feature_id=>$list)
        {
            /**
             * ADD category neras
             */
//            if(!in_array(16,$list)) $list[]=16;

            //Getting existing feature->categories
            $feature = new FeatureService();
            $ar = $feature->getCategories($feature_id);
            $siteFeatureCats = [];
            foreach ($ar as $item){
                $siteFeatureCats[$item->id] = $item->id;
            }

            foreach($list as $catid)
            {

                if(!in_array($catid,$siteFeatureCats)) {
                    $feature = new FeatureService();
                    $feature->saveFeatureCategories($feature_id, $catid);
                }

            }
        }


        foreach($feature_products as $pid=>$list1)
        {
//            dd($pid, $list1);
//            meadb_query("delete FROM #_feature_products WHERE featureproduct_product=".$pid);
//                Featurable::truncate();
//                $feature = new Featurable();
//                $feature->truncate();
//                dd('41');

            foreach($list1 as $fid=>$list2)
            {
                foreach($list2 as $zid=>$list1)
                {
                    $search = $featurableSite->where('product_id', $pid)->where('feature_id', $fid)->where('feature_value_id', $zid)->all();
                    if(empty($search)) {
                        $feature = new Featurable();
                        $feature->product_id = $pid;
                        $feature->feature_id = $fid;
                        $feature->feature_value_id = $zid;
                        $feature->save();
                    }
                }
            }
        }

        $a = Product::where('part_id', 0)->get();
        foreach($a as $p)
        {

            $pid = $p->id;

            if(!isset($pids[$pid]))
            {

                $p->quantity = 0;
                $p->quantity_nom = 0;
                $p->save();
            }
        }

        $list = FeatureValue::all();
        foreach($list as $a)
        {
            $b = Featurable::where('feature_value_id', $a->id)->get();
            if(empty($b))
            {
                $q = FeatureValue::find($a->id);
                $q->delete();
            }
            else
            {
                $if=0;
                foreach($b as $c)
                {
                    $d = Product::where('id' , $c->product_id)->first();

                    if(!empty($d))
                    {
                        $if=1;
                        break;
                    }
                }
                if($if==0)
                {
                    $q = FeatureValue::where('id', $a->id)->get();
                    $q->delete();
                }
            }
        }

        foreach($todelete_image as $im)
        {

            $d = Product::where('id', $im->product_id)->get();

            if(!empty($d))
            {

                echo "<hr>";
                print_r($im);
                $id = $im->product_id;

                $path = 'app/public/products/' . $id . "/" . $im->name . ".jpg";
                if(File::exists(storage_path($path))){
                    File::delete(storage_path($path));
                }

                $path = 'app/public/products/' . $id . "/thumb_" . $im->name . ".jpg";
                if(File::exists(storage_path($path))){
                    File::delete(storage_path($path));
                }

                $path = 'app/public/products/' .$id."/thumb100_".$im->name.".jpg";
                if(File::exists(storage_path($path))){
                    File::delete(storage_path($path));
                }

                $path= 'app/public/products/' .$id."/thumb500_".$im->name.".jpg";
                if(File::exists(storage_path($path))){
                    File::delete(storage_path($path));
                }

                $path = 'app/public/products/' .$id."/thumb1200_".$im->name.".jpg";
                if(File::exists(storage_path($path))){
                    File::delete(storage_path($path));
                }

                $path = 'app/public/products/' .$id."/thumb1200w_".$im->name.".jpg";
                if(File::exists(storage_path($path))){
                    File::delete(storage_path($path));
                }

                $q = Image::where(['product_id' => $id, 'name' => $im->name]);
                $q->delete();


            }
        }

//        $list=meadb_select("select product_id,product_code,product_quantity_nom,product_quantity_excel FROM #_products ORDER BY product_id ASC");
        $list = Product::all()->sortBy('id', 'asc');
        $codes=array();
        $q_all=array();
        $e_all=array();

        foreach($list as $c)
        {

            if(!isset($codes[$c->code])) $codes[$c->code]=array();

            $codes[$c->code][]=$c->id;

            if(!isset($q_all[$c->code])) $q_all[$c->code]=0;

            $q_all[$c->code]+=$c->quantity_nom;

            if($c->quantity_excel > 0)
            {
                $e_all[$c->code]=1;
            }

        }

//        foreach($codes as $s=>$p)
//        {
//            if(sizeof($p)<=1) continue;
//            echo $s."<br><br>";
//
//            $ids1=implode(",",$p);
//
//            $q="update #_products SET product_quantity_all1c=".$q_all[$s]." WHERE product_id IN (".$ids1.")";
//            echo $q."<br><br>";
//            meadb_query($q);
//
//            $q = Product::find()
//
//            $s=$q_all[$s];
//
//            if(isset($e_all[$s])) $s+=$e_all[$s];
//
//            $q="update #_products SET product_quantity=".$s." WHERE product_id IN (".$ids1.")";
//            echo $q."<br><br>";
//            meadb_query($q);
//
//
//
//
//            $min=0;
//            $min_value=-1;
//
//            foreach($p as $m=>$g)
//                if(isset($ids_nom[$g]))
//                    if($ids_nom[$g]>$min_value)
//                    {
//                        $min=$m;
//                        $min_value=$ids_nom[$g];
//                    }
//
//            echo $min." - ";
//
//            $id=$p[$min];
//            echo "id: ".$id."<br><br>";
//            unset($p[$min]);
//            $ids=implode(",",$p);
//            echo $ids."<br><br>";
//
//            $q="update #_products SET product_published=0 WHERE product_id IN (".$ids.")";
//            echo $q."<br><br>";
//            meadb_query($q);
//
//            $q="update #_products SET product_published=1 WHERE product_id IN (".$id.")";
//            echo $q."<br><br>";
//            meadb_query($q);
//
//
//
//            echo "<hr>";
//        }
    }
}