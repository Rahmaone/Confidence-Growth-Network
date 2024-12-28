<?php

namespace App\Services;

use GetStream\StreamChat\Client;
use GetStream\StreamChat\StreamChat;
use Illuminate\Http\Request;

class StreamChatService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(
            config('services.stream.key'),
            config('services.stream.secret')
        );
    }

    /**
     * Inisialisasi Stream.io Client jika belum ada.
     */
    public function initializeStreamClient()
    {
        if (!$this->client) {
            $this->client = new Client(
                config('stream.api_key'),
                config('stream.api_secret')
            );
        }
    }

    /**
     * Periksa pengguna di Stream.io.
     */
    public function ensureStreamUserExists($user)
    {
        $streamUsers = $this->client->queryUsers([
            'id' => (string)$user->id
        ]);

        if (empty($streamUsers['users'])) {
            $this->createStreamUser($user);
        }
    }

    /**
     * Buat token untuk pengguna.
     */
    public function createStreamToken($userId)
    {
        return $this->client->createToken((string)$userId);
    }

    /**
     * Render view untuk fitur chat.
     */
    public function renderChatView($user, $token)
    {
        return view('user.fitur.chat-mentor-alt', [
            'user' => $user,
            'token' => $token,
            'apiKey' => config('stream.api_key'),
        ]);
    }

    public function createStreamUser($user) 
    {
        try {
            $this->client->upsertUser([
                'id' => (string)$user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
            ]);
            return response()->json(['message' => 'User registered successfully']);
        } catch (\Stream\Exceptions\StreamException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createChannel($channelId, $currentUserId, $otherUserId,)
    {
        try {
            $channel = $this->client->Channel(
                'messaging', 
                $channelId, 
                ['members' => [$currentUserId, $otherUserId]]
            );
            $channel->create($currentUserId);

            return response()->json([
                'message' => 'Channel created successfully!',
            ]);
        } catch (\Stream\Exceptions\StreamException $e) {
            // Tangani kesalahan dari Stream API
            \Log::error('StreamChat Error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create channel: ' . $e->getMessage()], 500);
        }
    }

    public function getChannel($channelId)
    {
        try {
            // Ambil channel berdasarkan ID
            $channel = $this->client->Channel('messaging', $channelId);
            
            // Query untuk memverifikasi keberadaan channel
            $response = $channel->query([
                'state' => true,
                'watch' => false,
                'presence' => false,
            ]);

            // Kembalikan channel jika ditemukan
            return $response;
        } catch (\Exception $e) {
            // Tangkap error jika channel tidak ditemukan atau query gagal
            \Log::error('Channel not found or error occurred: ' . $e->getMessage());
            return null;
        }
    }

    public function getConversationsForMentor($mentor)
    {
        // Pastikan mentor terhubung dengan Stream API
        $client = new StreamChat(config('stream.api_key'));
        $client->connectUser($mentor, $mentor->stream_token);

        // Ambil daftar channel di mana mentor menjadi anggota
        $channels = $client->queryChannels([
            'members' => [$mentor->id],
        ]);

        $conversations = [];

        foreach ($channels as $channel) {
            // Menyaring hanya channel yang berisi mentor dan user
            $members = $channel->state->members;
            $user = null;

            // Temukan user yang terhubung di channel
            foreach ($members as $member) {
                if ($member['id'] !== $mentor->id) {
                    $user = $member;
                    break;
                }
            }

            // Jika ditemukan user, ambil pesan terakhir
            if ($user) {
                // Ambil pesan terakhir dari channel
                $lastMessage = $channel->state->messages->last();

                // Menyimpan percakapan dalam array dengan informasi tentang user dan pesan terakhir
                $conversations[$user['id']] = [
                    'user' => $user,
                    'lastMessage' => $lastMessage,
                    'channel' => $channel
                ];
            }
        }

        return $conversations;
    }



}
