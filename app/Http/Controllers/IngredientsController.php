<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Ingredients;
use App\Models\HistoryStok;

use Illuminate\Support\Facades\Hash;


class IngredientsController extends Controller
{

    public function __construct()
    {
        $this->ingredient = new Ingredients();
        $this->history_stok = new HistoryStok();

    }

    public function store(Request $request)
    {
        $storeData = $request->all();

        $ingredient = $this->ingredient->store($storeData);
        if($ingredient->wasChanged('ukuran')){
            $this->history_stok->store($storeData);
        }
        
        return response()->json(['success' => true]);
    }

    public function index()
    {
        $ingredient = Ingredients::all();
        return view('ingredients.ingredients-index',compact('ingredient'));
    }

    public function edit(Request $request)
    {
        $ingredient  = Ingredients::where('id_ingredient',$request->id)->first();
    
        return response()->json($ingredient);
    }

    public function delete($id)
    {
        $ingredient = Ingredients::where('id_ingredient',$id)->delete();
        return back();


    }
    
}
