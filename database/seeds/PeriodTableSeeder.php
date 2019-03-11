<?php

use Illuminate\Database\Seeder;
use App\Period;

class PeriodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $periods = [1,3,6,12,24,48];
        foreach ($periods as $period) {
            Period::create([
                'period_at_month' => $period
            ]);
        }
    }
}
