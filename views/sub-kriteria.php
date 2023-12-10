<?php require_once("../controller/script.php");
$_SESSION["project_cafe_kupang"]["name_page"] = "Sub Kriteria";
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
              <th class="text-dark">Kriteria</th>
              <th class="text-dark">Sub kriteria</th>
              <th class="text-dark">Nilai Sub kriteria</th>
              <th class="text-dark">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-dark">Kriteria</th>
              <th class="text-dark">Sub kriteria</th>
              <th class="text-dark">Nilai Sub kriteria</th>
              <th class="text-center">Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php if (mysqli_num_rows($views_sub_kriteria) > 0) {
              while ($row = mysqli_fetch_assoc($views_sub_kriteria)) { ?>
                <tr>
                  <td class="text-dark"><?= $row['kode_kriteria'] . " " . $row['nama_kriteria']  ?></td>
                  <td class="text-dark"><?= $row['sub_kriteria'] ?></td>
                  <td class="text-dark"><?= $row['nilai_sub'] ?></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $row['id_sub_kriteria'] ?>">
                      <i class="bi bi-trash3"></i> Hapus
                    </button>
                    <div class="modal fade" id="hapus<?= $row['id_sub_kriteria'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header border-bottom-0 shadow">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row["sub_kriteria"] ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="" method="post">
                            <input type="hidden" name="id_sub_kriteria" value="<?= $row['id_sub_kriteria'] ?>">
                            <input type="hidden" name="sub_kriteria" value="<?= $row["sub_kriteria"] ?>">
                            <div class="modal-body">
                              <p>Jika anda yakin ingin menghapus <?= $row["sub_kriteria"] ?> klik Hapus!</p>
                            </div>
                            <div class="modal-footer justify-content-center border-top-0">
                              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                              <button type="submit" name="delete_sub_kriteria" class="btn btn-danger btn-sm">hapus</button>
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
          <h5 class="modal-title" id="tambahLabel">Tambah Sub Kriteria</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="sub-kriteria" class="form-label text-dark">Kriteria</label>
              <select name="id-kriteria" class="form-control" aria-label="Default select example" required>
                <option selected value="">Pilih Kriteria</option>
                <?php foreach ($views_kriteria as $row_kriteria) : ?>
                  <option value="<?= $row_kriteria['id_kriteria'] ?>"><?= $row_kriteria['nama_kriteria'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="sub-kriteria" class="form-label text-dark">Sub Kriteria</label>
              <input type="text" name="sub-kriteria" class="form-control" id="sub-kriteria" placeholder="Sub Kriteria">
            </div>
            <div class="form-group">
              <label for="nilai" class="form-label text-dark">Nilai</label>
              <input type="number" name="nilai" class="form-control" id="nilai" placeholder="Nilai">
            </div>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="add_sub_kriteria" class="btn btn-primary btn-sm">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>