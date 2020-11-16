<?php

/**
 * Helper class to languages manage.
 *
 * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
 */
namespace App\Aid;

use Illuminate\Support\Collection;

/**
 * Has methods to show all available languages and save chosen user's language option.
 *
 * @category SigEx
 * @package App\Aid\Languages
 * @copyright 2019~2029 SigEx
 * @license MIT License. <https://opensource.org/licenses/MIT>
 * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
 */
class Languages
{
    /**
     * Defines available languages options and array fields.
     *
     * @return Collection
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    public static function all()
    {
        // Codes, see: https://www.science.co.il/language/Codes.php
        return Collection::make([
            [
                'code' => 'pt_br',
                'flag' => 'br',
                'name' => 'Português',
            ],
            [
                'code' => 'en',
                'flag' => 'us',
                'name' => 'English',
            ],
        ]);
    }

    /**
     * Return code from language data.
     *
     * @param string $language
     * @return string
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    public static function code($language)
    {
        return $language['code'];
    }

    /**
     * Return flag abbr from language data.
     *
     * @param string $language
     * @return string
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    public static function flag($language)
    {
        return $language['flag'];
    }

    /**
     * Return name from language data.
     *
     * @param string $language
     * @return string
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    public static function name($language)
    {
        return $language['name'];
    }

    /**
     * Return current flag abbr from user language option (set on database).
     *
     * @return mixed
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    public static function getCurentFlag()
    {
        return self::all()->where('code', backpack_user()->language)->first()['flag'];
    }

    /**
     * Returns true if this language is chosen by the user.
     *
     * @param string $language
     * @return bool
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    public static function isActive($language)
    {
        return $language['code'] === backpack_user()->language;
    }

    /**
     * Return a available languages collection.
     *
     * @return Collection
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    public function getAcceptedLanguages()
    {
        return self::all()->pluck('code');
    }

    /**
     * Defines a new language as user option.
     *
     * @param string $language
     * @return \Illuminate\Http\RedirectResponse
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    public function setUserLanguage($language)
    {
        if ($this->getAcceptedLanguages()->contains($language)) {
            backpack_user()->setLanguage($language);
        }

        return redirect()->back();
    }
}
