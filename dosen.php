<?php 

    include "koneksi.php";
    $query = mysqli_query($koneksi, "SELECT * FROM dosen");
    $no = 1;

    if (isset($_POST['simpan'])) {
        $nid  = $_POST['nid'];
        $nama_lengkap = $_POST['nama_lengkap'];

        $simpan = mysqli_query($koneksi,
            "INSERT INTO dosen (nid, nama_lengkap) VALUES ('$nid', '$nama_lengkap')"
        );

        if ($simpan) {
            // Insert user baru otomatis untuk login dosen
            mysqli_query($koneksi, "INSERT INTO user (username, password, nama, role) VALUES ('$nid', '$nid', '$nama_lengkap', 'dosen')");
            header("Location: dosen.php");
            exit;
        } else {
            echo "Gagal menambah data!";
        }
    }

    if (isset($_POST['update'])) {
        $nid  = $_POST['nid'];
        $nama_lengkap = $_POST['nama_lengkap'];

        $update = mysqli_query($koneksi,
            "UPDATE dosen SET nama_lengkap='$nama_lengkap' WHERE nid='$nid'"
        );

        if ($update) {
            mysqli_query($koneksi, "UPDATE user SET nama='$nama_lengkap' WHERE username='$nid'");
            header("Location: dosen.php");
            exit;
        } else {
            echo "Gagal update data!";
        }
    }

    if (isset($_GET['hapus'])) {
        $nid = $_GET['hapus'];
        mysqli_query($koneksi, "DELETE FROM dosen WHERE nid='$nid'");
        mysqli_query($koneksi, "DELETE FROM user WHERE username='$nid'");
        echo "<script>alert('Data dosen berhasil dihapus!'); window.location='dosen.php';</script>";
    }

    include 'header.php'; 
?>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
                <h5 class="fw-bold mb-0" style="color: #0f294a;">
                    <i class="bi bi-person-workspace me-2 text-warning"></i>Data Dosen
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
                                <th width="150">NID</th>
                                <th>Nama Lengkap</th>
                                <th class="text-center" width="170">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($query as $data) { ?>
                        <tr>
                            <td class="text-center"><?= $no; ?></td>
                            <td><?= $data['nid'] ?></td>
                            <td><?= $data['nama_lengkap'] ?></td>
                            <td class="text-center">
                                <a href="" class="btn btn-warning btn-sm text-dark fw-semibold" data-bs-toggle="modal" data-bs-target="#Modaledit<?= $no; ?>">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="dosen.php?hapus=<?= $data['nid']; ?>" class="btn btn-danger btn-sm fw-semibold" onclick="return confirm('Yakin ingin menghapus data dosen ini?')">
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
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data dosen</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">NID</label>
                                        <input type="text" name="nid" class="form-control" maxlength="5" readonly value="<?= $data['nid'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap" class="form-control" required value="<?= $data['nama_lengkap'] ?>">
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data dosen</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="mb-3">
                <label class="form-label fw-semibold">NID</label>
                <input type="text" name="nid" class="form-control" maxlength="5" placeholder="Contoh: 25001" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan nama lengkap" required>
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