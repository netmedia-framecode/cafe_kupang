<?php require_once("../controller/script.php");
$_SESSION["project_cafe_kupang"]["name_page"] = "Nilai Alternatif";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_cafe_kupang"]["name_page"] ?></h1>
  </div>

  <div class="card shadow mb-4 border-0">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-dark">Kafe</th>
              <th class="text-dark">Kriteria</th>
              <th class="text-dark">Bobot</th>
              <th class="text-dark">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-dark">Kafe</th>
              <th class="text-dark">Kriteria</th>
              <th class="text-dark">Bobot</th>
              <th class="text-center">Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php if (mysqli_num_rows($views_nilai_alternatif) > 0) {
              while ($row = mysqli_fetch_assoc($views_nilai_alternatif)) { ?>
                <tr>
                  <td class="text-dark"><?= $row['nama_kafe'] ?></td>
                  <td class="text-dark"><?= $row['nama_kriteria'] ?></td>
                  <td class="text-dark"><?= $row['nilai'] ?></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $row['id_nilai_alternatif'] ?>">
                      <i class="bi bi-pencil-square"></i> Ubah
                    </button>
                    <div class="modal fade" id="ubah<?= $row['id_nilai_alternatif'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header border-bottom-0 shadow">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Nilai Alternatif <?= $row['nama_kafe'] ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="" method="post" id="form">
                            <input type="hidden" name="id_nilai_alternatif" value="<?= $row['id_nilai_alternatif'] ?>">
                            <input type="hidden" name="nama_kafe" value="<?= $row['nama_kafe'] ?>">
                            <div class="modal-body text-left">
                              <?php
                              $id_kriteria = $row['id_kriteria'];
                              $id_kafe = $row['id_kafe'];
                              $nilai_kriteria = mysqli_query($conn, "SELECT * FROM nilai_alternatif JOIN alternatif ON nilai_alternatif.id_alternatif=alternatif.id_alternatif JOIN kafe ON alternatif.id_kafe=kafe.id_kafe WHERE kafe.id_kafe='$id_kafe' AND nilai_alternatif.id_kriteria='$id_kriteria' ORDER BY kafe.nama_kafe ASC");
                              if (mysqli_num_rows($nilai_kriteria) > 0) {
                                while ($row2 = mysqli_fetch_assoc($nilai_kriteria)) { ?>
                                  <div class="form-group" data-id-alternatif="<?= $row['id_nilai_alternatif']; ?>">
                                    <label for="nilai" class="form-label"><strong>Kriteria <?= $row['nama_kriteria'] ?></strong></label>
                                    <?php
                                    $no = 1;
                                    $select_sub_kriteria_option = "SELECT * FROM sub_kriteria WHERE id_kriteria='$id_kriteria'";
                                    $views_sub_kriteria_option = mysqli_query($conn, $select_sub_kriteria_option);
                                    foreach ($views_sub_kriteria_option as $row_ssk) : ?>
                                      <div class="row mb-3">
                                        <div class="col-lg-6 m-auto"><?= $row_ssk['sub_kriteria'] ?></div>
                                        <div class="col-lg-6">
                                          <input type="number" name="angka[]" value="<?= $row['nilai'] ?>" class="form-control p-2" id="nilai<?= $no; ?>" placeholder="Nilai" max="<?= $row_ssk['nilai_sub'] ?>" min="0" required>
                                          <div id="error<?= $no; ?>"></div>
                                          <script>
                                            $(document).ready(function() {
                                              $("#nilai<?= $no; ?>").on("input", function() {
                                                if ($(this).val().length > 2) {
                                                  $(this).val($(this).val().slice(0, 2));
                                                  Swal.fire({
                                                    icon: 'error',
                                                    title: 'Gagal',
                                                    text: "Nilai tidak boleh lebih dari 2 digit.",
                                                  })
                                                } else if ($(this).val() > <?= $row_ssk['nilai_sub'] ?>) {
                                                  $(this).val($(this).val().slice(0, 2));
                                                  Swal.fire({
                                                    icon: 'error',
                                                    title: 'Gagal',
                                                    text: "Nilai tidak boleh lebih dari <?= $row_ssk['nilai_sub'] ?>.",
                                                  })
                                                } else if ($(this).val() < 0) {
                                                  $(this).val($(this).val().slice(0, 2));
                                                  Swal.fire({
                                                    icon: 'error',
                                                    title: 'Gagal',
                                                    text: "Nilai tidak boleh minus.",
                                                  })
                                                } else {
                                                  $("#error<?= $no; ?>").text("");
                                                }
                                              });
                                            });
                                          </script>
                                        </div>
                                      </div>
                                    <?php $no++;
                                    endforeach; ?>
                                    <div class="row">
                                      <div class="col-lg-6"></div>
                                      <div class="col-lg-3">
                                        <input type="number" name="nilai" id="hasil<?= $row['id_nilai_alternatif']; ?>" class="form-control p-1" readonly required>
                                      </div>
                                      <div class="col-lg-2">
                                        <button type="button" class="btn btn-primary hitung-btn" data-target="#hasil<?= $row['id_nilai_alternatif']; ?>">Hitung</button>
                                      </div>
                                      <script>
                                        $(document).ready(function() {
                                          $(".hitung-btn").on("click", function() {
                                            let total = 0;
                                            let idAlternatif = $(this).closest('.form-group').data('id-alternatif');

                                            $("[data-id-alternatif='" + idAlternatif + "'] [name='angka[]']").each(function() {
                                              total += parseInt($(this).val()) || 0;
                                            });

                                            if (total > 100) {
                                              Swal.fire({
                                                icon: 'error',
                                                title: 'Gagal',
                                                text: "Jumlah nilai tidak boleh melebihi batas maksimum yaitu 100.",
                                              });
                                              $("#hasil<?= $row['id_nilai_alternatif']; ?>").val("");
                                            } else {
                                              $("#hasil<?= $row['id_nilai_alternatif']; ?>").val(total);
                                            }
                                          });
                                        });
                                      </script>
                                    </div>
                                  </div>
                              <?php }
                              } ?>
                            </div>
                            <div class="modal-footer justify-content-center border-top-0">
                              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                              <button type="submit" name="edit_nilai_alternatif" class="btn btn-warning btn-sm">Ubah</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
            <?php }
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>