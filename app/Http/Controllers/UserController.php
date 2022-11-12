<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignUpUserRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        return "Halo ini adalah method index, dalam controller SiswaController";
    }
    public function login(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        
        if (!$user){
            session()->setFlashdata('msg', 'Username Not Found');
            return redirect('/');
        }

        if (!password_verify($request->password, $user->password)){
            session()->setFlashdata('msg', 'Wrong Password');
            return redirect('/');
        }

        // $role = $this->user->roleRelations($user);
        // $this->setUserSession($user,$role);
        return redirect('menu');
    }
    public function create(SignUpUserRequest $request)
    {
        $registrationData = $request->validated();

        $registrationData['password'] = password_hash($request->password, PASSWORD_BCRYPT);
        $karyawan = User::create($registrationData);
        if($karyawan){
            return 200;
        }
        return 400;
    }
    // public function update(Request $request, $id)
    // {
    //     $user = User::findorFail($id);

    //     if ($item->update($request->validated()))
    //         return response([
    //             'message' => 'Update Data Success',
    //             'data' => $item,
    //         ], 200);

    //     return response([
    //         'message' => 'Update Data Failed',
    //         'data' => null,
    //     ], 400);
    // }
    
}
