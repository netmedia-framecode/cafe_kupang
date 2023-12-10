<?php require_once("../controller/script.php");
require_once("redirect.php");
$_SESSION['page-name'] = "Cetak Hasil";
$_SESSION['page-url'] = "cetak-hasil";

$selected = $_SESSION["project_cafe_kupang"]["perhitungan"]["selected"];
$xc_kriteria = mysqli_query($conn, "SELECT * FROM kriteria");
$count_kriteria = mysqli_num_rows($xc_kriteria);
require_once("ngitung.php");
$bobot_kriteria = get_bobot_kriteria();
$normal_kriteria = get_normal_kriteria($bobot_kriteria);
$data = get_hasil_analisa('', $selected);
$terbobot = get_terbobot($data, $normal_kriteria);
$total = get_total($terbobot);
$rank = get_rank($total);

function hari_ini()
{
  $hari = date("D");

  switch ($hari) {
    case 'Sun':
      $hari_ini = "Minggu";
      break;

    case 'Mon':
      $hari_ini = "Senin";
      break;

    case 'Tue':
      $hari_ini = "Selasa";
      break;

    case 'Wed':
      $hari_ini = "Rabu";
      break;

    case 'Thu':
      $hari_ini = "Kamis";
      break;

    case 'Fri':
      $hari_ini = "Jumat";
      break;

    case 'Sat':
      $hari_ini = "Sabtu";
      break;

    default:
      $hari_ini = "Tidak di ketahui";
      break;
  }
  return $hari_ini;
}

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Perhitungan Pegawai Tetap PDAM Kab Kupang.xls");
?>

<center>
  <h3>Data Pemilihan Kafe Di Kota Kupang</h3>
</center>
<div>
  <p><?= hari_ini() . ", " . date("d M Y") ?></p>
</div>
<table border="1">
  <thead>
    <tr align="center">
      <th scope="col" rowspan="2">Rank</th>
      <th scope="col" rowspan="2">Nama Kafe</th>
      <th colspan="<?= $count_kriteria ?>">Kriteria</th>
    <tr>
      <?php foreach ($xc_kriteria as $row_xc) : ?>
        <th scope="col"><?= $row_xc['nama_kriteria'] ?></th>
      <?php endforeach; ?>
      <th scope="col" rowspan="1">Total</th>
      <th scope="col" rowspan="1">Status</th>
    </tr>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rank as $key => $val) : ?>
      <tr align="center">
        <td><?= $rank[$key] ?></td>
        <th><?= $ALTERNATIF[$key] ?></th>
        <?php foreach ($terbobot[$key] as $k => $v) : ?>
          <td><?= round($v, 2) ?></td>
        <?php endforeach ?>
        <td><?= round($total[$key], 2) ?></td>
        <td><?php $nilai = round($total[$key], 2);
            if ($nilai >= 75) {
              echo "Kafe Direkomendasi";
            } else {
              echo "Kafe Tidak Direkomendasi";
            } ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>