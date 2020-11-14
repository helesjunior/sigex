<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocations', function (Blueprint $table) {
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
            $this->allocationValue($table);
            $this->allocationToPay($table);
            $this->allocationSoldOff($table);
            $this->allocationPaid($table);
            $this->allocationLeftoverSubscription($table);
            $this->allocationLeftoverToPay($table);
            $this->allocationLeftoverSoldOff($table);
            $this->allocationLeftoverPaid($table);

            // $table->timestamps();
            $table->timestamp('created_at')->nullable()->comment('Creation date and time');
            $table->timestamp('updated_at')->nullable()->comment('Last update date and time');

            $table->softDeletes()->comment('Deletion date and time');

            $table->unique(['unit_id', 'number']);
        });

        DB::statement("COMMENT ON TABLE allocations IS
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
        Schema::dropIfExists('allocations');
    }

    /**
     * Empenhado = 'value'
     *
     * @param Blueprint $table
     * @author Anderson Sathler <asathler@gmail.com
     */
    private function allocationValue(Blueprint $table)
    {
        $this->valueColumn($table, 'value',
            'Allocation value'
        );
    }

    /**
     * A liquidar = 'to_pay'
     *
     * @param Blueprint $table
     * @author Anderson Sathler <asathler@gmail.com
     */
    private function allocationToPay(Blueprint $table)
    {
        $this->valueColumn($table, 'to_pay',
            'Allocation value yet to pay'
        );
    }

    /**
     * Liquidado = 'sold_off'
     *
     * @param Blueprint $table
     * @author Anderson Sathler <asathler@gmail.com
     */
    private function allocationSoldOff(Blueprint $table)
    {
        $this->valueColumn($table, 'sold_off',
            'Allocation value sold off'
        );
    }

    /**
     * Pago = 'paid'
     *
     * @param Blueprint $table
     * @author Anderson Sathler <asathler@gmail.com
     */
    private function allocationPaid(Blueprint $table)
    {
        $this->valueColumn($table, 'paid',
            'Allocation value already paid'
        );
    }

    /**
     * Inscrito em restos a pagar = 'leftover_subscription'
     *
     * @param Blueprint $table
     * @author Anderson Sathler <asathler@gmail.com
     */
    private function allocationLeftoverSubscription(Blueprint $table)
    {
        $this->valueColumn($table, 'leftover_subscription',
            'Subscription of leftover Allocation'
        );
    }

    /**
     * Resto a pagar a liquidar = 'leftover_to_pay'
     *
     * @param Blueprint $table
     * @author Anderson Sathler <asathler@gmail.com
     */
    private function allocationLeftoverToPay(Blueprint $table)
    {
        $this->valueColumn($table, 'leftover_to_pay',
            'Leftover Allocation value yet to pay'
        );
    }

    /**
     * Resto a pagar liquidado = 'leftover_sold_off'
     *
     * @param Blueprint $table
     * @author Anderson Sathler <asathler@gmail.com
     */
    private function allocationLeftoverSoldOff(Blueprint $table)
    {
        $this->valueColumn($table, 'leftover_sold_off',
            'Leftover Allocation sold off value'
        );
    }

    /**
     * Resto a pagar pago = 'leftover_paid'
     *
     * @param Blueprint $table
     * @author Anderson Sathler <asathler@gmail.com
     */
    private function allocationLeftoverPaid(Blueprint $table)
    {
        $this->valueColumn($table, 'leftover_paid',
            'Leftover Allocation value already paid'
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
