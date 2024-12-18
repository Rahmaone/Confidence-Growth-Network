<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GetStream\StreamChat\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StreamChatController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(
            config('services.stream.key'),
            config('services.stream.secret')
        );
    }

    public function chatmentor2()
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login

        // Pastikan Stream.io Client sudah diinisialisasi
        if (!$this->client) {
            $this->client = new \GetStream\StreamChat\Client(
                config('stream.api_key'),
                config('stream.api_secret')
            );
        }

        try {
            // Periksa apakah pengguna sudah ada di Stream.io menggunakan queryUsers
            $streamUsers = $this->client->queryUsers([
                'id' => (string)$user->id
            ]);

            // Jika pengguna belum ada, buat pengguna baru
            if (empty($streamUsers['users'])) {
                $this->client->upsertUser([
                    'id' => (string)$user->id,
                    'name' => $user->name, // Gunakan nama dari database pengguna Laravel
                    'email' => $user->email, // Opsional, tambahkan email jika diperlukan
                    'role' => $user->role, // Anda bisa menyesuaikan role
                    // Tambahkan atribut lain yang relevan untuk aplikasi Anda
                ]);
            }
        } catch (\Exception $e) {
            // Tangani error (misalnya log error atau tampilkan pesan ke pengguna)
            \Log::error('Stream.io error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to initialize chat'], 500);
        }

        // Buat token untuk pengguna
        $token = $this->client->createToken((string)$user->id);

        return view('user.fitur.chat-mentor-alt', [
            'user' => $user,
            'token' => $token,
            'apiKey' => config('stream.api_key'), // Kirimkan API Key ke view
        ]);
    }

    public function generateToken(Request $request)
    {
        $userId = $request->query('user_id');

        if (!$userId) {
            return response()->json(['error' => 'User ID is required'], 400);
        }

        $token = $this->client->createToken($userId);

        return response()->json(['token' => $token]);
    }

    // Fungsi untuk membuat pengguna di Stream.io
    public function createStreamUser(User $user)
    {
        try {
            // Data pengguna untuk Stream.io
            $streamUserData = [
                'id' => (string)$user->id,       // ID unik dari Laravel (string)
                'name' => $user->name,          // Nama pengguna
                'email' => $user->email,        // Email pengguna
                'image' => $user->profile_image, // URL gambar profil (opsional)
                'role' => $user->role
            ];

            // Membuat pengguna di Stream.io
            $this->client->upsertUser($streamUserData);

            return response()->json(['message' => 'Stream.io user created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createChannel(Request $request)
    {
        $channelId = $request->input('channel_id');
        $members = $request->input('members');

        if (!$channelId || !$members) {
            return response()->json(['error' => 'Channel ID and members are required'], 400);
        }

        $channel = $this->client->Channel('messaging', $channelId, ['members' => $members]);
        $channel->create();

        return response()->json(['message' => 'Channel created successfully']);
    }
}
