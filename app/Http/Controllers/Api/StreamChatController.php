<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GetStream\StreamChat\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\StreamChatService;

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

        try {
            // Pastikan Stream.io Client sudah diinisialisasi
            $this->initializeStreamClient();

            // Periksa atau buat pengguna di Stream.io
            $this->ensureStreamUserExists($user);

            // Buat token untuk pengguna
            $token = $this->createStreamToken($user->id);

            // Kirimkan data ke view
            return $this->renderChatView($user, $token);
        } catch (\Exception $e) {
            // Tangani error
            \Log::error('Stream.io error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to initialize chat'], 500);
        }
    }

    /**
     * Inisialisasi Stream.io Client jika belum ada.
     */
    private function initializeStreamClient()
    {
        if (!$this->client) {
            $this->client = new \GetStream\StreamChat\Client(
                config('stream.api_key'),
                config('stream.api_secret')
            );
        }
    }

    /**
     * Periksa atau buat pengguna di Stream.io.
     */
    private function ensureStreamUserExists($user)
    {
        $streamUsers = $this->client->queryUsers([
            'id' => (string)$user->id
        ]);

        if (empty($streamUsers['users'])) {
            $this->client->upsertUser([
                'id' => (string)$user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ]);
        }
    }

    /**
     * Buat token untuk pengguna.
     */
    private function createStreamToken($userId)
    {
        return $this->client->createToken((string)$userId);
    }

    /**
     * Render view untuk fitur chat.
     */
    private function renderChatView($user, $token)
    {
        return view('user.fitur.chat-mentor-alt', [
            'user' => $user,
            'token' => $token,
            'apiKey' => config('stream.api_key'),
        ]);
    }

    public function createChannel(Request $request)
    {
        $channelId = $request->input('channel_id');
        $members = $request->input('members');

        if (!$channelId || !$members || count($members) < 2) {
            return response()->json(['error' => 'Channel ID and at least two members are required'], 400);
        }

        try {
            $channel = $this->client->Channel('messaging', $channelId, ['members' => $members]);
            $channel->create();

            return response()->json(['message' => 'Channel created successfully']);
        } catch (\Exception $e) {
            \Log::error('Stream.io error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create channel'], 500);
        }
    }


    public function createPrivateChat($userId, $mentorId)
    {

        $user = User::find($userId);
        $mentor = User::find($mentorId);

        if (!$user || !$mentor) {
            return response()->json(['error' => 'User or mentor not found'], 404);
        }
        
        $channelId = "private_{$userId}_{$mentorId}";
        $members = [$userId, $mentorId];

        $request = new \Illuminate\Http\Request([
            'channel_id' => $channelId,
            'members' => $members,
        ]);

        return $this->createChannel($request);
    }
}
