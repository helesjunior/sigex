<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreditorsRequest;
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
            'label' => 'Code',
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

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CreditorsRequest::class);

        $tab1 = 'Basic information';//__('backpack::crud.creditors.basis_information');
        $tab2 = 'Addition information';//__('backpack::crud.creditors.additional_information');

        $this->addFieldType($tab1);
        $this->addFieldCode($tab1);
        $this->addFieldName($tab1);
        $this->addFieldAddress($tab1);
        $this->addFieldNumber($tab1);
        $this->addFieldZipcode($tab1);
        $this->addFieldComplement($tab1);
        $this->addFieldCountry($tab1);
        $this->addFieldState($tab1);
        $this->addFieldCity($tab1);
        $this->addFieldConsortium($tab2);
        $this->addFieldPhone($tab2);
        $this->addFieldContactAgent($tab2);
        $this->addFieldNotes($tab2);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function addFieldType($tab)
    {
        CRUD::addField([
            'label' => "Type of creditor",
            'type' => 'select',
            'name' => 'type_id', // the db column for the foreign key
            'attributes' => [
                'id' => 'type_id',
            ],
            'entity' => 'type',
            'model' => "App\Models\CodeItem", // related model
            'attribute' => 'description', // foreign key attribute that is shown to user
            'options' => (function ($query) {
                return $query->orderBy('short_description', 'ASC')->where('code_id', 1)->get();
            }), //  y
            'tab' => $tab
        ]);
    }

    protected function addFieldCode($tab)
    {
        CRUD::addField([   // Text
            'name' => 'code',
            'label' => "Code",
            'type' => 'code_creditor',
            'attributes' => [
                'id' => 'code',
            ],
            'tab' => $tab
        ]);
    }

    protected function addFieldName($tab)
    {
        CRUD::addField([   // Text
            'name' => 'name',
            'label' => "Name",
            'type' => 'text',
            'attributes' => [
                'onkeyup' => "maiuscula(this)"
            ],
            'tab' => $tab
        ]);
    }

    protected function addFieldAddress($tab)
    {
        CRUD::addField([   // Text
            'name' => 'address',
            'label' => "Address",
            'type' => 'text',
            'attributes' => [
                'onkeyup' => "maiuscula(this)"
            ],
            'tab' => $tab
        ]);
    }

    protected function addFieldNumber($tab)
    {
        CRUD::addField([   // Text
            'name' => 'number',
            'label' => "Number",
            'type' => 'number',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => $tab
        ]);
    }

    protected function addFieldZipcode($tab)
    {
        CRUD::addField([   // Text
            'name' => 'zipcode',
            'label' => "Zipcode",
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => $tab
        ]);
    }

    protected function addFieldComplement($tab)
    {
        CRUD::addField([   // Text
            'name' => 'complement',
            'label' => "Complement",
            'type' => 'text',
            'attributes' => [
                'onkeyup' => "maiuscula(this)"
            ],
            'tab' => $tab
        ]);
    }

    protected function addFieldCountry($tab)
    {
        CRUD::addField([
            'label' => "Country",
            'type' => 'relationship',
            'name' => 'country', // the db column for the foreign key
            'attributes' => [
                'id' => 'country',
            ],
            'entity' => 'country',
            'model' => "App\Models\Country", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'allows_null' => true,
            'placeholder' => "Select country",
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }), //  y
            'tab' => $tab
        ]);
    }

    protected function addFieldState($tab)
    {
        CRUD::addField([
            'label' => "State",
            'type' => 'relationship',
            'name' => 'state', // the db column for the foreign key
            'attributes' => [
                'id' => 'state',
            ],
            'entity' => 'state',
            'model' => "App\Models\State", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'allows_null' => true,
            'placeholder' => "Select state",
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }), //  y
            'tab' => $tab
        ]);
    }

    protected function addFieldCity($tab)
    {
        CRUD::addField([
            'label' => "City",
            'type' => 'relationship',
            'name' => 'city', // the db column for the foreign key
            'attributes' => [
                'id' => 'city',
            ],
            'entity' => 'city',
            'model' => "App\Models\City", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'allows_null' => true,
            'placeholder' => "Select city",
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }), //  y
            'tab' => $tab
        ]);
    }

    protected function addFieldPhone($tab)
    {
        CRUD::addField([   // Text
            'name' => 'phone',
            'label' => "phone",
            'type' => 'text',
//            'wrapper' => [
//                'class' => 'form-group col-md-6'
//            ],
            'tab' => $tab
        ]);
    }

    protected function addFieldContactAgent($tab)
    {
        CRUD::addField([   // Text
            'name' => 'contact_agent',
            'label' => "Contact agent",
            'type' => 'text',
            'attributes' => [
                'onkeyup' => "maiuscula(this)"
            ],
            'tab' => $tab
        ]);
    }

    protected function addFieldNotes($tab)
    {
        CRUD::addField([   // Text
            'name' => 'notes',
            'label' => "Notes",
            'type' => 'textarea',
            'attributes' => [
                'onkeyup' => "maiuscula(this)"
            ],
            'tab' => $tab
        ]);
    }

    protected function addFieldConsortium($tab)
    {
        CRUD::addField([   // radio
            'name' => 'consortium', // the name of the db column
            'label' => 'Consortium?', // the input label
            'type' => 'checkbox',
//            'inline' => true, // show the radios all on the same line?
            'tab' => $tab
        ]);
    }


}
