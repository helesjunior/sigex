<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class CodigoItem
 * @package App\Models
 * @author Anderson Sathler <asathler@gmail.com
 */
class CodigoItem extends Model
{
    use CrudTrait;
    use SoftDeletes;
    use LogsActivity;

    const TYPE_CREDITOR_LEGAL_ENTITY = 1;
    const TYPE_CREDITOR_NATURAL_PERSON = 2;
    const TYPE_CREDITOR_GENERIC_ID = 3;
    const TYPE_CREDITOR_MANAGING_UNIT = 4;
    const TYPE_UNIT_EXECUTING_MANAGEMENT = 5;
    const TYPE_UNIT_CONTROL = 6;
    const TYPE_UNIT_ACCOUNTING_SECTOR = 7;

    protected static $logFillable = true;
    protected static $logName = 'codigo_itens';

    protected $description;
    protected $show_is_visible;
    protected $code_description;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $guarded = ['id'];
    protected $table = 'codigo_itens';
    protected $fillable = [
        'codigo_id',
        'descricao_resumida',
        'descricao',
        'visivel'
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

    public function codigo()
    {
        return $this->belongsTo('App\Models\Codigo');
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

    public function getCodigoDescricaoAttribute($value)
    {
        return $this->codigo->descricao;
    }

    public function getShowVisivelAttribute($value)
    {
        return $this->visivel == true ? trans('backpack::crud.yes') : trans('backpack::crud.no');
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
