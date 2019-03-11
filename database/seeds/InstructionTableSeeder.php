<?php

use Illuminate\Database\Seeder;
use App\Instruction;

class InstructionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Instruction::create([
            'id' => 75,
            'description' => 'CONTROLE DE CALIBRAÇÕES'
        ]);
    }
}
