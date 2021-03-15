<?php

/**
 * Traits to group CRUD Backpack common columns.
 *
 * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
 */
namespace App\Http\Traits;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait CommonColumns for Backpack common columns.
 *
 * @package App\Http\Traits
 * @example Method name for generic column should be 'addColumn' + 'Name' + 'Text/Combo/Checkbox/...()'
 *          addColumnDescriptionText()
 *          Or, specifically, should be 'addColumn' + 'Model/Table' + 'Text/Combo/Checkbox/...()'
 *          addColumnCountryCombo()
 * @see https://backpackforlaravel.com/docs/4.0/crud-columns
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
 */
trait CommonColumns
{
    // All columns should be shown in alphabetical order

    /**
     * Add column to grid view for Full name field.
     *
     * @author Anderson Sathler M. Ribeiro <asathler@gmail.com>
     */
    protected function addColumnFullName()
    {
        CRUD::addColumn([
            'name' => 'full_name',
            'label' => 'Full name',
            'type' => 'text',
            'visibleInTable' => true,
            'visibleInModal' => true,
            'visibleInShow' => true,
            'visibleInExport' => true,
            'searchLogic' => function (Builder $query, $column, $searchTerm) {
                $query->orWhere(
                    'full_name',
                    'iLike',
                    '%' . $searchTerm . '%'
                );
            }
        ]);
    }
}
