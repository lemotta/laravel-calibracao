<?php

use Illuminate\Database\Seeder;
use App\Report;

class ReportTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     * 01 - Jiga de Teste
      02 - Termo Higrômetro Digital
      03 - Termômetro Digital
      04 - Termopar
      05 - Frequncímetro Digital
      06 - Multímetro Digital
      07 - Osciloscópio
      08 - Test-Set
      09 - Fonte Ajustável
      10 - Linha Artificial
      11 - Máquina de Solda Onda
      12 - Gerador de Áudio
      13 - Cargas e Bobina e Retenção
      14 - Gabinete de Teste
      15 - Paquímetro
      16 - Programador Universal
      17 - Módulo de Programador Universal
      18 - Modem
      19 - Roteador
      20 - Radio
      21 - In-Circuit Tester
      22 - Power Meter
      23 - Terminal RF
      24 - Câmara Climática
      25 - Testador ESD
      26 - JTAG
      27 - Testador ESD
     */
    public function run() {
        $reports[] = array('number' => 159, 'route' => 'report.159', 'pattern1' => 12, 'pattern2' => 5, 'pattern3' => 6, 'pattern4' => 6);
        $reports[] = array('number' => 160, 'route' => 'report.160', 'pattern1' => 12, 'pattern2' => 5, 'pattern3' => null, 'pattern4' => null);
        $reports[] = array('number' => 161, 'route' => 'report.161', 'pattern1' => 6, 'pattern2' => 14, 'pattern3' => null, 'pattern4' => null);
        $reports[] = array('number' => 163, 'route' => 'report.163', 'pattern1' => 12, 'pattern2' => 5, 'pattern3' => 6, 'pattern4' => 13);
        $reports[] = array('number' => 164, 'route' => 'report.164', 'pattern1' => 12, 'pattern2' => 5, 'pattern3' => 6, 'pattern4' => 13);
        $reports[] = array('number' => 165, 'route' => 'report.165', 'pattern1' => 6, 'pattern2' => 9, 'pattern3' => null, 'pattern4' => null);
        $reports[] = array('number' => 170, 'route' => 'report.170', 'pattern1' => 5, 'pattern2' => null, 'pattern3' => null, 'pattern4' => null);
        $reports[] = array('number' => 175, 'route' => 'report.175', 'pattern1' => 5, 'pattern2' => null, 'pattern3' => null, 'pattern4' => null);
        $reports[] = array('number' => 205, 'route' => 'report.205', 'pattern1' => 6, 'pattern2' => null, 'pattern3' => null, 'pattern4' => null);
        $reports[] = array('number' => 207, 'route' => 'report.207', 'pattern1' => 5, 'pattern2' => 14, 'pattern3' => null, 'pattern4' => null);
        $reports[] = array('number' => 213, 'route' => 'report.213', 'pattern1' => 6, 'pattern2' => 1, 'pattern3' => null, 'pattern4' => null);
        $reports[] = array('number' => 324, 'route' => 'report.324', 'pattern1' => 2, 'pattern2' => 24, 'pattern3' => null, 'pattern4' => null);
        for ($i = 0; $i < count($reports); $i++) {
            Report::create([
                'number'   => $reports[$i]['number'],
                'route'    => $reports[$i]['route'],
                'pattern1' => $reports[$i]['pattern1'],
                'pattern2' => $reports[$i]['pattern2'],
                'pattern3' => $reports[$i]['pattern3'],
                'pattern4' => $reports[$i]['pattern4']
            ]);
        }
    }

}
