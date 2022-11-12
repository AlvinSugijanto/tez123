<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\VarianHarga;
use App\Models\Ingredients;
use App\Models\DetailMenu;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    public $timestamps = false;

    protected $fillable = [
        'nama_menu',
        'foto',
        'kategori_id_kategori',
        'description'
    ];

    public function getKategori($storeData)
    {
       $kategori = DB::table('kategori')
        ->where('nama_kategori', $storeData['kategori'])
        ->first();
        if($kategori)
            return $kategori->id_kategori;
    }
    public function getIngredient($storeData)
    {
       return DB::table('ingredients')
        ->where('nama', $storeData)
        ->pluck('id_ingredient')
        ->first();
        
    }
    public function getMenu($stok)
    {
        $menu = $this->all();
        $detail_menu = $stok;

        foreach($menu as $menus){
            $stok = 0;
            $menus->kategori_id_kategori = DB::table('kategori')
                                        ->where('id_kategori', $menus->kategori_id_kategori)
                                        ->pluck('nama_kategori')
                                        ->first();
            // $menus->harga = VarianHarga::where('menu_id_menu',$menus->id_menu)
            //                 ->first()
            //                 ->min('harga');
            foreach($detail_menu as $temp){
                $data = Ingredients::where('nama',$temp->nama)->first();
                $stok = $data->ukuran / $temp->ukuran;
                $temp->stok = $stok;
            }
            $menus->stok = $detail_menu->where('nama_menu',$menus->nama_menu)->min('stok');
        }
       
        return $menu;
    }

    public function getHarga()
    {

    }
    public function createPath($request)
    {
        if ($request->file('file')) {
            $image = $request->file('file');
            $imageName = $request->nama_menu . '.jpg';

            $image->move(('foto_menu'), $imageName);
            $path = '/foto_menu'.'/'.$imageName;


            return $path;

        }
        return $this->where('id_menu',$request->id)->pluck('foto')->first();
    }
}
