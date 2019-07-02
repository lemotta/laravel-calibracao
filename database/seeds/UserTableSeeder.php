<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        User::create([
            'name' => 'Lenilson Motta',
            'email' => 'lemotta@parks.com.br',
            'password' => bcrypt('Lenisabeva@270105')
                ], [
            'name' => 'Leonei Rodes',
            'email' => 'lrodes@parks.com.br',
            'password' => bcrypt('lrodes1234')]);
    }

}
