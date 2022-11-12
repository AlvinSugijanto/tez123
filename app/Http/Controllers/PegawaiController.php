<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignUpUserRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class PegawaiController extends Controller
{
    public function indexPegawai(Request $request)
    {
        $pegawai = User::all();
        return view('pegawai/pegawai-index',compact('pegawai'));

    }
    public function create(Request $request)
    {
        $registrationData = $request->all();
        $registrationData['password'] = password_hash($request->password, PASSWORD_BCRYPT);
        $karyawan = User::create($registrationData);
        if($karyawan){
            return response()->json(['success' => true]);
        }
    }

    public function edit(Request $request)
    {
        $pegawai = User::find($request->id);
        if($pegawai){
            return response()->json([
                'success' => true,
                'pegawai' => $pegawai
            ]);
        }
    }
    public function update(Request $request)
    {
        $pegawai = User::find($request->id)
                        ->update([
                            'name' => $request->name,
                            'email' => $request->email,
                            'role' => $request->role,
                            'alamat' => $request->alamat,
                            'tanggal_lahir' => $request->tanggal_lahir,
                        ]);
        return response()->json([
            'success' => true,
        ]);
    }
    
}
