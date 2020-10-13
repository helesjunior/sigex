<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id()->comment("Table's unique identifier");

            $table->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade')
                ->comment('Country foreign key');

            $table->foreignId('creditor_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Country foreign key');

            $table->foreignId('modality_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade')
                ->comment('Country foreign key');

            $table->foreignId('sub_category_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade')
                ->comment('Country foreign key');

            $table->foreignId('type_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade')
                ->comment('Country foreign key');

            $table->foreignId('unit_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Country foreign key');

            $table->foreignId('origin_unit_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Country foreign key');

            /*
            $table->foreign('categoria_id')->references('id')->on('codigoitens')->onDelete('cascade');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores')->onDelete('cascade');
            $table->foreign('modalidade_id')->references('id')->on('codigoitens')->onDelete('cascade');
            $table->foreign('subcategoria_id')->references('id')->on('orgaosubcategorias')->onDelete('cascade');
            $table->foreign('tipo_id')->references('id')->on('codigoitens')->onDelete('cascade');
            $table->foreign('unidade_id')->references('id')->on('unidades')->onDelete('cascade');
            $table->foreign('unidadeorigem_id')->references('id')->on('unidades')->onDelete('cascade');
            */

            $table->string('number')->comment('Contract number or identifier');
            // $table->string('processo')->nullable()->comment('');
            $table->text('subject')->comment('Subject and / or goal of contract');
            $table->text('complement')->nullable()->comment('Additional complement info');
            // $table->string('fundamento_legal')->nullable()->comment('');
            // $table->string('licitacao_numero')->nullable()->comment('');
            $table->date('signature')->comment('Contract signature date');
            $table->date('publishing')->nullable()->comment('Contract publishing date');
            $table->date('effective_start')->comment('Contract effective start date');
            $table->date('effective_finish')->comment('Contract effective finish date');
            $table->decimal('start_value', 17 ,2)->nullable()->comment('Contract initial signed value');
            // Parcelas = installments
            $table->integer('installments')->nullable()->comment('Number of installments');
            // $table->decimal('valor_parcela', 17 ,2)->nullable()->comment('');
            // $table->decimal('valor_global', 17, 2)->comment('');
            // $table->decimal('valor_acumulado', 17, 2)->nullable()->comment('');
            // $table->string('situacao_siasg')->nullable()->comment('');
            // $table->char('receita_despesa', 1)->nullable()->comment('');
            $table->boolean('status')->default(true)->comment('Active or inactive status');

            // $table->timestamps();
            $table->timestamp('created_at')->nullable()->comment('Creation date and time');
            $table->timestamp('updated_at')->nullable()->comment('Last update date and time');

            $table->softDeletes()->comment('Deletion date and time');
        });

        DB::statement("COMMENT ON TABLE contracts IS
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
        Schema::dropIfExists('contracts');
    }
}
