@extends ('layout.app')

@section ('page-specific-style')
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
@section ('content')

<div class="container mt-4">
    <h2 class="text-center mb-4">Chat with {{ $user->name }}</h2>

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

@section ('page-specific-scripts')
<script src="https://cdn.jsdelivr.net/npm/stream-chat@7.1.0/dist/bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/stream-chat@6"></script>

<script>
    
    document.addEventListener('DOMContentLoaded', async function () {
        const client = new StreamChat("{{ $apiKey }}");

        // Determine the role of the current user (mentor or user)
        const currentUser = {
            id: "{{ $currentUser->id }}",
            name: "{{ $currentUser->name }}",
            image: "{{ $currentUser->profile_image_url ?? 'https://via.placeholder.com/50' }}",
            role: "{{ $currentUser->role }}"
        };

        // Connect the current user to Stream.io
        await client.connectUser(currentUser, "{{ $token }}");

        const user = @json($user ?? null);
        const mentor = @json($mentor ?? null);
        const otherUser = @json($otherUser ?? null);

        // Create or join a private channel
        if (!user || !mentor) {
            console.error("User or mentor data is missing");
            alert("Chat cannot be initialized because user or mentor data is missing.");
        } else {
            const channelId = `private_${user.id}_${mentor.id}`;
            const channel = client.channel('messaging', channelId, {
                name: `Private Chat with ${otherUser.name}`,
                members: [user.id, mentor.id]
            });

            console.log("Channel initialized:", channel);
        }

        await channel.watch();

        // Load existing messages
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
                await channel.sendMessage({ text: message });
                appendMessage(currentUser.id, message);
                input.value = '';
            }
        });

        // Function to append messages to the chat container
        function appendMessage(userId, text) {
            const chatContainer = document.getElementById('chat-container');
            const messageDiv = document.createElement('div');
            messageDiv.className = 'chat-message';
            messageDiv.innerHTML = `
                <div class="user">${userId === currentUser.id ? 'You' : userId}</div>
                <div class="text">${text}</div>
            `;
            chatContainer.appendChild(messageDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    });
</script>
@endsection
