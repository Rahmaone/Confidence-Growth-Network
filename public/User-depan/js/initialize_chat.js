import axios from "axios";

document.querySelectorAll("#createChatLink").forEach((link) => {
    link.addEventListener("click", function (event) {
        event.preventDefault();
        const userId = this.getAttribute("data-user-id");
        const mentorId = this.getAttribute("data-mentor-id");
        const channelId = `private_${userId}_${mentorId}`;

        // Periksa apakah channel sudah ada
        axios
            .get(`/check-private-chat/${channelId}`)
            .then((response) => {
                if (response.data.exists) {
                    // Jika channel sudah ada, redirect ke halaman chat
                    window.location.href = `/chat/${channelId}`;
                } else {
                    // Jika channel belum ada, buat channel baru
                    axios
                        .post("/create-private-chat", {
                            channel_id: channelId,
                            members: [userId, mentorId],
                        })
                        .then((response) => {
                            alert(response.data.message); // Tampilkan pesan sukses
                            window.location.href = `/chat/${response.data.channelId}`; // Redirect ke halaman chat
                        })
                        .catch((error) => {
                            console.error(
                                error.response?.data?.error || error.message
                            );
                            alert(
                                "Failed to create chat: " +
                                    (error.response?.data?.error ||
                                        "Unknown error")
                            );
                        });
                }
            })
            .catch((error) => {
                console.error(error.response?.data?.error || error.message);
                alert(
                    "Failed to check chat: " +
                        (error.response?.data?.error || "Unknown error")
                );
            });
    });
});
