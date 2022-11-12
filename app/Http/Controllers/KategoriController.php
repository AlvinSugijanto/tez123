<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kategori;
use Illuminate\Support\Facades\Hash;


class KategoriController extends Controller
{
    // public function index()
    // {
    //     return "Halo ini adalah method index, dalam controller SiswaController";
    // }
    public function create(Request $request)
    {
        $storeData = $request->validated();

        
        $kategori = Kategori::create($storeData);
        if($karyawan){
            return 200;
        }
        return 400;
    }
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findorFail($id);

        if ($kategori->update($request->validated()))
            return response([
                'message' => 'Update Data Success',
                'data' => $kategori,
            ], 200);

        return response([
            'message' => 'Update Data Failed',
            'data' => null,
        ], 400);
    }
    
}
