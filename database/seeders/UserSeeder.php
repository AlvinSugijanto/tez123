<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name'         => 'Steven',
                'email'        => 'steven@gmail.com',
                'password'     => bcrypt('alvin5210'),
                'tanggal_lahir'=> '2022',
                'alamat'        => 'Purwokerto',
                'role'          => 'Owner'
            ]
        ]);
    }
}