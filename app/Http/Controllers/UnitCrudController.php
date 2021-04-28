<?php

/**
 * CRUD Controller class for unit.
 *
 * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
 */
namespace App\Http\Controllers;

use App\Http\Requests\UnitRequest;
use App\Http\Traits\CommonColumns;
use App\Http\Traits\CommonFields;
use App\Http\Traits\CommonFilters;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class UnitCrudController for CRUD operations
 *
 * @package App\Http\Controllers
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
 */
class UnitCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;
    use CommonColumns;
    use CommonFields;
    use CommonFilters;

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

        $this->addFieldSiafiCodeNumber();
        // $this->addFieldSiasgCodeNumber(); // Don't showed to user
        $this->addFieldSiorgCodeNumber();
        $this->addFieldDescriptionText();
        $this->addFieldShortNameText();
        $this->addFieldCountryCombo();
        $this->addFieldStateCombo();
        $this->addFieldCityCombo();
        $this->addFieldPhoneText();
        $this->addFieldTimezoneCombo();
        $this->addFieldOrganCombo();
        $this->addFieldCurrencyCombo();
        $this->addFieldTypeOfUnitCombo();
        $this->addFieldStatusCheckbox();
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
}
