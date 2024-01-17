<?php require_once("../controller/script.php");
$_SESSION["project_cafe_kupang"]["name_page"] = "Kafe";
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
              <th scope="col" class="text-center">#</th>
              <th scope="col" class="text-center">Nama Kafe</th>
              <th scope="col" class="text-center">Telp</th>
              <th scope="col" class="text-center">Alamat</th>
              <th scope="col" class="text-center">Status</th>
              <th scope="col" class="text-center">Jam Operational</th>
              <th scope="col" class="text-center">Tgl Buat</th>
              <th scope="col" class="text-center">Tgl Ubah</th>
              <th scope="col" class="text-center">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">Nama Kafe</th>
              <th class="text-center">Telp</th>
              <th class="text-center">Alamat</th>
              <th class="text-center">Status</th>
              <th class="text-center">Jam Operational</th>
              <th class="text-center">Tgl Buat</th>
              <th class="text-center">Tgl Ubah</th>
              <th class="text-center">Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php if (mysqli_num_rows($views_kafe) > 0) {
              $no = 1;
              while ($row = mysqli_fetch_assoc($views_kafe)) { ?>
                <tr>
                  <th scope="row"><?= $no; ?></th>
                  <td><img src="<?= $row["image"] ?>" style="width: 50px;height: 50px;margin-right: 10px;" alt="Image"><?= $row["nama_kafe"] ?></td>
                  <td><?= $row["telp"] ?></td>
                  <td><?= $row["alamat"] ?></td>
                  <td><?= $row["status_kafe"] ?></td>
                  <td>
                    <?php $jam_buka = date_create($row["jam_buka"]);
                    echo date_format($jam_buka, "h:i a"); ?>
                    <?php $jam_tutup = date_create($row["jam_tutup"]);
                    echo date_format($jam_tutup, "h:i a"); ?>
                  </td>
                  <td>
                    <div class="badge badge-opacity-success">
                      <?php $dateCreate = date_create($row["created_at"]);
                      echo date_format($dateCreate, "l, d M Y h:i a"); ?>
                    </div>
                  </td>
                  <td>
                    <div class="badge badge-opacity-warning">
                      <?php $dateUpdate = date_create($row["updated_at"]);
                      echo date_format($dateUpdate, "l, d M Y h:i a"); ?>
                    </div>
                  </td>
                  <td class="text-center">
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $row['id_kafe'] ?>">
                      <i class="bi bi-pencil-square"></i> Ubah
                    </button>
                    <div class="modal fade" id="ubah<?= $row['id_kafe'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header border-bottom-0 shadow">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $row["nama_kafe"] ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_kafe" value="<?= $row['id_kafe'] ?>">
                            <input type="hidden" name="nama_kafeOld" value="<?= $row["nama_kafe"] ?>">
                            <input type="hidden" name="avatarOld" value="<?= $row["image"] ?>">
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="avatar" class="form-label">Upload Gambar</label>
                                <div class="custom-file">
                                  <input type="file" name="avatar" class="custom-file-input" id="avatar">
                                  <label class="custom-file-label" for="avatar">Upload Gambar</label>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="nama" class="form-label">Nama Kafe</label>
                                <input type="text" name="nama" value="<?= $row['nama_kafe'] ?>" class="form-control" id="nama" placeholder="Nama Kafe" required>
                              </div>
                              <div class="form-group">
                                <label for="telp" class="form-label">Telp</label>
                                <input type="number" name="telp" value="<?= $row['telp'] ?>" class="form-control" id="telp" placeholder="Telp">
                              </div>
                              <div class="form-group">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" value="<?= $row['alamat'] ?>" class="form-control" id="alamat" placeholder="Alamat">
                              </div>
                              <div class="form-group">
                                <label for="jam_buka" class="form-label">Jam Buka</label>
                                <input type="time" name="jam_buka" value="<?= $row['jam_buka'] ?>" class="form-control" id="jam_buka" placeholder="Jam Buka">
                              </div>
                              <div class="form-group">
                                <label for="jam_tutup" class="form-label">Jam Tutup</label>
                                <input type="time" name="jam_tutup" value="<?= $row['jam_tutup'] ?>" class="form-control" id="jam_tutup" placeholder="Jam Tutup">
                              </div>
                            </div>
                            <div class="modal-footer justify-content-center border-top-0">
                              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                              <button type="submit" name="edit_kafe" class="btn btn-warning btn-sm">Ubah</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $row['id_kafe'] ?>">
                      <i class="bi bi-trash3"></i> Hapus
                    </button>
                    <div class="modal fade" id="hapus<?= $row['id_kafe'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header border-bottom-0 shadow">
                            <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $row["nama_kafe"] ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="" method="post">
                            <input type="hidden" name="id_kafe" value="<?= $row['id_kafe'] ?>">
                            <input type="hidden" name="nama_kafe" value="<?= $row["nama_kafe"] ?>">
                            <input type="hidden" name="avatarOld" value="<?= $row["image"] ?>">
                            <div class="modal-body">
                              <p>Jika anda yakin ingin menghapus <?= $row["nama_kafe"] ?> klik Hapus!</p>
                            </div>
                            <div class="modal-footer justify-content-center border-top-0">
                              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                              <button type="submit" name="delete_kafe" class="btn btn-danger btn-sm">hapus</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
            <?php $no++;
              }
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
          <h5 class="modal-title" id="tambahLabel">Tambah Kafe</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label for="avatar" class="form-label">Upload Gambar</label>
              <div class="custom-file">
                <input type="file" name="avatar" class="custom-file-input" id="avatar">
                <label class="custom-file-label" for="avatar">Upload Gambar</label>
              </div>
            </div>
            <div class="form-group">
              <label for="nama" class="form-label">Nama Kafe</label>
              <input type="text" name="nama" value="<?php if (isset($_POST['nama'])) {
                                                      echo $_POST['nama'];
                                                    } ?>" class="form-control" id="nama" placeholder="Nama Kafe" required>
            </div>
            <div class="form-group">
              <label for="telp" class="form-label">Telp</label>
              <input type="number" name="telp" value="<?php if (isset($_POST['telp'])) {
                                                        echo $_POST['telp'];
                                                      } ?>" class="form-control" id="telp" placeholder="Telp">
            </div>
            <div class="form-group">
              <label for="alamat" class="form-label">Alamat</label>
              <input type="text" name="alamat" value="<?php if (isset($_POST['alamat'])) {
                                                        echo $_POST['alamat'];
                                                      } ?>" class="form-control" id="alamat" placeholder="Alamat">
            </div>
            <div class="form-group">
              <label for="jam_buka" class="form-label">Jam Buka</label>
              <input type="time" name="jam_buka" value="<?php if (isset($_POST['jam_buka'])) {
                                                          echo $_POST['jam_buka'];
                                                        } ?>" class="form-control" id="jam_buka" placeholder="Jam Buka">
            </div>
            <div class="form-group">
              <label for="jam_tutup" class="form-label">Jam Tutup</label>
              <input type="time" name="jam_tutup" value="<?php if (isset($_POST['jam_tutup'])) {
                                                            echo $_POST['jam_tutup'];
                                                          } ?>" class="form-control" id="jam_tutup" placeholder="Jam Tutup">
            </div>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="add_kafe" class="btn btn-primary btn-sm">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>