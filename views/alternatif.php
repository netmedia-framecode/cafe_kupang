<?php require_once("../controller/script.php");
$_SESSION["project_cafe_kupang"]["name_page"] = "Alternatif";
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
              <th class="text-dark">Kode Alternatif</th>
              <th class="text-dark">Nama Alternatif</th>
              <th class="text-dark">Tgl Dibuat</th>
              <th class="text-dark">Tgl Diubah</th>
              <th class="text-dark">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-dark">Kode Alternatif</th>
              <th class="text-dark">Nama Alternatif</th>
              <th class="text-dark">Tgl Dibuat</th>
              <th class="text-dark">Tgl Diubah</th>
              <th class="text-center">Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php if (mysqli_num_rows($views_alternatif) > 0) {
              while ($row = mysqli_fetch_assoc($views_alternatif)) { ?>
                <tr>
                  <td class="text-dark"><?= $row['kode_alternatif'] ?></td>
                  <td class="text-dark"><?= $row['nama_kafe'] ?></td>
                  <td>
                    <div class="badge badge-opacity-success text-dark">
                      <?php $dateCreate = date_create($row['created_at']);
                      echo date_format($dateCreate, "l, d M Y h:i a"); ?>
                    </div>
                  </td>
                  <td>
                    <div class="badge badge-opacity-warning text-dark">
                      <?php $dateUpdate = date_create($row['updated_at']);
                      echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
                    </div>
                  </td>
                  <td class="text-center">
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $row['id_alternatif'] ?>">
                      <i class="bi bi-pencil-square"></i> Ubah
                    </button>
                    <div class="modal fade" id="ubah<?= $row['id_alternatif'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header border-bottom-0 shadow">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row['kode_alternatif'] ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="" method="post">
                            <input type="hidden" name="id_alternatif" value="<?= $row['id_alternatif'] ?>">
                            <input type="hidden" name="kode_alternatif" value="<?= $row['kode_alternatif'] ?>">
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="id_kafe" class="form-label">Nama Kafe</label>
                                <select name="id_kafe" class="form-control" id="id_kafe" aria-label="Default select example" required>
                                  <option selected value="">Pilih Kafe</option>
                                  <?php $id_kafe = $row['id_kafe'];
                                  foreach ($views_kafe as $row_kafe) {
                                    $selected = ($row_kafe['id_kafe'] == $id_kafe) ? 'selected' : ''; ?>
                                    <option value="<?= $row_kafe['id_kafe'] ?>" <?= $selected ?>><?= $row_kafe['nama_kafe'] ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            <div class="modal-footer justify-content-center border-top-0">
                              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                              <button type="submit" name="edit_alternatif" class="btn btn-warning btn-sm">Ubah</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $row['id_alternatif'] ?>">
                      <i class="bi bi-trash3"></i> Hapus
                    </button>
                    <div class="modal fade" id="hapus<?= $row['id_alternatif'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header border-bottom-0 shadow">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row["kode_alternatif"] ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="" method="post">
                            <input type="hidden" name="id_alternatif" value="<?= $row['id_alternatif'] ?>">
                            <input type="hidden" name="kode_alternatif" value="<?= $row['kode_alternatif'] ?>">
                            <div class="modal-body">
                              <p>Jika anda yakin ingin menghapus <?= $row["kode_alternatif"] ?> klik Hapus!</p>
                            </div>
                            <div class="modal-footer justify-content-center border-top-0">
                              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                              <button type="submit" name="delete_alternatif" class="btn btn-danger btn-sm">hapus</button>
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
          <h5 class="modal-title" id="tambahLabel">Tambah Alternatif</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="id_kafe" class="form-label">Nama Kafe</label>
              <select name="id_kafe" class="form-control" id="id_kafe" aria-label="Default select example" required>
                <option selected value="">Pilih Kafe</option>
                <?php foreach ($views_kafe_option as $row_kafe) : ?>
                  <option value="<?= $row_kafe['id_kafe'] ?>"><?= $row_kafe['nama_kafe'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="add_alternatif" class="btn btn-primary btn-sm">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>