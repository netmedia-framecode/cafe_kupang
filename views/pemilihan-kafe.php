<?php require_once("../controller/script.php");
$_SESSION["project_cafe_kupang"]["name_page"] = "Pemilihan Kafe";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_cafe_kupang"]["name_page"] ?></h1>
  </div>

  <div class="card shadow mb-4 border-0">
    <div class="card-body">
      <form action="" method="post">
        <div class="table-responsive">
          <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th scope="col" class="text-center">Pilih</th>
                <th scope="col" class="text-center">Nama Kafe</th>
                <th scope="col" class="text-center">Telp</th>
                <th scope="col" class="text-center">Alamat</th>
                <th scope="col" class="text-center">Status</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th class="text-center">Pilih</th>
                <th class="text-center">Nama Kafe</th>
                <th class="text-center">Telp</th>
                <th class="text-center">Alamat</th>
                <th class="text-center">Status</th>
              </tr>
            </tfoot>
            <tbody>
              <?php if (mysqli_num_rows($views_pemilihan_kafe) > 0) {
                $no = 1;
                while ($row = mysqli_fetch_assoc($views_pemilihan_kafe)) { ?>
                  <tr>
                    <th scope="row" style="width: 50px;">
                      <div class="form-check text-center">
                        <input class="form-check-input shadow border-0" type="checkbox" name="id_alternatif[]" value="<?= $row['id_alternatif'] ?>" style="transform: scale(1.5);">
                      </div>
                    </th>
                    <td><img src="<?= $row["image"] ?>" style="width: 50px;height: 50px;margin-right: 10px;" alt="Image"><?= $row["nama_kafe"] ?></td>
                    <td><?= $row["telp"] ?></td>
                    <td><?= $row["alamat"] ?></td>
                    <td><?= $row["status_kafe"] ?></td>
                  </tr>
              <?php $no++;
                }
              } ?>
            </tbody>
          </table>
          <button type="submit" name="perhitungan" class="d-none d-sm-inline-block btn btn-primary shadow-sm mt-3"><i class="bi bi-calculator"></i> Mulai Perhitungan</button>
        </div>
      </form>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>