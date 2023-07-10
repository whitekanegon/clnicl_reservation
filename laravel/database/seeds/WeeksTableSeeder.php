<?php

use Illuminate\ Database\ Seeder;

class WeeksTableSeeder extends Seeder {
 /**
  * Run the database seeds.
  *
  * @return void
  */
 public function run() {
  $param = [
   'name' => '日曜日',
   'week_id' => '0',
  ];
  DB::table( 'weeks' )->insert( $param );
  $param = [
   'name' => '月曜日',
   'week_id' => '1',
  ];
  DB::table( 'weeks' )->insert( $param );
  $param = [
   'name' => '火曜日',
   'week_id' => '2',
  ];
  DB::table( 'weeks' )->insert( $param );
  $param = [
   'name' => '水曜日',
   'week_id' => '3',
  ];
  DB::table( 'weeks' )->insert( $param );
  $param = [
   'name' => '木曜日',
   'week_id' => '4',
  ];
  DB::table( 'weeks' )->insert( $param );
  $param = [
   'name' => '金曜日',
   'week_id' => '5',
  ];
  DB::table( 'weeks' )->insert( $param );
  $param = [
   'name' => '土曜日',
   'week_id' => '6',
  ];
  DB::table( 'weeks' )->insert( $param );
  $param = [
   'name' => '祝日',
   'week_id' => '7',
  ];
  DB::table( 'weeks' )->insert( $param );
 }
}