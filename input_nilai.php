<?php 
include 'koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: nilai.php");
    exit;
}

$id_jadwal = $_GET['id'];

// PROSES SIMPAN & HITUNG NILAI AKHIR + GRADE
if (isset($_POST['simpan'])) {
    foreach ($_POST['id_krs'] as $i => $id_krs) {
        $tm  = $_POST['nilai_tm'][$i];
        $uts = $_POST['nilai_uts'][$i];
        $uas = $_POST['nilai_uas'][$i];

        // Lewati baris jika ketiga nilai belum diisi
        if ($tm === '' && $uts === '' && $uas === '') {
            continue;
        }

        $tm  = (float) $tm;
        $uts = (float) $uts;
        $uas = (float) $uas;

        // Hitung Nilai Akhir: TM 30%, UTS 30%, UAS 40%
        $nilai_akhir = ($uts * 0.3) + ($uas * 0.4) + ($tm * 0.3);

        // Penentuan Grade sesuai range
        if ($nilai_akhir >= 85) {
            $grade = 'A';
        } elseif ($nilai_akhir >= 75) {
            $grade = 'B';
        } elseif ($nilai_akhir >= 65) {
            $grade = 'C';
        } elseif ($nilai_akhir >= 55) {
            $grade = 'D';
        } else {
            $grade = 'E';
        }

        mysqli_query($koneksi, "
            UPDATE krs SET 
                nilai_tm    = '$tm',
                nilai_uts   = '$uts',
                nilai_uas   = '$uas',
                nilai_akhir = '$nilai_akhir',
                grade       = '$grade'
            WHERE id_krs = '$id_krs'
        ");
    }

    echo "<script>alert('Data nilai berhasil disimpan!'); window.location='input_nilai.php?id=$id_jadwal';</script>";
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

// Ambil data mahasiswa beserta nilai pada kelas ini
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
                    <i class="bi bi-award-fill me-2 text-warning"></i>Form Input Nilai Mahasiswa
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

        <!-- TABEL INPUT NILAI MAHASISWA -->
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <h6 class="fw-bold mb-0" style="color: #0f294a;">
                    <i class="bi bi-people-fill me-2 text-warning"></i>Daftar Nilai Mahasiswa (Bobot: TM 30%, UTS 30%, UAS 40%)
                </h6>
            </div>

            <form action="" method="POST">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle mb-0">
                            <thead class="table-light text-center">
                                <tr>
                                    <th width="50">No</th>
                                    <th width="130">NIM</th>
                                    <th class="text-start">Nama Mahasiswa</th>
                                    <th width="130">Nilai TM (30%)</th>
                                    <th width="130">Nilai UTS (30%)</th>
                                    <th width="130">Nilai UAS (40%)</th>
                                    <th width="120">Nilai Akhir</th>
                                    <th width="90">Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (mysqli_num_rows($query_mhs) > 0) { ?>
                                <?php foreach ($query_mhs as $mhs) { ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td class="text-center fw-semibold">
                                        <?= $mhs['nim']; ?>
                                        <input type="hidden" name="id_krs[]" value="<?= $mhs['id_krs']; ?>">
                                    </td>
                                    <td><?= $mhs['nama']; ?></td>
                                    <td>
                                        <input type="number" step="0.01" min="0" max="100" name="nilai_tm[]" class="form-control text-center" placeholder="0" value="<?= $mhs['nilai_tm']; ?>">
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" min="0" max="100" name="nilai_uts[]" class="form-control text-center" placeholder="0" value="<?= $mhs['nilai_uts']; ?>">
                                    </td>
                                    <td>
                                        <input type="number" step="0.01" min="0" max="100" name="nilai_uas[]" class="form-control text-center" placeholder="0" value="<?= $mhs['nilai_uas']; ?>">
                                    </td>
                                    <td class="text-center fw-bold">
                                        <?= ($mhs['nilai_akhir'] !== null) ? number_format($mhs['nilai_akhir'], 2) : '-'; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if (!empty($mhs['grade'])) { ?>
                                            <span class="badge bg-primary fs-6 px-3 py-1"><?= $mhs['grade']; ?></span>
                                        <?php } else { ?>
                                            <span class="text-muted">-</span>
                                        <?php } ?>
                                    </td>
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

                    <?php if (mysqli_num_rows($query_mhs) > 0) { ?>
                    <div class="mt-4 pt-3 border-top d-flex justify-content-end">
                        <button type="submit" name="simpan" class="btn text-white fw-semibold px-4" style="background-color: #0f294a;">
                            <i class="bi bi-save me-1"></i> Simpan Nilai
                        </button>
                    </div>
                    <?php } ?>
                </div>
            </form>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>