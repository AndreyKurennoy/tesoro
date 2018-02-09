<?php
/**
 * Created by PhpStorm.
 * User: aser
 * Date: 09.02.2018
 * Time: 11:08
 */

namespace App\Http\Controllers\Admin;


class Slug
{
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
}