<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'administrador',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('P@ssword123'),
            'userType' => 'ADMINISTRATOR',
        ]);

        DB::table('users')->insert([
            'name' => 'Avila David',
            'username' => 'mavila',
            'email' => 'manudva22@gmail.com',
            'password' => bcrypt('123456'),
            'userType' => 'ADMINISTRATOR',
        ]);

        // $this->call(UsersTableSeeder::class);
    }
}
