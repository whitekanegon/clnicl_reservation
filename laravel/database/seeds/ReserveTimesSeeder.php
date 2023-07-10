<?php

use Illuminate\Database\Seeder;

class ReserveTimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
         'name' => '9:00～',
         'order' => '1',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '9:30～',
         'order' => '2',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '10:00～',
         'order' => '3',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '10:30～',
         'order' => '4',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '11:00～',
         'order' => '5',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '11:30～',
         'order' => '6',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '12:00～',
         'order' => '7',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '12:30～',
         'order' => '8',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '13:00～',
         'order' => '9',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '13:30～',
         'order' => '10',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '14:00～',
         'order' => '11',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '14:30～',
         'order' => '12',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '15:00～',
         'order' => '13',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '15:30～',
         'order' => '14',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '16:00～',
         'order' => '15',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '16:30～',
         'order' => '16',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '17:00～',
         'order' => '17',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '17:30～',
         'order' => '18',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '18:00～',
         'order' => '19',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '18:30～',
         'order' => '20',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '19:00～',
         'order' => '21',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '19:30～',
         'order' => '22',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '20:00～',
         'order' => '23',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '20:30～',
         'order' => '24',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '21:00～',
         'order' => '25',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '21:30～',
         'order' => '26',
        ];
     	DB::table('reserve_times')->insert($param);
        $param = [
         'name' => '22:00～',
         'order' => '27',
        ];
     	DB::table('reserve_times')->insert($param);
    }
}
