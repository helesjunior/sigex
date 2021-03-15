<?php

/**
 * CRUD Controller class for state.
 *
 * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
 */
namespace App\Http\Controllers;

use App\Http\Requests\StateRequest;
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
 * Class StateCrudController for CRUD operations
 *
 * @package App\Http\Controllers
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
 */
class StateCrudController extends CrudController
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
        CRUD::setModel(\App\Models\State::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/state');
        CRUD::setEntityNameStrings('state', 'states');
        CRUD::orderBy('name', 'ASC');
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

        $this->addColumnCountry();
        $this->addColumnName();
        $this->addColumnAbbreviation();
        $this->addColumnIsCapital();
        $this->addColumnLatitude();
        $this->addColumnLongitude();
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
        CRUD::setValidation(StateRequest::class);

        $this->addFieldCountryCombo();
        $this->addFieldNameText();
        $this->addFieldAbbreviationText();
        $this->addFieldIsCapitalCheckbox();
        $this->addFieldLatitudeText();
        $this->addFieldLongitudeText();
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
