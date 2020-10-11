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

        $this->addFieldType();
        $this->addFieldCode();



    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function addFieldType()
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
        ]);
    }

    protected function addFieldCode()
    {
        CRUD::addField([   // Text
            'name' => 'code',
            'label' => "Code",
            'type' => 'code_creditor',
            'attributes' => [
                'id' => 'code',
            ],
        ]);
    }


}
