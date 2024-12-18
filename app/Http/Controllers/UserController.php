<?php

namespace App\Http\Controllers;

use App\Models\User;
use GetStream\StreamChat\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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

    public function chatmentor()
    {
        $mentors = User::where('role', 'mentor')->get(); // Ambil semua user dengan role mentor
        return view('user.fitur.chat-mentor', compact('mentors'));
    }

    
}