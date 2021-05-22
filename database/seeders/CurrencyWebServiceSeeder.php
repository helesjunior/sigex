<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurrencyWebServiceSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/Moedas?$format=json';

        try {
            ini_set('default_socket_timeout', 15); // 15 segundos no máximo!
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
