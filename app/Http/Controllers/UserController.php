<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
       return view('admin.users.index');
    }

    public function login()
    {
        return view('user.auth.login');
    }
}