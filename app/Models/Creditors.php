<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class Creditors extends Model
{
    use CrudTrait;
    use SoftDeletes;
    use LogsActivity;

    protected static $logFillable = true;
    protected static $logName = 'creditors';

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'creditors';
    protected $guarded = ['id'];
    protected $fillable = [
        'type_id',
        'code',
        'name',
        'consortium',
        'country_id',
        'state_id',
        'city_id',
        'address',
        'number',
        'complement',
        'zipcode',
        'phone',
        'contact_agent',
        'notes'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getCity()
    {
        return @$this->city->name;
    }

    public function getCountry()
    {
        return @$this->country->name;
    }

    public function getState()
    {
        return @$this->state->name;
    }

    public function getType()
    {
        return @$this->type->description;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function allocations()
    {
        return $this->hasMany(Allocation::class, 'creditor_id');
    }

    public function city()
    {
        // return $this->belongsTo(City::class, 'city_id');
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        // return $this->belongsTo(Country::class, 'country_id');
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        // return $this->belongsTo(State::class, 'state_id');
        return $this->belongsTo(State::class);
    }

    public function type()
    {
        return $this->belongsTo(CodeItem::class, 'type_id');
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
