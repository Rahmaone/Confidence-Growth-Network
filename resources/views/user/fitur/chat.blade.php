@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Chatroom: {{ $channelId }}</h2>

    <!-- Daftar Pesan -->
    <div id="chat-container" class="chat-container p-3 border rounded">
        @foreach ($messages as $message)
            <div class="chat-message">
                <div class="user">
                    {{ $message['user']['id'] === auth()->id() ? 'You' : $message['user']['name'] }}
                </div>
                <div class="text">{{ $message['text'] }}</div>
                <div class="time text-muted">{{ \Carbon\Carbon::parse($message['created_at'])->format('H:i') }}</div>
            </div>
        @endforeach
    </div>

    <!-- Form Input Pesan -->
    <div class="message-input bg-light p-3">
        <form id="chat-form">
            <div class="input-group">
                <input type="text" id="message" class="form-control" placeholder="Type your message here..." required>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Send</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('page-specific-scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const channelId = "{{ $channelId }}";

        // Handle form submission for sending messages
        const form = document.getElementById('chat-form');
        form.addEventListener('submit', async function (e) {
            e.preventDefault();
            const input = document.getElementById('message');
            const message = input.value.trim();

            if (message) {
                try {
                    await axios.post('/send-message', {
                        channel_id: channelId,
                        text: message,
                    });
                    location.reload(); // Reload untuk menampilkan pesan baru
                } catch (error) {
                    console.error(error.response?.data?.error || error.message);
                    alert("Failed to send message: " + (error.response?.data?.error || "Unknown error"));
                }
            }
        });
    });
</script>
@endsection
