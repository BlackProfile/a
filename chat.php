<?php
session_start();

// Simpan nama pengguna dalam sesi jika belum ada
if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = 'User' . rand(1000, 9999);
}

// Menyimpan pesan yang dikirim ke file teks
if (isset($_POST['message'])) {
    $message = strip_tags($_POST['message']);
    $username = $_SESSION['username'];
    $chatLog = fopen("chatlog.txt", "a");
    fwrite($chatLog, "<strong>$username:</strong> $message<br>");
    fclose($chatLog);
}

// Mengambil pesan dari file teks
if (isset($_POST['getMessages'])) {
    if (file_exists("chatlog.txt")) {
        echo file_get_contents("chatlog.txt");
    }
}
?>
