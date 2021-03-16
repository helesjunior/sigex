<?php

namespace App\Http\Controllers;

use App\Http\Requests\NatureExpenditureSubItemRequest;
use App\Http\Traits\CommonColumns;
use App\Http\Traits\CommonFields;
use App\Http\Traits\CommonFilters;
use App\Models\NatureExpenditureSubItem;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Route;

/**
 * Class CodeCrudController
 *
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 * @author Saulo Soares <saulosao@gmail.com>
 */
class NatureExpenditureSubItemCrudController extends CrudController
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
     * @author Saulo Soares <saulosao@gmail.com
     */
    public function setup()
    {
        $code = Route::current()->parameter('code');

        CRUD::setModel(NatureExpenditureSubItem::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . "/nature_expenditure/$code/sub_item");
        CRUD::setEntityNameStrings('subitem', 'subitens');
        CRUD::addClause('where', 'nature_expenditure_id', '=', $code);
        CRUD::addClause('orderBy', 'description', 'asc');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     * @author Saulo Soares <saulosao@gmail.com
     */
    protected function setupListOperation()
    {
        $this->addColumnNatureExpediture();
        $this->addColumnCode();
        $this->addColumnDescription();
        $this->addColumnStatus();
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     * @author Saulo Soares <saulosao@gmail.com
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(NatureExpenditureSubItemRequest::class);

        $this->addFieldNatureExpenditure(Route::current()->parameter('code'));
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
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    /**
     * Define what happens when the Show operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-show
     * @author Saulo Soares <saulosao@gmail.com
     */
    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        $this->addColumnNatureExpediture();
        $this->addColumnCode();
        $this->addColumnDescription();
        $this->addColumnStatus();
    }

    protected function addFieldCode()
    {
        CRUD::addField([
            'name' => 'code',
            'label' => "Code",
            'type' => 'number',
            'hint' => 'SIAFI nature of expenditure code',
            'attributes' => [
                'id' => 'code',
                'min' => "0",
                'max' => "99",
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

    private function addFieldNatureExpenditure(string $nature_expenditure_id): void
    {
        CRUD::addField([
            'name' => 'nature_expenditure_id',
            'type' => 'hidden',
            'value' => $nature_expenditure_id,
            'attributes' => [
                'id' => 'nature_expenditure_id',
            ]
        ]);
    }

    private function addColumnCode(): void
    {
        CRUD::addColumn([
            'name' => 'code',
            'label' => 'Code',
            'type' => 'number',
            'visibleInTable' => true,
            'visibleInExport' => true,
        ]);
    }
}
