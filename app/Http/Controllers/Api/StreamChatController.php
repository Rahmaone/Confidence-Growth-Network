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

    public function chatmentor()
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

    public function createPrivateChat(Request $request)
    {
        // Ambil channel_id dan members dari body request
        $channelId = $request->input('channel_id'); // Ambil channel_id dari body request
        $members = $request->input('members'); // Ambil members dari body request

        // Cek apakah members valid (harus ada 2 member)
        if (empty($members) || count($members) !== 2) {
            return response()->json(['error' => 'Invalid members data'], 400);
        }

        // Cari user dan mentor berdasarkan ID yang dikirim
        $user = User::find($members[0]);
        $mentor = User::find($members[1]);

        if (!$user || !$mentor) {
            return response()->json(['error' => 'User or mentor not found'], 404);
        }

        try {
            // Buat channel private menggunakan StreamChatService
            $channel = $this->StreamChatService->createChannel($channelId, $members);

            // Jika channel berhasil dibuat, kembalikan response sukses
            return response()->json([
                'success' => true,
                'message' => 'Private channel created successfully',
                'channelId' => $channelId,
            ]);
        } catch (\Exception $e) {
            // Jika terjadi error saat membuat channel
            \Log::error('Failed to create channel', [
                'channelId' => $channelId,
                'members' => $members,
                'exception' => $e->getMessage(),
            ]);

            return response()->json(['error' => 'Failed to create channel'], 500);
        }
    }



    // public function createPrivateChat($userId, $mentorId)
    // {
    //     \Log::info('Create Private Chat Debug: ', ['userId' => $userId, 'mentorId' => $mentorId]);

    //     // Validasi input
    //     if (!is_numeric($userId) || !is_numeric($mentorId)) {
    //         \Log::error('Invalid userId or mentorId', ['userId' => $userId, 'mentorId' => $mentorId]);
    //         return response()->json(['error' => 'Invalid userId or mentorId'], 400);
    //     }

    //     $user = User::find($userId);
    //     $mentor = User::find($mentorId);

    //     if (!$user || !$mentor) {
    //         \Log::error('User or mentor not found', ['userId' => $userId, 'mentorId' => $mentorId]);
    //         return response()->json(['error' => 'User or mentor not found'], 404);
    //     }

    //     $channelId = "private_{$userId}_{$mentorId}";
    //     $members = [$userId, $mentorId];

    //     \Log::info('Calling createChannel', ['channelId' => $channelId, 'members' => $members]);

    //     try {
    //         $response = $this->StreamChatService->createChannel($channelId, $members);
    //         \Log::info('Channel created successfully', ['response' => $response]);
    //         return $response;
    //     } catch (\Exception $e) {
    //         \Log::error('Failed to create channel', [
    //             'channelId' => $channelId,
    //             'members' => $members,
    //             'exception' => $e->getMessage(),
    //         ]);
    //         return response()->json(['error' => 'Failed to create channel'], 500);
    //     }
    // }

    public function checkPrivateChat($channelId)
    {

        try {
            // API request untuk cek keberadaan channel
            $response = $this->client->get("/channels/messaging/{$channelId}");
            
            // Jika response status adalah 200, berarti channel ada
            if ($response->getStatusCode() === 200) {
                return response()->json(['exists' => true, 'channel' => json_decode($response->getBody()->getContents())]);
            }
    
            // Jika tidak ada, return false
            return response()->json(['exists' => false]);
    
        } catch (\Exception $e) {
            if ($e->getCode() === 404) {
                // Channel tidak ada
                return response()->json(['exists' => false, 'message' => 'Channel not found']);
            }

            \Log::error('StreamChat Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function checkUser($userId)
    {
        try {
            $response = $this->client->queryUsers([
                'id' => $userId, // Filter berdasarkan ID pengguna
            ]);

            if (!empty($response['users'])) {
                return response()->json(['exists' => true]);
            } else {
                return response()->json(['exists' => false]);
            }
        } catch (\Exception $e) {
            \Log::error('StreamChat Error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    // Endpoint untuk mendaftarkan user
    public function registerUser(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|string',
        ]);

        // Dapatkan data user dari database
        $user = \App\Models\User::find($validated['user_id']);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return $this->StreamChatService->createStreamUser($user);
    }
}
