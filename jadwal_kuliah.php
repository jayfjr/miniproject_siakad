<?php 
include 'header.php'; 
include 'koneksi.php';

// Mengambil NIM mahasiswa yang sedang login dari session username
$nim = $_SESSION['username'];

// Mengambil jadwal kuliah mahasiswa dengan menggabungkan tabel krs, jadwal, matakuliah, dan dosen
$query = mysqli_query($koneksi, "
    SELECT jadwal.*, matakuliah.nama_mk, matakuliah.sks, dosen.nama_lengkap AS nama_dosen 
    FROM krs
    INNER JOIN jadwal ON krs.id_jadwal = jadwal.id_jadwal
    INNER JOIN matakuliah ON jadwal.kode_mk = matakuliah.kode_mk
    INNER JOIN dosen ON jadwal.nid = dosen.nid
    WHERE krs.nim = '$nim'
    ORDER BY FIELD(jadwal.hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'), jadwal.jam_mulai ASC
");

$no = 1;
$total_sks = 0;
?>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <h5 class="fw-bold mb-0" style="color: #0f294a;">
                    <i class="bi bi-calendar-week me-2 text-warning"></i>Jadwal Kuliah Saya
                </h5>
                <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                    NIM: <?= $nim; ?>
                </span>
            </div>

            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" width="50">No</th>
                                <th width="110">Kode MK</th>
                                <th>Nama Matakuliah</th>
                                <th class="text-center" width="80">SKS</th>
                                <th width="110">Hari</th>
                                <th width="160">Waktu</th>
                                <th class="text-center" width="100">Ruangan</th>
                                <th>Dosen Pengampu</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (mysqli_num_rows($query) > 0) { ?>
                            <?php foreach ($query as $data) { 
                                $total_sks += $data['sks'];
                            ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="fw-semibold"><?= $data['kode_mk']; ?></td>
                                <td><?= $data['nama_mk']; ?></td>
                                <td class="text-center"><?= $data['sks']; ?> SKS</td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1">
                                        <?= $data['hari']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?= date('H:i', strtotime($data['jam_mulai'])); ?> - <?= date('H:i', strtotime($data['jam_selesai'])); ?> WIB
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-secondary"><?= $data['ruangan']; ?></span>
                                </td>
                                <td><?= $data['nama_dosen']; ?></td>
                            </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    Belum ada jadwal kuliah yang terdaftar untuk NIM Anda.
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <?php if (mysqli_num_rows($query) > 0) { ?>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="3" class="text-end">Total SKS Diambil :</th>
                                <th class="text-center text-primary"><?= $total_sks; ?> SKS</th>
                                <th colspan="4"></th>
                            </tr>
                        </tfoot>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>