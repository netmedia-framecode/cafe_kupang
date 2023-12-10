<?php require_once("controller/script.php");
$_SESSION["project_cafe_kupang"]["name_page"] = "Tentang"; ?>

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
            <h1>Tentang</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end breadcrumb section -->

  <!-- shop banner -->
  <section class="shop-banner shadow">
    <div class="container">
      <h3>Apps <br><span class="orange-text">Kafe Kupang</span></h3>
      <div class="sale-percent mt-3">
        <p>Aplikasi ini dikembangkan dengan menggunakan metode SMART (Simple Multi Additive Attribute Rating Technique) untuk menemukan Kafe mana saja yang direkomendasikan untuk didatangi. Dengan adanya aplikasi ini diharapkan dapat mempermudah pengambilan keputusan dalam pemilihan kafe di Kota Kupang yang sesuai dengan pertimbangan konsumen sehingga proses pengambilan keputusan menjadi cepat, tepat dan akurat serta dapat menghasilkan suatu alternatif saran atau rekomendasi pemilihan kafe di Kota Kupang.</p>
      </div>
    </div>
  </section>
  <!-- end shop banner -->

  <!-- featured section -->
  <div class="feature-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <div class="featured-text">
            <h2 class="pb-3">Penelitian</h2>
            <div class="row">
              <div class="col-lg-6 col-md-6 mb-4 mb-md-5">
                <div class="list-box d-flex">
                  <div class="list-icon">
                    <i class="bi bi-list-ul"></i>
                  </div>
                  <div class="content">
                    <h3>Rumusan Masalah</h3>
                    <p>Pembahasan utama dalam penelitian ini adalah sulitnya dalam pemilihan cafe untuk kegiatan-kegiatan para kelompok atau kaum milenial. Pihak cafe juga kesulitan dalam mempromosikan cafe mereka di Kota Kupang.</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 mb-5 mb-md-5">
                <div class="list-box d-flex">
                  <div class="list-icon">
                    <i class="bi bi-list-ul"></i>
                  </div>
                  <div class="content">
                    <h3>Batasan Masalah</h3>
                    <p>Batasan masalah dalam pembuatan sistem ini adalah sebagai berikut:</p>
                    <ul>
                      <li>
                        <p>Kriteria yang digunakan untuk pemilihan cafe yaitu: fasilitas, biaya, lokasi, variasi menu, pelayanan, waktu operasional dan rating.</p>
                      </li>
                      <li>
                        <p>Studi kasus penelitian ini hanya di Wilayah Kota Kupang.</p>
                      </li>
                      <li>
                        <p>Metode yang digunakan adalah Metode SMART.</p>
                      </li>
                      <li>
                        <p>Sistem ini berbasis website.</p>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 mb-5 mb-md-5">
                <div class="list-box d-flex">
                  <div class="list-icon">
                    <i class="bi bi-list-ul"></i>
                  </div>
                  <div class="content">
                    <h3>Tujuan Penelitian</h3>
                    <p>Merancang, membangun dan menerapkan sistem pedukung keputusan berbasis website untuk pemilihan cafe di Kota Kupang dengan menerapkan metode Simple Multi Additive Attribute Rating Technique (SMART).</p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="list-box d-flex">
                  <div class="list-icon">
                    <i class="bi bi-list-ul"></i>
                  </div>
                  <div class="content">
                    <h3>Manfaat Penelitian</h3>
                    <p>Manfaat dari penelitian ini diharapkan dapat mempermudah pemilik cafe untuk mempromosikan cafe dan juga memudahkan konsumen yang ada di Kota Kupang dalam mengambil keputusan untuk memilih cafe yang tepat berdasarkan kriteria yang sudah di tetapkan dengan memberikan suatu alternatif saran atau rekomedasi cafe yang tepat.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end featured section -->

  <!-- footer -->
  <?php require_once("sections/footer.php"); ?>
  <!-- end footer -->

</body>

</html>