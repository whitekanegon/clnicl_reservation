<?php

use Illuminate\Database\Seeder;

class InputSelectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
         'input_item_id' => 6,
         'name' => '男性',
         'order' => 1,
        ];
        DB::table('input_selections')->insert($param);
        $param = [
         'input_item_id' => 6,
         'name' => '女性',
         'order' => 2,
        ];
        DB::table('input_selections')->insert($param);
        $param = [
         'input_item_id' => 7,
         'name' => '初診',
         'order' => 1,
        ];
        DB::table('input_selections')->insert($param);
        $param = [
         'input_item_id' => 7,
         'name' => '通院中',
         'order' => 2,
        ];
        DB::table('input_selections')->insert($param);
        $param = [
         'input_item_id' => 7,
         'name' => '久しぶり',
         'order' => 3,
        ];
        DB::table('input_selections')->insert($param);
    }
}
