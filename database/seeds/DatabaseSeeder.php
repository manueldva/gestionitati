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
            'perfil' => 'Administrador',
            'descripcion' => 'Administrador',
        ]);

        DB::table('modulos')->insert([
            'descripcion' => 'Seguridad',
            'link' => 'seguridad',
            'valor' => 'SEGURIDAD',
        ]);

        DB::table('modulos')->insert([
            'descripcion' => 'Tablero',
            'link' => 'home',
            'valor' => 'TABLERO',
        ]);

        DB::table('modulos')->insert([
            'descripcion' => 'Clientes',
            'link' => 'clientes',
            'valor' => 'CLIENTE',
        ]);

        DB::table('modulos')->insert([
            'descripcion' => 'Complementos',
            'link' => 'complementos',
            'valor' => 'COMPLEMENTO',
        ]);


        DB::table('modulo_perfil')->insert([
            'modulo_id' => 1,
            'perfil_id' => 1,
            'permiso' => 2,
        ]);

        DB::table('modulo_perfil')->insert([
            'modulo_id' => 2,
            'perfil_id' => 1,
            'permiso' => 2,
        ]);

        DB::table('modulo_perfil')->insert([
            'modulo_id' => 3,
            'perfil_id' => 1,
            'permiso' => 2,
        ]);

        DB::table('modulo_perfil')->insert([
            'modulo_id' => 4,
            'perfil_id' => 1,
            'permiso' => 2,
        ]);


        /*DB::table('users')->insert([
            'name' => 'administrador',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('P@ssword123'),
            //'userType' => 'ADMINISTRATOR',
            'perfil_id' => 1,
        ]);*/

        DB::table('users')->insert([
            'name' => 'Avila David',
            'username' => 'mavila',
            'email' => 'manudva22@gmail.com',
            'password' => bcrypt('33456282'),
            //'userType' => 'ADMINISTRATOR',
            'perfil_id' => 1,
        ]);


        DB::table('tipodocumentos')->insert([
            'descripcion' => 'DNI',
        ]);
        
        DB::table('tipodocumentos')->insert([
            'descripcion' => 'CI',
        ]);

        DB::table('tipodocumentos')->insert([
            'descripcion' => 'LE',
        ]);

        DB::table('tipodocumentos')->insert([
            'descripcion' => 'LC',
        ]);

        DB::table('tipodocumentos')->insert([
            'descripcion' => 'PASAPORTE',
        ]);

        DB::table('tipodocumentos')->insert([
            'descripcion' => 'CF',
        ]);

        DB::table('tipodocumentos')->insert([
            'descripcion' => 'Documento Extranjero',
        ]);

        DB::table('tipodocumentos')->insert([
            'descripcion' => 'En trámite con constancia',
        ]);

        DB::table('tipodocumentos')->insert([
            'descripcion' => 'NN',
        ]);


        DB::table('tipodocumentos')->insert([
            'descripcion' => 'CUIT',
        ]);


        DB::table('tipoclientes')->insert([
            'descripcion' => 'Persona Fisica',
        ]);

        DB::table('tipoclientes')->insert([
            'descripcion' => 'Razon Social',
        ]);

        
        DB::table('tipoivas')->insert([
            'descripcion' => 'IVA Responsable Inscripto',
        ]);

        DB::table('tipoivas')->insert([
            'descripcion' => 'IVA Responsable no Inscripto',
        ]);

        DB::table('tipoivas')->insert([
            'descripcion' => 'IVA no Responsable',
        ]);

        DB::table('tipoivas')->insert([
            'descripcion' => 'IVA Sujeto Exento',
        ]);

        DB::table('tipoivas')->insert([
            'descripcion' => 'Consumidor Final',
        ]);

        DB::table('tipoivas')->insert([
            'descripcion' => 'Responsable Monotributo',
        ]);

        DB::table('tipoivas')->insert([
            'descripcion' => 'Sujeto no Categorizado',
        ]);

        DB::table('tipoivas')->insert([
            'descripcion' => 'Proveedor del Exterior',
        ]);

        DB::table('tipoivas')->insert([
            'descripcion' => 'Cliente del Exterior',
        ]);

        DB::table('tipoivas')->insert([
            'descripcion' => 'IVA Liberado – Ley Nº 19.640',
        ]);

        DB::table('tipoivas')->insert([
            'descripcion' => 'IVA Responsable Inscripto – Agente de Percepción',
        ]);

        DB::table('tipoivas')->insert([
            'descripcion' => 'Pequeño Contribuyente Eventual',
        ]);

        
        DB::table('tipoivas')->insert([
            'descripcion' => 'Monotributista Social',
        ]);

        
        DB::table('tipoivas')->insert([
            'descripcion' => 'Pequeño Contribuyente Eventual Social',
        ]);


        DB::table('tipoempleados')->insert([
            'descripcion' => 'Vendedor',
        ]);



        // $this->call(UsersTableSeeder::class);
    }
}
