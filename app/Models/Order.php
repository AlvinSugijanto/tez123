<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;
use App\Models\DetailOrder;

class Order extends Model
{
    protected $table = 'order';
    public $timestamps = true;
    protected $primaryKey = 'id_order';
    public $incrementing = false;

    protected $fillable = [
        'id_order',
        'status',
        'jenis_order',
        'jenis_pembayaran',
        'total',
        'menu_id_menu',
        'created_by'

    ];
    public function generateId()
    {
        $count = $this->count()+1;
        if($count<10)
        {
            $count = '0'.$count;
        }
        $day = Carbon::now()->format('d');
        return 'SLS-EK'.$day.$count;
    }
    public function reduceStok($detail_order)
    {
        foreach($detail_order as $row){
            $detail_menu = DB::table('detail_menu')->where('menu_id_menu', $row->menu_id_menu)->get();
            foreach($detail_menu as $detail){
                $ingredient = DB::table('ingredients')
                                ->where('id_ingredient', $detail->ingredients_id_ingredient)
                                ->decrement('ukuran' ,$detail->ukuran * $row->jumlah);
            }
        }
        return $detail_order;
    }
    public function historyStok($detail_order, $id_order)
    {
        foreach($detail_order as $row){
            $detail_menu = DB::table('detail_menu')->where('menu_id_menu', $row->menu_id_menu)->get();
            foreach($detail_menu as $detail){
                DB::table('history_stok')
                    ->insert([
                        'qty' => $detail->ukuran * $row->jumlah,
                        'satuan' => 'Gram',
                        'jenis' => 'out',
                        'ingredients_id_ingredient' => $detail->ingredients_id_ingredient,
                        'references_id'             => $id_order,
                        'created_at'                => Carbon::now()
                    ]);
            }
        }
        return $detail_order;
    }
    public function findDetail($request){
        $deleted_rows = DetailOrder::where('order_id_order',$request->id_order)->delete();
        
        for($i=0;$i<count($request['nama_menu']);$i++){
            $detail_order[$i] = DetailOrder::create([
                'jumlah'           => $request['qty'][$i],
                'menu_id_menu'     => DB::table('menu')->where('nama_menu', $request['nama_menu'][$i])->pluck('id_menu')->first(),
                'order_id_order'   => $request->id_order,
                'varian'           => $request['varian'][$i],
                'subtotal'           => $request['subtotal'][$i]

            ]);
        }
    }

}
