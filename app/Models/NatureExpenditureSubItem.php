<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class NatureExpenditureSubItem
 *
 * @package App\Models
 * @author Anderson Sathler <asathler@gmail.com
 */
class NatureExpenditureSubItem extends Model
{
    use CrudTrait;
    use SoftDeletes;
    use LogsActivity;

    protected static $logFillable = true;
    protected static $logName = 'nature_expenditure_sub_items';

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
        'nature_expenditure_id',
        'code',
        'description',
        'status'
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

    public function nature_expenditure()
    {
        return $this->belongsTo(NatureExpenditure::class);
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

    public function getNatureExpeditureDescriptionAttribute($value)
    {
        return $this->nature_expenditure->description;
    }

    public function getShowStatusAttribute($value)
    {
        return $this->status === true ? trans('backpack::crud.yes') : trans('backpack::crud.no');
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
