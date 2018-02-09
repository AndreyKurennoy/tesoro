<?php
/**
 * Created by PhpStorm.
 * User: aser
 * Date: 08.02.2018
 * Time: 19:41
 */

namespace App\Http\Controllers\Admin;


use App\Models\FeatureValue;
use App\Services\BrandService;
use App\Services\CategoryService;
use App\Services\CollectionService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
//use Alexusmai\Ruslug\Slug;
use App\Http\Controllers\Admin\Slug as Slug;
//Models
use App\Models\Complect;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Collection;
use App\Models\Feature;

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
        $offers = simplexml_load_string($offersXml);
        $offers = json_encode($offers);
        $offers = json_decode($offers,TRUE);

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
                $new_id=0;
                $category = new Category();
                $category->parent = 0;
                $category->publish = 0;
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
         *
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
    }

}