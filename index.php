<?php require_once("controller/script.php");
$_SESSION["project_cafe_kupang"]["name_page"] = ""; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once("sections/head.php"); ?>
</head>

<body>

  <!-- nav -->
  <?php require_once("sections/nav.php"); ?>
  <!-- end nav -->

  <!-- hero area -->
  <div class="hero-area hero-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2 text-center">
          <div class="hero-text">
            <div class="hero-text-tablecell">
              <p class="subtitle">Kriteria</p>
              <h1>Cafe & Bar Kupang</h1>
              <div class="hero-btns">
                <a href="kafe-kupang" class="boxed-btn">Lihat Kafe</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end hero area -->

  <!-- features list section -->
  <div class="list-section pt-80 pb-80 shadow">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-6 mb-4 mb-lg-0">
          <div class="list-box d-flex align-items-center">
            <div class="list-icon">
              <i class="bi bi-buildings-fill"></i>
            </div>
            <div class="content">
              <h3>Kafe Kupang Apps</h3>
              <p>Aplikasi ini dikembangkan dengan menggunakan metode SMART (Simple Multi Additive Attribute Rating Technique) untuk menemukan Kafe mana saja yang direkomendasikan untuk didatangi. Dengan adanya aplikasi ini diharapkan dapat mempermudah pengambilan keputusan dalam pemilihan kafe di Kota Kupang yang sesuai dengan pertimbangan konsumen sehingga proses pengambilan keputusan menjadi cepat, tepat dan akurat serta dapat menghasilkan suatu alternatif saran atau rekomendasi pemilihan kafe di Kota Kupang.</p>
              <a href="tentang" class="bordered-btn text-dark mt-3">Detail</a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!-- end features list section -->

  <!-- product section -->
  <div class="latest-news pt-150 pb-150" id="cafe">
    <div class="container">

      <div class="row">
        <div class="col-lg-8 offset-lg-2 text-center">
          <div class="section-title">
            <h3>Kafe Kupang</h3>
            <p>Daftar kafe di Kota Kupang yang direkomendasikan.</p>
          </div>
        </div>
      </div>

      <div class="row">
        <?php if (mysqli_num_rows($views_kafe) > 0) {
          while ($row_kafe = mysqli_fetch_assoc($views_kafe)) { ?>
            <div class="col-lg-4 col-md-6">
              <div class="single-latest-news">
                <a>
                  <div class="latest-news-bg" style="background-image: url(<?= $row_kafe['image'] ?>);"></div>
                </a>
                <div class="news-text-box">
                  <h3><?= $row_kafe['nama_kafe'] ?></h3>
                  <p class="blog-meta">
                    <span class="author"><i class="fas fa-phone"></i> <?= $row_kafe['telp'] ?></span>
                    <span class="date"><i class="fas fa-map-marker-alt"></i> <?= $row_kafe['alamat'] ?></span>
                  </p>
                </div>
              </div>
            </div>
        <?php }
        } ?>
        <a href="kafe-kupang#cafe" class="bordered-btn text-dark mt-3 m-auto">Lihat Lainnya</a>
      </div>
    </div>
  </div>
  <!-- end product section -->

  <!-- footer -->
  <?php require_once("sections/footer.php"); ?>
  <!-- end footer -->

</body>

</html>