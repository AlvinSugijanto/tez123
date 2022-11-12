<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateMenuRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Menu;
use App\Models\Kategori;
use App\Models\Ingredients;
use App\Models\DetailMenu;
use App\Models\VarianHarga;

use Illuminate\Support\Facades\Hash;


class MenuController extends Controller
{

    public function __construct()
    {
        $this->menu = new Menu();
        $this->detail_menu = new DetailMenu();
        $this->varian_harga = new VarianHarga();
    }

    public function index()
    {
        $kategori = Kategori::all();
        $ingredient = Ingredients::all();
        $stok = $this->detail_menu->getStok();
        $menu = $this->menu->getMenu($stok);
        return view('menu.menu-index',compact('menu','kategori','ingredient'));
    }
    public function getMenu()
    {

        $kategori = Kategori::all();
        $ingredient = Ingredients::all();
        $stok = $this->detail_menu->getStok();
        $menu = $this->menu->getMenu($stok);
        return view('menu.advanced-menu',compact('menu','kategori','ingredient'));
    }
    public function create()
    {
        $kategori = Kategori::all();
        return view('menu.menu-create',compact('kategori'));

    }
    public function store(Request $request)
    {
        $storeData = $request->all();
        $menu = Menu::updateOrCreate([
            'id_menu' => $request->id
        ],
        [
            'nama_menu' => $storeData['nama_menu'],
            'description' => $storeData['description'],
            'foto'      => $this->menu->createPath($request),
            'kategori_id_kategori' => $this->menu->getKategori($storeData)
        ]);
        if(isset($storeData['ingredient'])){
            for($i=0;$i<count($storeData['ingredient']);$i++){
                DetailMenu::updateOrCreate([
                    'id_detail_menu' => $storeData['id_detail_menu'][$i]
                ],
                [
                    'ukuran' => $storeData['qty'][$i],
                    'satuan' => 'gram',
                    'menu_id_menu' => $menu->id_menu,
                    'ingredients_id_ingredient' => $this->menu->getIngredient($storeData['ingredient'][$i])
                ]);
            };
        }
        if(isset($storeData['varian'])){
            for($i=0;$i<count($storeData['varian']);$i++){
                VarianHarga::updateOrCreate([
                    'id_varian_harga' => $storeData['id_varian_harga'][$i]
                ],
                [
                    'varian' => $storeData['varian'][$i],
                    'harga' => $storeData['harga'][$i],
                    'menu_id_menu' => $menu->id_menu,
                ]);
            };
        }

        // for($i=0;$i<count($storeData['ingredient']);$i++){
        //     DetailMenu::create([
        //         'ukuran' => $storeData['qty'][$i],
        //         'satuan' => 'gram',
        //         'menu_id_menu' => $menu->id_menu,
        //         'ingredients_id_ingredient' => $this->menu->getIngredient($storeData['ingredient'][$i])
        //     ]);
        // };
        // for($i=0;$i<count($storeData['varian']);$i++){
        //     VarianHarga::create([
        //         'varian' => $storeData['varian'][$i],
        //         'harga' => $storeData['harga'][$i],
        //         'menu_id_menu' => $menu->id_menu,
        //     ]);
        // }
        if($menu){
            return response()->json(['success' => true]);
        }

    }
    public function edit(Request $request)
    {
        $menu  = Menu::where('id_menu',$request->id)->first();
        $menu->kategori = $this->menu->getKategori($menu);
        $ingredient_detail = DetailMenu::join('ingredients','detail_menu.ingredients_id_ingredient','=','ingredients.id_ingredient')
                            ->where('menu_id_menu',$request->id)
                            ->select('detail_menu.id_detail_menu','detail_menu.ukuran', 'ingredients.nama')
                            ->get();

        $varian_harga = VarianHarga::where('menu_id_menu',$request->id)->get();
        return response()->json([
            'menu' => $menu, 
            'ingredient' => $ingredient_detail,
            'varian_harga' => $varian_harga
        ]);
        
    }
    public function delete($id)
    {
        $ingredient = Menu::where('id_menu',$id)->delete();
        return back();
    }
    public function deleteDM(Request $request)
    {
        DetailMenu::where('id_detail_menu',$request->id)->delete();
        return response()->json(['success' => true]);
        
    }
    public function deleteHarga(Request $request)
    {
        VarianHarga::where('id_varian_harga',$request->id)->delete();
        return response()->json(['success' => true]);
        
    }
}
