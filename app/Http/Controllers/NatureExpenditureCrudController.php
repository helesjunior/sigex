<?php

namespace App\Http\Controllers;

use App\Http\Requests\NatureExpenditureRequest;
use App\Models\NatureExpenditure;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ExpenseKindController
 *
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 * @author Saulo Soares <saulosao@gmail.com
 */
class NatureExpenditureCrudController extends CrudController
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
     * @author Saulo Soares <saulosao@gmail.com
     */
    public function setup()
    {
        CRUD::setModel(NatureExpenditure::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/nature_expenditure');
        CRUD::setEntityNameStrings('nature expenditure', 'nature expenditures');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     * @author Saulo Soares <saulosao@gmail.com
     */
    protected function setupListOperation(): void
    {

        $this->addColumnCode();
        $this->addColumnDescription();
        $this->addColumnStatus();

        $this->crud->addButtonFromView('line', 'more_items', 'more.sub_items', 'end');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     * @author Saulo Soares <saulosao@gmail.com
     */
    protected function setupCreateOperation(): void
    {
        CRUD::setValidation(NatureExpenditureRequest::class);

        $this->addFieldCode();
        $this->addFieldDescription();
        $this->addFieldStatus();

    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     * @author Saulo Soares <saulosao@gmail.com
     */
    protected function setupUpdateOperation(): void
    {
        $this->setupCreateOperation();
    }

    /**
     * Define what hapens when the Show operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-show
     * @author Saulo Soares <saulosao@gmail.com
     */
    protected function setupShowOperation(): void
    {
        $this->crud->set('show.setFromDb', false);

        $this->addColumnCode();
        $this->addColumnDescription();
        $this->addColumnSubItens();
        $this->addColumnStatus();
    }

    protected function addColumnDescription(): void
    {
        CRUD::addColumn([
            'name' => 'description',
            'label' => 'Description',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInExport' => true,
        ]);
    }

    protected function addColumnCode(): void
    {
        CRUD::addColumn([
            'name' => 'code',
            'label' => 'Code',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInExport' => true,
        ]);
    }

    protected function addColumnStatus(): void
    {
        CRUD::addColumn([
            'name' => 'status',
            'label' => 'Status',
            'type' => 'boolean',
            'options' => [0 => 'Inactive', 1 => 'Active'],
            'visibleInTable' => false,
            'visibleInExport' => true,
        ]);
    }

    protected function addFieldCode(): void
    {
        CRUD::addField([
            'name' => 'code',
            'label' => "Code",
            'type' => 'number',
            'hint' => 'SIAFI nature of expenditure code',
            'attributes' => [
                'id' => 'code',
                'min' => "0",
                'max' => "999999",
            ]
        ]);
    }

    protected function addFieldDescription(): void
    {
        CRUD::addField([
            'name' => 'description',
            'label' => "Description",
            'type' => 'text',
            'attributes' => [
                'id' => 'description',
                'onkeyup' => "maiuscula(this)"
            ]
        ]);
    }

    protected function addFieldStatus(): void
    {
        CRUD::addField([
            'name' => 'status',
            'label' => "Active?",
            'type' => 'checkbox',
            'attributes' => [
                'id' => 'status',
            ]
        ]);
    }

    protected function addColumnSubItens(): void
    {
        $this->crud->addColumn([
            'name' => 'subItems',
            'label' => 'Nature Expenditure SubItens',
            'type' => 'table',
            'columns' => [
                'description' => 'Description',
                'show_status' => 'Active?'
            ]
        ]);
    }
}
