<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kategori;
use Illuminate\Support\Facades\Hash;


class DashboardController extends Controller
{

    public function index()
    {
        return view('dashboard');

    }


}
