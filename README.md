# 🎓 Sistem Informasi Akademik (SIAKAD) Mini

Aplikasi web Sistem Informasi Akademik sederhana yang dibangun menggunakan **PHP Native**, **MySQL**, dan **Bootstrap 5**. Proyek ini dirancang sebagai studi kasus pengelolaan data perkuliahan terpadu dengan pembagian hak akses (*multi-role*) antara **Admin**, **Dosen**, dan **Mahasiswa**.

---

## ✨ Fitur Utama Berdasarkan Role

### 🛡️ 1. Administrator (`admin`)
* **Manajemen Master Data (CRUD Modal):** Pengelolaan data **Mahasiswa**, **Dosen**, **Matakuliah**, dan **User** dalam satu halaman menggunakan Bootstrap Modal.
* **Sinkronisasi Akun Otomatis:** Penambahan atau penghapusan data Mahasiswa dan Dosen otomatis membuat atau menghapus akun login pada tabel `user`.
* **Penjadwalan Kelas:** Mengatur jadwal perkuliahan (`kode_mk`, hari, jam mulai/selesai, ruangan, dan dosen pengampu).
* **Plotting Peserta Kelas (KRS):** Mengelola daftar mahasiswa yang mengambil mata kuliah pada setiap jadwal kelas.

### 👨‍🏫 2. Dosen (`dosen`)
* **Jadwal Mengajar:** Menampilkan daftar kelas yang diampu sesuai dengan NID dosen yang sedang login.
* **Absensi 1-Klik (*Real-Time*):** Mencatat waktu kehadiran mahasiswa (`TIME`) untuk Pertemuan 1 hingga Pertemuan 5 hanya dengan satu klik, lengkap dengan fitur pembatalan jika terjadi salah input.
* **Input & Kalkulasi Nilai Otomatis:** Menginput nilai Tugas Mandiri (30%), UTS (30%), dan UAS (40%) dengan perhitungan **Nilai Akhir** dan **Grade (A–E)** otomatis.

### 🎓 3. Mahasiswa (`mahasiswa`)
* **Jadwal Kuliah:** Melihat daftar mata kuliah yang diambil beserta informasi ruangan, waktu, dosen pengampu, dan total SKS.
* **Rekap Absensi:** Memantau status dan jam kehadiran pada setiap pertemuan beserta persentase kehadiran per mata kuliah.
* **Kartu Hasil Studi (KHS):** Melihat rincian nilai ujian, grade huruf, serta perhitungan **Indeks Prestasi Semester (IPS)** secara otomatis.

---

## 🛠️ Teknologi yang Digunakan
* **Backend:** PHP Native (MySQLi)
* **Database:** MySQL / MariaDB
* **Frontend:** HTML5, CSS3, Bootstrap 5.3, Bootstrap Icons
* **Web Server Lokal:** XAMPP / Laragon

---

## 🗄️ Struktur Database (`belajar_php`)

Sistem ini menggunakan 6 tabel relasional utama:
1. `user` — Menyimpan kredensial login dan hak akses (`admin`, `dosen`, `mahasiswa`).
2. `mahasiswa` — Menyimpan data master mahasiswa (`nim`, `nama`, `jurusan`).
3. `dosen` — Menyimpan data master dosen (`nid`, `nama`).
4. `matakuliah` — Menyimpan data master mata kuliah (`kode_mk`, `nama_mk`, `sks`).
5. `jadwal` — Menyimpan jadwal perkuliahan yang berelasi dengan `matakuliah` dan `dosen`.
6. `krs` — Menyimpan relasi mahasiswa dengan jadwal kelas, data kehadiran (`pertemuan1`–`pertemuan5`), serta komponen nilai (`nilai_tm`, `nilai_uts`, `nilai_uas`, `nilai_akhir`, `grade`).

---
