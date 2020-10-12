<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id()->comment("Table's unique identifier");
            $table->foreignId('country_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Country foreign key');

            $table->boolean('is_capital')->comment("If this state is the country's capital");
            $table->string('name')->comment('State name');
            $table->string('abbreviation')->comment('Short state name');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('status')->comment('Active or inactive status');

            // $table->timestamps();
            $table->timestamp('created_at')->nullable()->comment('Creation date and time');
            $table->timestamp('updated_at')->nullable()->comment('Last update date and time');

            $table->softDeletes()->comment('Deletion date and time');
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
        Schema::dropIfExists('states');
    }
}
