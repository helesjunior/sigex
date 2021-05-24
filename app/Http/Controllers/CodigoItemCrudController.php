<?php

/**
 * CRUD Controller class for code item.
 *
 * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
 */
namespace App\Http\Controllers;

use App\Http\Requests\CodigoitemRequest;
use App\Http\Traits\CommonFields;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CodigoCrudController for CRUD operations
 *
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 * @author Anderson Sathler <asathler@gmail.com
 */
class CodigoItemCrudController extends CrudController
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
        $codigo = \Route::current()->parameter('codigo');

        CRUD::setModel(\App\Models\CodigoItem::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . "/codigo/$codigo/item");
        CRUD::setEntityNameStrings('código item', 'código itens');
        CRUD::addClause('where', 'codigo_id', '=', $codigo);
        CRUD::orderBy('descricao', 'asc');
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
        CRUD::addColumn([
            'name'  => 'codigo_descricao',
            'label' => 'Código Descrição',
            'type'  => 'string'
        ]);

        CRUD::addColumn([
            'name'  => 'descricao',
            'label' => 'Descrição',
            'type'  => 'string'
        ]);

        CRUD::addColumn([
            'name'  => 'visivel',
            'label' => 'Visível?',
            'type'  => 'boolean'
        ]);
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
        CRUD::setValidation(CodigoitemRequest::class);

        $this->addFieldCodeIdHidden();
        $this->addFieldDescriptionText();
        $this->addFieldIsVisibleCheckbox();
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     * @author Anderson Sathler <asathler@gmail.com
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
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

        CRUD::addColumn([
            'name'  => 'codigo_descricao',
            'label' => 'Código Descrição',
            'type'  => 'string'
        ]);

        CRUD::addColumn([
            'name'  => 'descricao',
            'label' => 'Descrição',
            'type'  => 'string'
        ]);

        CRUD::addColumn([
            'name'  => 'visivel',
            'label' => 'Visível?',
            'type'  => 'boolean'
        ]);
    }
}
