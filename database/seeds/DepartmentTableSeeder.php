<?php

use Illuminate\Database\Seeder;
use App\Department;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            'almox',
            'assistec',
            'cqfinal',
            'cqreceb',
            'engteste',
            'filial',
            'infordados',
            'labcalibr',
            'montagem',
            'p&d',
            'processo',
            'teste',
            'ti'
        ];

        foreach ($departments as $department) {
            Department::create([
                'description' => $department
            ]);
        }
    }
}
