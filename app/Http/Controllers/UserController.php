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
        $currentUser = Auth::user();

        // Step 1: Ambil ID mentor dan channel percakapan
        $currentUserId = $currentUser->id; // Format ID mentor di GetStream
        $channels = $this->client->queryChannels([
            'type' => 'messaging',
            'members' => ['$in' => [strval($currentUserId)]],
        ]);

        // Step 2: Ambil daftar user_id dari percakapan
        $userIdsWithConversation = [];
        foreach ($channels['channels'] as $channel) {
            foreach ($channel['members'] as $member) {
                if (($member['user_id'] !== $currentUserId)) {
                    $userIdsWithConversation[] = $member['user_id'];
                }
            }
        }

        // Step 3: Filter pengguna berdasarkan daftar user_id
        $users = User::whereIn('id', $userIdsWithConversation)->get();

        return view('user.fitur.chat-mentor', compact(
            'mentors', 
            'users', 
            'currentUser',
            'channels'
        ));
    }

    public function pelaksanaankuiz()
    {
        return view('user.fitur.pelaksanaankuiz');
    }

    public function hasilkuiz(Request $request)
    {
        $score = $request->query('score', 0); // Default score ke 0 jika tidak ada
        return view('user.fitur.hasilkuiz', compact('score'));
    }
}
    public function initializeChat($otherId) 
    {
        $currentUser = Auth::user(); // Asumsikan pengguna yang login
        $otherUser = User::find($otherId); // Ambil data pengguna yang ingin diajak chat

        if (!$currentUser || !$otherUser) {
            abort(404, 'User not found');
        }

        if ($currentUser->role == 'user') {
            $user = $currentUser;
            $mentor = $otherUser;
        } elseif ($currentUser->role == 'mentor') {
            $mentor = $currentUser;
            $user = $otherUser;
        }

        $this->StreamChatService->ensureStreamUserExists($currentUser);
        $this->StreamChatService->ensureStreamUserExists($otherUser);

        $this->StreamChatService->createStreamToken($currentUser);

        // Membuat ID channel
        $channelId = 'private_' . $user->id . '_' . $mentor->id;

        // Memeriksa apakah channel sudah ada
        $existingChannel = $this->StreamChatService->getChannel($channelId);

        if (!$existingChannel) {
            // Jika channel tidak ada, buat channel baru
            $currentUserId = strval($currentUser->id);
            $otherUserId = strval($otherUser->id);

            // Membuat channel baru
            $this->StreamChatService->createChannel($channelId, $currentUserId, $otherUserId);
        }

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
                'channelId' => $channelId,
                'apiKey' => env('STREAM_API_KEY'),
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
