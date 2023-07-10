<?php

use Illuminate\Database\Seeder;

class InputItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
         'name' => 'お名前',
         'input_type_id' => 1,
         'required' => 1,
         'order' => 1,
         'status' => 1,
         'explain' => '（例：山田　太郎）',
         'identify_name' => 'name',
        ];
        DB::table('input_items')->insert($param);
        $param = [
         'name' => 'メールアドレス',
         'input_type_id' => 1,
         'required' => 1,
         'status' => 1,
         'order' => 4,
         'explain' => '（例：clinic@yoyaku.com）',
         'identify_name' => 'email',
        ];
        DB::table('input_items')->insert($param);
        $param = [
         'name' => '生年月日',
         'input_type_id' => 6,
         'required' => 1,
         'order' => 6,
         'status' => 1,
         'explain' => '',
         'identify_name' => 'birthday',
        ];
        DB::table('input_items')->insert($param);
        $param = [
         'name' => 'お名前（フリガナ）',
         'input_type_id' => 1,
         'required' => 1,
         'order' => 2,
         'status' => 1,
         'explain' => '（例：ヤマダ　タロウ）',
         'identify_name' => 'furigana',
        ];
        DB::table('input_items')->insert($param);
        $param = [
         'name' => 'お電話番号',
         'input_type_id' => 1,
         'required' => 1,
         'order' => 3,
         'status' => 1,
         'explain' => '（例：09012345678）',
         'identify_name' => 'tel',
        ];
        DB::table('input_items')->insert($param);
        $param = [
         'name' => '性別',
         'input_type_id' => 4,
         'required' => 1,
         'order' => 7,
         'status' => 1,
         'explain' => '',
         'identify_name' => 'gender',
        ];
        DB::table('input_items')->insert($param);
        $param = [
         'name' => '当院での受診',
         'input_type_id' => 4,
         'required' => 1,
         'order' => 8,
         'status' => 1,
         'explain' => '',
         'identify_name' => 'experience',
        ];
        DB::table('input_items')->insert($param);
        $param = [
         'name' => '当院へのメッセージ',
         'input_type_id' => 2,
         'required' => 0,
         'order' => 9,
         'status' => 1,
         'explain' => '',
         'identify_name' => 'message',
        ];
        DB::table('input_items')->insert($param);
    }
}
