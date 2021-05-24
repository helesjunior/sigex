<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processos', function (Blueprint $table) {
            $table->id();
            $table->integer('categoria_id');
            $table->foreignId('natureza_despesa_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('natureza_despesa_subelemento_id')
                ->constrained()
                ->onDelete('cascade');
            $table->foreignId('fornecedor_id')
                ->constrained()
                ->onDelete('cascade');
            $table->text('objeto');
            $table->text('informacao_complementar')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('categoria_id')->references('id')->on('codigo_itens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('processos');
    }
}
