<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;
use DB;
class DetailMenu extends Model
{
    protected $table = 'detail_menu';
    protected $primaryKey = 'id_detail_menu';
    public $timestamps = false;

    protected $fillable = [
        'ukuran',
        'satuan',
        'menu_id_menu',
        'ingredients_id_ingredient'
    ];

    public function getStok(){
        $ingredient = $this->join('menu','detail_menu.menu_id_menu','menu.id_menu')
                            ->join('ingredients','detail_menu.ingredients_id_ingredient','ingredients.id_ingredient')
                            ->get(['menu.nama_menu','detail_menu.ukuran','ingredients.nama']);

        return $ingredient;
    }

}
