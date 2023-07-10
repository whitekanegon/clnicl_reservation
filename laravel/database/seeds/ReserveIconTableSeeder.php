<?php

use Illuminate\ Database\ Seeder;

class ReserveIconTableSeeder extends Seeder {
 /**
  * Run the database seeds.
  *
  * @return void
  */
 public function run() {
  $param = [
   'icon' => '◎',
   'icon_awesome' => '',
   'order' => '1',
  ];
  DB::table( 'reserve_icons' )->insert( $param );

  $param = [
   'icon' => '休',
   'icon_awesome' => '',
   'order' => '2',
  ];
  DB::table( 'reserve_icons' )->insert( $param );

  $param = [
   'icon' => '－',
   'icon_awesome' => '',
   'order' => '3',
  ];
  DB::table( 'reserve_icons' )->insert( $param );

  $param = [
   'icon' => '〇',
   'icon_awesome' => '',
   'order' => '4',
  ];
  DB::table( 'reserve_icons' )->insert( $param );

  $param = [
   'icon' => '×',
   'icon_awesome' => '',
   'order' => '5',
  ];
  DB::table( 'reserve_icons' )->insert( $param );

  $param = [
   'icon' => '△',
   'icon_awesome' => '',
   'order' => '6',
  ];
  DB::table( 'reserve_icons' )->insert( $param );

  $param = [
   'icon' => '□',
   'icon_awesome' => '',
   'order' => '7',
  ];
  DB::table( 'reserve_icons' )->insert( $param );

 }
}