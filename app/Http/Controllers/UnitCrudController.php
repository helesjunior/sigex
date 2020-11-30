<?php

/**
 * CRUD Controller class for unit.
 *
 * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
 */
namespace App\Http\Controllers;

use App\Http\Requests\UnitRequest;
use App\Models\Code;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

/**
 * Class UnitCrudController for CRUD operations
 *
 * @package App\Http\Controllers
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
 */
class UnitCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Unit::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/unit');
        CRUD::setEntityNameStrings('units', 'units');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->setupShowOperation();

        $this->crud->enableExportButtons();
    }

    /**
     * Define what happens when the Show operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-show
     * @author Anderson Sathler <asathler@gmail.com
     */
    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        $this->addColumnSiafiCode();
        // $this->addColumnSiasgCode(); // Don't showed to user
        $this->addColumnSiorgCode();
        $this->addColumnDescription();
        $this->addColumnShortName();
        $this->addColumnCountry();
        $this->addColumnState();
        $this->addColumnCity();
        $this->addColumnPhone();
        $this->addColumnTimezone();
        $this->addColumnOrgan();
        $this->addColumnCurrency();
        $this->addColumnType();
        $this->addColumnStatus();
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(UnitRequest::class);

        $this->addFieldSiafiCode();
        // $this->addFieldSiasgCode(); // Don't showed to user
        $this->addFieldSiorgCode();
        $this->addFieldDescription();
        $this->addFieldShortName();
        $this->addFieldCountry();
        $this->addFieldState();
        $this->addFieldCity();
        $this->addFieldPhone();
        $this->addFieldTimezone();
        $this->addFieldOrgan();
        $this->addFieldCurrency();
        $this->addFieldType();
        $this->addFieldStatus();
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    /**
     * Add column to grid view for SIAFI Code field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnSiafiCode()
    {
        CRUD::addColumn([
            'name' => 'siafi_code',
            'label' => 'SIAFI Code',
            'type' => 'number',
            'thousands_sep' => '',
            'visibleInTable' => true,
            'visibleInModal' => true,
            'visibleInShow' => true,
            'visibleInExport' => true,
            'searchLogic' => function (Builder $query, $column, $searchTerm) {
                $query->orWhere(
                    'siafi_code',
                    'iLike',
                    '%' . $searchTerm . '%'
                );
            }
        ]);
    }

    /**
     * Add column to grid view for SIASG Code field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnSiasgCode()
    {
        /*
         * Don't show this column
         *
        CRUD::addColumn([
            'name' => 'siasg_code',
            'label' => 'SIASG Code',
            'type' => 'number',
            'thousands_sep' => '',
            'visibleInTable' => false, // true
            'visibleInModal' => false, // true
            'visibleInShow' => false, // true
            'visibleInExport' => false, // true
            'searchLogic' => function (Builder $query, $column, $searchTerm) {
                $query->orWhere(
                    'siasg_code',
                    'iLike',
                    '%' . $searchTerm . '%'
                );
            }
        ]);
        */
    }

    /**
     * Add column to grid view for SIORG Code field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnSiorgCode()
    {
        CRUD::addColumn([
            'name' => 'siorg_code',
            'label' => 'SIORG Code',
            'type' => 'number',
            'thousands_sep' => '',
            'visibleInTable' => true,
            'visibleInModal' => true,
            'visibleInShow' => true,
            'visibleInExport' => true,
            'searchLogic' => function (Builder $query, $column, $searchTerm) {
                $query->orWhere(
                    'siorg_code',
                    'iLike',
                    '%' . $searchTerm . '%'
                );
            }
        ]);
    }

    /**
     * Add column to grid view for Description field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnDescription()
    {
        CRUD::addColumn([
            'name' => 'description',
            'label' => 'Description',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInModal' => true,
            'visibleInShow' => true,
            'visibleInExport' => true,
            'searchLogic' => function (Builder $query, $column, $searchTerm) {
                $query->orWhere(
                    'description',
                    'iLike',
                    '%' . $searchTerm . '%'
                );
            }
        ]);
    }

    /**
     * Add column to grid view for Short Name field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnShortName()
    {
        CRUD::addColumn([
            'name' => 'short_name',
            'label' => 'Short name',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInModal' => true,
            'visibleInShow' => true,
            'visibleInExport' => true,
            'searchLogic' => function (Builder $query, $column, $searchTerm) {
                $query->orWhere(
                    'short_name',
                    'iLike',
                    '%' . $searchTerm . '%'
                );
            }
        ]);
    }

    /**
     * Add column to grid view for Country field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnCountry()
    {
        CRUD::addColumn([
            'name' => 'country_id',
            'label' => 'Country',
            'type' => 'select',
            'model' => 'App\Models\Country',
            'entity' => 'country',
            'attribute' => 'name',
            'visibleInTable' => true,
            'visibleInModal' => true,
            'visibleInShow' => true,
            'visibleInExport' => true,
            'searchLogic' => function (Builder $query, $column, $searchTerm) {
                $query->orWhereHas('country', function ($q) use ($column, $searchTerm) {
                    $q->where(
                        'name',
                        'iLike',
                        '%' . $searchTerm . '%'
                    );
                });
            }
        ]);
    }

    /**
     * Add column to grid view for State field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnState()
    {
        CRUD::addColumn([
            'name' => 'state_id',
            'label' => 'State',
            'type' => 'select',
            'model' => 'App\Models\State',
            'entity' => 'state',
            'attribute' => 'name',
            'visibleInTable' => true,
            'visibleInModal' => true,
            'visibleInShow' => true,
            'visibleInExport' => true,
            'searchLogic' => function (Builder $query, $column, $searchTerm) {
                $query->orWhereHas('state', function ($q) use ($column, $searchTerm) {
                    $q->where(
                        'name',
                        'iLike',
                        '%' . $searchTerm . '%'
                    );
                });
            }
        ]);
    }

    /**
     * Add column to grid view for City field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnCity()
    {
        CRUD::addColumn([
            'name' => 'city_id',
            'label' => 'City',
            'type' => 'select',
            'model' => 'App\Models\City',
            'entity' => 'city',
            'attribute' => 'name',
            'visibleInTable' => true,
            'visibleInModal' => true,
            'visibleInShow' => true,
            'visibleInExport' => true,
            'searchLogic' => function (Builder $query, $column, $searchTerm) {
                $query->orWhereHas('city', function ($q) use ($column, $searchTerm) {
                    $q->where(
                        'name',
                        'iLike',
                        '%' . $searchTerm . '%'
                    );
                });
            }
        ]);
    }

    /**
     * Add column to grid view for Phone # field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnPhone()
    {
        CRUD::addColumn([
            'name' => 'phone',
            'label' => 'Phone #',
            'type' => 'phone',
            'visibleInTable' => true,
            'visibleInModal' => true,
            'visibleInShow' => true,
            'visibleInExport' => true,
            'searchLogic' => function (Builder $query, $column, $searchTerm) {
                $charsToRemove = ['+', ' ', '(', ')', '-', '_', '.'];
                $query->orWhere(
                    'phone',
                    'iLike',
                    '%' . str_replace($charsToRemove,'', $searchTerm) . '%'
                );
            }
        ]);
    }

    /**
     * Add column to grid view for Timezone field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnTimezone()
    {
        CRUD::addColumn([
            'name' => 'timezone',
            'label' => 'Timezone',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInModal' => true,
            'visibleInShow' => true,
            'visibleInExport' => true,
            'searchLogic' => function (Builder $query, $column, $searchTerm) {
                $query->orWhere(
                    'short_name',
                    'iLike',
                    '%' . $searchTerm . '%'
                );
            }
        ]);
    }

    /**
     * Add column to grid view for Organ field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnOrgan()
    {
        CRUD::addColumn([
            'name' => 'orgao_id',
            'label' => 'Organ',
            'type' => 'select',
            'model' => 'App\Models\Organ',
            'entity' => 'organ',
            'attribute' => 'name',
            'visibleInTable' => true,
            'visibleInModal' => true,
            'visibleInShow' => true,
            'visibleInExport' => true,
            'searchLogic' => function (Builder $query, $column, $searchTerm) {
                $query->orWhereHas('organ', function ($q) use ($column, $searchTerm) {
                    $q->where(
                        'name',
                        'iLike',
                        '%' . $searchTerm . '%'
                    );
                });
            }
        ]);
    }

    /**
     * Add column to grid view for Currency field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnCurrency()
    {
        CRUD::addColumn([
            'name' => 'currency_id',
            'label' => 'Currency',
            'type' => 'select',
            'model' => 'App\Models\Currency',
            'entity' => 'currency',
            'attribute' => 'name',
            'visibleInTable' => true,
            'visibleInModal' => true,
            'visibleInShow' => true,
            'visibleInExport' => true,
            'searchLogic' => function (Builder $query, $column, $searchTerm) {
                $query->orWhereHas('currency', function ($q) use ($column, $searchTerm) {
                    $q->where(
                        'name',
                        'iLike',
                        '%' . $searchTerm . '%'
                    );
                });
            }
        ]);
    }

    /**
     * Add column to grid view for Type field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnType()
    {
        CRUD::addColumn([
            'name' => 'type_id',
            'label' => 'Type',
            'type' => 'select',
            'model' => 'App\Models\CodeItem',
            'entity' => 'type',
            'attribute' => 'description',
            'visibleInTable' => true,
            'visibleInModal' => true,
            'visibleInShow' => true,
            'visibleInExport' => true,
            'searchLogic' => function (Builder $query, $column, $searchTerm) {
                $query->orWhereHas('type', function ($q) use ($column, $searchTerm) {
                    $q->where(
                        'description',
                        'iLike',
                        '%' . $searchTerm . '%'
                    );
                });
            }
        ]);
    }

    /**
     * Add column to grid view for Status field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnStatus()
    {
        CRUD::addColumn([
            'name' => 'status',
            'label' => 'Status',
            'type' => 'boolean',
            'visibleInTable' => true,
            'visibleInModal' => true,
            'visibleInShow' => true,
            'visibleInExport' => true,
        ]);
    }

    /**
     * Add form field to SIAFI Code.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addFieldSiafiCode()
    {
        CRUD::addField([
            'name' => 'siafi_code',
            'label' => 'SIAFI Code',
            'type' => 'number',
        ]);
    }

    /**
     * Add form field to SIASG Code.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addFieldSiasgCode()
    {
        /*
         * Don't show this field
         *
        CRUD::addField([
            'name' => 'siasg_code',
            'label' => 'SIASG Code',
            'type' => 'number',
        ]);
        */
    }

    /**
     * Add form field to SIORG Code.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addFieldSiorgCode()
    {
        CRUD::addField([
            'name' => 'siorg_code',
            'label' => 'SIORG Code',
            'type' => 'number',
        ]);
    }

    /**
     * Add form field to Description.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addFieldDescription()
    {
        CRUD::addField([
            'name' => 'description',
            'label' => 'Description',
            'type' => 'text',
        ]);
    }

    /**
     * Add form field to Short name.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addFieldShortName()
    {
        CRUD::addField([
            'name' => 'short_name',
            'label' => 'Short name',
            'type' => 'text',
        ]);
    }

    /**
     * Add form field to Country.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addFieldCountry()
    {
        CRUD::addField([
            'name' => 'country_id',
            'label' => 'Country',
            'type' => 'select2',
            'options' => (function (Builder $query) {
                return $query->orderBy('name', 'ASC')
                    ->where('status', 1)
                    ->get();
            })
        ]);
    }

    /**
     * Add form field to State.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addFieldState($country = 0)
    {
        CRUD::addField([
            'name' => 'state_id',
            'label' => 'State',
            'type' => 'select2',
            'options' => (function (Builder $query) use ($country) {
                return $query->orderBy('name', 'ASC')
                    // ->where('country_id', $country)
                    ->where('status', 1)
                    ->get();
            })
        ]);
    }

    /**
     * Add form field to City.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addFieldCity($state = 0)
    {
        CRUD::addField([
            'name' => 'city_id',
            'label' => 'City',
            'type' => 'select2',
            'options' => (function (Builder $query) use ($state) {
                return $query->orderBy('name', 'ASC')
                    // ->where('country_id', $state)
                    ->where('status', 1)
                    ->get();
            })
        ]);
    }

    /**
     * Add form field to Phone #.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addFieldPhone()
    {
        CRUD::addField([
            'name' => 'phone',
            'label' => 'Phone #',
            'type' => 'text',
        ]);
    }

    /**
     * Add form field to Timezone.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addFieldTimezone()
    {
        CRUD::addField([
            'name' => 'timezone',
            'label' => 'Timezone',
            'type' => 'select2_from_array',
            'allows_null' => true,
            'options' => \DateTimeZone::listIdentifiers()
        ]);
    }

    /**
     * Add form field to Organ.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addFieldOrgan()
    {
        CRUD::addField([
            'name' => 'organ_id',
            'label' => 'Organ',
            'type' => 'select2',
            'options' => (function (Builder $query) {
                return $query->orderBy('name', 'ASC')
                    ->where('status', 1)
                    ->get();
            })
        ]);
    }

    /**
     * Add form field to Currency.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addFieldCurrency()
    {
        CRUD::addField([
            'name' => 'currency_id',
            'label' => 'Currency',
            'type' => 'select2',
            'options' => (function (Builder $query) {
                return $query->orderBy('name', 'ASC')
                    ->get();
            })
        ]);
    }

    /**
     * Add form field to Type.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addFieldType()
    {
        CRUD::addField([
            'name' => 'type_id',
            'label' => 'Type',
            'type' => 'select2',
            'allows_null' => true,
            'options' => (function (Builder $query) {
                return $query->orderBy('description', 'ASC')
                    ->where('code_id', Code::TYPE_UNITS)
                    ->get();
            })
        ]);
    }

    /**
     * Add form field to Status.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addFieldStatus()
    {
        CRUD::addField([
            'name' => 'status',
            'label' => 'Status',
            'type' => 'checkbox',
            'default' => true
        ]);
    }
}
