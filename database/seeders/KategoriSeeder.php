<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        DB::table('kategori')->insert([
            [
                'nama_kategori'   => 'Coffee',
            ],
            [
                'nama_kategori'   => 'Non-Coffee',
            ],
            [
                'nama_kategori'   => 'Snack',
            ],
            [
                'nama_kategori'   => 'Mains',
            ],
            [
                'nama_kategori'   => 'Yakult Series',
            ],
            [
                'nama_kategori'    => 'Tea-Series'
            ]
        ]);
    }
}