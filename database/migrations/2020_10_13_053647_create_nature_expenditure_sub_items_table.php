<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNatureExpenditureSubItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nature_expenditure_sub_items', function (Blueprint $table) {
            $table->id()->comment("Table's unique identifier");

            $table->foreignId('nature_expenditure_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Nature expenditure foreign key');

            $table->string('code')->comment('SIAFI nature of expenditure sub item code');
            $table->string('description')->comment('Nature of expenditure sub item description');
            $table->boolean('status')->default(true)->comment('Active or inactive status');

            // $table->timestamps();
            $table->timestamp('created_at')->nullable()->comment('Creation date and time');
            $table->timestamp('updated_at')->nullable()->comment('Last update date and time');

            $table->softDeletes()->comment('Deletion date and time');
        });

        DB::statement("COMMENT ON TABLE nature_expenditure_sub_items IS
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
        Schema::dropIfExists('nature_expenditure_sub_items');
    }
}
