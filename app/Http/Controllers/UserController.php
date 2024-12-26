<?php

namespace App\Http\Controllers;

use App\Models\User;
use GetStream\StreamChat\Client;
use App\Services\StreamChatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ModulPembelajaran;


class UserController extends Controller
{
    protected $client;

    protected $StreamChatService;

    public function __construct(StreamChatService $StreamChatService)
    {
        $this->StreamChatService = $StreamChatService;

        $this->client = new Client(
            config('services.stream.key'),
            config('services.stream.secret')
        );
    }

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
        $users = User::where('role', 'user')->get(); // Ambil semua user dengan role mentor
        return view('user.fitur.chat-mentor', compact('mentors', 'users'));
    }

    public function showChat($userId)
    {
        $currentUser = Auth::user(); // Asumsikan pengguna yang login
        $otherUser = User::find($userId); // Ambil data pengguna yang ingin diajak chat

        if (!$currentUser) {
            abort(404, 'User not found');
        }

        if ($currentUser->role == 'user') {
            $user = $currentUser;
            $mentor = $otherUser;
        } elseif ($currentUser->role == 'mentor') {
            $mentor = $currentUser;
            $user = $otherUser;
        }

        // if (!$user || !$mentor) {
        //     abort(404, 'User or mentor data is invalid');
        // }
        

        try {
            \Log::info('Show Chat Debug', [
                'currentUser' => $currentUser,
                'otherUser' => $otherUser,
                'user' => $user,
                'mentor' => $mentor,
            ]);
            // Buat token Stream Chat untuk mentor
            $token = $this->client->createToken((string)$currentUser->id);
            

            return view('user.fitur.UI_chat', [
                'currentUser' => $currentUser,
                'otherUser' => $otherUser,
                'apiKey' => config('stream.api_key'),
                'token' => $token,
                'user' => $user,
                'mentor' => $mentor,
            ]);
        } catch (\Exception $e) {
            \Log::error('Stream.io error: ' . $e->getMessage());
            return abort(500, 'Failed to initialize chat');
        }
    }
}