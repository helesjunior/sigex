<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal_plans', function (Blueprint $table) {
            $table->id()->comment("Table's unique identifier");
            $table->string('code')->comment('SIAFI internal plan code');
            $table->string('description')->comment('Internal plan description');
            $table->boolean('status')->default(true)->comment('Active or inactive status');

            // $table->timestamps();
            $table->timestamp('created_at')->nullable()->comment('Creation date and time');
            $table->timestamp('updated_at')->nullable()->comment('Last update date and time');

            $table->softDeletes()->comment('Deletion date and time');
        });

        DB::statement("COMMENT ON TABLE internal_plans IS
            '...'
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internal_plans');
    }
}
