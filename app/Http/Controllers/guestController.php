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

    public function pelaksanaankuiz()
    {
        return view('guest.pelaksanaankuiz');
    }

    public function hasilkuiz(Request $request)
    {
        $score = $request->query('score', 0); // Default score ke 0 jika tidak ada
        return view('guest.hasilkuiz', compact('score'));
    }
}
