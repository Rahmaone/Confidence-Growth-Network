<?php

namespace App\Services;

use GetStream\StreamChat\Client;
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
            $this->client = new \GetStream\StreamChat\Client(
                config('stream.api_key'),
                config('stream.api_secret')
            );
        }
    }

    /**
     * Periksa atau buat pengguna di Stream.io.
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
        $this->client->upsertUser([
            'id' => (string)$user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
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
}
