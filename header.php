<?php
session_start();
$nama = $_SESSION['nama'];
$role = $_SESSION['role']; // 'admin', 'dosen', atau 'mahasiswa'
$halaman = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SIAKAD UNIKOM Banten</title>
    <!-- Bootstrap 5 CSS & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8fafc;
        }
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background-color: #0f294a;
        }
        .sidebar .nav-link {
            color: #cbd5e1;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 6px;
            font-weight: 500;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #1e40af;
            color: #ffffff;
        }
        .sidebar .nav-link.active {
            border-left: 4px solid #f59e0b;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar Menu -->
    <div class="sidebar text-white p-3 d-flex flex-column">
        <div class="mb-4 pb-3 border-bottom border-secondary">
            <h5 class="fw-bold mb-0 text-warning">
                <i class="bi bi-mortarboard-fill me-2"></i>SIAKAD
            </h5>
            <small class="text-light opacity-75">UNIKOM Banten</small>
        </div>

        <ul class="nav flex-column mb-auto">
        <!-- Dashboard -->
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link <?php echo ($halaman == 'dashboard.php') ? 'active' : ''; ?>">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>

        <?php if ($role == 'admin') { ?>
        <!-- ==================== MENU ADMIN ==================== -->
        <li class="nav-item mt-3 mb-1 px-3 text-uppercase fw-bold text-warning opacity-75" style="font-size: 0.72rem; letter-spacing: 0.8px;">
            Master Data
        </li>
        <li class="nav-item">
            <a href="user.php" class="nav-link <?php echo ($halaman == 'user.php') ? 'active' : ''; ?>">
                <i class="bi bi-person-gear me-2"></i> User
            </a>
        </li>
        <li class="nav-item">
            <a href="dosen.php" class="nav-link <?php echo ($halaman == 'dosen.php') ? 'active' : ''; ?>">
                <i class="bi bi-person-workspace me-2"></i> Dosen
            </a>
        </li>
        <li class="nav-item">
            <a href="mahasiswa.php" class="nav-link <?php echo ($halaman == 'mahasiswa.php') ? 'active' : ''; ?>">
                <i class="bi bi-people-fill me-2"></i> Mahasiswa
            </a>
        </li>
        <li class="nav-item">
            <a href="matakuliah.php" class="nav-link <?php echo ($halaman == 'matakuliah.php') ? 'active' : ''; ?>">
                <i class="bi bi-journal-bookmark-fill me-2"></i> Matakuliah
            </a>
        </li>

        <li class="nav-item mt-3 mb-1 px-3 text-uppercase fw-bold text-warning opacity-75" style="font-size: 0.72rem; letter-spacing: 0.8px;">
            Penjadwalan
        </li>
        <li class="nav-item">
            <a href="jadwal.php" class="nav-link <?php echo in_array($halaman, ['jadwal_kelas.php', 'jadwal_detail.php', 'jadwal.php']) ? 'active' : ''; ?>">
                <i class="bi bi-calendar-week me-2"></i> Jadwal Kelas
            </a>
        </li>

    <?php } elseif ($role == 'dosen') { ?>
        <!-- ==================== MENU DOSEN ==================== -->
        <li class="nav-item mt-3 mb-1 px-3 text-uppercase fw-bold text-warning opacity-75" style="font-size: 0.72rem; letter-spacing: 0.8px;">
            Menu Dosen
        </li>
        <li class="nav-item">
            <a href="jadwal_mengajar.php" class="nav-link <?php echo in_array($halaman, ['jadwal_mengajar.php', 'detail_absensi.php']) ? 'active' : ''; ?>">
                <i class="bi bi-calendar-check me-2"></i> Jadwal Mengajar
            </a>
        </li>
        <li class="nav-item">
            <a href="nilai_ujian.php" class="nav-link <?php echo in_array($halaman, ['nilai_ujian.php', 'input_nilai.php']) ? 'active' : ''; ?>">
                <i class="bi bi-clipboard-data me-2"></i> Nilai Ujian
            </a>
        </li>

    <?php } elseif ($role == 'mahasiswa') { ?>
        <!-- ==================== MENU MAHASISWA ==================== -->
        <li class="nav-item mt-3 mb-1 px-3 text-uppercase fw-bold text-warning opacity-75" style="font-size: 0.72rem; letter-spacing: 0.8px;">
            Menu Mahasiswa
        </li>
        <li class="nav-item">
            <a href="jadwal_kuliah.php" class="nav-link <?php echo ($halaman == 'jadwal_kuliah.php') ? 'active' : ''; ?>">
                <i class="bi bi-calendar-week me-2"></i> Jadwal Kuliah
            </a>
        </li>
        <li class="nav-item">
            <a href="absensi_mahasiswa.php" class="nav-link <?php echo ($halaman == 'absensi_mahasiswa.php') ? 'active' : ''; ?>">
                <i class="bi bi-check2-square me-2"></i> Absensi
            </a>
        </li>
        <li class="nav-item">
            <a href="nilai_mahasiswa.php" class="nav-link <?php echo ($halaman == 'nilai_mahasiswa.php') ? 'active' : ''; ?>">
                <i class="bi bi-award me-2"></i> Nilai Ujian
            </a>
        </li>
    <?php } ?>
</ul>

        <!-- Tombol Logout -->
        <div class="pt-3 border-top border-secondary">
            <a href="logout.php" class="btn btn-warning w-100 fw-semibold text-dark" onclick="return confirm('Yakin ingin keluar dari sistem?')">
                <i class="bi bi-box-arrow-left me-2"></i> Logout
            </a>
        </div>
    </div>

    <!-- Konten Utama -->
    <div class="flex-grow-1 p-4">
        <!-- Kartu Selamat Datang -->
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold mb-1" style="color: #0f294a;">
                        Selamat Datang, <?=$nama; ?>!
                    </h4>
                    <p class="text-muted mb-0">
                        Anda masuk ke sistem sebagai: 
                        <span class="badge bg-warning text-dark text-uppercase px-3 py-1">
                            <?=$role; ?>
                        </span>
                    </p>
                </div>
                <div class="text-end text-muted d-none d-md-block">
                    <i class="bi bi-person-circle fs-1" style="color: #0f294a;"></i>
                </div>
            </div>
        </div>