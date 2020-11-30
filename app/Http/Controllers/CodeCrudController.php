<?php

/**
 * CRUD Controller class for code.
 *
 * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
 */
namespace App\Http\Controllers;

use App\Http\Requests\CodeRequest;
use App\Http\Traits\CommonFields;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CodeCrudController for CRUD operations
 *
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 * @author Anderson Sathler <asathler@gmail.com
 */
class CodeCrudController extends CrudController
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
     * @author Anderson Sathler <asathler@gmail.com
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Code::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/code');
        CRUD::setEntityNameStrings('code', 'codes');
        CRUD::orderBy('description', 'asc');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     * @author Anderson Sathler <asathler@gmail.com
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb();

        $this->crud->addButtonFromView('line', 'more_items', 'more.items', 'end');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     * @author Anderson Sathler <asathler@gmail.com
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CodeRequest::class);

        $this->addFieldDescriptionText();
        $this->addFieldIsVisibleCheckbox();
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
     * Define what hapens when the Show operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-show
     * @author Anderson Sathler <asathler@gmail.com
     */
    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        CRUD::addColumn([
            'name'  => 'description',
            'label' => 'Description',
            'type'  => 'string'
        ]);

        $this->crud->addColumn([
            'name' => 'items',
            'label' => 'Code Items',
            'type' => 'table',
            'columns' => [
                'description'     => 'Description',
                'show_is_visible' => 'Is Visible'
            ]
        ]);

        CRUD::addColumn([
            'name'  => 'is_visible',
            'label' => 'Is Visible',
            'type'  => 'boolean'
        ]);
    }
}
