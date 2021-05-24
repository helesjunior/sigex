<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeOfCreditorsCodeitemsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $code = \App\Models\Codigo::create([
            'description' => 'Type of creditors',
            'is_visible' => false
        ]);

        $code_items = \App\Models\CodigoItem::create([
            'code_id' => $code->id,
            'short_description' => '1',
            'description' => 'Legal entity',
            'is_visible' => true
        ]);

        $code_items = \App\Models\CodigoItem::create([
            'code_id' => $code->id,
            'short_description' => '2',
            'description' => 'Natural person',
            'is_visible' => true
        ]);

        $code_items = \App\Models\CodigoItem::create([
            'code_id' => $code->id,
            'short_description' => '3',
            'description' => 'Generic id',
            'is_visible' => true
        ]);

        $code_items = \App\Models\CodigoItem::create([
            'code_id' => $code->id,
            'short_description' => '4',
            'description' => 'Managing unit',
            'is_visible' => true
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\Models\Codigo::where([
            'description' => 'Type of creditors',
            'is_visible' => false
        ])->forceDelete();


    }
}
