<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Chat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; }
        #chat-box { width: 100%; height: 400px; border: 1px solid #ccc; overflow-y: scroll; padding: 10px; background-color: #f9f9f9; }
        #message-box { width: 100%; padding: 10px; margin-top: 10px; }
        #send-btn { padding: 10px 20px; background-color: #28a745; color: white; border: none; cursor: pointer; }
        #send-btn:hover { background-color: #218838; }
    </style>
</head>
<body>

    <h2>Live Chat</h2>
    <div id="chat-box"></div>
    <textarea id="message-box" rows="3" placeholder="Ketik pesan Anda..."></textarea><br>
    <button id="send-btn">Kirim</button>

    <script>
        $(document).ready(function () {
            // Ambil pesan secara berkala
            function getMessages() {
                $.post("chat.php", { getMessages: true }, function (data) {
                    $("#chat-box").html(data);
                    $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight); // Auto-scroll ke bawah
                });
            }

            // Kirim pesan
            $("#send-btn").click(function () {
                var message = $("#message-box").val();
                if (message.trim() != "") {
                    $.post("chat.php", { message: message }, function () {
                        $("#message-box").val("");
                        getMessages();
                    });
                }
            });

            // Perbarui chat setiap 2 detik
            setInterval(getMessages, 2000);

            // Mulai chat
            getMessages();
        });
    </script>
</body>
</html>
