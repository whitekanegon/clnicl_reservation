<?php

use Illuminate\Database\Seeder;

class RegularHolidaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'clinical_item_id' => '1',
            'day' => 0,
        ];
        DB::table('regular_holidays')->insert($param);

        $param = [
            'clinical_item_id' => '2',
            'day' => 0,
        ];
        DB::table('regular_holidays')->insert($param);

        $param = [
            'clinical_item_id' => '3',
            'day' => 0,
        ];
        DB::table('regular_holidays')->insert($param);

        $param = [
            'clinical_item_id' => '4',
            'day' => 0,
        ];
        DB::table('regular_holidays')->insert($param);

    }
}
