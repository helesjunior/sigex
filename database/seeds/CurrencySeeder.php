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

        $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/Moedas?$format=json';

        try {
            $data = json_decode(file_get_contents($url));
        } catch (\Exception $e) {
            $data = [];
        }

        foreach ($data as $value) {
            if (is_array($value)) {
                foreach ($value as $v) {
                    \App\Models\Currency::create([
                        'symbol' => $v->simbolo,
                        'name' => $v->nomeFormatado,
                        'type' => $v->tipoMoeda,
                    ]);
                }
            }
        }
    }
}
