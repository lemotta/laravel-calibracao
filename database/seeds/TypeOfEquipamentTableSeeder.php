<?php

use Illuminate\Database\Seeder;
use App\Typeofequipament;

class TypeOfEquipamentTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $typeOfEquipaments = [
            'Jiga de Teste',
            'Termo Higrômetro Digital',
            'Termômetro Digital',
            'Termopar',
            'Frequncímetro Digital',
            'Multímetro Digital',
            'Osciloscópio',
            'Test-Set',
            'Fonte Ajustável',
            'Linha Artificial',
            'Máquina de Solda Onda',
            'Gerador de Áudio',
            'Cargas e Bobina e Retenção',
            'Gabinete de Teste',
            'Paquímetro',
            'Programador Universal',
            'Módulo de Programador Universal',
            'Modem',
            'Roteador',
            'Radio',
            'In-Circuit Tester',
            'Power Meter',
            'Terminal RF',
            'Câmara Climática',
            'Testador ESD',
            'JTAG',
            'Testador ESD'
        ];
        
        foreach ($typeOfEquipaments as $typeOfEquipament) {
            Typeofequipament::create([
                'type' => $typeOfEquipament
            ]);
        }
    }

}
