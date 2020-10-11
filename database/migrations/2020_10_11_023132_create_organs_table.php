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
            $table->id()->comment("Table's unique identifier");
            $table->foreignId('higher_organ_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Higher organ foreign key');

            $table->string('code')->unique()->comment('Unique SIAFI code for organ');
            $table->string('name')->comment('Organ name');
            $table->boolean('status')->comment('Active or inactive status');

            // $table->timestamps();
            $table->timestamp('created_at')->nullable()->comment('Creation date and time');
            $table->timestamp('updated_at')->nullable()->comment('Last update date and time');

            // $table->softDeletes();
            $table->timestamp('deleted_at')->nullable()->comment('Deletion date and time');
        });

        DB::statement("COMMENT ON TABLE organs IS
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
        Schema::dropIfExists('organs');
    }
}
