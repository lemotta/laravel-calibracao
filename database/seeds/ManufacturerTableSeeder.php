<?php

use Illuminate\Database\Seeder;
use App\Manufacturer;

class ManufacturerTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $manufacturers = [
            'PARKS',
            'MINIPA',
            'FULL GAUGE',
            'ECD',
            'MEGABRAS',
            'ENTELBRA',
            'ICEL',
            'FLUKE',
            'TEKTRONIX',
            'WISE',
            'WWG',
            'WANDEL',
            'TELEBYTE',
            'ELECTROVERT',
            'LEADER',
            'DIGITEL',
            'MITUTOYO',
            'ELETRONIC DIGITAL CALIPER',
            'STAG',
            'HI-LO SYSTEMS',
            'EETOOLS',
            'SLOKA',
            'RUNCOM',
            'TRI',
            'AVR',
            'PROG MASTER',
            'JDSU',
            'THYSSEN',
            'STARA',
            'CP ELETRONICA',
            'LIFEMED',
            'INSTALARME',
            'MAXICLIMA',
            'NAUTEC',
            'THERMOTRON',
            'MIC',
            'NOVUS',
            'WAVETEK'
        ];
        
        foreach ($manufacturers as $manufacturer) {
            Manufacturer::create([
                'name' => $manufacturer
            ]);
        }
    }

}
