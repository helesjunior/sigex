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
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
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
        CRUD::setValidation(CreditorsRequest::class);

        $tab1 = __('backpack::crud.creditors.basis_information');
        $tab2 = __('backpack::crud.creditors.additional_information');

        $this->addFieldType($tab1);
        $this->addFieldCode($tab1);
        $this->addFieldName($tab1);
        $this->addFieldAddress($tab1);
        $this->addFieldNumber($tab1);
        $this->addFieldZipcode($tab1);
        $this->addFieldComplement($tab1);
        $this->addFieldPhone($tab2);
        $this->addFieldConsortium($tab2);
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
            'wrapper'   => [
                'class'      => 'form-group col-md-6'
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
            'wrapper'   => [
                'class'      => 'form-group col-md-6'
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



    protected function addFieldPhone($tab)
    {
        CRUD::addField([   // Text
            'name' => 'phone',
            'label' => "phone",
            'type' => 'text',
            'wrapper'   => [
                'class'      => 'form-group col-md-6'
            ],
            'tab' => $tab
        ]);
    }

    protected function addFieldContactAgent($tab)
    {
        CRUD::addField([   // Text
            'name' => 'contact_agent',
            'label' => "Contact agent",
            'type' => 'text',
            'tab' => $tab
        ]);
    }

    protected function addFieldNotes($tab)
    {
        CRUD::addField([   // Text
            'name' => 'notes',
            'label' => "Notes",
            'type' => 'textarea',
            'tab' => $tab
        ]);
    }

    protected function addFieldConsortium($tab)
    {
        CRUD::addField([   // radio
            'name'        => 'consortium', // the name of the db column
            'label'       => 'Consortium?', // the input label
            'type'        => 'radio',
            'options'     => [
                0 => "No",
                1 => "Yes"
            ],
            'default' => 0,
            'inline'      => true, // show the radios all on the same line?
            'wrapper'   => [
                'class'      => 'form-group col-md-6'
            ],
            'tab' => $tab
        ]);
    }


}
