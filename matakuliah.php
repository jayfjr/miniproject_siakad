<?php 
include "koneksi.php";

// 1. PROSES TAMBAH DATA
if (isset($_POST['simpan'])) {
    $kode_mk = $_POST['kode_mk'];
    $nama_mk = $_POST['nama_mk'];
    $sks     = $_POST['sks'];

    $simpan = mysqli_query($koneksi,
        "INSERT INTO matakuliah (kode_mk, nama_mk, sks) VALUES ('$kode_mk', '$nama_mk', '$sks')"
    );

    if ($simpan) {
        header("Location: matakuliah.php");
        exit;
    } else {
        echo "Gagal menambah data!";
    }
}

// 2. PROSES EDIT DATA
if (isset($_POST['update'])) {
    $kode_mk = $_POST['kode_mk'];
    $nama_mk = $_POST['nama_mk'];
    $sks     = $_POST['sks'];

    $update = mysqli_query($koneksi,
        "UPDATE matakuliah SET nama_mk='$nama_mk', sks='$sks' WHERE kode_mk='$kode_mk'"
    );

    if ($update) {
        header("Location: matakuliah.php");
        exit;
    } else {
        echo "Gagal update data!";
    }
}

// 3. PROSES HAPUS DATA
if (isset($_GET['hapus'])) {
    $kode_mk = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM matakuliah WHERE kode_mk='$kode_mk'");
    echo "<script>alert('Data matakuliah berhasil dihapus!'); window.location='matakuliah.php';</script>";
    exit;
}

include 'header.php'; 
$query = mysqli_query($koneksi, "SELECT * FROM matakuliah");
$no = 1;
?>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <h5 class="fw-bold mb-0" style="color: #0f294a;">
                    <i class="bi bi-journal-bookmark-fill me-2 text-warning"></i>Data Matakuliah
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
                                <th class="text-center" width="60">No</th>
                                <th width="150">Kode MK</th>
                                <th>Nama Matakuliah</th>
                                <th class="text-center" width="100">SKS</th>
                                <th class="text-center" width="170">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($query as $data) { ?>
                        <tr>
                            <td class="text-center"><?= $no; ?></td>
                            <td class="fw-semibold"><?= $data['kode_mk'] ?></td>
                            <td><?= $data['nama_mk'] ?></td>
                            <td class="text-center">
                                <span class="badge bg-info bg-opacity-10 text-dark px-3 py-2">
                                    <?= $data['sks'] ?> SKS
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="" class="btn btn-warning btn-sm text-dark fw-semibold" data-bs-toggle="modal" data-bs-target="#Modaledit<?= $no; ?>">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="matakuliah.php?hapus=<?= $data['kode_mk']; ?>" class="btn btn-danger btn-sm fw-semibold" onclick="return confirm('Yakin ingin menghapus data matakuliah ini?')">
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
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data matakuliah</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Kode Matakuliah</label>
                                        <input type="text" name="kode_mk" class="form-control" maxlength="5" readonly value="<?= $data['kode_mk'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Nama Matakuliah</label>
                                        <input type="text" name="nama_mk" class="form-control" required value="<?= $data['nama_mk'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">SKS</label>
                                        <input type="number" name="sks" class="form-control" min="1" max="6" required value="<?= $data['sks'] ?>">
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data matakuliah</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="mb-3">
                <label class="form-label fw-semibold">Kode Matakuliah</label>
                <input type="text" name="kode_mk" class="form-control" maxlength="5" placeholder="Contoh: MK001" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Matakuliah</label>
                <input type="text" name="nama_mk" class="form-control" placeholder="Masukkan nama matakuliah" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">SKS</label>
                <input type="number" name="sks" class="form-control" min="1" max="6" placeholder="Contoh: 3" required>
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