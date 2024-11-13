<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class guestController extends Controller
{
    public function index()
    {
        return view('guest.index');
    }
       public function service()
    {
        return view('guest.modulPembelajaran');
    }
    public function chatmentor()
    {
        return view('guest.chat-mentor');
    }

    public function kuiz()
    {
        return view('guest.kuiz');
    }
}