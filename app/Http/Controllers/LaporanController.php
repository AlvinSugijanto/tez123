<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kategori;
use Illuminate\Support\Facades\Hash;


class LaporanController extends Controller
{
    // public function index()
    // {
    //     return "Halo ini adalah method index, dalam controller SiswaController";
    // }
    public function monthly_report(Request $request)
    {
        $storeData = $request->validated();

        
        $kategori = Kategori::create($storeData);
        if($karyawan){
            return 200;
        }
        return 400;
    }

    
}
