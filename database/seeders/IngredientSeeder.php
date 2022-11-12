<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientSeeder extends Seeder
{
    public function run()
    {
        DB::table('ingredients')->insert([
            [
                'nama'   => 'Red Velvet',
                'satuan' => 'gram'
            ],
            [
                'nama'   => 'Blue Syrup',
                'satuan' => 'gram'            
            ],
            [
                'nama'   => 'Oreo',
                'satuan' => 'gram'            
            ],
            [
                'nama'   => 'Rum Syrup',
                'satuan' => 'gram'
            ],
            [
                'nama'   => 'Thai Greentea',
                'satuan' => 'gram'
            ],
            [
                'nama'   => 'SKM',
                'satuan' => 'gram'
            ],
            [
                'nama'   => 'Susu',
                'satuan' => 'gram'
            ],
            [
                'nama'   => 'Espresso',
                'satuan' => 'gram'
            ],
        ]);
    }
}