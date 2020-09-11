<?php

namespace App\Http\Controllers;

use App\Http\Requests\CodeRequest;
use App\Models\CodeItem;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CodeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CodeCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Code::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/code');
        CRUD::setEntityNameStrings('code', 'codes');
        CRUD::orderBy('description');
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
        CRUD::setValidation(CodeRequest::class);

        CRUD::field('description')->type('text');
        CRUD::field('is_visible')->type('boolean');

        CRUD::addField([
            'name' => 'items',
            'label' => 'Items',
            'type' => 'table_items',
            'entity_singular' => 'item',
            'columns' => [
                'description' => 'Description',
                'is_visible' => 'Is visible',
            ],
            'max' => 15,
            'min' => 0
        ]);
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

    public function update()
    {
        $codeId = \Request()->get('id');
        $codeItems = json_decode(\Request()->get('items'), true);

        $items = array_map(function ($item) use ($codeId) {
            return array_merge($item, ['code_id' => $codeId]);
        }, $codeItems);

        dd('update', $codeId, $codeItems, $items, $this->crud); //, $item);

        foreach ($items as $item) {
            CodeItem::updateOrCreate([
                'id' => $item['id'] ?? null
            ], [
                'code_id' => $item['code_id'],
                'description' => $item['description'],
                'is_visible' => $item['is_visible']
            ]);
        }





        $this->crud->hasAccessOrFail('update');

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();
        // update the row in the db
        $item = $this->crud->update($request->get($this->crud->model->getKeyName()),
            $this->crud->getStrippedSaveRequest());
        $this->data['entry'] = $this->crud->entry = $item;

        // show a success message
        \Alert::success(trans('backpack::crud.update_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());



        // dd('update', $id, $items, $codeItems);
        // // dd($id, $items, $x, json_decode(\Request()->get('items'), true), $this);
    }
}
