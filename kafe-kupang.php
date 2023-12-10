<?php require_once("controller/script.php");
$_SESSION["project_cafe_kupang"]["name_page"] = "Kafe Kupang"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once("sections/head.php"); ?>
</head>

<body>

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
            <h1>Kafe Kupang</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end breadcrumb section -->

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
        <?php if (mysqli_num_rows($views_kafe_detail) > 0) {
          while ($row_kafe = mysqli_fetch_assoc($views_kafe_detail)) { ?>
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
      </div>
    </div>
  </div>
  <!-- end product section -->

  <!-- footer -->
  <?php require_once("sections/footer.php"); ?>
  <!-- end footer -->

</body>

</html>