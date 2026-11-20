<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universitas Komputer Banten (UNIKOM Banten) | Kampus Teknologi & Portal SIAKAD</title>

    <!-- Google Fonts: Plus Jakarta Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons (CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom CSS Identitas UNIKOM Banten -->
    <style>
        :root {
            --unikom-navy: #0f294a;
            --unikom-navy-dark: #091a30;
            --unikom-blue: #1e40af;
            --unikom-gold: #f59e0b;
            --unikom-gold-hover: #d97706;
            --unikom-gold-soft: #fef3c7;
            --unikom-surface: #f8fafc;
            --unikom-text: #0f172a;
            --unikom-muted: #475569;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--unikom-text);
            background-color: #ffffff;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6, .navbar-brand {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Offset scroll agar judul section tidak tertutup navbar sticky */
        section[id], footer[id] {
            scroll-margin-top: 78px;
        }

        /* ================= 1. NAVBAR STICKY ================= */
        .navbar-unikom {
            background-color: rgba(15, 41, 74, 0.97);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 20px rgba(9, 26, 48, 0.2);
        }

        .navbar-unikom .nav-link {
            color: rgba(255, 255, 255, 0.88);
            font-weight: 500;
            font-size: 0.94rem;
            padding: 0.5rem 0.9rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .navbar-unikom .nav-link:hover,
        .navbar-unikom .nav-link.active {
            color: var(--unikom-gold);
            background-color: rgba(255, 255, 255, 0.06);
        }

        .btn-gold {
            background-color: var(--unikom-gold);
            color: var(--unikom-navy-dark);
            font-weight: 700;
            border: none;
            transition: all 0.25s ease;
        }

        .btn-gold:hover,
        .btn-gold:focus {
            background-color: var(--unikom-gold-hover);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.35);
        }

        .btn-royal {
            background: linear-gradient(135deg, var(--unikom-navy), var(--unikom-blue));
            color: #ffffff;
            font-weight: 600;
            border: none;
            transition: all 0.25s ease;
        }

        .btn-royal:hover,
        .btn-royal:focus {
            background: linear-gradient(135deg, var(--unikom-blue), var(--unikom-navy));
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(30, 64, 175, 0.28);
        }

        /* ================= 2. HERO SECTION ================= */
        .hero-section {
            background: linear-gradient(135deg, var(--unikom-navy-dark) 0%, var(--unikom-navy) 55%, var(--unikom-blue) 100%);
            color: #ffffff;
            position: relative;
            overflow: hidden;
            padding: 5rem 0 5.5rem;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(rgba(245, 158, 11, 0.16) 1px, transparent 1px),
                radial-gradient(rgba(255, 255, 255, 0.06) 1px, transparent 1px);
            background-size: 32px 32px;
            background-position: 0 0, 16px 16px;
            pointer-events: none;
        }

        .hero-pill {
            background-color: rgba(245, 158, 11, 0.16);
            color: #fcd34d;
            border: 1px solid rgba(245, 158, 11, 0.42);
            font-weight: 600;
        }

        .hero-media-wrapper {
            position: relative;
            padding-bottom: 2.25rem;
        }

        .hero-photo {
            width: 100%;
            height: 410px;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.16);
        }

        .hero-floating-card {
            position: relative;
            margin-top: -3.2rem;
            margin-left: 1rem;
            margin-right: 1rem;
            background: rgba(255, 255, 255, 0.97);
            color: var(--unikom-text);
            border-radius: 1rem;
            border-left: 5px solid var(--unikom-gold);
            box-shadow: 0 20px 40px -12px rgba(9, 26, 48, 0.45);
        }

        @media (min-width: 768px) {
            .hero-floating-card {
                margin-left: 1.75rem;
                margin-right: 1.75rem;
            }
        }

        .status-chip {
            background-color: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 0.55rem 0.75rem;
            transition: all 0.2s ease;
        }

        .status-chip:hover {
            border-color: var(--unikom-blue);
            background-color: #eff6ff;
        }

        /* ================= 3. TENTANG & FASILITAS KAMPUS ================= */
        .section-tag {
            display: inline-block;
            background-color: var(--unikom-gold-soft);
            color: #b45309;
            font-weight: 700;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 0.4rem 0.95rem;
            border-radius: 50rem;
            margin-bottom: 0.75rem;
        }

        .about-photo-box {
            position: relative;
        }

        .about-photo {
            width: 100%;
            height: 430px;
            object-fit: cover;
        }

        .about-badge-overlay {
            position: absolute;
            bottom: 1.25rem;
            left: 1.25rem;
            right: 1.25rem;
            background: rgba(15, 41, 74, 0.92);
            backdrop-filter: blur(8px);
            color: #ffffff;
            border-radius: 0.9rem;
            border: 1px solid rgba(255, 255, 255, 0.14);
        }

        .feature-mini-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.95rem;
            transition: all 0.25s ease;
            height: 100%;
        }

        .feature-mini-card:hover {
            transform: translateY(-4px);
            border-color: var(--unikom-blue);
            box-shadow: 0 12px 26px -8px rgba(15, 41, 74, 0.12);
        }

        .feature-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 0.75rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(30, 64, 175, 0.1);
            color: var(--unikom-blue);
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        /* ================= 4. PROGRAM STUDI (4 KARTU) ================= */
        .prodi-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .prodi-card:hover {
            transform: translateY(-6px);
            border-color: var(--unikom-blue);
            box-shadow: 0 20px 38px -12px rgba(15, 41, 74, 0.16);
        }

        .prodi-img-wrapper {
            position: relative;
            overflow: hidden;
        }

        .prodi-card .card-img-top {
            height: 180px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .prodi-card:hover .card-img-top {
            transform: scale(1.05);
        }

        .prodi-badge-float {
            position: absolute;
            top: 0.75rem;
            left: 0.75rem;
        }

        /* ================= 5. LAYANAN SIAKAD & AKTIVITAS ================= */
        .siakad-section {
            background-color: var(--unikom-surface);
        }

        .siakad-banner-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1.25rem;
            overflow: hidden;
            box-shadow: 0 14px 32px -12px rgba(15, 41, 74, 0.1);
        }

        .siakad-banner-img {
            width: 100%;
            height: 100%;
            min-height: 270px;
            max-height: 340px;
            object-fit: cover;
        }

        .modul-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            transition: all 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .modul-card:hover {
            transform: translateY(-5px);
            border-color: var(--unikom-gold);
            box-shadow: 0 18px 34px -12px rgba(15, 41, 74, 0.14);
        }

        /* ================= 6. MODAL LOGIN SIAKAD ================= */
        .modal-header-unikom {
            background: linear-gradient(135deg, var(--unikom-navy) 0%, var(--unikom-blue) 100%);
            color: #ffffff;
            border-bottom: 3px solid var(--unikom-gold);
        }

        .role-tab-group .btn-role-tab {
            border: 1px solid #cbd5e1;
            color: var(--unikom-muted);
            font-weight: 600;
            font-size: 0.875rem;
            padding: 0.58rem 0.5rem;
            background-color: #f8fafc;
            transition: all 0.2s ease;
        }

        .role-tab-group .btn-check:checked + .btn-role-tab {
            background-color: var(--unikom-navy);
            border-color: var(--unikom-navy);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(15, 41, 74, 0.22);
        }

        .role-tab-group .btn-check:checked + .btn-role-tab i {
            color: var(--unikom-gold);
        }

        .form-control:focus {
            border-color: var(--unikom-blue);
            box-shadow: 0 0 0 0.22rem rgba(30, 64, 175, 0.15);
        }

        /* ================= 7. FOOTER ================= */
        .footer-unikom {
            background-color: var(--unikom-navy-dark);
            color: rgba(255, 255, 255, 0.78);
        }

        .footer-unikom a {
            color: rgba(255, 255, 255, 0.76);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer-unikom a:hover {
            color: var(--unikom-gold);
        }

        .social-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            transition: all 0.25s ease;
        }

        .social-circle:hover {
            background-color: var(--unikom-gold);
            color: var(--unikom-navy-dark);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <!-- =====================================================================
         1. NAVBAR STICKY-TOP
    ====================================================================== -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-unikom sticky-top py-2.5">
        <div class="container">
            <!-- Logo Kampus UNIKOM Banten -->
            <a class="navbar-brand d-flex align-items-center gap-2.5" href="#beranda">
                <div class="d-flex align-items-center justify-content-center rounded-3 bg-warning text-dark shadow-sm" style="width: 42px; height: 42px;">
                    <i class="bi bi-cpu-fill fs-4"></i>
                </div>
                <div class="lh-1">
                    <span class="d-block fw-bold text-white fs-6">UNIKOM BANTEN</span>
                    <small class="text-warning fw-semibold" style="font-size: 0.7rem; letter-spacing: 0.5px;">Universitas Komputer Banten</small>
                </div>
            </a>

            <!-- Toggle Hamburger Mobile -->
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUnikom" aria-controls="navbarUnikom" aria-expanded="false" aria-label="Buka menu navigasi">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Daftar Menu & Tombol Login SIAKAD -->
            <div class="collapse navbar-collapse" id="navbarUnikom">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-1">
                    <li class="nav-item">
                        <a class="nav-link active" href="#beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang Kampus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#prodi">Program Studi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#siakad">Layanan SIAKAD</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak">Kontak</a>
                    </li>
                </ul>

                <!-- Tombol Login SIAKAD Menonjol -->
                <div class="d-grid d-lg-flex">
                    <!-- <button type="button" class="btn btn-gold rounded-pill px-4 py-2 d-inline-flex align-items-center justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                        <i class="bi bi-box-arrow-in-right"></i>
                        <span>Login SIAKAD</span>
                    </button> -->

                    <a href="login.php" class="btn btn-gold rounded-pill px-4 py-2 d-inline-flex align-items-center justify-content-center gap-2" >Login SIAKAD</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- =====================================================================
         2. HERO SECTION (DENGAN FOTO MAHASISWA & FLOATING CARD SIAKAD)
    ====================================================================== -->
    <section id="beranda" class="hero-section">
        <div class="container position-relative">
            <div class="row align-items-center g-5">
                <!-- Kolom Kiri: Headline Kampus & Tombol Aksi -->
                <div class="col-lg-6 text-center text-lg-start">
                    <span class="badge hero-pill rounded-pill px-3 py-2 mb-3">
                        <i class="bi bi-geo-alt-fill me-1"></i> Kampus Teknologi Informasi — Kota Serang, Banten
                    </span>
                    <h1 class="display-5 fw-extrabold lh-sm mb-3">
                        Cetak Talenta Digital Unggul Bersama <span class="text-warning">Universitas Komputer Banten</span>
                    </h1>
                    <p class="lead text-white-50 mb-4" style="font-size: 1.06rem;">
                        Perguruan tinggi berbasis teknologi informasi dan bisnis digital di Banten yang menghadirkan pembelajaran modern serta Portal SIAKAD terintegrasi untuk kelancaran perkuliahan mahasiswa dan dosen.
                    </p>

                    <!-- Tombol CTA -->
                    <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start">
                        <button type="button" class="btn btn-gold btn-lg rounded-pill px-4 py-3 fs-6 d-inline-flex align-items-center justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <i class="bi bi-shield-lock-fill"></i>
                            <span>Login SIAKAD</span>
                        </button>
                        <a href="#prodi" class="btn btn-outline-light btn-lg rounded-pill px-4 py-3 fs-6 d-inline-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-mortarboard-fill"></i>
                            <span>Program Studi</span>
                        </a>
                    </div>

                    <!-- Statistik Singkat Kampus -->
                    <div class="row g-3 mt-4 pt-3 border-top border-white border-opacity-10 text-center text-lg-start">
                        <div class="col-4">
                            <h4 class="fw-bold text-warning mb-0">4 Prodi</h4>
                            <small class="text-white-50">IT & Bisnis Digital</small>
                        </div>
                        <div class="col-4">
                            <h4 class="fw-bold text-warning mb-0">Real-Time</h4>
                            <small class="text-white-50">KRS, Absensi & Nilai</small>
                        </div>
                        <div class="col-4">
                            <h4 class="fw-bold text-warning mb-0">100%</h4>
                            <small class="text-white-50">Praktikum Terpadu</small>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Foto Kolaborasi Mahasiswa + Floating Card Status SIAKAD -->
                <div class="col-lg-6">
                    <div class="hero-media-wrapper">
                        <img
                            src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=900&q=80"
                            alt="Mahasiswa Universitas Komputer Banten berkolaborasi menggunakan laptop di kampus modern"
                            class="hero-photo rounded-4 shadow-lg"
                            onerror="this.onerror=null;this.src='https://placehold.co/900x600/0f294a/f59e0b?text=Mahasiswa+UNIKOM+Banten';"
                        >

                        <!-- Floating Card Status SIAKAD -->
                        <div class="hero-floating-card p-3 p-sm-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-success-subtle text-success-emphasis rounded-pill px-2.5 py-1">
                                        <i class="bi bi-circle-fill me-1" style="font-size: 0.55rem;"></i> Portal Aktif
                                    </span>
                                    <strong class="small text-dark">SIAKAD UNIKOM Banten</strong>
                                </div>
                                <button type="button" class="btn btn-sm btn-link text-decoration-none fw-bold p-0" style="color: var(--unikom-blue);" data-bs-toggle="modal" data-bs-target="#loginModal">
                                    Masuk <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>

                            <div class="row g-2">
                                <div class="col-4">
                                    <div class="status-chip text-center text-sm-start">
                                        <i class="bi bi-calendar2-week-fill text-primary d-block mb-1 fs-5"></i>
                                        <div class="fw-bold" style="font-size: 0.78rem;">Jadwal Kuliah</div>
                                        <small class="text-muted d-none d-sm-inline" style="font-size: 0.7rem;">KRS & Ruang</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="status-chip text-center text-sm-start">
                                        <i class="bi bi-person-check-fill text-warning d-block mb-1 fs-5"></i>
                                        <div class="fw-bold" style="font-size: 0.78rem;">Absensi Online</div>
                                        <small class="text-muted d-none d-sm-inline" style="font-size: 0.7rem;">16 Pertemuan</small>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="status-chip text-center text-sm-start">
                                        <i class="bi bi-award-fill text-success d-block mb-1 fs-5"></i>
                                        <div class="fw-bold" style="font-size: 0.78rem;">KHS & Nilai</div>
                                        <small class="text-muted d-none d-sm-inline" style="font-size: 0.7rem;">Auto Grade</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =====================================================================
         3. SECTION TENTANG & FASILITAS KAMPUS (FOTO LAB + 4 POIN KEUNGGULAN)
    ====================================================================== -->
    <section id="tentang" class="py-5 my-lg-3">
        <div class="container">
            <div class="row align-items-center g-5">
                <!-- Kolom Kiri: Foto Laboratorium Komputer & Aktivitas Pemrograman -->
                <div class="col-lg-6">
                    <div class="about-photo-box">
                        <img
                            src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=800&q=80"
                            alt="Laboratorium Komputer dan Aktivitas Pemrograman Universitas Komputer Banten"
                            class="about-photo rounded-4 shadow"
                            onerror="this.onerror=null;this.src='https://placehold.co/800x600/0f294a/f59e0b?text=Lab+Komputer+UNIKOM+Banten';"
                        >
                        <div class="about-badge-overlay p-3 d-flex align-items-center gap-3">
                            <div class="bg-warning text-dark rounded-3 p-2.5 d-flex align-items-center justify-content-center">
                                <i class="bi bi-pc-display-horizontal fs-4"></i>
                            </div>
                            <div>
                                <div class="fw-bold small">Laboratorium Pemrograman & Rekayasa Sistem</div>
                                <small class="text-white-50">Fasilitas praktikum modern untuk pengembangan web, basis data, dan jaringan.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Narasi Profil Kampus & 4 Poin Keunggulan -->
                <div class="col-lg-6">
                    <span class="section-tag">Tentang & Fasilitas Kampus</span>
                    <h2 class="fw-bold display-6 mb-3">Pusat Pendidikan Tinggi Teknologi Informasi di Banten</h2>
                    <p class="text-muted mb-4">
                        <strong>Universitas Komputer Banten (UNIKOM Banten)</strong> berkomitmen mencetak lulusan yang kompeten dalam rekayasa perangkat lunak, tata kelola sistem informasi, dan inovasi bisnis digital dengan dukungan ekosistem kampus berbasis teknologi.
                    </p>

                    <!-- 4 Poin Keunggulan -->
                    <div class="row g-3">
                        <!-- Poin 1 -->
                        <div class="col-sm-6">
                            <div class="feature-mini-card p-3 d-flex align-items-start gap-3">
                                <div class="feature-icon-box">
                                    <i class="bi bi-briefcase-fill"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Kurikulum Berbasis Industri</h6>
                                    <p class="text-muted small mb-0">Selaras dengan standar kebutuhan software house dan transformasi digital.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Poin 2 -->
                        <div class="col-sm-6">
                            <div class="feature-mini-card p-3 d-flex align-items-start gap-3">
                                <div class="feature-icon-box">
                                    <i class="bi bi-laptop-fill"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Laboratorium Komputer Modern</h6>
                                    <p class="text-muted small mb-0">Perangkat komputasi mutakhir untuk praktikum pemrograman dan server.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Poin 3 -->
                        <div class="col-sm-6">
                            <div class="feature-mini-card p-3 d-flex align-items-start gap-3">
                                <div class="feature-icon-box">
                                    <i class="bi bi-person-workspace"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Dosen Praktisi & Akademisi</h6>
                                    <p class="text-muted small mb-0">Bimbingan langsung dari tenaga pengajar berpengalaman di proyek IT.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Poin 4 -->
                        <div class="col-sm-6">
                            <div class="feature-mini-card p-3 d-flex align-items-start gap-3">
                                <div class="feature-icon-box">
                                    <i class="bi bi-hdd-network-fill"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Portal SIAKAD Terintegrasi</h6>
                                    <p class="text-muted small mb-0">Manajemen penjadwalan kuliah, absensi pertemuan, dan penilaian digital.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =====================================================================
         4. SECTION PROGRAM STUDI (4 KARTU DENGAN GAMBAR HEADER 180PX)
    ====================================================================== -->
    <section id="prodi" class="py-5 border-top border-light-subtle" style="background-color: #fbfdff;">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-7">
                    <span class="section-tag">Fakultas Ilmu Komputer & Bisnis Digital</span>
                    <h2 class="fw-bold display-6 mb-3">Pilihan Program Studi Unggulan</h2>
                    <p class="text-muted">
                        Pilih program studi yang sesuai dengan minat karier teknologi Anda di Universitas Komputer Banten.
                    </p>
                </div>
            </div>

            <!-- 4 Kartu Program Studi -->
            <div class="row g-4">
                <!-- Prodi 1: S1 Teknik Informatika -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="prodi-card">
                        <div class="prodi-img-wrapper">
                            <img
                                src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=600&q=80"
                                class="card-img-top"
                                alt="Program Studi S1 Teknik Informatika"
                                onerror="this.onerror=null;this.src='https://placehold.co/600x400/0f294a/f59e0b?text=S1+Teknik+Informatika';"
                            >
                            <span class="badge text-bg-dark prodi-badge-float px-3 py-1.5 rounded-pill">Sarjana (S1)</span>
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <h5 class="fw-bold mb-2">S1 Teknik Informatika</h5>
                            <p class="text-muted small flex-grow-1">
                                Mendalami rekayasa perangkat lunak, pemrograman web & mobile, kecerdasan buatan (AI), serta keamanan jaringan.
                            </p>
                            <hr class="my-3 opacity-10">
                            <div class="d-flex align-items-center justify-content-between small">
                                <span class="text-muted"><i class="bi bi-award-fill text-warning me-1"></i>Gelar: <strong>S.Kom.</strong></span>
                                <span class="fw-semibold" style="color: var(--unikom-blue);">8 Semester</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Prodi 2: S1 Sistem Informasi -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="prodi-card">
                        <div class="prodi-img-wrapper">
                            <img
                                src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=600&q=80"
                                class="card-img-top"
                                alt="Program Studi S1 Sistem Informasi"
                                onerror="this.onerror=null;this.src='https://placehold.co/600x400/1e40af/ffffff?text=S1+Sistem+Informasi';"
                            >
                            <span class="badge text-bg-dark prodi-badge-float px-3 py-1.5 rounded-pill">Sarjana (S1)</span>
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <h5 class="fw-bold mb-2">S1 Sistem Informasi</h5>
                            <p class="text-muted small flex-grow-1">
                                Fokus pada analisis dan perancangan sistem informasi enterprise, manajemen basis data, dan business intelligence.
                            </p>
                            <hr class="my-3 opacity-10">
                            <div class="d-flex align-items-center justify-content-between small">
                                <span class="text-muted"><i class="bi bi-award-fill text-warning me-1"></i>Gelar: <strong>S.Kom.</strong></span>
                                <span class="fw-semibold" style="color: var(--unikom-blue);">8 Semester</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Prodi 3: S1 Bisnis Digital -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="prodi-card">
                        <div class="prodi-img-wrapper">
                            <img
                                src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=600&q=80"
                                class="card-img-top"
                                alt="Program Studi S1 Bisnis Digital"
                                onerror="this.onerror=null;this.src='https://placehold.co/600x400/0f294a/f59e0b?text=S1+Bisnis+Digital';"
                            >
                            <span class="badge text-bg-dark prodi-badge-float px-3 py-1.5 rounded-pill">Sarjana (S1)</span>
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <h5 class="fw-bold mb-2">S1 Bisnis Digital</h5>
                            <p class="text-muted small flex-grow-1">
                                Memadukan strategi manajemen bisnis modern dengan teknologi e-commerce, digital marketing, dan inovasi startup.
                            </p>
                            <hr class="my-3 opacity-10">
                            <div class="d-flex align-items-center justify-content-between small">
                                <span class="text-muted"><i class="bi bi-award-fill text-warning me-1"></i>Gelar: <strong>S.Bns.</strong></span>
                                <span class="fw-semibold" style="color: var(--unikom-blue);">8 Semester</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Prodi 4: D3 Manajemen Informatika -->
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="prodi-card">
                        <div class="prodi-img-wrapper">
                            <img
                                src="https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=600&q=80"
                                class="card-img-top"
                                alt="Program Studi D3 Manajemen Informatika"
                                onerror="this.onerror=null;this.src='https://placehold.co/600x400/1e40af/f59e0b?text=D3+Manajemen+Informatika';"
                            >
                            <span class="badge bg-warning text-dark prodi-badge-float px-3 py-1.5 rounded-pill fw-bold">Vokasi (D3)</span>
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <h5 class="fw-bold mb-2">D3 Manajemen Informatika</h5>
                            <p class="text-muted small flex-grow-1">
                                Pendidikan vokasi siap kerja yang menekankan keterampilan praktik pemrograman aplikasi, basis data, dan jaringan.
                            </p>
                            <hr class="my-3 opacity-10">
                            <div class="d-flex align-items-center justify-content-between small">
                                <span class="text-muted"><i class="bi bi-award-fill text-warning me-1"></i>Gelar: <strong>A.Md.Kom.</strong></span>
                                <span class="fw-semibold" style="color: var(--unikom-blue);">6 Semester</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =====================================================================
         5. SECTION LAYANAN SIAKAD & AKTIVITAS PERKULIAHAN
    ====================================================================== -->
    <section id="siakad" class="siakad-section py-5">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-lg-8">
                    <span class="section-tag">Layanan SIAKAD & Aktivitas Perkuliahan</span>
                    <h2 class="fw-bold display-6 mb-3">Portal Akademik Mahasiswa, Dosen & Admin</h2>
                    <p class="text-muted">
                        Kelola seluruh siklus perkuliahan mulai dari penjadwalan kelas, presensi pertemuan, hingga input dan rekap nilai akhir secara digital.
                    </p>
                </div>
            </div>

            <!-- Banner Foto Dosen Mengajar di Ruang Kelas Modern -->
            <div class="siakad-banner-card mb-5">
                <div class="row g-0 align-items-center">
                    <div class="col-lg-5">
                        <img
                            src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80"
                            alt="Aktivitas Dosen Mengajar di Ruang Kelas Modern UNIKOM Banten"
                            class="siakad-banner-img"
                            onerror="this.onerror=null;this.src='https://placehold.co/800x500/0f294a/f59e0b?text=Perkuliahan+Modern+UNIKOM+Banten';"
                        >
                    </div>
                    <div class="col-lg-7 p-4 p-lg-5">
                        <span class="badge bg-primary-subtle text-primary-emphasis rounded-pill px-3 py-2 mb-2 fw-semibold">
                            <i class="bi bi-broadcast me-1"></i> Ekosistem Perkuliahan Digital
                        </span>
                        <h3 class="fw-bold mb-3">Terhubung dalam Satu Alur Akademik Terpadu</h3>
                        <p class="text-muted mb-4">
                            Admin akademik menyusun jadwal perkuliahan dan dosen pengampu, mahasiswa mengambil kelas melalui KRS online, dan dosen mencatat absensi serta nilai mata kuliah secara real-time di dalam sistem.
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-light text-dark border px-3 py-2"><i class="bi bi-check2-circle text-success me-1"></i> Validasi Jadwal & KRS</span>
                            <span class="badge bg-light text-dark border px-3 py-2"><i class="bi bi-check2-circle text-success me-1"></i> Rekap Kehadiran 16 Pertemuan</span>
                            <span class="badge bg-light text-dark border px-3 py-2"><i class="bi bi-check2-circle text-success me-1"></i> Kalkulasi Grade Otomatis</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3 Kartu Modul Praktikum dengan Tombol Akses Role Otomatis -->
            <div class="row g-4">
                <!-- Kartu 1: Penjadwalan Kuliah & KRS -->
                <div class="col-12 col-md-4">
                    <div class="modul-card p-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded-3 bg-primary bg-opacity-10 text-primary p-3 fs-4">
                                <i class="bi bi-calendar2-week-fill"></i>
                            </div>
                            <div>
                                <span class="badge bg-primary-subtle text-primary-emphasis mb-1">Modul 01</span>
                                <h5 class="fw-bold mb-0">Penjadwalan Kuliah & KRS</h5>
                            </div>
                        </div>
                        <p class="text-muted small mb-3 flex-grow-1">
                            Mahasiswa dapat melihat daftar mata kuliah yang tersedia, memilih jadwal kelas (KRS), dan memantau jadwal perkuliahan mingguan secara praktis.
                        </p>
                        <ul class="list-unstyled small text-muted mb-4">
                            <li class="mb-1"><i class="bi bi-check-circle-fill text-success me-2"></i>Pengambilan kelas KRS tanpa duplikasi</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Informasi hari, jam, ruang & dosen</li>
                        </ul>
                        <button type="button" class="btn btn-gold w-100 rounded-3 py-2.5" onclick="openLoginWithRole('mahasiswa')">
                            <i class="bi bi-mortarboard-fill me-1"></i> Masuk sebagai Mahasiswa
                        </button>
                    </div>
                </div>

                <!-- Kartu 2: Absensi Perkuliahan Digital -->
                <div class="col-12 col-md-4">
                    <div class="modul-card p-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded-3 bg-warning bg-opacity-25 text-warning-emphasis p-3 fs-4">
                                <i class="bi bi-person-check-fill"></i>
                            </div>
                            <div>
                                <span class="badge bg-warning-subtle text-warning-emphasis mb-1">Modul 02</span>
                                <h5 class="fw-bold mb-0">Absensi Perkuliahan Digital</h5>
                            </div>
                        </div>
                        <p class="text-muted small mb-3 flex-grow-1">
                            Dosen mengelola daftar hadir mahasiswa pada setiap pertemuan (Pertemuan 1–16) dengan pilihan status Hadir, Izin, Sakit, atau Alpha.
                        </p>
                        <ul class="list-unstyled small text-muted mb-4">
                            <li class="mb-1"><i class="bi bi-check-circle-fill text-success me-2"></i>Input presensi kelas per pertemuan</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Rekap persentase kehadiran mahasiswa</li>
                        </ul>
                        <button type="button" class="btn btn-royal w-100 rounded-3 py-2.5" onclick="openLoginWithRole('dosen')">
                            <i class="bi bi-person-badge-fill me-1 text-warning"></i> Masuk sebagai Dosen
                        </button>
                    </div>
                </div>

                <!-- Kartu 3: Input Nilai & KHS -->
                <div class="col-12 col-md-4">
                    <div class="modul-card p-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="rounded-3 bg-success bg-opacity-10 text-success p-3 fs-4">
                                <i class="bi bi-award-fill"></i>
                            </div>
                            <div>
                                <span class="badge bg-success-subtle text-success-emphasis mb-1">Modul 03</span>
                                <h5 class="fw-bold mb-0">Input Nilai & KHS</h5>
                            </div>
                        </div>
                        <p class="text-muted small mb-3 flex-grow-1">
                            Pengelolaan data master pengguna, mata kuliah, penjadwalan dosen, serta pemantauan rekap nilai akhir dan Kartu Hasil Studi (KHS).
                        </p>
                        <ul class="list-unstyled small text-muted mb-4">
                            <li class="mb-1"><i class="bi bi-check-circle-fill text-success me-2"></i>Manajemen master user, MK & jadwal</li>
                            <li><i class="bi bi-check-circle-fill text-success me-2"></i>Monitoring nilai Tugas, UTS, UAS & Grade</li>
                        </ul>
                        <button type="button" class="btn btn-dark w-100 rounded-3 py-2.5 fw-semibold" onclick="openLoginWithRole('admin')">
                            <i class="bi bi-shield-check me-1 text-warning"></i> Masuk sebagai Admin
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =====================================================================
         6. MODAL LOGIN SIAKAD INTERAKTIF (FORM action="proses_login.php")
    ====================================================================== -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <!-- Header Modal -->
                <div class="modal-header modal-header-unikom px-4 py-3">
                    <div class="d-flex align-items-center gap-2.5">
                        <div class="bg-warning text-dark rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                            <i class="bi bi-shield-lock-fill fs-5"></i>
                        </div>
                        <div>
                            <h5 class="modal-title fw-bold mb-0 fs-6" id="loginModalLabel">Login Portal SIAKAD</h5>
                            <small class="text-white-50" style="font-size: 0.78rem;">Universitas Komputer Banten (UNIKOM Banten)</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="modal" aria-label="Tutup modal"></button>
                </div>

                <!-- Body Modal -->
                <div class="modal-body p-4">
                    <!-- Notifikasi Feedback Interaktif -->
                    <div id="loginFeedback" class="d-none mb-3" role="alert"></div>

                    <!-- Form Login HTML siap disambungkan ke backend PHP -->
                    <form id="siakadLoginForm" action="proses_login.php" method="POST" novalidate>
                        <!-- Pilihan Radio Role: Mahasiswa, Dosen, Admin -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold small text-secondary d-block mb-2">Pilih Peran Pengguna (Role)</label>
                            <div class="btn-group w-100 role-tab-group" role="group" aria-label="Pilihan Role SIAKAD">
                                <input type="radio" class="btn-check" name="role" id="roleMahasiswa" value="mahasiswa" autocomplete="off" checked>
                                <label class="btn btn-role-tab rounded-start-3" for="roleMahasiswa">
                                    <i class="bi bi-mortarboard-fill me-1"></i> Mahasiswa
                                </label>

                                <input type="radio" class="btn-check" name="role" id="roleDosen" value="dosen" autocomplete="off">
                                <label class="btn btn-role-tab" for="roleDosen">
                                    <i class="bi bi-person-badge-fill me-1"></i> Dosen
                                </label>

                                <input type="radio" class="btn-check" name="role" id="roleAdmin" value="admin" autocomplete="off">
                                <label class="btn btn-role-tab rounded-end-3" for="roleAdmin">
                                    <i class="bi bi-gear-fill me-1"></i> Admin
                                </label>
                            </div>
                        </div>

                        <!-- Input Dinamis: NIM Mahasiswa / NIDN Dosen / Email Admin -->
                        <div class="mb-3">
                            <label for="loginIdentifier" id="identifierLabel" class="form-label fw-semibold small text-secondary">NIM Mahasiswa</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i id="identifierIcon" class="bi bi-person-vcard text-primary"></i></span>
                                <input type="text" class="form-control" id="loginIdentifier" name="username" placeholder="Masukkan NIM Mahasiswa (Contoh: 202401001)" required>
                            </div>
                        </div>

                        <!-- Input Password + Toggle Lihat/Sembunyikan -->
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label fw-semibold small text-secondary">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-key-fill text-primary"></i></span>
                                <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Masukkan kata sandi" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePasswordBtn" aria-label="Lihat atau sembunyikan password">
                                    <i class="bi bi-eye" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Checkbox Mode Simulasi Preview -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="simulationMode" checked>
                                <label class="form-check-label small text-muted" for="simulationMode">
                                    Mode Simulasi Preview (tampilkan notifikasi redirect tanpa server PHP)
                                </label>
                            </div>
                        </div>

                        <!-- Tombol Submit & Tombol Cepat Isi Akun Demo -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-gold py-2.5 rounded-3 fw-bold">
                                <i class="bi bi-box-arrow-in-right me-1"></i> Masuk ke SIAKAD
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm rounded-3" id="fillDemoBtn">
                                <i class="bi bi-magic me-1"></i> Isi Akun Demo
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Footer Modal -->
                <div class="modal-footer bg-light justify-content-between py-2.5 px-4">
                    <small class="text-muted">Endpoint: <code>proses_login.php</code></small>
                    <small class="text-muted">UPT Puskom UNIKOM Banten</small>
                </div>
            </div>
        </div>
    </div>

    <!-- =====================================================================
         7. FOOTER KAMPUS (KOTA SERANG, BANTEN)
    ====================================================================== -->
    <footer id="kontak" class="footer-unikom pt-5 pb-4">
        <div class="container">
            <div class="row g-4 pb-4 border-bottom border-white border-opacity-10">
                <!-- Kolom 1: Profil Singkat Kampus -->
                <div class="col-lg-4">
                    <div class="d-flex align-items-center gap-2.5 mb-3">
                        <div class="d-flex align-items-center justify-content-center rounded-3 bg-warning text-dark" style="width: 40px; height: 40px;">
                            <i class="bi bi-cpu-fill fs-5"></i>
                        </div>
                        <div class="lh-1">
                            <span class="d-block fw-bold text-white fs-6">UNIKOM BANTEN</span>
                            <small class="text-warning fw-semibold" style="font-size: 0.72rem;">Universitas Komputer Banten</small>
                        </div>
                    </div>
                    <p class="small mb-3">
                        Kampus teknologi informasi dan bisnis digital di Kota Serang, Banten yang menghadirkan pendidikan unggul dan layanan SIAKAD terintegrasi.
                    </p>
                    <div class="d-flex gap-2">
                        <a href="#kontak" class="social-circle" aria-label="Instagram UNIKOM Banten"><i class="bi bi-instagram"></i></a>
                        <a href="#kontak" class="social-circle" aria-label="YouTube UNIKOM Banten"><i class="bi bi-youtube"></i></a>
                        <a href="#kontak" class="social-circle" aria-label="LinkedIn UNIKOM Banten"><i class="bi bi-linkedin"></i></a>
                        <a href="#kontak" class="social-circle" aria-label="Facebook UNIKOM Banten"><i class="bi bi-facebook"></i></a>
                    </div>
                </div>

                <!-- Kolom 2: Navigasi Halaman -->
                <div class="col-6 col-md-4 col-lg-2">
                    <h6 class="text-white fw-bold mb-3">Navigasi</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2">
                        <li><a href="#beranda">Beranda</a></li>
                        <li><a href="#tentang">Tentang Kampus</a></li>
                        <li><a href="#prodi">Program Studi</a></li>
                        <li><a href="#siakad">Layanan SIAKAD</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Tautan Cepat Akademik -->
                <div class="col-6 col-md-4 col-lg-3">
                    <h6 class="text-white fw-bold mb-3">Tautan Cepat Akademik</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2">
                        <li><a href="javascript:void(0)" onclick="openLoginWithRole('mahasiswa')">Portal Mahasiswa (KRS & KHS)</a></li>
                        <li><a href="javascript:void(0)" onclick="openLoginWithRole('dosen')">Portal Dosen (Absensi & Nilai)</a></li>
                        <li><a href="javascript:void(0)" onclick="openLoginWithRole('admin')">Portal Admin Akademik</a></li>
                        <li><a href="#prodi">Informasi Program Studi</a></li>
                    </ul>
                </div>

                <!-- Kolom 4: Alamat & Kontak Kampus -->
                <div class="col-md-4 col-lg-3">
                    <h6 class="text-white fw-bold mb-3">Alamat & Kontak</h6>
                    <ul class="list-unstyled small d-flex flex-column gap-2.5">
                        <li class="d-flex gap-2">
                            <i class="bi bi-geo-alt-fill text-warning mt-1"></i>
                            <span>Jl. Raya Serang - Pandeglang Km. 4, Cipocok Jaya, Kota Serang, Banten 42121</span>
                        </li>
                        <li class="d-flex gap-2">
                            <i class="bi bi-telephone-fill text-warning"></i>
                            <span>(0254) 791-8820</span>
                        </li>
                        <li class="d-flex gap-2">
                            <i class="bi bi-envelope-fill text-warning"></i>
                            <span>info@unikombanten.ac.id</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Hak Cipta -->
            <div class="pt-4 d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2 small">
                <p class="mb-0">&copy; 2026 Universitas Komputer Banten (UNIKOM Banten). Hak Cipta Dilindungi Undang-Undang.</p>
                <p class="mb-0 text-white-50">Sistem Informasi Akademik (SIAKAD)</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5.3 JS Bundle (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script Interaktif Modal Login & Navigasi -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roleRadios = document.querySelectorAll('input[name="role"]');
            const identifierLabel = document.getElementById('identifierLabel');
            const identifierIcon = document.getElementById('identifierIcon');
            const loginIdentifier = document.getElementById('loginIdentifier');
            const loginPassword = document.getElementById('loginPassword');
            const togglePasswordBtn = document.getElementById('togglePasswordBtn');
            const togglePasswordIcon = document.getElementById('togglePasswordIcon');
            const loginForm = document.getElementById('siakadLoginForm');
            const loginFeedback = document.getElementById('loginFeedback');
            const fillDemoBtn = document.getElementById('fillDemoBtn');
            const simulationMode = document.getElementById('simulationMode');

            // Mendapatkan nilai role yang sedang dipilih
            function getSelectedRole() {
                const checked = document.querySelector('input[name="role"]:checked');
                return checked ? checked.value : 'mahasiswa';
            }

            // 1. Mengubah label, ikon, dan placeholder input sesuai role
            function updateRoleUI(role) {
                if (role === 'mahasiswa') {
                    identifierLabel.textContent = 'NIM Mahasiswa';
                    identifierIcon.className = 'bi bi-person-vcard text-primary';
                    loginIdentifier.placeholder = 'Masukkan NIM Mahasiswa (Contoh: 202401001)';
                } else if (role === 'dosen') {
                    identifierLabel.textContent = 'NIDN Dosen';
                    identifierIcon.className = 'bi bi-person-badge text-primary';
                    loginIdentifier.placeholder = 'Masukkan NIDN Dosen (Contoh: 0415089002)';
                } else {
                    identifierLabel.textContent = 'Email Admin';
                    identifierIcon.className = 'bi bi-envelope-at text-primary';
                    loginIdentifier.placeholder = 'Masukkan Email Admin (Contoh: admin@unikombanten.ac.id)';
                }
            }

            roleRadios.forEach(function (radio) {
                radio.addEventListener('change', function () {
                    updateRoleUI(this.value);
                    loginFeedback.classList.add('d-none');
                });
            });

            // 2. Tombol toggle lihat / sembunyikan password
            togglePasswordBtn.addEventListener('click', function () {
                const isPassword = loginPassword.getAttribute('type') === 'password';
                loginPassword.setAttribute('type', isPassword ? 'text' : 'password');
                togglePasswordIcon.classList.toggle('bi-eye', !isPassword);
                togglePasswordIcon.classList.toggle('bi-eye-slash', isPassword);
            });

            // 3. Tombol cepat "Isi Akun Demo" sesuai role yang aktif
            fillDemoBtn.addEventListener('click', function () {
                const role = getSelectedRole();
                if (role === 'mahasiswa') {
                    loginIdentifier.value = '202401001';
                    loginPassword.value = 'mhs12345';
                } else if (role === 'dosen') {
                    loginIdentifier.value = '0415089002';
                    loginPassword.value = 'dosen12345';
                } else {
                    loginIdentifier.value = 'admin@unikombanten.ac.id';
                    loginPassword.value = 'admin12345';
                }
                loginFeedback.classList.add('d-none');
            });

            // 4. Validasi & simulasi pengalihan dashboard saat form disubmit
            loginForm.addEventListener('submit', function (event) {
                const role = getSelectedRole();
                const usernameVal = loginIdentifier.value.trim();
                const passwordVal = loginPassword.value.trim();

                if (!usernameVal || !passwordVal) {
                    event.preventDefault();
                    showFeedback(
                        'danger',
                        '<i class="bi bi-exclamation-triangle-fill me-2"></i>Mohon isi <strong>' + identifierLabel.textContent + '</strong> dan <strong>Password</strong> terlebih dahulu.'
                    );
                    return;
                }

                // Jika mode simulasi aktif, tampilkan notifikasi redirect ke dashboard role terkait
                if (simulationMode.checked) {
                    event.preventDefault();

                    const dashboardTargets = {
                        mahasiswa: { label: 'Mahasiswa', path: 'mahasiswa/dashboard.php' },
                        dosen: { label: 'Dosen', path: 'dosen/dashboard.php' },
                        admin: { label: 'Admin Akademik', path: 'admin/dashboard.php' }
                    };

                    const target = dashboardTargets[role];

                    showFeedback(
                        'success',
                        `<div class="d-flex flex-column gap-2">
                            <div>
                                <i class="bi bi-check-circle-fill me-1"></i>
                                <strong>Autentikasi Berhasil (${target.label})!</strong><br>
                                <span class="small">Akun <code>${escapeHtml(usernameVal)}</code> terverifikasi. Mengarahkan ke halaman <code>${target.path}</code>...</span>
                            </div>
                            <div>
                                <a href="${target.path}" class="btn btn-sm btn-success fw-semibold rounded-pill px-3">
                                    Buka ${target.path} <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>`
                    );
                }
            });

            function showFeedback(type, htmlContent) {
                loginFeedback.className = `alert alert-${type} small rounded-3 py-2.5 px-3 mb-3`;
                loginFeedback.innerHTML = htmlContent;
            }

            function escapeHtml(str) {
                const div = document.createElement('div');
                div.textContent = str;
                return div.innerHTML;
            }

            // Tutup menu collapse navbar di tampilan mobile setelah menu diklik
            const navLinks = document.querySelectorAll('.navbar-unikom .nav-link');
            const navbarCollapse = document.getElementById('navbarUnikom');
            navLinks.forEach(function (link) {
                link.addEventListener('click', function () {
                    if (navbarCollapse.classList.contains('show')) {
                        const collapseInstance = bootstrap.Collapse.getInstance(navbarCollapse);
                        if (collapseInstance) collapseInstance.hide();
                    }
                });
            });
        });

        // Fungsi global untuk membuka Modal Login dengan role yang langsung terpilih
        function openLoginWithRole(roleName) {
            const targetRadio = document.querySelector(`input[name="role"][value="${roleName}"]`);
            const feedbackBox = document.getElementById('loginFeedback');
            if (targetRadio) {
                targetRadio.checked = true;
                targetRadio.dispatchEvent(new Event('change'));
            }
            if (feedbackBox) {
                feedbackBox.classList.add('d-none');
            }
            const loginModalEl = document.getElementById('loginModal');
            const modal = bootstrap.Modal.getOrCreateInstance(loginModalEl);
            modal.show();
        }
    </script>
</body>
</html>