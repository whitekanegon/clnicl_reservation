<?php

use Illuminate\Database\Seeder;

class ClinicalItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
         'name' => '治療',
         'order' => 1,
         'status' => 1,
         'reserve_timing' => 2,
         'reserve_include_holiday' => 0,
         'calendar_length' => 3,
        ];
        DB::table('clinical_items')->insert($param);
        $param = [
         'name' => '相談',
         'order' => 2,
         'status' => 1,
         'reserve_timing' => 2,
         'reserve_include_holiday' => 0,
         'calendar_length' => 3,
        ];
        DB::table('clinical_items')->insert($param);
        $param = [
         'name' => '定期検診',
         'order' => 3,
         'status' => 1,
         'reserve_timing' => 2,
         'reserve_include_holiday' => 0,
         'calendar_length' => 3,
        ];
        DB::table('clinical_items')->insert($param);
    }
}
