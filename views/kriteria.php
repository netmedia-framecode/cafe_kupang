<?php require_once("../controller/script.php");
$_SESSION["project_cafe_kupang"]["name_page"] = "Kriteria";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_cafe_kupang"]["name_page"] ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambah"><i class="bi bi-plus-lg"></i> Tambah</a>
  </div>

  <div class="card shadow mb-4 border-0">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-dark">Kode Kriteria</th>
              <th class="text-dark">Nama Kriteria</th>
              <th class="text-dark">Bobot</th>
              <th class="text-dark">Tgl Dibuat</th>
              <th class="text-dark">Tgl Diubah</th>
              <th class="text-dark">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-dark">Kode Kriteria</th>
              <th class="text-dark">Nama Kriteria</th>
              <th class="text-dark">Bobot</th>
              <th class="text-dark">Tgl Dibuat</th>
              <th class="text-dark">Tgl Diubah</th>
              <th class="text-center">Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php if (mysqli_num_rows($views_kriteria) > 0) {
              while ($row = mysqli_fetch_assoc($views_kriteria)) { ?>
                <tr>
                  <td class="text-dark"><?= $row['kode_kriteria'] ?></td>
                  <td class="text-dark"><?= $row['nama_kriteria'] ?></td>
                  <td class="text-dark"><?= $row['bobot'] ?></td>
                  <td class="text-dark">
                    <div class="badge badge-opacity-success text-dark">
                      <?php $dateCreate = date_create($row['created_at']);
                      echo date_format($dateCreate, "l, d M Y h:i a"); ?>
                    </div>
                  </td>
                  <td class="text-dark">
                    <div class="badge badge-opacity-warning text-dark">
                      <?php $dateUpdate = date_create($row['updated_at']);
                      echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
                    </div>
                  </td>
                  <td class="text-center">
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $row['id_kriteria'] ?>">
                      <i class="bi bi-pencil-square"></i> Ubah
                    </button>
                    <div class="modal fade" id="ubah<?= $row['id_kriteria'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header border-bottom-0 shadow">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row["nama_kriteria"] ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="" method="POST">
                            <input type="hidden" name="id_kriteria" value="<?= $row['id_kriteria'] ?>">
                            <input type="hidden" name="nama_kriteriaOld" value="<?= $row["nama_kriteria"] ?>">
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="nama-kriteria" class="form-label">Nama Kriteria</label>
                                <input type="text" name="nama" value="<?= $row['nama_kriteria'] ?>" class="form-control" id="nama-kriteria" placeholder="Nama Kriteria">
                              </div>
                              <div class="form-group">
                                <label for="bobot" class="form-label">Bobot</label>
                                <input type="number" name="bobot" value="<?= $row['bobot'] ?>" class="form-control" id="bobot" placeholder="Bobot">
                              </div>
                            </div>
                            <div class="modal-footer justify-content-center border-top-0">
                              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                              <button type="submit" name="edit_kriteria" class="btn btn-warning btn-sm">Ubah</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $row['id_kriteria'] ?>">
                      <i class="bi bi-trash3"></i> Hapus
                    </button>
                    <div class="modal fade" id="hapus<?= $row['id_kriteria'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header border-bottom-0 shadow">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row["nama_kriteria"] ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="" method="post">
                            <input type="hidden" name="id_kriteria" value="<?= $row['id_kriteria'] ?>">
                            <input type="hidden" name="nama_kriteria" value="<?= $row["nama_kriteria"] ?>">
                            <div class="modal-body">
                              <p>Jika anda yakin ingin menghapus <?= $row["nama_kriteria"] ?> klik Hapus!</p>
                            </div>
                            <div class="modal-footer justify-content-center border-top-0">
                              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                              <button type="submit" name="delete_kriteria" class="btn btn-danger btn-sm">hapus</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
            <?php }
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-bottom-0 shadow">
          <h5 class="modal-title" id="tambahLabel">Tambah Kriteria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="nama" class="form-label">Nama Kriteria</label>
              <input type="text" name="nama" value="<?php if (isset($_POST['nama'])) {
                                                      echo $_POST['nama'];
                                                    } ?>" class="form-control" id="nama" placeholder="Nama Kriteria">
            </div>
            <div class="form-group">
              <label for="bobot" class="form-label">Bobot</label>
              <input type="number" name="bobot" value="<?php if (isset($_POST['bobot'])) {
                                                          echo $_POST['bobot'];
                                                        } ?>" class="form-control" id="bobot" placeholder="Bobot">
            </div>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="add_kriteria" class="btn btn-primary btn-sm">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>