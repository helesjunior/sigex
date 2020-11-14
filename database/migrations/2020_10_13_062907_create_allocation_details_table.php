<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommitDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commit_details', function (Blueprint $table) {
            $table->id()->comment("Table's unique identifier");

            $table->foreignId('commit_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Commit foreign key');

            $table->foreignId('expense_kind_sub_item_id')
                ->constrained()
                ->onDelete('cascade')
                ->comment('Expense kind sub item foreign key');

            // Values
            $this->valueColumn($table, 'empaliquidar', 'SIAFI account: 6.2.2.9.2.01.01');
            $this->valueColumn($table, 'empemliquidacao', 'SIAFI account: 6.2.2.9.2.01.02');
            $this->valueColumn($table, 'empliquidado', 'SIAFI account: 6.2.2.9.2.01.03');
            $this->valueColumn($table, 'emppago', 'SIAFI account: 6.2.2.9.2.01.04');
            $this->valueColumn($table, 'empaliqrpnp', 'SIAFI account: 6.2.2.9.2.01.05');
            $this->valueColumn($table, 'empemliqrpnp', 'SIAFI account: 6.2.2.9.2.01.06');
            $this->valueColumn($table, 'emprpp', 'SIAFI account: 6.2.2.9.2.01.07');

            $this->valueColumn($table, 'rpnpaliquidar', 'SIAFI account: 6.3.1.1.0.00.00');
            $this->valueColumn($table, 'rpnpaliquidaremliquidacao', 'SIAFI account: 6.3.1.2.0.00.00');
            $this->valueColumn($table, 'rpnpliquidado', 'SIAFI account: 6.3.1.3.0.00.00');
            $this->valueColumn($table, 'rpnppago', 'SIAFI account: 6.3.1.4.0.00.00');
            $this->valueColumn($table, 'rpnpaliquidarbloq', 'SIAFI account: 6.3.1.5.1.00.00');
            $this->valueColumn($table, 'rpnpaliquidaremliquidbloq', 'SIAFI account: 6.3.1.5.2.00.00');
            $this->valueColumn($table, 'rpnpcancelado', 'SIAFI account: 6.3.1.9.1.00.00');
            $this->valueColumn($table, 'rpnpoutrocancelamento', 'SIAFI account: 6.3.1.9.8.00.00');
            $this->valueColumn($table, 'rpnpemliqoutrocancelamento', 'SIAFI account: 6.3.1.9.9.00.00');
            $this->valueColumn($table, 'rppliquidado', 'SIAFI account: 6.3.2.1.0.00.00');
            $this->valueColumn($table, 'rpppago', 'SIAFI account: 6.3.2.2.0.00.00');
            $this->valueColumn($table, 'rppcancelado', 'SIAFI account: 6.3.2.9.1.01.00');

            $this->valueColumn($table, 'rpnpaliquidinsc',
                'SIAFI account: 5.3.1.1.1.01.00, RP não processados a liquidar inscritos'
            );
            $this->valueColumn($table, 'rpnpemliquidinsc',
                'SIAFI account: 5.3.1.1.1.02.00, RP não processados em liquidação inscritos'
            );
            $this->valueColumn($table, 'reinscrpnpaliquidbloq',
                'SIAFI account: 5.3.1.2.1.00.00, Reinscrição RPNP a liquidar/bloqueados'
            );
            $this->valueColumn($table, 'reinscrpnpemliquid',
                'SIAFI account: 5.3.1.2.2.00.00, Reinscrição RP não processado em liquidação'
            );
            $this->valueColumn($table, 'rpnprestab',
                'SIAFI account: 5.3.1.3.0.00.00, RP não processados restabelecidos'
            );
            $this->valueColumn($table, 'rpnpaliquidtransfdeb',
                'SIAFI account: 5.3.1.6.1.00.00, RPNP a liquidar recebido por transferência'
            );
            $this->valueColumn($table, 'rpnpaliquidemliquidtransfdeb',
                'SIAFI account: 5.3.1.6.2.00.00, RPNP a liq em liq recebido por transferência'
            );
            $this->valueColumn($table, 'rpnpliquidapgtransfdeb',
                'SIAFI account: 5.3.1.6.3.00.00, RPNP liq a pagar recebidos por transferência'
            );
            $this->valueColumn($table, 'rpnpbloqtransfdeb',
                'SIAFI account: 5.3.1.6.4.00.00, RPNP bloqueados recebidos por transferência'
            );
            $this->valueColumn($table, 'rppinsc',
                'SIAFI account: 5.3.2.1.0.00.00, RP processados - inscritos'
            );
            $this->valueColumn($table, 'rppexecant',
                'SIAFI account: 5.3.2.2.0.00.00, RP processados - exercícios anteriores'
            );
            $this->valueColumn($table, 'rpptrasf',
                'SIAFI account: 5.3.2.6.0.00.00, RP processados recebidos por transferência'
            );
            $this->valueColumn($table, 'rpnpaliquidtransfcred',
                'SIAFI account: 6.3.1.6.1.00.00, RPNP a liquidar transferido'
            );
            $this->valueColumn($table, 'rpnpaliquidemliquidtransfcred',
                'SIAFI account: 6.3.1.6.2.00.00, RPNP a liquidar em liquidação transferido'
            );
            $this->valueColumn($table, 'rpnpliquidapgtransfcred',
                'SIAFI account: 6.3.1.6.3.00.00, RPNP liquidados a pagar transferidos'
            );
            $this->valueColumn($table, 'rpnpbloqtransfcred',
                'SIAFI account: 6.3.1.6.4.00.00, RPNP bloqueados transferidos'
            );
            $this->valueColumn($table, 'rpptransffusao',
                'SIAFI account: 6.3.2.6.0.00.00, RPP transferidos por fusão/cisão/extinção'
            );
            $this->valueColumn($table, 'ajusterpexecant',
                'SIAFI account: 6.3.2.9.1.02.00, Ajuste de controle RP de exercícios anteriores'
            );

            // $table->timestamps();
            $table->timestamp('created_at')->nullable()->comment('Creation date and time');
            $table->timestamp('updated_at')->nullable()->comment('Last update date and time');

            $table->softDeletes()->comment('Deletion date and time');

            $table->unique(['commit_id', 'expense_kind_sub_item_id']);
        });

        DB::statement("COMMENT ON TABLE commit_details IS
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
        Schema::dropIfExists('commit_details');
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
