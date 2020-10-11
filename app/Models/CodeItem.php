<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class CodeItem
 * @package App\Models
 * @author Anderson Sathler <asathler@gmail.com
 */
class CodeItem extends Model
{
    use CrudTrait;
    use LogsActivity;

    const TYPE_CREDITOR_LEGAL_ENTITY = 1;
    const TYPE_CREDITOR_NATURAL_PERSON = 2;
    const TYPE_CREDITOR_GENERIC_ID = 3;
    const TYPE_CREDITOR_MANAGING_UNIT = 4;

    protected static $logFillable = true;
    protected static $logName = 'code_items';

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
        'short_description',
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
