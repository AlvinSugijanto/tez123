<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Ingredients extends Model
{
    protected $table = 'ingredients';
    protected $primaryKey = 'id_ingredient';
    public $timestamps = true;

    protected $fillable = [
        'id_ingredient',
        'nama',
        'ukuran',
        'satuan',
        'hpp_rata'
    ];
    public function getKategori($storeData)
    {
       $kategori = DB::table('kategori')
        ->where('nama_kategori', $storeData['kategori'])
        ->first();
        if($kategori)
            return $kategori->id_kategori;
    }
    public function getMenu()
    {
        $menu = $this->all();
        foreach($menu as $menus){
            $menus->kategori_id_kategori = DB::table('kategori')
                                        ->where('id_kategori', $menus->kategori_id_kategori)
                                        ->pluck('nama_kategori')
                                        ->first();
        }
        return $menu;
    }
    public function store($request)
    {
        if($request['id'] == NULL){
            return $this->create([
                'nama' => $request['nama']
            ]);
        }else{
            $temp = $this->where('id_ingredient',$request['id'])->pluck('ukuran')->first();
            if($temp != 0 && isset($request['ukuran'])){
                $request['ukuran'] = $request['ukuran'] + $temp;
            }
            return $this->updateOrCreate([
                'id_ingredient' => $request['id']
            ], $request);
        }
    }
    public function updateHpp($nama, $qty, $subtotal){
        $ingredient = DB::table('ingredients')
        ->where('nama',$nama)
        ->first();

        $rataAkhir = $subtotal  / $qty;
        $rataAkhir = sprintf("%.2f",$rataAkhir);
        return DB::table('ingredients')
        ->where('nama',$nama)
        ->update([
            'hpp_rata' => $rataAkhir,
            'ukuran'   => $ingredient->ukuran + $qty
        ]);
    }
}
