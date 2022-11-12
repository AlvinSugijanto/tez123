<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class DetailPurchase extends Model
{
    protected $table = 'detail_purchase';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'jumlah',
        'subtotal',
        'ingredients_id_ingredient',
        'purchase_id_purchase'
    ];

    public function getIngredient($request){
        return DB::table('ingredients')
        ->where('nama', $request)
        ->pluck('id_ingredient')
        ->first();
    }
    public function getDetail($id){
        $detail = $this->where('purchase_id_purchase',$id)->get();
        foreach($detail as $row){
            $row->ingredients_id_ingredient = DB::table('ingredients')->where('id_ingredient', $row->ingredients_id_ingredient)->pluck('nama')->first();
        }
        return $detail;
    }
}
