<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Currency::create([
            'symbol' => 'BRL',
            'name' => 'Real Brasileiro',
            'type' => 'A'
        ]);
    }
}
