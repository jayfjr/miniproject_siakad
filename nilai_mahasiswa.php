<?php 
include 'header.php'; 
include 'koneksi.php';

// Mengambil NIM mahasiswa yang sedang login dari session username
$nim = $_SESSION['username'];

// Mengambil data nilai mahasiswa berdasarkan jadwal yang diambil di tabel krs
$query = mysqli_query($koneksi, "
    SELECT krs.*, jadwal.kode_mk, matakuliah.nama_mk, matakuliah.sks, dosen.nama_lengkap AS nama_dosen 
    FROM krs
    INNER JOIN jadwal ON krs.id_jadwal = jadwal.id_jadwal
    INNER JOIN matakuliah ON jadwal.kode_mk = matakuliah.kode_mk
    INNER JOIN dosen ON jadwal.nid = dosen.nid
    WHERE krs.nim = '$nim'
    ORDER BY matakuliah.kode_mk ASC
");

$no = 1;
$total_sks = 0;
$total_sks_dinilai = 0;
$total_mutu = 0;
?>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <h5 class="fw-bold mb-0" style="color: #0f294a;">
                    <i class="bi bi-award-fill me-2 text-warning"></i>Kartu Hasil Studi (Nilai Ujian)
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
                                <th class="text-start">Matakuliah & Dosen Pengampu</th>
                                <th width="75">SKS</th>
                                <th width="110">Nilai TM<br><small class="text-muted fw-normal">(30%)</small></th>
                                <th width="110">Nilai UTS<br><small class="text-muted fw-normal">(30%)</small></th>
                                <th width="110">Nilai UAS<br><small class="text-muted fw-normal">(40%)</small></th>
                                <th width="115">Nilai Akhir</th>
                                <th width="90">Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (mysqli_num_rows($query) > 0) { ?>
                            <?php foreach ($query as $data) { 
                                $total_sks += $data['sks'];

                                // Menentukan warna badge dan bobot huruf untuk IPS
                                $badge_grade = 'bg-secondary';
                                $bobot = 0;
                                if ($data['grade'] == 'A') {
                                    $badge_grade = 'bg-success';
                                    $bobot = 4;
                                } elseif ($data['grade'] == 'B') {
                                    $badge_grade = 'bg-primary';
                                    $bobot = 3;
                                } elseif ($data['grade'] == 'C') {
                                    $badge_grade = 'bg-info text-dark';
                                    $bobot = 2;
                                } elseif ($data['grade'] == 'D') {
                                    $badge_grade = 'bg-warning text-dark';
                                    $bobot = 1;
                                } elseif ($data['grade'] == 'E') {
                                    $badge_grade = 'bg-danger';
                                    $bobot = 0;
                                }

                                if (!empty($data['grade'])) {
                                    $total_sks_dinilai += $data['sks'];
                                    $total_mutu += ($bobot * $data['sks']);
                                }
                            ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="text-center fw-semibold"><?= $data['kode_mk']; ?></td>
                                <td>
                                    <div class="fw-semibold"><?= $data['nama_mk']; ?></div>
                                    <small class="text-muted"><?= $data['nama_dosen']; ?></small>
                                </td>
                                <td class="text-center"><?= $data['sks']; ?></td>
                                <td class="text-center">
                                    <?= ($data['nilai_tm'] !== null) ? number_format($data['nilai_tm'], 2) : '-'; ?>
                                </td>
                                <td class="text-center">
                                    <?= ($data['nilai_uts'] !== null) ? number_format($data['nilai_uts'], 2) : '-'; ?>
                                </td>
                                <td class="text-center">
                                    <?= ($data['nilai_uas'] !== null) ? number_format($data['nilai_uas'], 2) : '-'; ?>
                                </td>
                                <td class="text-center fw-bold">
                                    <?= ($data['nilai_akhir'] !== null) ? number_format($data['nilai_akhir'], 2) : '-'; ?>
                                </td>
                                <td class="text-center">
                                    <?php if (!empty($data['grade'])) { ?>
                                        <span class="badge <?= $badge_grade; ?> fs-6 px-3 py-1">
                                            <?= $data['grade']; ?>
                                        </span>
                                    <?php } else { ?>
                                        <span class="text-muted">-</span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    Belum ada data nilai ujian untuk NIM Anda.
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        <?php if (mysqli_num_rows($query) > 0) { 
                            $ips = ($total_sks_dinilai > 0) ? ($total_mutu / $total_sks_dinilai) : 0;
                        ?>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="3" class="text-end">Total SKS :</th>
                                <th class="text-center text-primary"><?= $total_sks; ?></th>
                                <th colspan="3" class="text-end">Indeks Prestasi Semester (IPS) :</th>
                                <th colspan="2" class="text-center text-success fs-6">
                                    <?= number_format($ips, 2); ?>
                                </th>
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