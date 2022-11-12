<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RealMenuSeeder extends Seeder
{
    public function run()
    {
        DB::table('menu')->insert([
            [
                'nama_menu'   => 'Elemen Api',
                'foto'        => '/foto_menu/Elemen Api.jpg',
                'kategori_id_kategori'=> 1
            ],
            [
                'nama_menu'   => 'Elemen Air',
                'foto'        => '/foto_menu/Elemen Air.jpg',
                'kategori_id_kategori'=> 1
            ],            
            [
                'nama_menu'   => 'Elemen Tanah',
                'foto'        => '/foto_menu/Elemen Tanah.jpg',
                'kategori_id_kategori'=> 1
            ],            
            [
                'nama_menu'   => 'Elemen Angin',
                'foto'        => '/foto_menu/Elemen Angin.jpg',
                'kategori_id_kategori'=> 1
            ],
            [
                'nama_menu'   => 'Elemen Alam',
                'foto'        => '/foto_menu/Elemen Alam.jpg',
                'kategori_id_kategori'=> 1
            ],
        ]);
    }
}