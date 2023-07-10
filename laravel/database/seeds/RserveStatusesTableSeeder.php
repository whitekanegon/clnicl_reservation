<?php

use Illuminate\ Database\ Seeder;

class RserveStatusesTableSeeder extends Seeder {
 /**
  * Run the database seeds.
  *
  * @return void
  */
 public function run() {
  $param = [
   'name' => '予約可',
   'allow' => '1',
   'reserve_icon_id' => '1',
   'order' => '1',
   'status' => '1',
  ];
  DB::table( 'reserve_statuses' )->insert( $param );

  $param = [
   'name' => '休診日',
   'allow' => '0',
   'reserve_icon_id' => '2',
   'order' => '2',
   'status' => '1',
  ];
  DB::table( 'reserve_statuses' )->insert( $param );

  $param = [
   'name' => 'ネット予約不可',
   'allow' => '0',
   'reserve_icon_id' => '3',
   'order' => '3',
   'status' => '1',
  ];
  DB::table( 'reserve_statuses' )->insert( $param );

  $param = [
    'name' => 'あとわずか',
    'allow' => '1',
    'reserve_icon_id' => '6',
    'order' => '4',
    'status' => '1',
   ];
   DB::table( 'reserve_statuses' )->insert( $param );

  }
}
