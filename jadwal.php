<?php 
include "koneksi.php";

// 1. PROSES TAMBAH JADWAL
if (isset($_POST['simpan'])) {
    $kode_mk     = $_POST['kode_mk'];
    $hari        = $_POST['hari'];
    $jam_mulai   = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $ruangan     = $_POST['ruangan'];
    $nid         = $_POST['nid'];

    $simpan = mysqli_query($koneksi, "
        INSERT INTO jadwal (kode_mk, hari, jam_mulai, jam_selesai, ruangan, nid) 
        VALUES ('$kode_mk', '$hari', '$jam_mulai', '$jam_selesai', '$ruangan', '$nid')
    ");

    if ($simpan) {
        header("Location: jadwal.php");
        exit;
    } else {
        echo "Gagal menambah jadwal: " . mysqli_error($koneksi);
    }
}

// 2. PROSES EDIT JADWAL
if (isset($_POST['update'])) {
    $id_jadwal   = $_POST['id_jadwal'];
    $kode_mk     = $_POST['kode_mk'];
    $hari        = $_POST['hari'];
    $jam_mulai   = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $ruangan     = $_POST['ruangan'];
    $nid         = $_POST['nid'];

    $update = mysqli_query($koneksi, "
        UPDATE jadwal SET 
            kode_mk     = '$kode_mk',
            hari        = '$hari',
            jam_mulai   = '$jam_mulai',
            jam_selesai = '$jam_selesai',
            ruangan     = '$ruangan',
            nid         = '$nid'
        WHERE id_jadwal = '$id_jadwal'
    ");

    if ($update) {
        header("Location: jadwal.php");
        exit;
    } else {
        echo "Gagal update jadwal: " . mysqli_error($koneksi);
    }
}

// 3. PROSES HAPUS JADWAL
if (isset($_GET['hapus'])) {
    $id_jadwal = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM jadwal WHERE id_jadwal='$id_jadwal'");
    echo "<script>alert('Data jadwal berhasil dihapus!'); window.location='jadwal.php';</script>";
    exit;
}

include 'header.php'; 

// Ambil data jadwal beserta nama matakuliah dan nama dosen
$query = mysqli_query($koneksi, "
    SELECT jadwal.*, matakuliah.nama_mk, dosen.nama_lengkap AS nama_dosen 
    FROM jadwal
    INNER JOIN matakuliah ON jadwal.kode_mk = matakuliah.kode_mk
    INNER JOIN dosen ON jadwal.nid = dosen.nid
    ORDER BY jadwal.id_jadwal ASC
");

// Ambil data master matakuliah & dosen untuk dropdown modal
$data_mk     = mysqli_query($koneksi, "SELECT * FROM matakuliah ORDER BY nama_mk ASC");
$data_dosen  = mysqli_query($koneksi, "SELECT * FROM dosen ORDER BY nama_lengkap ASC");
$daftar_hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
$no = 1;
?>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <h5 class="fw-bold mb-0" style="color: #0f294a;">
                    <i class="bi bi-calendar-week me-2 text-warning"></i>Data Jadwal Kelas
                </h5>
                <a href="#" class="btn btn-sm fw-semibold text-white px-3 py-2" style="background-color: #0f294a;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Data
                </a>
            </div>

            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" width="50">No</th>
                                <th class="text-center" width="90">ID Jadwal</th>
                                <th>Kode MK</th>
                                <th>Nama Matakuliah</th>
                                <th>Hari</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th class="text-center">Ruangan</th>
                                <th>NID</th>
                                <th>Nama Dosen</th>
                                <th>Detail</th>
                                <th class="text-center" width="160">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($query as $data) { ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td class="text-center fw-semibold"><?= $data['id_jadwal']; ?></td>
                                <td class="fw-semibold"><?= $data['kode_mk']; ?></td>
                                <td><?= $data['nama_mk']; ?></td>
                                <td>
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-2 py-1">
                                        <?= $data['hari']; ?>
                                    </span>
                                </td>
                                <td><?= date('H:i', strtotime($data['jam_mulai'])); ?></td>
                                <td><?= date('H:i', strtotime($data['jam_selesai'])); ?></td>
                                <td class="text-center">
                                    <span class="badge bg-secondary"><?= $data['ruangan']; ?></span>
                                </td>
                                <td><?= $data['nid']; ?></td>
                                <td><?= $data['nama_dosen']; ?></td>
                                <td><a href="jadwal_detail.php?id=<?= $data['id_jadwal']; ?>">Detail</a></td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-warning btn-sm text-dark fw-semibold" data-bs-toggle="modal" data-bs-target="#Modaledit<?= $no; ?>">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <a href="jadwal_kelas.php?hapus=<?= $data['id_jadwal']; ?>" class="btn btn-danger btn-sm fw-semibold" onclick="return confirm('Yakin ingin menghapus jadwal ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>

                            <!-- MODAL EDIT -->
                            <div class="modal fade" id="Modaledit<?= $no; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <form action="" method="POST">
                                  <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Jadwal Kelas</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                        <input type="hidden" name="id_jadwal" value="<?= $data['id_jadwal']; ?>">

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-semibold">Matakuliah</label>
                                                <select name="kode_mk" class="form-select" required>
                                                    <option value="">-- Pilih Matakuliah --</option>
                                                    <?php foreach ($data_mk as $mk) { ?>
                                                        <option value="<?= $mk['kode_mk']; ?>" <?= ($mk['kode_mk'] == $data['kode_mk']) ? 'selected' : ''; ?>>
                                                            <?= $mk['kode_mk']; ?> - <?= $mk['nama_mk']; ?> (<?= $mk['sks']; ?> SKS)
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="form-label fw-semibold">Dosen Pengampu</label>
                                                <select name="nid" class="form-select" required>
                                                    <option value="">-- Pilih Dosen --</option>
                                                    <?php foreach ($data_dosen as $dsn) { ?>
                                                        <option value="<?= $dsn['nid']; ?>" <?= ($dsn['nid'] == $data['nid']) ? 'selected' : ''; ?>>
                                                            <?= $dsn['nid']; ?> - <?= $dsn['nama_lengkap']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label class="form-label fw-semibold">Hari</label>
                                                <select name="hari" class="form-select" required>
                                                    <option value="">-- Pilih Hari --</option>
                                                    <?php foreach ($daftar_hari as $hari) { ?>
                                                        <option value="<?= $hari; ?>" <?= ($hari == $data['hari']) ? 'selected' : ''; ?>>
                                                            <?= $hari; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label class="form-label fw-semibold">Jam Mulai</label>
                                                <input type="time" name="jam_mulai" class="form-control" value="<?= $data['jam_mulai']; ?>" required>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label class="form-label fw-semibold">Jam Selesai</label>
                                                <input type="time" name="jam_selesai" class="form-control" value="<?= $data['jam_selesai']; ?>" required>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label class="form-label fw-semibold">Ruangan</label>
                                                <input type="text" name="ruangan" class="form-control" maxlength="5" value="<?= $data['ruangan']; ?>" required>
                                            </div>
                                        </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                                  </div>
                                </form>
                                </div>
                              </div>
                            </div>

                        <?php $no++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

<!-- MODAL ADD -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <form action="" method="POST">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Jadwal Kelas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Matakuliah</label>
                    <select name="kode_mk" class="form-select" required>
                        <option value="">-- Pilih Matakuliah --</option>
                        <?php foreach ($data_mk as $mk) { ?>
                            <option value="<?= $mk['kode_mk']; ?>">
                                <?= $mk['kode_mk']; ?> - <?= $mk['nama_mk']; ?> (<?= $mk['sks']; ?> SKS)
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Dosen Pengampu</label>
                    <select name="nid" class="form-select" required>
                        <option value="">-- Pilih Dosen --</option>
                        <?php foreach ($data_dosen as $dsn) { ?>
                            <option value="<?= $dsn['nid']; ?>">
                                <?= $dsn['nid']; ?> - <?= $dsn['nama_lengkap']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label fw-semibold">Hari</label>
                    <select name="hari" class="form-select" required>
                        <option value="">-- Pilih Hari --</option>
                        <?php foreach ($daftar_hari as $hari) { ?>
                            <option value="<?= $hari; ?>"><?= $hari; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label fw-semibold">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label fw-semibold">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label fw-semibold">Ruangan</label>
                    <input type="text" name="ruangan" class="form-control" maxlength="5" placeholder="Contoh: R.301" required>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="simpan">Add</button>
      </div>
    </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>