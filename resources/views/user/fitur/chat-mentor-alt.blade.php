@extends('layout.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Private Chat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
</head>
<body>
<div class="container mt-4">
    <h2 class="text-center mb-4">{{ $mentor->name }}</h2>

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

<script src="https://cdn.jsdelivr.net/npm/stream-chat@7.1.0/dist/bundle.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', async function () {
        const client = new StreamChat("{{ $apiKey }}");

        // Connect the user to Stream.io
        await client.connectUser(
            {
                id: "{{ $user->id }}",
                name: "{{ $user->name }}",
                image: "{{ $user->profile_image_url ?? 'https://via.placeholder.com/50' }}",
                role: "{{ $user->role }}"
            },
            "{{ $token }}"
        );

        // Create or join a private channel
        const channelId = `private_{{ $user->id }}_{{ $mentor->id }}`;
        const channel = client.channel('messaging', channelId, {
            name: `Private Chat with {{ $mentor->name }}`,
            members: ["{{ $user->id }}", "{{ $mentor->id }}"]
        });

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
                appendMessage("{{ $user->id }}", message);
                input.value = '';
            }
        });

        // Function to append messages to the chat container
        function appendMessage(userId, text) {
            const chatContainer = document.getElementById('chat-container');
            const messageDiv = document.createElement('div');
            messageDiv.className = 'chat-message';
            messageDiv.innerHTML = `
                <div class="user">${userId === "{{ $user->id }}" ? 'You' : userId}</div>
                <div class="text">${text}</div>
            `;
            chatContainer.appendChild(messageDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    });
</script>
</body>
</html>
