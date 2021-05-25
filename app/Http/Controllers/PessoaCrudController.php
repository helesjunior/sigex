<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoasRequest;
use App\Http\Traits\CommonFields;
use App\Models\Pessoas;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PessoaCrudController
 * @package App\Http\Controllers
 * @property-read CrudPanel $crud
 */
class PessoaCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;
    use CommonFields;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(Pessoas::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/pessoa');
        CRUD::setEntityNameStrings('pessoa', 'pessoas');

        $this->data['breadcrumbs'] = [
            trans('Sigex') => backpack_url('dashboard'),
            trans('Pessoas') => true,
        ];
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation(): void
    {
        $this->crud->enableExportButtons();

        $this->addColumnName();
        $this->addColumnEmail();
        $this->addColumnCelular();
        $this->addColumnCPF();
        $this->addColumnDataNascimento();
        $this->addColumnGenero();

    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation(): void
    {
        CRUD::setValidation(PessoasRequest::class);

        $tab1 = 'Basic information'; //__('backpack::crud.creditors.basis_information');
        $tab2 = 'Addition information'; //__('backpack::crud.creditors.additional_information');

        $this->addFieldNameText($tab1, true);
        $this->addFieldEmail($tab1, true);
        $this->addFieldCelularText($tab1);
        $this->addFieldCPF($tab1);
        $this->addFieldDataNascimento($tab1);
        $this->addFieldGenero($tab1);


    }

    protected function setupUpdateOperation(): void
    {
        $this->setupCreateOperation();
    }

    protected function addColumnName(): void
    {
        CRUD::addColumn([
            'name' => 'name',
            'label' => 'Nome',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInExport' => true,
        ]);
    }

    protected function addColumnEmail(): void
    {
        CRUD::addColumn([
            'name' => 'email',
            'label' => 'Email',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInExport' => true,
        ]);
    }

    protected function addColumnCelular(): void
    {
        CRUD::addColumn([
            'name' => 'celular',
            'label' => 'Celular',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInExport' => true,
        ]);
    }

    protected function addColumnCPF(): void
    {
        CRUD::addColumn([
            'name' => 'cpf',
            'label' => 'CPF',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInExport' => true,
        ]);
    }


    protected function addColumnDataNascimento(): void
    {
        CRUD::addColumn([   // date_picker
            'name' => 'data_nascimento',
            'label' => 'Data Nascimento',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInExport' => true,
        ]);
    }

    protected function addColumnGenero(): void
    {
        CRUD::addColumn([   // radio
            'name' => 'genero', // the name of the db column
            'label' => 'Genero', // the input label
            'type' => 'radio',
            'options' => [
                // the key will be stored in the db, the value will be shown as label;
                0 => "Feminino",
                1 => "Masculino"
            ],
        ]);
    }

}
