<?php
session_start();

// Menghapus semua data session yang tersimpan
session_unset();
session_destroy();

// Kembalikan ke halaman utama / login
header("location:index.php");
exit;
?>