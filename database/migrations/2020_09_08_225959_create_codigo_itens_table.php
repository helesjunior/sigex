<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodigoItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codigo_itens', function (Blueprint $table) {
            $table->id()->comment("Table's unique identifier");
            $table->foreignId('codigo_id')->constrained()->onDelete('cascade')->comment('Link to parent table: code');
            $table->string('descricao_resumida', 50)->after('code_id')->nullable();
            $table->string('descricao', 200)->comment('Description or value of each domain data');
            $table->boolean('visivel')->default(true)->comment('Showed or not');

            // $table->timestamps();
            $table->timestamp('created_at')->nullable()->comment('Creation date and time');
            $table->timestamp('updated_at')->nullable()->comment('Last update date and time');

            $table->softDeletes()->comment('Deletion date and time');
        });

        DB::statement("COMMENT ON TABLE code_items IS
            'All domain data values for each code'
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codigo_itens');
    }
}
