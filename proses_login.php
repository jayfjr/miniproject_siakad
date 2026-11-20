<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Pengecekan 1: Cari data berdasarkan username terlebih dahulu
$query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
$cek   = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);

    // Pengecekan 2: Jika username ditemukan, cocokan password-nya
    if ($password == $data['password']) {

        $_SESSION['username'] = $data['username'];
        $_SESSION['nama']     = $data['nama'];
        $_SESSION['role']     = $data['role'];

        if ($data['role'] == "admin") {
            header("location:dashboard.php");
        } else if ($data['role'] == "dosen") {
            header("location:kelas.php");
        } else if ($data['role'] == "mahasiswa") {
            header("location:jadwal_kuliah.php");
        }

    } else {
        echo "<script>
                alert('Password salah!');
                window.location='login.php';
              </script>";
    }

} else {
    echo "<script>
            alert('Username tidak ditemukan!');
            window.location='login.php';
          </script>";
}
?>