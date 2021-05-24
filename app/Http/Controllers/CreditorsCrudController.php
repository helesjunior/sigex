<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreditorsRequest;
use App\Http\Traits\CommonFields;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CreditorsCrudController
 * @package App\Http\Controllers
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CreditorsCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use CommonFields;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Creditors::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/creditors');
        CRUD::setEntityNameStrings('creditors', 'creditors');

        $this->data['breadcrumbs'] = [
            trans('Sigex') => backpack_url('dashboard'),
            trans('Creditors') => false,
        ];
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

        $this->addColumnType();
        $this->addColumnCode();
        $this->addColumnName();
        $this->addColumnAddress();
        $this->addColumnNumber();
        $this->addColumnZipcode();
        $this->addColumnComplement();
        $this->addColumnCountry();
        $this->addColumnState();
        $this->addColumnCity();
        $this->addColumnPhone();
        $this->addColumnConsortium();
        $this->addColumnContactAgent();
        $this->addColumnNotes();
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CreditorsRequest::class);

        $tab1 = 'Basic information'; //__('backpack::crud.creditors.basis_information');
        $tab2 = 'Addition information'; //__('backpack::crud.creditors.additional_information');

        $this->addFieldTypeOfCreditorCombo($tab1);
        $this->addFieldCreditorCodeCustom($tab1);
        $this->addFieldNameText($tab1, true);
        $this->addFieldAddressText($tab1);
        $this->addFieldNumberNumber($tab1);
        $this->addFieldZipcodeText($tab1);
        $this->addFieldComplementText($tab1);
        $this->addFieldCountryCombo($tab1);
        $this->addFieldStateCombo($tab1);
        $this->addFieldCityCombo($tab1);

        $this->addFieldConsortiumCheckbox($tab2);
        $this->addFieldPhoneText($tab2);
        $this->addFieldContactAgentText($tab2);
        $this->addFieldNotesTextarea($tab2);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function addColumnType()
    {
        CRUD::addColumn([
            'name' => 'type_id',
            'label' => 'Type of creditor',
            'type' => 'model_function',
            'function_name' => 'getType',
            'visibleInTable' => true,
            'visibleInExport' => true,
        ]);
    }

    protected function addColumnCode()
    {
        CRUD::addColumn([
            'name' => 'code',
            'label' => 'Codigo',
            'type' => 'text',
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

    protected function addColumnAddress()
    {
        CRUD::addColumn([
            'name' => 'address',
            'label' => 'Address',
            'type' => 'text',
            'visibleInTable' => false,
            'visibleInExport' => true,
        ]);
    }

    protected function addColumnNumber()
    {
        CRUD::addColumn([
            'name' => 'number',
            'label' => 'Number',
            'type' => 'number',
            'visibleInTable' => false,
            'visibleInExport' => true,
        ]);
    }

    protected function addColumnZipcode()
    {
        CRUD::addColumn([
            'name' => 'zipcode',
            'label' => 'Zipcode',
            'type' => 'text',
            'visibleInTable' => false,
            'visibleInExport' => true,
        ]);
    }

    protected function addColumnComplement()
    {
        CRUD::addColumn([
            'name' => 'complement',
            'label' => 'Complement',
            'type' => 'text',
            'visibleInTable' => false,
            'visibleInExport' => true,
        ]);
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

    protected function addColumnState()
    {
        CRUD::addColumn([
            'name' => 'state_id',
            'label' => 'State',
            'type' => 'model_function',
            'function_name' => 'getState',
            'visibleInTable' => true,
            'visibleInExport' => true,
        ]);
    }

    protected function addColumnCity()
    {
        CRUD::addColumn([
            'name' => 'city_id',
            'label' => 'City',
            'type' => 'model_function',
            'function_name' => 'getCity',
            'visibleInTable' => true,
            'visibleInExport' => true,
        ]);
    }

    protected function addColumnPhone()
    {
        CRUD::addColumn([
            'name' => 'phone',
            'label' => 'Phone',
            'type' => 'text',
            'visibleInTable' => false,
            'visibleInExport' => true,
        ]);
    }

    protected function addColumnConsortium()
    {
        CRUD::addColumn([
            'name' => 'consortium',
            'label' => 'Consortium',
            'type' => 'boolean',
            'options' => [0 => 'No', 1 => 'Yes'],
            'visibleInTable' => false,
            'visibleInExport' => true,
        ]);
    }

    protected function addColumnContactAgent()
    {
        CRUD::addColumn([
            'name' => 'contact_agent',
            'label' => 'Contact agent',
            'type' => 'text',
            'visibleInTable' => false,
            'visibleInExport' => true,
        ]);
    }

    protected function addColumnNotes()
    {
        CRUD::addColumn([
            'name' => 'notes',
            'label' => 'Notes',
            'type' => 'text',
            'limit' => 150,
            'visibleInTable' => false,
            'visibleInExport' => true,
        ]);
    }
}
