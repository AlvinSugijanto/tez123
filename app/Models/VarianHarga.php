<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
class VarianHarga extends Model
{
    protected $table = 'varian_harga';
    public $timestamps = false;

    protected $fillable = [
        'varian',
        'harga',
        'menu_id_menu',

    ];
    public function getMenu($storeData)
    {
        return $this->join('menu', 'varian_harga.menu_id_menu', '=', 'menu.id_menu')
        ->where('nama_menu',$storeData)
        ->get(['varian','harga','nama_menu']);
        
    }
    public function getHarga($menu)
    {
        foreach($menu as $row){
            $row->harga = $this->where('menu_id_menu',$row->id_menu)->first()->min('harga');
        }
        return $menu;
    }

}
