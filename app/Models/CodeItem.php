<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CodeItem
 * @package App\Models
 * @author Anderson Sathler <asathler@gmail.com
 */
class CodeItem extends Model
{
    use CrudTrait;

    protected $description;
    protected $show_is_visible;
    protected $code_description;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $guarded = ['id'];

    protected $fillable = [
        'code_id',
        'description',
        'is_visible'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function code()
    {
        return $this->belongsTo('App\Models\Code');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    public function getCodeDescriptionAttribute($value)
    {
        return $this->code->description;
    }

    public function getShowIsVisibleAttribute($value)
    {
        return $this->is_visible == true ? trans('backpack::crud.yes') : trans('backpack::crud.no');
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
