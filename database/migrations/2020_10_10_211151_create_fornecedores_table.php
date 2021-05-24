<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornecedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->id();
            $table->integer('tipo_id');
            $table->string('codigo');
            $table->string('nome');
            $table->boolean('consorcio')->default(false);
            $table->integer('pais_id')->nullable();
            $table->integer('estado_id')->nullable();
            $table->integer('cidade_id')->nullable();
            $table->string('endereco');
            $table->integer('numero');
            $table->string('complemento')->nullable();
            $table->string('cep')->nullable();
            $table->string('telefone')->nullable();
            $table->string('contato')->nullable();
            $table->text('informacoes_complementares')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tipo_id')->references('id')->on('codigo_itens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornecedores');
    }
}
