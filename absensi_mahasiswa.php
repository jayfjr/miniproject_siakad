<?php 
include 'header.php'; 
include 'koneksi.php';

// Mengambil NIM mahasiswa yang sedang login dari session username
$nim = $_SESSION['username'];

// Mengambil data absensi mahasiswa berdasarkan jadwal yang diambil di tabel krs
$query = mysqli_query($koneksi, "
    SELECT krs.*, jadwal.kode_mk, jadwal.hari, jadwal.jam_mulai, jadwal.jam_selesai, 
           matakuliah.nama_mk, dosen.nama_lengkap AS nama_dosen 
    FROM krs
    INNER JOIN jadwal ON krs.id_jadwal = jadwal.id_jadwal
    INNER JOIN matakuliah ON jadwal.kode_mk = matakuliah.kode_mk
    INNER JOIN dosen ON jadwal.nid = dosen.nid
    WHERE krs.nim = '$nim'
    ORDER BY FIELD(jadwal.hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'), jadwal.jam_mulai ASC
");

$no = 1;
?>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <h5 class="fw-bold mb-0" style="color: #0f294a;">
                    <i class="bi bi-check2-square me-2 text-warning"></i>Rekap Absensi Perkuliahan
                </h5>
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                    NIM: <?= $nim; ?>
                </span>
            </div>

            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle mb-0">
                        <thead class="table-light text-center">
                            <tr>
                                <th width="50">No</th>
                                <th width="100">Kode MK</th>
                                <th class="text-start">Matakuliah & Dosen</th>
                                <th width="115">Pertemuan 1</th>
                                <th width="115">Pertemuan 2</th>
                                <th width="115">Pertemuan 3</th>
                                <th width="115">Pertemuan 4</th>
                                <th width="115">Pertemuan 5</th>
                                <th width="110">Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (mysqli_num_rows($query) > 0) { ?>
                            <?php foreach ($query as $data) { 
                                $jumlah_hadir = 0;
                            ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="text-center fw-semibold"><?= $data['kode_mk']; ?></td>
                                <td>
                                    <div class="fw-semibold"><?= $data['nama_mk']; ?></div>
                                    <small class="text-muted">
                                        <?= $data['nama_dosen']; ?> &bull; <?= $data['hari']; ?>, <?= date('H:i', strtotime($data['jam_mulai'])); ?>
                                    </small>
                                </td>

                                <!-- Loop 5 Kolom Pertemuan (pertemuan1 s.d. pertemuan5) -->
                                <?php for ($i = 1; $i <= 5; $i++) { 
                                    $kolom = "pertemuan" . $i;
                                    $jam_absen = $data[$kolom];
                                ?>
                                    <td class="text-center">
                                        <?php if (!empty($jam_absen)) { 
                                            $jumlah_hadir++;
                                        ?>
                                            <span class="badge bg-success py-2 px-2 w-100">
                                                <i class="bi bi-check-circle-fill me-1"></i><?= date('H:i:s', strtotime($jam_absen)); ?>
                                            </span>
                                        <?php } else { ?>
                                            <span class="badge bg-light text-muted border py-2 px-2 w-100">
                                                -
                                            </span>
                                        <?php } ?>
                                    </td>
                                <?php } ?>

                                <td class="text-center fw-bold">
                                    <?php $persen = ($jumlah_hadir / 5) * 100; ?>
                                    <span class="badge <?= ($persen >= 80) ? 'bg-primary' : 'bg-warning text-dark'; ?> px-2 py-1">
                                        <?= $jumlah_hadir; ?> / 5 (<?= $persen; ?>%)
                                    </span>
                                </td>
                            </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    Belum ada data absensi perkuliahan untuk NIM Anda.
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