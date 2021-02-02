<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryTypes = array('incomes', 'expenses');

        foreach ($categoryTypes as $type) {
            DB::table('category_type')->insert(['category_type_name' => $type,]);
        }
    }
}
