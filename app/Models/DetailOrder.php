<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class DetailOrder extends Model
{
    protected $table = 'detail_order';
    protected $primaryKey = 'id_detail_order';
    public $timestamps = true;

    protected $fillable = [
        'jumlah',
        'menu_id_menu',
        'order_id_order',
        'varian',
        'subtotal',
        'created_at',
        'updated_at'
    ];

    public function getMenu($request){
        return DB::table('menu')
        ->where('nama_menu', $request)
        ->pluck('id_menu')
        ->first();
    }
    public function getDetail($id){
        $detail = $this->where('order_id_order',$id)->get();
        foreach($detail as $row){
            $row->harga = DB::table('varian_harga')->where('menu_id_menu', $row->menu_id_menu)->where('varian', $row->Varian)->pluck('harga')->first();
            $row->menu_id_menu = DB::table('menu')->where('id_menu', $row->menu_id_menu)->pluck('nama_menu')->first();
        }
        return $detail;
    }
}
