<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SIAKAD - Universitas Komputer Banten</title>

    <!-- Google Fonts: Plus Jakarta Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons (CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom CSS Identitas Warna UNIKOM Banten -->
    <style>
        :root {
            --unikom-navy: #0f294a;
            --unikom-navy-dark: #091a30;
            --unikom-blue: #1e40af;
            --unikom-gold: #f59e0b;
            --unikom-gold-hover: #d97706;
            --unikom-bg: #f8fafc;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--unikom-bg);
            color: #0f172a;
            margin: 0;
        }

        h1, h2, h3, h4, h5, h6, .brand-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Kartu Showcase Utama di Tengah Layar */
        .showcase-card {
            width: 100%;
            max-width: 440px;
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1.25rem;
            box-shadow: 0 20px 40px -15px rgba(15, 41, 74, 0.14);
            overflow: hidden;
        }

        .showcase-top-bar {
            height: 6px;
            background: linear-gradient(90deg, var(--unikom-navy) 0%, var(--unikom-blue) 65%, var(--unikom-gold) 100%);
        }

        .university-emblem {
            width: 68px;
            height: 68px;
            border-radius: 1rem;
            background: linear-gradient(135deg, var(--unikom-navy) 0%, var(--unikom-blue) 100%);
            color: var(--unikom-gold);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 20px -6px rgba(15, 41, 74, 0.35);
            border: 2px solid rgba(245, 158, 11, 0.45);
        }

        /* Tombol Signature Emas UNIKOM Banten */
        .btn-unikom-gold {
            background-color: var(--unikom-gold);
            color: var(--unikom-navy-dark);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            border: none;
            transition: all 0.25s ease;
        }

        .btn-unikom-gold:hover,
        .btn-unikom-gold:focus {
            background-color: var(--unikom-gold-hover);
            color: var(--unikom-navy-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.38);
        }

        /* Header Modal Bergradasi Navy - Biru */
        .modal-header-unikom {
            background: linear-gradient(135deg, var(--unikom-navy) 0%, var(--unikom-blue) 100%);
            color: #ffffff;
            border-bottom: 3px solid var(--unikom-gold);
        }

        .modal-logo-badge {
            width: 40px;
            height: 40px;
            border-radius: 0.7rem;
            background-color: var(--unikom-gold);
            color: var(--unikom-navy-dark);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* Styling Input Form */
        .input-group-text {
            background-color: #f8fafc;
            border-color: #cbd5e1;
            color: var(--unikom-navy);
        }

        .form-control {
            border-color: #cbd5e1;
            padding-top: 0.62rem;
            padding-bottom: 0.62rem;
        }

        .form-control:focus {
            border-color: var(--unikom-blue);
            box-shadow: 0 0 0 0.22rem rgba(30, 64, 175, 0.14);
        }
    </style>
</head>
<body>

    <!-- =====================================================================
         AREA PREVIEW KOMPONEN: KARTU SHOWCASE DI TENGAH LAYAR
    ====================================================================== -->
    <main class="min-vh-100 d-flex align-items-center justify-content-center p-3">
        <div class="showcase-card">
            <!-- Garis Aksen Atas -->
            <div class="showcase-top-bar"></div>

            <div class="p-4 p-sm-5 text-center">
                <!-- Emblem / Logo Universitas -->
                <div class="university-emblem mb-3">
                    <i class="bi bi-cpu-fill fs-1"></i>
                </div>

                <!-- Nama Universitas & Keterangan Portal -->
                <h1 class="brand-title h4 fw-extrabold mb-1" style="color: var(--unikom-navy);">
                    UNIKOM BANTEN
                </h1>
                <p class="fw-semibold small mb-1" style="color: var(--unikom-blue);">
                    Universitas Komputer Banten
                </p>
                <p class="text-muted small mb-4">
                    Portal Sistem Informasi Akademik (SIAKAD)
                </p>

                <!-- Tombol Login SIAKAD (Pemicu Modal) -->
                <button
                    type="button"
                    class="btn btn-unikom-gold rounded-pill px-4 py-2.5 d-inline-flex align-items-center justify-content-center gap-2 shadow-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#loginModal"
                >
                    <i class="bi bi-box-arrow-in-right fs-5"></i>
                    <span>Login SIAKAD</span>
                </button>
            </div>
        </div>
    </main>

    <!-- =====================================================================
         BOOTSTRAP MODAL LOGIN (HANYA USERNAME & PASSWORD)
    ====================================================================== -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

                <!-- Header Modal -->
                <div class="modal-header modal-header-unikom px-4 py-3">
                    <div class="d-flex align-items-center gap-2.5">
                        <span class="modal-logo-badge">
                            <i class="bi bi-cpu-fill fs-5"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0 fs-6" id="loginModalLabel">
                            Login SIAKAD - Universitas Komputer Banten
                        </h5>
                    </div>
                    <button
                        type="button"
                        class="btn-close btn-close-white shadow-none"
                        data-bs-dismiss="modal"
                        aria-label="Tutup modal login"
                    ></button>
                </div>

                <!-- Body Modal: Form Login Sederhana (Username & Password) -->
                <div class="modal-body p-4">
                    <form action="proses_login.php" method="POST">

                        <!-- Input 1: Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold small text-secondary">
                                Username
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-person"></i>
                                </span>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="username"
                                    name="username"
                                    placeholder="Masukkan username"
                                    autocomplete="username"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Input 2: Password + Tombol Lihat/Sembunyikan -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold small text-secondary">
                                Password
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    placeholder="Masukkan password"
                                    autocomplete="current-password"
                                    required
                                >
                                <button
                                    class="btn btn-outline-secondary"
                                    type="button"
                                    id="togglePassword"
                                    aria-label="Tampilkan atau sembunyikan password"
                                >
                                    <i class="bi bi-eye" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Tombol Submit Penuh -->
                        <button type="submit" class="btn btn-unikom-gold w-100 rounded-3 py-2.5">
                            Masuk
                        </button>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS Bundle (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script Toggle Lihat/Sembunyikan Password & Auto-Focus -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loginModal = document.getElementById('loginModal');
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');
            const togglePasswordBtn = document.getElementById('togglePassword');
            const togglePasswordIcon = document.getElementById('togglePasswordIcon');

            // Toggle tampilan teks password
            togglePasswordBtn.addEventListener('click', function () {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                togglePasswordIcon.classList.toggle('bi-eye', !isPassword);
                togglePasswordIcon.classList.toggle('bi-eye-slash', isPassword);
            });

            // Fokus otomatis ke kolom username saat modal terbuka
            loginModal.addEventListener('shown.bs.modal', function () {
                usernameInput.focus();
            });
        });
    </script>
</body>
</html>