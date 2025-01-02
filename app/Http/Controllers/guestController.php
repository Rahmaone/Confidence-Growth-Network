<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class guestController extends Controller
{
    public function index()
    {
        $mentors = User::where('role', 'mentor')->get();
        return view('guest.index', compact('mentors'));
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
    public function event()
    {
        return view('guest.event');
    }
    public function about()
    {
        return view('guest.about');
    }
}