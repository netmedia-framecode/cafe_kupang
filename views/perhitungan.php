<?php require_once("../controller/script.php");
$_SESSION["project_cafe_kupang"]["name_page"] = "Perhitungan";
if (!isset($_SESSION["project_cafe_kupang"]["perhitungan"])) {
  header("Location: pemilihan-kafe");
  exit();
} else {
  if ($_SESSION["project_cafe_kupang"]["perhitungan"]["akses"] !== 1) {
    header("Location: pemilihan-kafe");
    exit();
  } else {
    $selected = $_SESSION["project_cafe_kupang"]["perhitungan"]["selected"];
  }
}
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_cafe_kupang"]["name_page"] ?></h1>
  </div>

  <?php
  require_once("ngitung.php");
  $bobot_kriteria = get_bobot_kriteria();
  $normal_kriteria = get_normal_kriteria($bobot_kriteria);
  $data = get_hasil_analisa('', $selected);
  $terbobot = get_terbobot($data, $normal_kriteria);
  $total = get_total($terbobot);
  $rank = get_rank($total);
  ?>
  <div class="row">

    <div class="col-md-12">
      <div class="card shadow">
        <div class="card-header shadow">
          Normaslisasi Kriteria
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <?php foreach ($xc_kriteria as $row_xc) : ?>
                    <th scope="col"><?= $row_xc['nama_kriteria'] ?></th>
                  <?php endforeach; ?>
                  <th scope="col">Total</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th scope="col"></th>
                  <?php foreach ($xc_kriteria as $row_xc) : ?>
                    <th scope="col"><?= $row_xc['nama_kriteria'] ?></th>
                  <?php endforeach; ?>
                  <th scope="col">Total</th>
                </tr>
              </tfoot>
              <tbody>
                <tr>
                  <th scope="row">Bobot</th>
                  <?php $total_bobot = 0;
                  foreach ($xc_kriteria as $row_xc) : ?>
                    <td><?= $row_xc['bobot'] ?></td>
                  <?php $total_bobot += $row_xc['bobot'];
                  endforeach; ?>
                  <td><?= $total_bobot; ?></td>
                </tr>
                <tr>
                  <th scope="row">Bobot Normal</th>
                  <?php foreach ($normal_kriteria as $key => $val) : ?>
                    <td><?= round($val, 2) ?></td>
                  <?php endforeach ?>
                  <td><?= array_sum($normal_kriteria) ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card shadow mt-3">
        <div class="card-header shadow">
          Alternatif
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <?php foreach ($xc_kriteria as $row_xc) : ?>
                    <th scope="col"><?= $row_xc['nama_kriteria'] ?></th>
                  <?php endforeach; ?>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th scope="col"></th>
                  <?php foreach ($xc_kriteria as $row_xc) : ?>
                    <th scope="col"><?= $row_xc['nama_kriteria'] ?></th>
                  <?php endforeach; ?>
                </tr>
              </tfoot>
              <tbody>
                <?php foreach ($data as $key => $val) : ?>
                  <tr>
                    <th><?= $ALTERNATIF[$key] ?></th>
                    <?php foreach ($val as $k => $v) : ?>
                      <td>
                        <?= $v; ?>
                      </td>
                    <?php endforeach ?>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-12">
      <div class="card shadow mt-3">
        <div class="card-header shadow">
          Normalisasi Terbobot
        </div>
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
      </div>
    </div>

    <div class="col md-12 mt-3">
      <div class="d-flex">
        <div>
          <a style="cursor: pointer;" onclick="window.open('cetak-hasil', '_blank')" class="btn btn-success shadow border-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cetak hasil perhitungan akhir ke excel">
            <i class="fas fa-file-excel"></i> Export
          </a>
        </div>
        <div style="margin-left: 10px;">
          <form action="" method="post">
            <?php foreach ($rank as $key => $val) : ?>
              <input type="hidden" name="total[]" value="<?= round($total[$key], 4) ?>">
              <input type="hidden" name="nama_kafe[]" value="<?= $ALTERNATIF[$key] ?>">
            <?php endforeach ?>
            <button type="submit" name="pemilihan" class="btn btn-primary shadow border-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Lakukan otomatisasi pemilihan kafe untuk direkomendasikan dengan satu kali klik saja.">
              <i class="fas fa-tasks"></i> Kirim Hasil
            </button>
          </form>
        </div>
        <div style="margin-left: 10px;">
          <form action="" method="post">
            <button type="submit" name="reset_perhitungan" class="btn btn-secondary shadow border-0">
              <i class="fas fa-redo"></i> Reset
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>