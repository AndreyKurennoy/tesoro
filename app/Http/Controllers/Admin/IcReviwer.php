<?php
/**
 * Created by PhpStorm.
 * User: aser
 * Date: 08.02.2018
 * Time: 19:41
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
class IcReviwer
{
    public static function review(){

        $importXml = Storage::disk('public')->get('import.xml');
        $import = simplexml_load_string($importXml);
        $import = json_encode($import);
        $import = json_decode($import,TRUE);

        $offersXml = Storage::disk('public')->get('offers.xml');
        $offers = simplexml_load_string($offersXml);
        $offers = json_encode($offers);
        $offers = json_decode($offers,TRUE);


        dd($import);
    }
}