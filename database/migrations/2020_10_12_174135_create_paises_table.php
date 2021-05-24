<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @see https://www.iso.org/obp/ui/#search/code/
     * @return void
     */
    public function up()
    {
        Schema::create('paises', function (Blueprint $table) {
            $table->id()->comment("Table's unique identifier");
            $table->string('nome')->comment('Country name');
            $table->string('nome_completo')->comment('Country full name');
            $table->string('alpha2_codigo')->comment('Alpha 2 code for country flag');
            $table->string('alpha3_codigo')->comment('Alpha 3 code for country name');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('situacao')->default(true)->comment('Active or inactive status');

            // $table->timestamps();
            $table->timestamp('created_at')->nullable()->comment('Creation date and time');
            $table->timestamp('updated_at')->nullable()->comment('Last update date and time');

            $table->softDeletes()->comment('Deletion date and time');
        });

        DB::statement("COMMENT ON TABLE countries IS
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
        Schema::dropIfExists('paises');
    }
}
