<?php

use Illuminate\Database\Seeder;
use App\Laboratory;

class LaboratoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $laboratories = [
            'AUTENTICA',
            'CALIBRATEC',
            'IAM LABCAL',
            'CETEMP SENAI',
            'LABELO PUC',
            'TRI',
            'JDSU',
            'INTERNO'            
        ];
        
        foreach ($laboratories as $laboratory) {
            Laboratory::create([
                'laboratory' => $laboratory
            ]);
        }
    }
}
