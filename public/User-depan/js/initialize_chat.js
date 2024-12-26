document.querySelectorAll("#createChatLink").forEach((link) => {
    link.addEventListener("click", async function (event) {
        event.preventDefault();
        const userId = this.getAttribute("data-user-id");
        const mentorId = this.getAttribute("data-mentor-id");
        const channelId = `private_${userId}_${mentorId}`;

        try {
            // Langkah 1: Periksa apakah pengguna terdaftar di Stream API
            await checkOrRegisterUser(userId);
            await checkOrRegisterUser(mentorId);

            // Langkah 2: Periksa apakah channel sudah ada
            const checkResponse = await axios.get(
                `/chat/check-private-chat/${channelId}`
            );
            if (checkResponse.data.exists) {
                // Jika channel sudah ada, redirect ke halaman chat
                window.location.href = `/chat/${channelId}`;
            } else {
                // Jika channel belum ada, buat channel baru
                // Mengirimkan permintaan POST untuk membuat private chat
                const createResponse = await axios.post(
                    "/chat/create-private-chat",
                    {
                        channel_id: channelId, // ID channel
                        members: [userId, mentorId], // Daftar anggota
                    }
                );

                // Menangani respons dari server
                if (createResponse.data.success) {
                    alert(createResponse.data.message); // Tampilkan pesan sukses
                    window.location.href = `/chat/${createResponse.data.channelId}`; // Redirect ke halaman chat
                } else {
                    alert(
                        "Error creating channel: " + createResponse.data.error
                    );
                }
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
