<?php

namespace App\Aid;

use Illuminate\Support\Collection;

class Languages
{
    public static function all()
    {
        // Codes, see: https://www.science.co.il/language/Codes.php
        return Collection::make([
            [
                'code' => 'en',
                'flag' => 'us',
                'name' => 'English',
            ],
            [
                'code' => 'pt_br',
                'flag' => 'br',
                'name' => 'Português',
            ],
        ]);
    }

    public static function code($language)
    {
        return $language['code'];
    }

    public static function flag($language)
    {
        return $language['flag'];
    }

    public static function name($language)
    {
        return $language['name'];
    }

    public static function getCurentFlag()
    {
        return self::all()->where('code', backpack_user()->language)->first()['flag'];
    }

    public static function isActive($language)
    {
        return $language['code'] === backpack_user()->language;
    }
}
