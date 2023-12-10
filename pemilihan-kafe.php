<?php require_once("controller/script.php");
$_SESSION["project_cafe_kupang"]["name_page"] = "Pemilihan Kafe"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once("sections/head.php"); ?>
</head>

<body>
  <?php foreach ($messageTypes as $type) {
    if (isset($_SESSION["project_cafe_kupang"]["message_$type"])) {
      echo "<div class='message-$type' data-message-$type='{$_SESSION["project_cafe_kupang"]["message_$type"]}'></div>";
    }
  } ?>

  <!-- nav -->
  <?php require_once("sections/nav.php"); ?>
  <!-- end nav -->

  <!-- breadcrumb-section -->
  <div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2 text-center">
          <div class="breadcrumb-text">
            <p>Cafe & Bar Kuapng</p>
            <h1>Pemilihan Kafe</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end breadcrumb section -->

  <!-- choice product -->
  <div class="mt-100 mb-150">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="single-article-section">
            <div class="single-article-text">
              <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="assets/img/1.png" class="d-block w-100" alt="..." style="height: 400px; object-fit: cover;">
                  </div>
                  <div class="carousel-item">
                    <img src="assets/img/2.jpg" class="d-block w-100" alt="..." style="height: 400px; object-fit: cover;">
                  </div>
                  <div class="carousel-item">
                    <img src="assets/img/3.jpg" class="d-block w-100" alt="..." style="height: 400px; object-fit: cover;">
                  </div>
                </div>
              </div>

              <?php if (!isset($_SESSION["project_cafe_kupang"]["perhitungan"])) { ?>
                <h2 class="mt-3">Pilih Kafe</h2>
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
                        <button type="submit" name="perhitungan" class="d-none d-sm-inline-block btn btn-primary shadow-sm mt-3 mb-1"><i class="bi bi-calculator"></i> Mulai</button>
                        <p>Dengan klik mulai anda akan mencari kafe dengan kualitas yang terbaik berdasarkan rangking.</p>
                      </div>
                    </form>
                  </div>
                </div>
              <?php } else if (isset($_SESSION["project_cafe_kupang"]["perhitungan"])) {
                require_once("views/ngitung.php");
                $selected = $_SESSION["project_cafe_kupang"]["perhitungan"]["selected"];
                $bobot_kriteria = get_bobot_kriteria();
                $normal_kriteria = get_normal_kriteria($bobot_kriteria);
                $data = get_hasil_analisa('', $selected);
                $terbobot = get_terbobot($data, $normal_kriteria);
                $total = get_total($terbobot);
                $rank = get_rank($total);
              ?>
                <h2 class="mt-3">Kafe Direkomendasikan</h2>
                <div class="card shadow">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th></th>
                            <?php foreach ($xc_kriteria as $row_xc) : ?>
                              <th scope="col"><?= $row_xc['nama_kriteria'] ?></th>
                            <?php endforeach; ?>
                            <th>Total</th>
                            <th>Rank</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th></th>
                            <?php foreach ($xc_kriteria as $row_xc) : ?>
                              <th scope="col"><?= $row_xc['nama_kriteria'] ?></th>
                            <?php endforeach; ?>
                            <th>Total</th>
                            <th>Rank</th>
                          </tr>
                        </tfoot>
                        <tbody>
                          <?php foreach ($rank as $key => $val) : ?>
                            <tr>
                              <th><?= $ALTERNATIF[$key] ?></th>
                              <?php foreach ($terbobot[$key] as $k => $v) : ?>
                                <td><?= round($v, 2) ?></td>
                              <?php endforeach ?>
                              <td><?= round($total[$key], 2) ?></td>
                              <td><?= $rank[$key] ?></td>
                            </tr>
                          <?php
                            mysqli_query($conn, "UPDATE alternatif SET total='$total[$key]', rank='$rank[$key]' WHERE id_alternatif='$key'");
                          endforeach ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="card-footer">
                    <form action="" method="post">
                      <button type="submit" name="reset_perhitungan" class="btn btn-secondary shadow border-0">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                      </button>
                    </form>
                  </div>
                </div>
              <?php } ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end choice product -->

  <!-- footer -->
  <?php require_once("sections/footer.php"); ?>
  <!-- end footer -->

</body>

</html>