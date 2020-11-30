<?php

/**
 * CRUD Controller class for state.
 *
 * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
 */
namespace App\Http\Controllers;

use App\Http\Requests\StateRequest;
use App\Http\Traits\CommonFields;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class StateCrudController for CRUD operations
 *
 * @package App\Http\Controllers
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
 */
class StateCrudController extends CrudController
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
        $this->setupShowOperation();

        $this->crud->enableExportButtons();
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

        $this->addColumnCountry();
        $this->addColumnName();
        $this->addColumnAbbreviation();
        $this->addColumnIsCapital();
        $this->addColumnLatitude();
        $this->addColumnLongitude();
        $this->addColumnStatus();
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

        $this->addFieldCountryCombo();
        $this->addFieldNameText();
        $this->addFieldAbbreviationText();
        $this->addFieldIsCapitalCheckbox();
        $this->addFieldLatitudeText();
        $this->addFieldLongitudeText();
        $this->addFieldStatusCheckbox();
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
     * Add column to grid view for Country field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnCountry()
    {
        CRUD::addColumn([
            'name' => 'country_id',
            'label' => 'Country',
            'type' => 'select',
            'model' => 'App\Models\Country',
            'entity' => 'country',
            'attribute' => 'name',
            'visibleInTable' => true,
            'visibleInModal' => true,
            'visibleInShow' => true,
            'visibleInExport' => true,
            'searchLogic' => function (Builder $query, $column, $searchTerm) {
                $query->orWhereHas('country', function ($q) use ($column, $searchTerm) {
                    $q->where(
                        'name',
                        'iLike',
                        '%' . $searchTerm . '%'
                    );
                });
            }
        ]);
    }

    /**
     * Add column to grid view for Status field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnIsCapital()
    {
        CRUD::addColumn([
            'name' => 'is_capital',
            'label' => 'Is capital',
            'type' => 'boolean',
            'visibleInTable' => true,
            'visibleInModal' => true,
            'visibleInShow' => true,
            'visibleInExport' => true
        ]);
    }

    /**
     * Add column to grid view for Name field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnName()
    {
        CRUD::addColumn([
            'name' => 'name',
            'label' => 'Name',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInModal' => true,
            'visibleInShow' => true,
            'visibleInExport' => true,
            'searchLogic' => function (Builder $query, $column, $searchTerm) {
                $query->orWhere(
                    'name',
                    'iLike',
                    '%' . $searchTerm . '%'
                );
            }
        ]);
    }

    /**
     * Add column to grid view for Abbreviation field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnAbbreviation()
    {
        CRUD::addColumn([
            'name' => 'abbreviation',
            'label' => 'Abbreviation',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInModal' => true,
            'visibleInShow' => true,
            'visibleInExport' => true,
            'searchLogic' => function (Builder $query, $column, $searchTerm) {
                $query->orWhere(
                    'abbreviation',
                    'iLike',
                    '%' . $searchTerm . '%'
                );
            }
        ]);
    }

    /**
     * Add column to grid view for Latitude field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnLatitude()
    {
        CRUD::addColumn([
            'name' => 'latitude',
            'label' => 'Latitude',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInModal' => true,
            'visibleInShow' => true,
            'visibleInExport' => true,
            'searchLogic' => function (Builder $query, $column, $searchTerm) {
                $query->orWhere(
                    'latitude',
                    'iLike',
                    '%' . $searchTerm . '%'
                );
            }
        ]);
    }

    /**
     * Add column to grid view for Longitude field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnLongitude()
    {
        CRUD::addColumn([
            'name' => 'longitude',
            'label' => 'Longitude',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInModal' => true,
            'visibleInShow' => true,
            'visibleInExport' => true,
            'searchLogic' => function (Builder $query, $column, $searchTerm) {
                $query->orWhere(
                    'longitude',
                    'iLike',
                    '%' . $searchTerm . '%'
                );
            }
        ]);
    }

    /**
     * Add column to grid view for Status field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnStatus()
    {
        CRUD::addColumn([
            'name' => 'status',
            'label' => 'Status',
            'type' => 'boolean',
            'visibleInTable' => true,
            'visibleInModal' => true,
            'visibleInShow' => true,
            'visibleInExport' => true
        ]);
    }
}
