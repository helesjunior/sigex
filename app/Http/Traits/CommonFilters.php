<?php

/**
 * Traits to group CRUD Backpack common filters.
 *
 * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
 */
namespace App\Http\Traits;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait CommonFields for Backpack common filters.
 *
 * @package App\Http\Traits
 * @example Method name for generic filters should be 'addFilter' + 'Name' + 'Text/Combo/Checkbox/...()'
 *          addFilterDescriptionText()
 *          Or, specifically, should be 'addFilter' + 'Model/Table' + 'Text/Combo/Checkbox/...()'
 *          addFilterCountryCombo()
 * @see https://backpackforlaravel.com/docs/4.0/crud-filters
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
 */
trait CommonFilters
{
    // All filters should be shown in alphabetical order

    /**
     * Add filter to Contract number field.
     *
     * @author Anderson Sathler <asathler@gmail.com>
     */
    protected function addFilterContractNumber()
    {
        $field = [
            'name' => 'contrato',      // Translate
            'type' => 'select2',
            'label' => 'Núm. Contrato' // Translate
        ];

        $contracts = [];
        // $contracts = $this->retornaContratos(); // Translate

        CRUD::addFilter(
            $field,
            $contracts,
            function ($value) {
                $this->crud->addClause('where', 'contratos.numero', $value); // Translate
            }
        );
    }
}
