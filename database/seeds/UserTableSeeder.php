<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'lenilson dos santos motta',
            'email' => 'lenilsonmotta@gmail.com',
            'password' => bcrypt('Lenisabeva#270105')
        ]);
    }
}
