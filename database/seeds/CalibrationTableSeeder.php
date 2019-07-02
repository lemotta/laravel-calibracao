<?php

use Illuminate\Database\Seeder;
use App\Calibration;

class CalibrationTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $calibration[] = array(
            'register_id' => 3,
            'laboratory_id' => 5,
            'certificate_calibration' => 'E0645/2019',
            'results' => null,
            'next_calibration' => '2021-06-27',
            'user_id' => 1
        );

        $calibration[] = array(
            'register_id' => 6,
            'laboratory_id' => 5,
            'certificate_calibration' => 'T0830/2019',
            'results' => null,
            'next_calibration' => '2021-06-27',
            'user_id' => 1
        );

        for ($i = 0; $i < count($calibration); $i++) {
            Calibration::create([
                'register_id' => $calibration[$i]['register_id'],
                'laboratory_id' => $calibration[$i]['laboratory_id'],
                'certificate_calibration' => $calibration[$i]['certificate_calibration'],
                'results' => $calibration[$i]['results'],
                'next_calibration' => $calibration[$i]['next_calibration'],
                'user_id' => $calibration[$i]['user_id']
            ]);
        }
    }

}
