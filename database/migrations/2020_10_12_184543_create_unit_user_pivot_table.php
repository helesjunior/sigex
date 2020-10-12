<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUnitUserPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_user', function (Blueprint $table) {
            $table->foreignId('unit_id')
                ->index('unit_user_unit')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Unit foreign key');

            $table->foreignId('user_id')
                ->index('unit_user_user')
                ->constrained()
                ->onDelete('cascade')
                ->comment('User foreign key');

            $table->primary(['unit_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unit_user');
    }
}
