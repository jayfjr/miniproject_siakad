<?php 
include "koneksi.php";

// Pastikan parameter id jadwal dikirim lewat URL
if (!isset($_GET['id'])) {
    header("Location: jadwal_kelas.php");
    exit;
}

$id_jadwal = $_GET['id'];

// 1. PROSES TAMBAH MAHASISWA KE JADWAL (INSERT KE TABEL KRS)
if (isset($_POST['simpan'])) {
    $nim = $_POST['nim'];

    // Cek agar mahasiswa yang sama tidak terdaftar dua kali di jadwal ini
    $cek = mysqli_query($koneksi, "SELECT * FROM krs WHERE id_jadwal='$id_jadwal' AND nim='$nim'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Mahasiswa tersebut sudah terdaftar di kelas ini!'); window.location='jadwal_detail.php?id=$id_jadwal';</script>";
        exit;
    } else {
        $simpan = mysqli_query($koneksi, "INSERT INTO krs (nim, id_jadwal) VALUES ('$nim', '$id_jadwal')");
        if ($simpan) {
            header("Location: jadwal_detail.php?id=$id_jadwal");
            exit;
        } else {
            echo "Gagal menambahkan mahasiswa: " . mysqli_error($koneksi);
        }
    }
}

// 2. PROSES HAPUS MAHASISWA DARI JADWAL (DELETE DARI TABEL KRS)
if (isset($_GET['hapus'])) {
    $id_krs = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM krs WHERE id_krs='$id_krs'");
    echo "<script>alert('Mahasiswa berhasil dihapus dari jadwal!'); window.location='jadwal_detail.php?id=$id_jadwal';</script>";
    exit;
}

include 'header.php'; 

// Ambil detail jadwal berdasarkan id_jadwal
$query_jadwal = mysqli_query($koneksi, "
    SELECT jadwal.*, matakuliah.nama_mk, matakuliah.sks, dosen.nama_lengkap AS nama_dosen 
    FROM jadwal
    INNER JOIN matakuliah ON jadwal.kode_mk = matakuliah.kode_mk
    INNER JOIN dosen ON jadwal.nid = dosen.nid
    WHERE jadwal.id_jadwal = '$id_jadwal'
");
$jadwal = mysqli_fetch_assoc($query_jadwal);

// Ambil daftar mahasiswa yang terdaftar pada jadwal ini melalui tabel krs
$query_mhs = mysqli_query($koneksi, "
    SELECT krs.id_krs, mahasiswa.nim, mahasiswa.nama, mahasiswa.jurusan 
    FROM krs
    INNER JOIN mahasiswa ON krs.nim = mahasiswa.nim
    WHERE krs.id_jadwal = '$id_jadwal'
    ORDER BY mahasiswa.nim ASC
");

// Ambil semua data mahasiswa untuk pilihan dropdown di Modal Tambah
$list_mahasiswa = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY nama ASC");
$no = 1;
?>

        <!-- KARTU 1: DETAIL JADWAL KELAS -->
        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <h5 class="fw-bold mb-0" style="color: #0f294a;">
                    <i class="bi bi-info-circle-fill me-2 text-warning"></i>Detail Jadwal Kelas
                </h5>
                <a href="jadwal.php" class="btn btn-secondary btn-sm fw-semibold">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <table class="table table-borderless table-sm mb-0">
                            <tr>
                                <td class="text-muted" width="160">ID Jadwal</td>
                                <td class="fw-semibold">: <?= $jadwal['id_jadwal']; ?></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Matakuliah</td>
                                <td class="fw-semibold">: <?= $jadwal['kode_mk']; ?> - <?= $jadwal['nama_mk']; ?> (<?= $jadwal['sks']; ?> SKS)</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Dosen Pengampu</td>
                                <td class="fw-semibold">: <?= $jadwal['nid']; ?> - <?= $jadwal['nama_dosen']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless table-sm mb-0">
                            <tr>
                                <td class="text-muted" width="140">Hari</td>
                                <td>: <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1"><?= $jadwal['hari']; ?></span></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Waktu</td>
                                <td class="fw-semibold">: <?= date('H:i', strtotime($jadwal['jam_mulai'])); ?> - <?= date('H:i', strtotime($jadwal['jam_selesai'])); ?> WIB</td>
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

        <!-- KARTU 2: DAFTAR MAHASISWA PESERTA KELAS -->
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <h5 class="fw-bold mb-0" style="color: #0f294a;">
                    <i class="bi bi-people-fill me-2 text-warning"></i>Daftar Mahasiswa Peserta Kelas
                </h5>
                <button type="button" class="btn btn-sm fw-semibold text-white px-3 py-2" style="background-color: #0f294a;" data-bs-toggle="modal" data-bs-target="#modalTambahMhs">
                    <i class="bi bi-person-plus-fill me-1"></i> Tambah Mahasiswa
                </button>
            </div>

            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" width="60">No</th>
                                <th width="150">NIM</th>
                                <th>Nama Lengkap</th>
                                <th>Jurusan</th>
                                <th class="text-center" width="120">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (mysqli_num_rows($query_mhs) > 0) { ?>
                            <?php foreach ($query_mhs as $mhs) { ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="fw-semibold"><?= $mhs['nim']; ?></td>
                                <td><?= $mhs['nama']; ?></td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                        <?= $mhs['jurusan']; ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="jadwal_detail.php?id=<?= $id_jadwal; ?>&hapus=<?= $mhs['id_krs']; ?>" class="btn btn-danger btn-sm fw-semibold" onclick="return confirm('Yakin ingin menghapus mahasiswa ini dari jadwal?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    Belum ada mahasiswa yang terdaftar di jadwal kelas ini.
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

<!-- MODAL TAMBAH MAHASISWA KE JADWAL -->
<div class="modal fade" id="modalTambahMhs" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="" method="POST">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Tambah Mahasiswa ke Kelas</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label fw-semibold">Pilih Mahasiswa</label>
            <select name="nim" class="form-select" required>
              <option value="">-- Pilih Mahasiswa --</option>
              <?php foreach ($list_mahasiswa as $m) { ?>
                <option value="<?= $m['nim']; ?>">
                  <?= $m['nim']; ?> - <?= $m['nama']; ?> (<?= $m['jurusan']; ?>)
                </option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="simpan">Tambahkan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>