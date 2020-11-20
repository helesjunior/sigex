<?php

use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $higher_organ = \App\Models\HigherOrgan::create([
            'code' => '63000',
            'name' => 'Advocacia_geral da União',
            'status' => true
        ]);

        $organ = \App\Models\Organ::create([
            'higher_organ_id' => $higher_organ->id,
            'code' => '63000',
            'name' => 'Advocacia_geral da União',
            'status' => true
        ]);

        \App\Models\Unit::create([
            'organ_id' => $organ->id,
            'siafi_code' => '110161',
            'description' => 'Superintendência de Administração no Distrito Federal',
            'short_name' => 'SAD/DF',
            'currency_id' => 1,
            'type_id' => \App\Models\CodeItem::TYPE_UNIT_EXECUTING_MANAGEMENT
        ]);

        \App\Models\Unit::create([
            'organ_id' => $organ->id,
            'siafi_code' => '110096',
            'description' => 'Superintendência de Administração em Pernambuco',
            'short_name' => 'SAD/PE',
            'currency_id' => 1,
            'type_id' => \App\Models\CodeItem::TYPE_UNIT_EXECUTING_MANAGEMENT
        ]);
    }
}
