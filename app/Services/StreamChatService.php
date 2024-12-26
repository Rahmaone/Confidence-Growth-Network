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

    public function createChannel($channelId, $members)
    {
        try {
            $channel = $this->client->Channel('messaging', $channelId, [
                'members' => $members
            ]);
            $channel->create(); // Buat channel baru di Stream API

            return response()->json([
                'message' => 'Channel created successfully!',
                'channelId' => $channelId,
            ]);
        } catch (\Stream\Exceptions\StreamException $e) {
            // Tangani kesalahan dari Stream API
            \Log::error('StreamChat Error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create channel: ' . $e->getMessage()], 500);
        }
    }

}
