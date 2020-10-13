<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commits', function (Blueprint $table) {
            $table->id()->comment("Table's unique identifier");
            $table->string('number')->comment('SIAFI 9999NE000000 unique code for each unit');
            $table->boolean('leftover')->default(0)->comment('Has or not any value for leftover');

            // Foreign keys
            $table->foreignId('unit_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Unit foreign key');

            $table->foreignId('creditor_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Creditor foreign key');

            $table->foreignId('internal_plan_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade')
                ->comment('Internal plan foreign key');

            $table->foreignId('expense_kind_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Expense kind foreign key');

            // Values
            $this->commitValue($table);
            $this->commitToPay($table);
            $this->commitSoldOff($table);
            $this->commitPaid($table);
            $this->commitLeftoverSubscription($table);
            $this->commitLeftoverToPay($table);
            $this->commitLeftoverSoldOff($table);
            $this->commitLeftoverPaid($table);

            // $table->timestamps();
            $table->timestamp('created_at')->nullable()->comment('Creation date and time');
            $table->timestamp('updated_at')->nullable()->comment('Last update date and time');

            $table->softDeletes()->comment('Deletion date and time');

            $table->unique(['unit_id', 'number']);
        });

        DB::statement("COMMENT ON TABLE commits IS
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
        Schema::dropIfExists('commits');
    }

    /**
     * Empenhado = 'value'
     *
     * @param Blueprint $table
     * @author Anderson Sathler <asathler@gmail.com
     */
    private function commitValue(Blueprint $table)
    {
        $this->valueColumn($table, 'value',
            'Commit value'
        );
    }

    /**
     * A liquidar = 'to_pay'
     *
     * @param Blueprint $table
     * @author Anderson Sathler <asathler@gmail.com
     */
    private function commitToPay(Blueprint $table)
    {
        $this->valueColumn($table, 'to_pay',
            'Commit value yet to pay'
        );
    }

    /**
     * Liquidado = 'sold_off'
     *
     * @param Blueprint $table
     * @author Anderson Sathler <asathler@gmail.com
     */
    private function commitSoldOff(Blueprint $table)
    {
        $this->valueColumn($table, 'sold_off',
            'Commit value sold off'
        );
    }

    /**
     * Pago = 'paid'
     *
     * @param Blueprint $table
     * @author Anderson Sathler <asathler@gmail.com
     */
    private function commitPaid(Blueprint $table)
    {
        $this->valueColumn($table, 'paid',
            'Commit value already paid'
        );
    }

    /**
     * Inscrito em restos a pagar = 'leftover_subscription'
     *
     * @param Blueprint $table
     * @author Anderson Sathler <asathler@gmail.com
     */
    private function commitLeftoverSubscription(Blueprint $table)
    {
        $this->valueColumn($table, 'leftover_subscription',
            'Subscription of leftover commit'
        );
    }

    /**
     * Resto a pagar a liquidar = 'leftover_to_pay'
     *
     * @param Blueprint $table
     * @author Anderson Sathler <asathler@gmail.com
     */
    private function commitLeftoverToPay(Blueprint $table)
    {
        $this->valueColumn($table, 'leftover_to_pay',
            'Leftover commit value yet to pay'
        );
    }

    /**
     * Resto a pagar liquidado = 'leftover_sold_off'
     *
     * @param Blueprint $table
     * @author Anderson Sathler <asathler@gmail.com
     */
    private function commitLeftoverSoldOff(Blueprint $table)
    {
        $this->valueColumn($table, 'leftover_sold_off',
            'Leftover commit sold off value'
        );
    }

    /**
     * Resto a pagar pago = 'leftover_paid'
     *
     * @param Blueprint $table
     * @author Anderson Sathler <asathler@gmail.com
     */
    private function commitLeftoverPaid(Blueprint $table)
    {
        $this->valueColumn($table, 'leftover_paid',
            'Leftover commit value already paid'
        );
    }

    /**
     * Add new value column, with decimal type, total size = 17 with 2 places and optional comment
     *
     * @param Blueprint $table
     * @param string $columnName
     * @param string $comment
     * @author Anderson Sathler <asathler@gmail.com
     */
    private function valueColumn(Blueprint $table, $columnName, $comment = '')
    {
        $table->decimal($columnName, 17, 2)->default(0)->comment($comment);
    }
}
