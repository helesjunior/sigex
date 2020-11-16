<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id()->comment("Table's unique identifier");

            $table->foreignId('organ_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Organ foreign key');

            $table->string('code')->unique()->comment('Unique SIAFI code for unit');
            $table->string('name', 200)->comment('Unit name');
            $table->string('short_name', 50)->comment('Unit short or abbreviate name');
            $table->string('phone', 20)->nullable()->comment('Unit contact phone number');

            $table->foreignId('currency_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Currency foreign key');

            $table->integer('city_id')->nullable()->comment('City foreign key');
            $table->integer('state_id')->nullable()->comment('State foreign key');
            $table->integer('country_id')->nullable()->comment('Country foreign key');
            $table->integer('type_id')->comment('Unit type foreign key');
            $table->boolean('status')->default(true)->comment('Active or inactive status');

            // $table->foreign('type_id')->references('id')->on('code_items')->onDelete('cascade');

            // esfera
            // poder
            // tipo adm
            // situacao

            // gestao
            // codigo siasg
            // sisg ?
            // aderiu siasg
            // codigo siorg

            // $table->timestamps();
            $table->timestamp('created_at')->nullable()->comment('Creation date and time');
            $table->timestamp('updated_at')->nullable()->comment('Last update date and time');

            $table->softDeletes()->comment('Deletion date and time');
        });

        DB::statement("COMMENT ON TABLE units IS
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
        Schema::dropIfExists('units');
    }
}
