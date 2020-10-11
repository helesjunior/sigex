<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organs', function (Blueprint $table) {
            $table->id();
            $table->integer('higher_organ_id')->unsigned();
            $table->string('code')->unique();
            $table->string('name');
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('higher_organ_id')
                ->references('id')
                ->on('higher_organs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organs');
    }
}
