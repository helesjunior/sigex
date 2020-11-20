<?php

/**
 * CRUD Controller class for unit.
 *
 * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
 */
namespace App\Http\Controllers;

use App\Http\Requests\UnitRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

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

        /*
        $this->crud->removeColumns([
            'siasg_code',
            'country_id',
            'state_id',
            'city_id',
            'organ_id',
            'currency_id',
            'type_id',
        ]);
        */
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

        CRUD::setFromDb(); // fields

        /*
        'siafi_code' => 'required|unique:units',
        'siasg_code' => 'unique:units',
        'siorg_code' => 'unique:units',
        'description' => 'required|min:5|max:255',
        'short_name' => 'required|min:3|max:50',
        'country_id' => 'required_without:state_id,city_id',
        'state_id' => 'required_without:country_id,city_id',
        'city_id' => 'required_without:country_id,state_id',
        'phone' => 'max:20',
        'timezone' => 'timezone',
        'organ_id' => 'required',
        'currency_id' => 'required',
        'type_id' => 'required',
        // 'status'
        */

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
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
            'visibleInExport' => true
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
        CRUD::addColumn([
            'name' => 'siasg_code',
            'label' => 'SIASG Code',
            'type' => 'number',
            'thousands_sep' => '',
            'visibleInTable' => false, // true,
            'visibleInExport' => true
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
            'visibleInExport' => true
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
            'visibleInExport' => true
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
            'visibleInExport' => true
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
            'name' => 'country_name',
            'label' => 'Country',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInExport' => true
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
            'name' => 'state_name',
            'label' => 'State',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInExport' => true
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
            'name' => 'city_name',
            'label' => 'City',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInExport' => true
        ]);
    }

    /**
     * Add column to grid view for Phone field.
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
            'visibleInExport' => true
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
            'visibleInExport' => true
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
            'name' => 'organ_name',
            'label' => 'Organ',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInExport' => true
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
            'name' => 'currency_name_and_symbol',
            'label' => 'Currency',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInExport' => true
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
            'name' => 'type_name',
            'label' => 'Type',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInExport' => true
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
            'visibleInExport' => true
        ]);
    }

    protected function addFieldXPTO()
    {
        //
    }
}
