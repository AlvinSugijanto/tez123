<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        DB::table('menu')->insert([
            [
                'nama_menu'   => 'Americano',
                'foto'        => '/foto_menu/Americano.jpg',
                'kategori_id_kategori'=> 1
            ],
            [
                'nama_menu'   => 'Kopi Tangguh',
                'foto'        => '/foto_menu/Kopi Tangguh.jpg',
                'kategori_id_kategori'=> 1
            ],
            [
                'nama_menu'   => 'Cappucino',
                'foto'        => '/foto_menu/Cappucino.jpg',
                'kategori_id_kategori'=> 1
            ],
            [
                'nama_menu'   => 'Mocchacino',
                'foto'        => '/foto_menu/Mocchacino.jpg',
                'kategori_id_kategori'=> 1
            ],
            [
                'nama_menu'   => 'Kopi Susu Gula Aren',
                'foto'        => '/foto_menu/Kopi Susu Gula Aren.jpg',
                'kategori_id_kategori'=> 1
            ],
            [
                'nama_menu'   => 'Kopi Susu Hazelnut',
                'foto'        => '/foto_menu/Kopi Susu Hazelnut.jpg',
                'kategori_id_kategori'=> 1
            ],
            [
                'nama_menu'   => 'Kopi Susu Vanilla',
                'foto'        => '/foto_menu/Kopi Susu Vanilla.jpg',
                'kategori_id_kategori'=> 1
            ],
            [
                'nama_menu'   => 'Kopi Susu Caramel',
                'foto'        => '/foto_menu/Kopi Susu Caramel.jpg',
                'kategori_id_kategori'=> 1
            ],
            [
                'nama_menu'   => 'Kopi Susu Banana',
                'foto'        => '/foto_menu/Kopi Susu Banana.jpg',
                'kategori_id_kategori'=> 1
            ],
            [
                'nama_menu'   => 'Cafe Latte',
                'foto'        => '/foto_menu/Cafe Latte.jpg',
                'kategori_id_kategori'=> 1
            ],
            [
                'nama_menu'   => 'Caramel Latte',
                'foto'        => '/foto_menu/Caramel Latte.jpg',
                'kategori_id_kategori'=> 1
            ],
            [
                'nama_menu'   => 'Vanilla Latte',
                'foto'        => '/foto_menu/Vanilla Latte.jpg',
                'kategori_id_kategori'=> 1
            ],
            [
                'nama_menu'   => 'Hazelnut',
                'foto'        => '/foto_menu/Hazelnut.jpg',
                'kategori_id_kategori'=> 1
            ],
            [
                'nama_menu'   => 'Avoffee',
                'foto'        => '/foto_menu/Avoffee.jpg',
                'kategori_id_kategori'=> 1
            ],
            [
                'nama_menu'   => 'Taroffee',
                'foto'        => '/foto_menu/Taroffee.jpg',
                'kategori_id_kategori'=> 1
            ],
            [
                'nama_menu'   => 'Lemon Tea',
                'foto'        => '-',
                'kategori_id_kategori'=> 6
            ],
            [
                'nama_menu'   => 'Jasmine Tea',
                'foto'        => '-',
                'kategori_id_kategori'=> 6
            ],
            [
                'nama_menu'   => 'Strawberry Tea',
                'foto'        => '-',
                'kategori_id_kategori'=> 6
            ],
            [
                'nama_menu'   => 'Mango Tea',
                'foto'        => '-',
                'kategori_id_kategori'=> 6
            ],
            [
                'nama_menu'   => 'Lychee Tea',
                'foto'        => '-',
                'kategori_id_kategori'=> 6
            ],
            [
                'nama_menu'   => 'Peach Tea',
                'foto'        => '-',
                'kategori_id_kategori'=> 6
            ],
            [
                'nama_menu'   => 'Milk Tea',
                'foto'        => '-',
                'kategori_id_kategori'=> 6
            ],
            [
                'nama_menu'   => 'Cookies and Cream',
                'foto'        => '-',
                'kategori_id_kategori'=> 2
            ],
            [
                'nama_menu'   => 'Nuttynuts',
                'foto'        => '-',
                'kategori_id_kategori'=> 2
            ],
            [
                'nama_menu'   => 'Strawberry Jam',
                'foto'        => '-',
                'kategori_id_kategori'=> 2
            ],
            [
                'nama_menu'   => 'Almond Milk',
                'foto'        => '-',
                'kategori_id_kategori'=> 2
            ],
        ]);
    }
}