<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
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
    <h2 class="text-center mb-4">Chat Room</h2>

    <!-- Chat Messages Section -->
    <div id="chat-container" class="chat-container p-3 border rounded">
        <!-- Pesan akan dimuat di sini secara dinamis -->
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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/stream-chat@7.1.0/dist/bundle.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const client = new StreamChat("{{ $apiKey }}");

        // Menghubungkan pengguna ke Stream.io
        client.connectUser(
            {
                id: "{{ $user->id }}",
                name: "{{ $user->name }}",
                image: "{{ $user->profile_image_url ?? 'https://via.placeholder.com/50' }}"
            },
            "{{ $token }}"
        );

        // Membuat saluran chat
        const channel = client.channel('messaging', 'general', {
            name: 'General Chat'
        });

        channel.watch().then(() => {
            channel.state.messages.forEach(message => {
                appendMessage(message.user.id, message.text);
            });
        });

        // Mengirim pesan
        const form = document.getElementById('chat-form');
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const input = document.getElementById('message');
            const message = input.value.trim();

            if (message) {
                channel.sendMessage({ text: message }).then(() => {
                    appendMessage("{{ $user->id }}", message);
                    input.value = '';
                });
            }
        });

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
