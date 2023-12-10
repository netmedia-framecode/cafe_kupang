<!-- copyright -->
<div class="copyright">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-12">
        <p>Copyrights &copy; <?= date('Y') ?> - <a href="https://netmedia-framecode.com/" target="_blank">Netmedia Framecode</a>, All Rights Reserved. Develop by Anggie Arisca Amfoni</p>
      </div>
      <div class="col-lg-6 text-right col-md-12">
        <div class="social-icons">
          <ul>
            <li><a href="https://www.facebook.com/anggie.arisca" target="_blank"><i class="bi bi-facebook"></i></a></li>
            <li><a href="https://www.instagram.com/anggiearisca/" target="_blank"><i class="bi bi-instagram"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end copyright -->

<!-- jquery -->
<script src="<?= $baseURL ?>assets/js/jquery-1.11.3.min.js"></script>
<!-- bootstrap -->
<script src="<?= $baseURL ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- count down -->
<script src="<?= $baseURL ?>assets/js/jquery.countdown.js"></script>
<!-- isotope -->
<script src="<?= $baseURL ?>assets/js/jquery.isotope-3.0.6.min.js"></script>
<!-- waypoints -->
<script src="<?= $baseURL ?>assets/js/waypoints.js"></script>
<!-- owl carousel -->
<script src="<?= $baseURL ?>assets/js/owl.carousel.min.js"></script>
<!-- magnific popup -->
<script src="<?= $baseURL ?>assets/js/jquery.magnific-popup.min.js"></script>
<!-- mean menu -->
<script src="<?= $baseURL ?>assets/js/jquery.meanmenu.min.js"></script>
<!-- sticker js -->
<script src="<?= $baseURL ?>assets/js/sticker.js"></script>
<!-- main js -->
<script src="<?= $baseURL ?>assets/js/main.js"></script>

<script>
const showMessage = (type, title, message) => {
  if (message) {
    Swal.fire({
      icon: type,
      title: title,
      text: message,
    });
  }
};

showMessage("success", "Berhasil Terkirim", $(".message-success").data("message-success"));
showMessage("info", "For your information", $(".message-info").data("message-info"));
showMessage("warning", "Peringatan!!", $(".message-warning").data("message-warning"));
showMessage("error", "Kesalahan", $(".message-danger").data("message-danger"));
</script>