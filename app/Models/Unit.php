<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * Class Unit
 *
 * @package App\Models
 * @author Anderson Sathler <asathler@gmail.com
 */
class Unit extends Model
{
    use CrudTrait;
    use SoftDeletes;
    use LogsActivity;

    protected static $logFillable = true;
    protected static $logName = 'units';

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
        'siafi_code',
        'siasg_code',
        'siorg_code',
        'description',
        'short_name',
        'country_id',
        'state_id',
        'city_id',
        'phone',
        'timezone',
        'organ_id',
        'currency_id',
        'type_id',
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

    public function allocations()
    {
        return $this->hasMany(Allocation::class, 'unit_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function organ()
    {
        return $this->belongsTo(Organ::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function type()
    {
        return $this->belongsTo(CodeItem::class);
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

    public function getCityNameAttribute(): string
    {
        return ($this->city()->first() != null) ? $this->city()->first()->name : '';
    }

    public function getCountryNameAttribute(): string
    {
        return ($this->country()->first() != null) ? $this->country()->first()->name : '';
    }

    public function getCurrencyNameAndSymbolAttribute(): string
    {
        $curr = $this->currency()->first();
        return ($curr != null) ? $curr->name . ' (' . $curr->symbol . ')' : '';
    }

    public function getOrganNameAttribute(): string
    {
        return ($this->organ()->first() != null) ? $this->organ()->first()->name : '';
    }

    public function getStateNameAttribute(): string
    {
        return ($this->state()->first() != null) ? $this->state()->first()->name : '';
    }

    public function getTypeNameAttribute(): string
    {
        return ($this->type()->first() != null) ? $this->type()->first()->description : '';
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
