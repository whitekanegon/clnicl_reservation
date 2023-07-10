<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClinicalItemsTableSeeder::class);
        $this->call(ReserveTimesSeeder::class);
        $this->call(RserveStatusesTableSeeder::class);
        $this->call(ReserveIconTableSeeder::class);
        $this->call(WeeksTableSeeder::class);
        $this->call(RegularHolidaysTableSeeder::class);
        $this->call(InputItemsTableSeeder::class);
        $this->call(InputSelectionsTableSeeder::class);
        $this->call(InputTypesTableSeeder::class);
        $this->call(MailSettingsTableSeeder::class);
       }
}
