<?php 
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');

if (!isset($_GET['id'])) {
    header("Location: jadwal_mengajar.php");
    exit;
}

$id_jadwal = $_GET['id'];

// 1. PROSES SIMPAN ABSENSI (1-KLIK MASUK JAM KE KOLOM PERTEMUAN1 - PERTEMUAN5)
if (isset($_GET['absen']) && isset($_GET['id_krs'])) {
    $pertemuan = $_GET['absen'];
    $id_krs    = $_GET['id_krs'];

    // Validasi agar hanya kolom pertemuan 1 sampai 5 yang bisa diproses
    if (in_array($pertemuan, ['1', '2', '3', '4', '5'])) {
        $kolom        = "pertemuan" . $pertemuan;
        $jam_sekarang = date('H:i:s');

        mysqli_query($koneksi, "UPDATE krs SET $kolom = '$jam_sekarang' WHERE id_krs = '$id_krs'");
    }

    header("Location: detail_absensi.php?id=$id_jadwal");
    exit;
}

// 2. PROSES BATAL ABSENSI (JIKA DOSEN SALAH KLIK)
if (isset($_GET['batal']) && isset($_GET['id_krs'])) {
    $pertemuan = $_GET['batal'];
    $id_krs    = $_GET['id_krs'];

    if (in_array($pertemuan, ['1', '2', '3', '4', '5'])) {
        $kolom = "pertemuan" . $pertemuan;
        mysqli_query($koneksi, "UPDATE krs SET $kolom = NULL WHERE id_krs = '$id_krs'");
    }

    header("Location: detail_absensi.php?id=$id_jadwal");
    exit;
}

include 'header.php';

// Ambil informasi detail jadwal kelas
$query_jadwal = mysqli_query($koneksi, "
    SELECT jadwal.*, matakuliah.nama_mk, matakuliah.sks, dosen.nama_lengkap AS nama_dosen 
    FROM jadwal
    INNER JOIN matakuliah ON jadwal.kode_mk = matakuliah.kode_mk
    INNER JOIN dosen ON jadwal.nid = dosen.nid
    WHERE jadwal.id_jadwal = '$id_jadwal'
");
$jadwal = mysqli_fetch_assoc($query_jadwal);

// Ambil data mahasiswa beserta status pertemuan 1 - 5 dari tabel krs
$query_mhs = mysqli_query($koneksi, "
    SELECT krs.*, mahasiswa.nama, mahasiswa.jurusan 
    FROM krs
    INNER JOIN mahasiswa ON krs.nim = mahasiswa.nim
    WHERE krs.id_jadwal = '$id_jadwal'
    ORDER BY mahasiswa.nim ASC
");
$no = 1;
?>

        <!-- INFORMASI KELAS -->
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <h5 class="fw-bold mb-0" style="color: #0f294a;">
                    <i class="bi bi-journal-check me-2 text-warning"></i>Lembar Absensi Perkuliahan
                </h5>
                <button type="button" onclick="window.close()" class="btn btn-secondary btn-sm fw-semibold">
                    <i class="bi bi-x-circle me-1"></i> Tutup Tab
                </button>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless table-sm mb-0">
                            <tr>
                                <td class="text-muted" width="150">Matakuliah</td>
                                <td class="fw-semibold">: <?= $jadwal['kode_mk']; ?> - <?= $jadwal['nama_mk']; ?> (<?= $jadwal['sks']; ?> SKS)</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Dosen Pengampu</td>
                                <td class="fw-semibold">: <?= $jadwal['nama_dosen']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless table-sm mb-0">
                            <tr>
                                <td class="text-muted" width="120">Hari / Waktu</td>
                                <td class="fw-semibold">: <?= $jadwal['hari']; ?>, <?= date('H:i', strtotime($jadwal['jam_mulai'])); ?> - <?= date('H:i', strtotime($jadwal['jam_selesai'])); ?> WIB</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Ruangan</td>
                                <td>: <span class="badge bg-secondary"><?= $jadwal['ruangan']; ?></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABEL ABSENSI MAHASISWA -->
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="fw-bold mb-0" style="color: #0f294a;">
                    <i class="bi bi-people-fill me-2 text-warning"></i>Daftar Kehadiran Mahasiswa (Klik tombol untuk mencatat jam hadir)
                </h6>
            </div>

            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle mb-0">
                        <thead class="table-light text-center">
                            <tr>
                                <th width="50">No</th>
                                <th width="130">NIM</th>
                                <th class="text-start">Nama Mahasiswa</th>
                                <th width="125">Pertemuan 1</th>
                                <th width="125">Pertemuan 2</th>
                                <th width="125">Pertemuan 3</th>
                                <th width="125">Pertemuan 4</th>
                                <th width="125">Pertemuan 5</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (mysqli_num_rows($query_mhs) > 0) { ?>
                            <?php foreach ($query_mhs as $mhs) { ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="text-center fw-semibold"><?= $mhs['nim']; ?></td>
                                <td><?= $mhs['nama']; ?></td>

                                <!-- Loop 5 Kolom Pertemuan (pertemuan1 s.d. pertemuan5) -->
                                <?php for ($i = 1; $i <= 5; $i++) { 
                                    $kolom = "pertemuan" . $i;
                                    $jam_absen = $mhs[$kolom];
                                ?>
                                    <td class="text-center">
                                        <?php if (empty($jam_absen)) { ?>
                                            <!-- Belum Absen: Klik untuk mencatat TIME saat ini -->
                                            <a href="detail_absensi.php?id=<?= $id_jadwal; ?>&absen=<?= $i; ?>&id_krs=<?= $mhs['id_krs']; ?>" 
                                               class="btn btn-outline-primary btn-sm w-100 fw-semibold">
                                                <i class="bi bi-hand-index-thumb"></i> Absen
                                            </a>
                                        <?php } else { ?>
                                            <!-- Sudah Absen: Tampilkan Jam (klik jika ingin membatalkan) -->
                                            <a href="detail_absensi.php?id=<?= $id_jadwal; ?>&batal=<?= $i; ?>&id_krs=<?= $mhs['id_krs']; ?>" 
                                               class="badge bg-success text-decoration-none py-2 px-2 w-100"
                                               title="Klik untuk membatalkan absensi"
                                               onclick="return confirm('Batalkan absensi Pertemuan <?= $i; ?> untuk <?= $mhs['nama']; ?>?')">
                                                <i class="bi bi-check-circle-fill me-1"></i><?= date('H:i:s', strtotime($jam_absen)); ?>
                                            </a>
                                        <?php } ?>
                                    </td>
                                <?php } ?>
                            </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    Belum ada mahasiswa yang terdaftar pada kelas ini.
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>