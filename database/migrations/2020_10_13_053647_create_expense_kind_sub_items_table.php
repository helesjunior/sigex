<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseKindSubItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_kind_sub_items', function (Blueprint $table) {
            $table->id()->comment("Table's unique identifier");
            $table->foreignId('expense_kind_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Expense kind foreign key');

            $table->string('code')->comment('SIAFI expenses kind sub item code');
            $table->string('description')->comment('Expenses kind sub item description');
            $table->boolean('status')->default(true)->comment('Active or inactive status');

            // $table->timestamps();
            $table->timestamp('created_at')->nullable()->comment('Creation date and time');
            $table->timestamp('updated_at')->nullable()->comment('Last update date and time');

            $table->softDeletes()->comment('Deletion date and time');
        });

        DB::statement("COMMENT ON TABLE expense_kind_sub_items IS
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
        Schema::dropIfExists('expense_kind_sub_items');
    }
}
