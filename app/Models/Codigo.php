<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Codigo
 *
 * @package App\Models
 * @author Anderson Sathler <asathler@gmail.com
 */
class Codigo extends Model
{
    use CrudTrait;
    use SoftDeletes;
    use LogsActivity;

    const TYPE_CREDITORS = 1;
    const TYPE_UNITS = 2;

    protected static $logFillable = true;
    protected static $logName = 'codigos';

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $guarded = ['id'];
    protected $table = 'codigos';
    protected $fillable = [
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

    public function itens()
    {
        return $this->hasMany('App\Models\CodigoItem', 'codigo_id');
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

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
