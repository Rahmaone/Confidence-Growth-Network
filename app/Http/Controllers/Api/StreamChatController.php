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
    protected $StreamChatService;

    public function __construct(StreamChatService $StreamChatService)
    {
        $this->StreamChatService = $StreamChatService;

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
            $this->StreamChatService->initializeStreamClient();

            // Periksa atau buat pengguna di Stream.io
            $this->StreamChatService->ensureStreamUserExists($user);

            // Buat token untuk pengguna
            $token = $this->StreamChatService->createStreamToken($user->id);

            // Kirimkan data ke view
            return $this->StreamChatService->renderChatView($user, $token);
        } catch (\Exception $e) {
            // Tangani error
            \Log::error('Stream.io error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to initialize chat'], 500);
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

        return $this->StreamChatService->createChannel($request);
    }

    public function checkPrivateChat($channelId)
    {

        try {
            $channel = $this->client->Channel('messaging', $channelId);
            $state = $channel->state();

            return response()->json(['exists' => true]);
        } catch (\StreamChat\Exceptions\StreamException $e) {
            // Jika channel tidak ditemukan
            return response()->json(['exists' => false]);
        }
    }

}
