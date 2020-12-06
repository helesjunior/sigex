<?php

namespace App\Http\Controllers;

use App\Http\Requests\StateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StateCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 * @author Franklin silva <franklin.linux@gmail.com
 */
class StateCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

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
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->enableExportButtons();

        $this->addColumnCountry();
        $this->addColumnIsCapital();
        $this->addColumnName();
        $this->addColumnLatitude();
        $this->addColumnLongitude();
        $this->addColumnStatus();

    }

    protected function addColumnCountry()
    {
        CRUD::addColumn([
            'name' => 'country_id',
            'label' => 'Country',
            'type' => 'model_function',
            'function_name' => 'getCountry',
            'visibleInTable' => true,
            'visibleInExport' => true,
        ]);
    }

    protected function addColumnIsCapital()
    {
        CRUD::addColumn([
            'name' => 'is_capital',
            'label' => 'Is Capital?',
            'type' => 'boolean',
            'options' => [0 => 'No', 1 => 'Yes'],
            'visibleInTable' => true,
            'visibleInExport' => true,
        ]);
    }

    protected function addColumnName()
    {
        CRUD::addColumn([
            'name' => 'name',
            'label' => 'Name',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInExport' => true,
        ]);
    }

    protected function addColumnAbbreviation()
    {
        CRUD::addColumn([
            'name' => 'abbreviation',
            'label' => 'Abbreviation',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInExport' => true,
        ]);
    }


    protected function addColumnLatitude()
    {
        CRUD::addColumn([
            'name' => 'latitude',
            'label' => 'Latitude',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInExport' => true,
        ]);
    }

    protected function addColumnLongitude()
    {
        CRUD::addColumn([
            'name' => 'longitude',
            'label' => 'Longitude',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInExport' => true,
        ]);
    }

    protected function addColumnStatus()
    {
        CRUD::addColumn([
            'name' => 'status',
            'label' => 'Status',
            'type' => 'boolean',
            'options' => [0 => 'Inactive', 1 => 'Active'],
            'visibleInTable' => true,
            'visibleInExport' => true,
        ]);
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

        $this->addFieldCountry();
        $this->addFieldIsCapital();
        $this->addFieldName();
        $this->addFieldAbbreviation();
        $this->addFieldLatitude();
        $this->addFieldLongitude();
        $this->addFieldStatus();

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


    protected function addFieldCountry()
    {
        CRUD::addField([
            'label' => "Country",
            'type' => 'relationship',
            'name' => 'country_id', // the db column for the foreign key
            'entity' => 'country',
            'model' => "App\Models\Country", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'allows_null' => true,
            'placeholder' => "Select country",
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            })
        ]);
    }

    protected function addFieldIsCapital()
    {
        CRUD::addField([   // checkbox
            'name' => 'is_capital', // the name of the db column
            'label' => 'Is Capital?', // the input label
            'type' => 'checkbox',
            'inline' => false // show the radios all on the same line?
        ]);
    }

    protected function addFieldName()
    {
        CRUD::addField([   // Text
            'name' => 'name',
            'label' => "Name",
            'type' => 'text',
            'attributes' => [
                'onkeyup' => "maiuscula(this)"
            ]
        ]);
    }

    protected function addFieldAbbreviation()
    {
        CRUD::addField([   // Text
            'name' => 'abbreviation',
            'label' => "Abbreviation",
            'type' => 'text',
            'attributes' => [
                'onkeyup' => "maiuscula(this)"
            ]
        ]);
    }

    protected function addFieldLatitude()
    {
        CRUD::addField([   // Text
            'name' => 'latitude',
            'label' => "Latitude",
            'type' => 'text',
            'attributes' => [
                'onkeyup' => "maiuscula(this)"
            ]
        ]);
    }

    protected function addFieldLongitude()
    {
        CRUD::addField([   // Text
            'name' => 'longitude',
            'label' => "Longitude",
            'type' => 'text',
            'attributes' => [
                'onkeyup' => "maiuscula(this)"
            ]
        ]);
    }

    protected function addFieldStatus()
    {
        CRUD::addField([   // checkbox
            'name' => 'status', // the name of the db column
            'label' => 'Status', // the input label
            'type' => 'checkbox',
            'inline' => true // show the radios all on the same line?
        ]);
    }
}
