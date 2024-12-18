<?php

namespace App\Http\Controllers;

use App\Models\User;
use GetStream\StreamChat\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ModulPembelajaran;


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

    public function bukamodulPembelajaran()
    {
        // Ambil data dari database menggunakan model
        $modulPembelajaran = ModulPembelajaran::paginate(3); // 5 item per halaman
        // Kirim data ke view
        return view('user.fitur.modul_pembelajaran', compact('modulPembelajaran'));
        dd($modulPembelajaran); // Dump data untuk memastikan isi variabel
    }

    public function chatmentor()
    {
        $mentors = User::where('role', 'mentor')->get(); // Ambil semua user dengan role mentor
        return view('user.fitur.chat-mentor', compact('mentors'));
    }


}