<?php

use App\Tb_usuario_tiene_rol;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tb_usuario_tiene_rolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_usuario_tiene_rol')->insert([
            'idUser' => '1',
            'idRol' => '1',
            'idEmpresa' =>'1'
        ]);
        DB::table('tb_usuario_tiene_rol')->insert([
            'idUser' => '2',
            'idRol' => '1',
            'idEmpresa' =>'2'
        ]);
        DB::table('tb_usuario_tiene_rol')->insert([
            'idUser' => '3',
            'idRol' => '1',
            'idEmpresa' =>'3'
        ]);
        DB::table('tb_usuario_tiene_rol')->insert([
            'idUser' => '4',
            'idRol' => '1',
            'idEmpresa' =>'4'
        ]);
        DB::table('tb_usuario_tiene_rol')->insert([
            'idUser' => '5',
            'idRol' => '1',
            'idEmpresa' =>'5'
        ]);
        DB::table('tb_usuario_tiene_rol')->insert([
            'idUser' => '6',
            'idRol' => '1',
            'idEmpresa' =>'6'
        ]);
        DB::table('tb_usuario_tiene_rol')->insert([
            'idUser' => '7',
            'idRol' => '1',
            'idEmpresa' =>'7'
        ]);
        DB::table('tb_usuario_tiene_rol')->insert([
            'idUser' => '8',
            'idRol' => '1',
            'idEmpresa' =>'8'
        ]);
        DB::table('tb_usuario_tiene_rol')->insert([
            'idUser' => '9',
            'idRol' => '1',
            'idEmpresa' =>'9'
        ]);
        DB::table('tb_usuario_tiene_rol')->insert([
            'idUser' => '10',
            'idRol' => '1',
            'idEmpresa' =>'10'
        ]);
        DB::table('tb_usuario_tiene_rol')->insert([
            'idUser' => '11',
            'idRol' => '1',
            'idEmpresa' =>'11'
        ]);
        DB::table('tb_usuario_tiene_rol')->insert([
            'idUser' => '12',
            'idRol' => '1',
            'idEmpresa' =>'12'
        ]);
        DB::table('tb_usuario_tiene_rol')->insert([
            'idUser' => '13',
            'idRol' => '1',
            'idEmpresa' =>'13'
        ]);
        DB::table('tb_usuario_tiene_rol')->insert([
            'idUser' => '14',
            'idRol' => '1',
            'idEmpresa' =>'14'
        ]);
        DB::table('tb_usuario_tiene_rol')->insert([
            'idUser' => '15',
            'idRol' => '1',
            'idEmpresa' =>'15'
        ]);
        DB::table('tb_usuario_tiene_rol')->insert([
            'idUser' => '16',
            'idRol' => '1',
            'idEmpresa' =>'16'
        ]);
        DB::table('tb_usuario_tiene_rol')->insert([
            'idUser' => '17',
            'idRol' => '1',
            'idEmpresa' =>'17'
        ]);
    }
}
