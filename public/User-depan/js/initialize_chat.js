import axios from "axios";

document.querySelectorAll("#createChatLink").forEach((link) => {
    link.addEventListener("click", function (event) {
        event.preventDefault();
        const userId = this.getAttribute("data-user-id");
        const mentorId = this.getAttribute("data-mentor-id");

        axios
            .post("/create-private-chat", {
                channel_id: `private_${userId}_${mentorId}`,
                members: [userId, mentorId],
            })
            .then((response) => {
                alert(response.data.message); // Tampilkan pesan sukses
                window.location.href = `/chat/${response.data.channelId}`; // Redirect ke halaman chat
            })
            .catch((error) => {
                console.error(error.response.data.error);
                alert("Failed to create chat: " + error.response.data.error);
            });
    });
});
