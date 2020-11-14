<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Allocation
 *
 * @package App\Models
 * @author Anderson Sathler <asathler@gmail.com
 */
class Allocation extends Model
{
    use CrudTrait;
    use SoftDeletes;
    use LogsActivity;

    protected static $logFillable = true;
    protected static $logName = 'allocations';

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
        'number',
        'leftover',
        'unit_id',
        'creditor_id',
        'internal_plan_id',
        'expense_kind_id',
        'value',
        'to_pay',
        'sold_off',
        'paid',
        'leftover_subscription',
        'leftover_to_pay',
        'leftover_sold_off',
        'leftover_paid'
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

    public function creditor()
    {
        return $this->belongsTo(Creditors::class);
    }

    public function detail()
    {
        return $this->hasOne(AllocationDetail::class);
    }

    public function expense_kind()
    {
        return $this->belongsTo(ExpenseKind::class);
    }

    public function internal_plan()
    {
        return $this->belongsTo(InternalPlan::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
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
