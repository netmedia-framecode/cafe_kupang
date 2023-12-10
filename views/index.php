<?php require_once("../controller/script.php");
$_SESSION["project_cafe_kupang"]["name_page"] = "";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Users</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $counts_users ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                Kafe</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $counts_kafe ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-list-ul fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-lg-12 mb-4">

      <!-- Illustrations -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Hasil Kafe</h6>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col" class="text-center">Nama Kafe</th>
                <th scope="col" class="text-center">Telp</th>
                <th scope="col" class="text-center">Alamat</th>
                <th scope="col" class="text-center">Status</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">Nama Kafe</th>
                <th class="text-center">Telp</th>
                <th class="text-center">Alamat</th>
                <th class="text-center">Status</th>
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
                  </tr>
              <?php $no++;
                }
              } ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>