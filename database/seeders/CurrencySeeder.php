<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeders.
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
