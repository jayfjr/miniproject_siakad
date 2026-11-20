<?php 
    include 'header.php'; 
    include "koneksi.php";
    $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
    $no=1;


if (isset($_POST['simpan'])) {
    $nim     = $_POST['nim'];
    $nama    = $_POST['nama'];
    $jurusan = $_POST['jurusan'];

    $query = mysqli_query($koneksi,
        "INSERT INTO mahasiswa (nim, nama, jurusan) VALUES ('$nim', '$nama', '$jurusan')"
    );

    if ($query) {
        //insert user baru
        mysqli_query($koneksi, "INSERT INTO user (username, password, nama, role) VALUES ('$nim', '$nim', '$nama', 'mahasiswa')");
        header("Location: mahasiswa.php");
        exit;
    } else {
        echo "Gagal menambah data!";
    }
}

if (isset($_POST['update'])) {
    $nim    = $_POST['nim'];
    $nama    = $_POST['nama'];
    $jurusan = $_POST['jurusan'];

    $update = mysqli_query($koneksi,
        "UPDATE mahasiswa SET nama='$nama',  jurusan='$jurusan' WHERE nim='$nim'");

    if ($update) {
        mysqli_query($koneksi, "UPDATE user SET nama='$nama' WHERE username='$nim'");
        header("Location: mahasiswa.php");
        exit;
    } else {
        echo "Gagal update data!";
    }
}

if (isset($_GET['hapus'])) {
    $nim = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE nim='$nim'");
    mysqli_query($koneksi, "DELETE FROM user WHERE username='$nim'");
    echo "<script>alert('Data mahasiswa berhasil dihapus!'); window.location='mahasiswa.php';</script>";
}
?>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <h5 class="fw-bold mb-0" style="color: #0f294a;">
                    <i class="bi bi-people-fill me-2 text-warning"></i>Data Mahasiswa
                </h5>
                <a href="tambah.php" class="btn btn-sm fw-semibold text-white px-3 py-2" style="background-color: #0f294a;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Data
                </a>
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
                                <th class="text-center" width="170">Aksi</th>
                            </tr>
                        </thead>
                        <?php foreach($query as $data) {?>
                        <tr>
                            <td><?=$no;?></td>
                            <td><?= $data['nim'] ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                            <?= $data['jurusan'] ?>
                                        </span>
                            </td>
                            <td class="text-center">
                                <a href="" class="btn btn-warning btn-sm text-dark fw-semibold" data-bs-toggle="modal" data-bs-target="#Modaledit<?=$no;?>">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="mahasiswa.php?hapus=<?= $data['nim']; ?>" class="btn btn-danger btn-sm fw-semibold" onclick="return confirm('Yakin ingin menghapus data mahasiswa ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>


                        <!-- MODAL EDIT -->
                        <div class="modal fade" id="Modaledit<?=$no;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <form action="" method="POST">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data mahasiswa</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">NIM</label>
                                        <input type="text" name="nim" class="form-control" maxlength="10" readonly value="<?= $data['nim'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control" required value="<?= $data['nama'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Jurusan</label>
                                        <select name="jurusan" class="form-select" required>
                                            <option value="">-- Pilih Jurusan --</option>
                                            <option value="Teknik Informatika" <?= ($data['jurusan'] == 'Teknik Informatika') ? 'selected' : ''; ?>>Teknik Informatika</option>
                                            <option value="Sistem Informasi" <?= ($data['jurusan'] == 'Sistem Informasi') ? 'selected' : ''; ?>>Sistem Informasi</option>
                                            <option value="Sistem Komputer" <?= ($data['jurusan'] == 'Sistem Komputer') ? 'selected' : ''; ?>>Sistem Komputer</option>
                                            <option value="Manajemen Informatika" <?= ($data['jurusan'] == 'Manajemen Informatika') ? 'selected' : ''; ?>>Manajemen Informatika</option>
                                        </select>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data mahasiswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="mb-3">
                <label class="form-label fw-semibold">NIM</label>
                <input type="text" name="nim" class="form-control" maxlength="10" placeholder="Contoh: 2026010001" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Jurusan</label>
                <select name="jurusan" class="form-select" required>
                    <option value="">-- Pilih Jurusan --</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Sistem Komputer">Sistem Komputer</option>
                    <option value="Manajemen Informatika">Manajemen Informatika</option>
                </select>
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