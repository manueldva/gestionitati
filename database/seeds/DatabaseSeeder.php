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
        
        DB::table('perfiles')->insert([
            'perfil' => 'administrador',
            'descripcion' => 'administrador',
        ]);

        DB::table('modulos')->insert([
            'descripcion' => 'Seguridad',
            'link' => 'seguridad',
            'valor' => 'SEGURIDAD',
        ]);

        DB::table('modulo_perfil')->insert([
            'modulo_id' => 1,
            'perfil_id' => 1,
            'permiso' => 2,
        ]);


        DB::table('users')->insert([
            'name' => 'administrador',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('P@ssword123'),
            'userType' => 'ADMINISTRATOR',
            'perfil_id' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'Avila David',
            'username' => 'mavila',
            'email' => 'manudva22@gmail.com',
            'password' => bcrypt('123456'),
            'userType' => 'ADMINISTRATOR',
            'perfil_id' => 1,
        ]);

        // $this->call(UsersTableSeeder::class);
    }
}
