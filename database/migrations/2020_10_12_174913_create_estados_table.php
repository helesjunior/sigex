<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->id()->comment("Table's unique identifier");
            $table->integer('pais_id');

            $table->boolean('capital')->default(false)
                ->comment("If this state is the country's capital");
            $table->string('nome')->comment('State name');
            $table->string('abreviatura')->comment('Short state name');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('situacao')->default(true)->comment('Active or inactive status');

            // $table->timestamps();
            $table->timestamp('created_at')->nullable()->comment('Creation date and time');
            $table->timestamp('updated_at')->nullable()->comment('Last update date and time');

            $table->softDeletes()->comment('Deletion date and time');

            $table->foreign('pais_id')->references('id')->on('paises')->onDelete('cascade');
        });

        DB::statement("COMMENT ON TABLE states IS
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
        Schema::dropIfExists('estados');
    }
}
