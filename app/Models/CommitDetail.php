<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class CommitDetail
 *
 * @package App\Models
 * @author Anderson Sathler <asathler@gmail.com
 */
class CommitDetail extends Model
{
    use CrudTrait;
    use SoftDeletes;
    use LogsActivity;

    protected static $logFillable = true;
    protected static $logName = 'commit_details';

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'commit_id',
        'expense_kind_sub_item_id',
        'empaliquidar',
        'empemliquidacao',
        'empliquidado',
        'emppago',
        'empaliqrpnp',
        'empemliqrpnp',
        'emprpp',
        'rpnpaliquidar',
        'rpnpaliquidaremliquidacao',
        'rpnpliquidado',
        'rpnppago',
        'rpnpaliquidarbloq',
        'rpnpaliquidaremliquidbloq',
        'rpnpcancelado',
        'rpnpoutrocancelamento',
        'rpnpemliqoutrocancelamento',
        'rppliquidado',
        'rpppago',
        'rppcancelado',
        'rpnpaliquidinsc',
        'rpnpemliquidinsc',
        'reinscrpnpaliquidbloq',
        'reinscrpnpemliquid',
        'rpnprestab',
        'rpnpaliquidtransfdeb',
        'rpnpaliquidemliquidtransfdeb',
        'rpnpliquidapgtransfdeb',
        'rpnpbloqtransfdeb',
        'rppinsc',
        'rppexecant',
        'rpptrasf',
        'rpnpaliquidtransfcred',
        'rpnpaliquidemliquidtransfcred',
        'rpnpliquidapgtransfcred',
        'rpnpbloqtransfcred',
        'rpptransffusao',
        'ajusterpexecant'
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

    public function commit()
    {
        return $this->hasOne(Commit::class);
    }

    public function subItems()
    {
        return $this->hasMany(ExpenseKindSubItem::class, 'expense_kind_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
