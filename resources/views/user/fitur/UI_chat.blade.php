@extends('layout.app')

@section('page-specific-style')
<style>
    .chat-container {
        max-height: 500px;
        overflow-y: auto;
    }
    .chat-message {
        border-bottom: 1px solid #f1f1f1;
        padding: 10px;
    }
    .chat-message .user {
        font-weight: bold;
    }
    .chat-message .text {
        margin-top: 5px;
    }
    .message-input {
        position: fixed;
        bottom: 0;
        width: 100%;
        background: #fff;
        padding: 10px 0;
        border-top: 1px solid #ddd;
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Chat with {{ $otherUser->name }}</h2>

    <!-- Chat Messages Section -->
    <div id="chat-container" class="chat-container p-3 border rounded">
        <!-- Messages will be dynamically loaded here -->
    </div>

    <!-- Input Section -->
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
<script src="
https://cdn.jsdelivr.net/npm/stream-chat@8.49/dist/browser.full-bundle.min.js
"></script>

<script>
    document.addEventListener('DOMContentLoaded', async function () {


        // Initialize Stream Chat client
        const client = new StreamChat("{{ $apiKey }}");

        // Connect the current user
        await client.connectUser(
            {
                id: "{{ $currentUser->id }}",
                name: "{{ $currentUser->name }}",
                image: "{{ $currentUser->profile_image_url ?? 'https://via.placeholder.com/50' }}"
            },
            "{{ $token }}"
        );

        // Join the existing channel
        const channel = client.channel('messaging', "{{ $channelId }}");

        // Watch the channel for updates
        await channel.watch();

        // Load existing messages and append to the chat container
        channel.state.messages.forEach(message => {
            appendMessage(message.user.id, message.text);
        });

        // Handle form submission for sending messages
        const form = document.getElementById('chat-form');
        form.addEventListener('submit', async function (e) {
            e.preventDefault();
            const input = document.getElementById('message');
            const message = input.value.trim();

            if (message) {
                try {
                    await channel.sendMessage(
                        { text: message }
                    );
                    appendMessage("{{ $currentUser->id }}", message);
                    input.value = '';
                } catch (error) {
                    console.error('Failed to send message:', error);
                }
            }
        });

        // Function to append messages to the chat container
        function appendMessage(userId, text) {
            const chatContainer = document.getElementById('chat-container');
            const messageDiv = document.createElement('div');
            messageDiv.className = 'chat-message';
            messageDiv.innerHTML = `
                <div class="user">${userId === "{{ $currentUser->id }}" ? 'You' : 'User ' + userId}</div>
                <div class="text">${text}</div>
            `;
            chatContainer.appendChild(messageDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    });
</script>
@endsection
