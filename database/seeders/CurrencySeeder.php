<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $currencies = array('USD', 'JOD', 'EUR', 'AED', 'SAR');

        foreach ($currencies as $currency) {
            DB::table('currencies')->insert(['currency_name' => $currency,]);
        }
    }
}
