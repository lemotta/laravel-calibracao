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
        $this->call(InstructionTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(ManufacturerTableSeeder::class);
        $this->call(TypeOfEquipamentTableSeeder::class);
        $this->call(PeriodTableSeeder::class);
        $this->call(ModelOfEquipamentTableSeeder::class);
        $this->call(ReportTableSeeder::class);
        $this->call(LaboratoryTableSeeder::class);
        $this->call(RegisterTableSeeder::class);
        $this->call(CalibrationTableSeeder::class);
    }
}
