<?php

use Illuminate\Database\Seeder;
use App\Register;

class RegisterTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $registers[] = array(
            'department_id' => 8,
            'number' => 2,
            'serialnumber' => '6818',
            'modelofequipament_id' => 27,
            'require_calibration' => 1,
            'is_pattern' => 1,
            'active' => 1,
            'period_id' => 5,
            'report_id' => null,
            'instruction_id' => 75,
            'contact' => 'lemotta@parks.com.br'
        );

        $registers[] = array(
            'department_id' => 8,
            'number' => 7,
            'serialnumber' => '5725',
            'modelofequipament_id' => 46,
            'require_calibration' => 1,
            'is_pattern' => 1,
            'active' => 1,
            'period_id' => 5,
            'report_id' => 6,
            'instruction_id' => 75,
            'contact' => 'lemotta@parks.com.br'
        );

        $registers[] = array(
            'department_id' => 8,
            'number' => 4,
            'serialnumber' => '79110444',
            'modelofequipament_id' => 15,
            'require_calibration' => 1,
            'is_pattern' => 1,
            'active' => 1,
            'period_id' => 5,
            'report_id' => null,
            'instruction_id' => 75,
            'contact' => 'lemotta@parks.com.br'
        );

        $registers[] = array(
            'department_id' => 8,
            'number' => 3,
            'serialnumber' => '2021511',
            'modelofequipament_id' => 24,
            'require_calibration' => 1,
            'is_pattern' => 1,
            'active' => 1,
            'period_id' => 5,
            'report_id' => null,
            'instruction_id' => 75,
            'contact' => 'lemotta@parks.com.br'
        );

        $registers[] = array(
            'department_id' => 8,
            'number' => 1,
            'serialnumber' => '9152',
            'modelofequipament_id' => 7,
            'require_calibration' => 1,
            'is_pattern' => 1,
            'active' => 1,
            'period_id' => 4,
            'report_id' => null,
            'instruction_id' => 75,
            'contact' => 'lemotta@parks.com.br'
        );

        $registers[] = array(
            'department_id' => 11,
            'number' => 13,
            'serialnumber' => '4760',
            'modelofequipament_id' => 37,
            'require_calibration' => 1,
            'is_pattern' => 1,
            'active' => 1,
            'period_id' => 5,
            'report_id' => null,
            'instruction_id' => 75,
            'contact' => 'lemotta@parks.com.br'
        );
        
        $registers[] = array(
            'department_id' => 11,
            'number' => 20,
            'serialnumber' => '37867',
            'modelofequipament_id' => 50,
            'require_calibration' => 0,
            'is_pattern' => 1,
            'active' => 1,
            'period_id' => null,
            'report_id' => null,
            'instruction_id' => 75,
            'contact' => 'lemotta@parks.com.br'
        );

        for ($i = 0; $i < count($registers); $i++) {
            Register::create([
                'department_id' => $registers[$i]['department_id'],
                'number' => $registers[$i]['number'],
                'serialnumber' => $registers[$i]['serialnumber'],
                'modelofequipament_id' => $registers[$i]['modelofequipament_id'],
                'require_calibration' => $registers[$i]['require_calibration'],
                'is_pattern' => $registers[$i]['is_pattern'],
                'active' => $registers[$i]['active'],
                'period_id' => $registers[$i]['period_id'],
                'report_id' => $registers[$i]['report_id'],
                'instruction_id' => $registers[$i]['instruction_id'],
                'contact' => $registers[$i]['contact']
            ]);
        }
    }

}
