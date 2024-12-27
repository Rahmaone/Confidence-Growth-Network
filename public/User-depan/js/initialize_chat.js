document.querySelectorAll("#createChatLink").forEach((link) => {
    link.addEventListener("click", async function (event) {
        event.preventDefault();

        const userId = this.getAttribute("data-user-id");
        const mentorId = this.getAttribute("data-mentor-id");
        const channelId = `private_${userId}_${mentorId}`;

        // Inisialisasi Stream Client
        const client = StreamChat.getInstance("{{ api_key }}");

        // Tentukan pengguna saat ini dan pengguna lainnya
        let currentUser = {};
        let otherUser = {};
        try {
            const currentRole = "{{ $currentUser->role }}"; // Periksa apakah ini user atau mentor
            if (currentRole === "mentor") {
                currentUser = await fetchUserDetails(mentorId);
                otherUser = await fetchUserDetails(userId);
            } else {
                currentUser = await fetchUserDetails(userId);
                otherUser = await fetchUserDetails(mentorId);
            }
        } catch (error) {
            console.error("Failed to fetch user details:", error.message);
            alert("Unable to initialize chat. Please try again.");
            return;
        }

        try {
            // Langkah 1: Periksa apakah pengguna terdaftar di Stream API
            await checkOrRegisterUser(currentUser.id);
            await checkOrRegisterUser(otherUser.id);

            // Langkah 2: Hubungkan pengguna ke Stream API
            await client.connectUser(
                {
                    id: currentUser.id,
                    name: currentUser.name,
                },
                currentUser.token
            );

            // Langkah 3: Periksa apakah channel sudah ada
            const checkResponse = await axios.get(
                `/chat/check-private-chat/${channelId}`
            );
            if (checkResponse.data.exists) {
                // Jika channel sudah ada, redirect ke halaman chat
                window.location.href = `/chat/${channelId}`;
            } else {
                // Langkah 4: Buat channel baru jika belum ada
                const newChannel = client.channel("messaging", channelId, {
                    name: `Private Chat with ${otherUser.name}`,
                    members: [currentUser.id, otherUser.id],
                });
                await newChannel.create();

                console.log("Channel created successfully, redirecting...");
                window.location.href = `/chat/${channelId}`;
            }
        } catch (error) {
            console.error(error.response?.data?.error || error.message);
            alert(
                "An error occurred: " +
                    (error.response?.data?.error || "Unknown error")
            );
        }
    });
});

// Fungsi untuk memeriksa atau mendaftarkan pengguna di Stream API
async function checkOrRegisterUser(userId) {
    try {
        const response = await axios.get(`/chat/check-user/${userId}`);
        if (!response.data.exists) {
            // Jika pengguna belum terdaftar, daftarkan pengguna
            await axios.post(`/chat/register-user`, { user_id: userId });
        }
    } catch (error) {
        console.error(
            `Failed to check or register user ${userId}:`,
            error.response?.data?.error || error.message
        );
        throw new Error(
            `Failed to ensure user ${userId} is registered on Stream API.`
        );
    }
}

// Fungsi untuk mengambil detail pengguna
async function fetchUserDetails(userId) {
    try {
        const response = await axios.get(`/chat/user-details/${userId}`);
        return response.data;
    } catch (error) {
        console.error(
            `Failed to fetch user details for ${userId}:`,
            error.message
        );
        throw new Error("Unable to fetch user details.");
    }
}
