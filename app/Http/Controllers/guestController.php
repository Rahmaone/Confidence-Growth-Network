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
        return view('guest.service');
    }
    public function userservice()
    {
        return view('guest.modulPembelajaran');
    }
}