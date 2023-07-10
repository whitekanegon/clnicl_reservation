<?php

use Illuminate\Database\Seeder;

class InputTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
         'input_type_id' => 1,
         'type' => 'text',
         'name' => 'テキストボックス',
        ];
        DB::table('input_types')->insert($param);
        $param = [
         'input_type_id' => 2,
         'type' => 'textarea',
         'name' => 'テキストエリア',
        ];
        DB::table('input_types')->insert($param);
        $param = [
         'input_type_id' => 3,
         'type' => 'select',
         'name' => 'セレクトボックス',
        ];
        DB::table('input_types')->insert($param);
        $param = [
         'input_type_id' => 4,
         'type' => 'radio',
         'name' => 'ラジオボタン',
        ];
        DB::table('input_types')->insert($param);
        $param = [
         'input_type_id' => 5,
         'type' => 'checkbox',
         'name' => 'チェックボックス',
        ];
        DB::table('input_types')->insert($param);
        $param = [
         'input_type_id' => 6,
         'type' => 'birthday',
         'name' => '生年月日',
        ];
        DB::table('input_types')->insert($param);
    }
}
