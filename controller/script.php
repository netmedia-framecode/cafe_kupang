<?php if (!isset($_SESSION[""])) {
  session_start();
}
error_reporting(~E_NOTICE & ~E_DEPRECATED);
require_once("db_connect.php");
require_once(__DIR__ . "/../models/sql.php");
require_once("functions.php");

$messageTypes = ["success", "info", "warning", "danger", "dark"];

$baseURL = "http://$_SERVER[HTTP_HOST]/apps/tugas/cafe_kupang/";
$name_website = "Cafe Kupang";

$select_auth = "SELECT * FROM auth";
$views_auth = mysqli_query($conn, $select_auth);
$select_kafe = "SELECT * FROM kafe WHERE id_status='3' ORDER BY id_kafe DESC LIMIT 3";
$views_kafe = mysqli_query($conn, $select_kafe);
$select_kafe_detail = "SELECT * FROM kafe WHERE id_status='3'";
$views_kafe_detail = mysqli_query($conn, $select_kafe_detail);

if (!isset($_SESSION["project_cafe_kupang"]["users"])) {
  if (isset($_SESSION["project_cafe_kupang"]["time_message"]) && (time() - $_SESSION["project_cafe_kupang"]["time_message"]) > 2) {
    foreach ($messageTypes as $type) {
      if (isset($_SESSION["project_cafe_kupang"]["message_$type"])) {
        unset($_SESSION["project_cafe_kupang"]["message_$type"]);
      }
    }
    unset($_SESSION["project_cafe_kupang"]["time_message"]);
  }
  if (isset($_POST["register"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (register($conn, $validated_post, $action = 'insert') > 0) {
      header("Location: verification?en=" . $_SESSION['data_auth']['en_user']);
      exit();
    }
  }
  if (isset($_POST["re_verifikasi"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (re_verifikasi($conn, $validated_post, $action = 'update') > 0) {
      $message = "Kode token yang baru telah dikirim ke email anda.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: verification?en=" . $_SESSION['data_auth']['en_user']);
      exit();
    }
  }
  if (isset($_POST["verifikasi"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (verifikasi($conn, $validated_post, $action = 'update') > 0) {
      $message = "Akun anda berhasil di verifikasi.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: ./");
      exit();
    }
  }
  if (isset($_POST["forgot_password"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (forgot_password($conn, $validated_post, $action = 'update', $baseURL) > 0) {
      $message = "Kami telah mengirim link ke email anda untuk melakukan reset kata sandi.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: ./");
      exit();
    }
  }
  if (isset($_POST["new_password"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (new_password($conn, $validated_post, $action = 'update') > 0) {
      $message = "Kata sandi anda telah berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      header("Location: ./");
      exit();
    }
  }
  if (isset($_POST["login"])) {
    if (login($conn, $_POST) > 0) {
      header("Location: ../views/");
      exit();
    }
  }

  $select_pemilihan_kafe = "SELECT * FROM alternatif JOIN kafe ON alternatif.id_kafe=kafe.id_kafe JOIN status_kafe ON kafe.id_status=status_kafe.id_status WHERE kafe.id_status='3' ORDER BY kafe.nama_kafe ASC";
  $views_pemilihan_kafe = mysqli_query($conn, $select_pemilihan_kafe);
  if (isset($_POST['perhitungan'])) {
    if (!isset($_POST['id_alternatif'])) {
      $message = "Maaf, anda harus memilih kafe terlebih dahulu.";
      $message_type = "danger";
      alert($message, $message_type);
      header("Location: pemilihan-kafe");
      exit();
    }

    $selected = (array) $_POST['id_alternatif'];

    if (count($selected) < 2) {
      $message = "Maaf, anda harus memilih minimal 2 kafe untuk melakukan perhitungan.";
      $message_type = "danger";
      alert($message, $message_type);
      header("Location: pemilihan-kafe");
      exit();
    } else {
      $_SESSION["project_cafe_kupang"]["perhitungan"] = [
        "akses" => 1,
        "selected" => $selected
      ];
      header("Location: pemilihan-kafe");
      exit();
    }
  }
  if (isset($_POST["reset_perhitungan"])) {
    unset($_SESSION["project_cafe_kupang"]["perhitungan"]);
    header("Location: pemilihan-kafe");
    exit();
  }
}

if (isset($_SESSION["project_cafe_kupang"]["users"])) {
  $id_user = valid($conn, $_SESSION["project_cafe_kupang"]["users"]["id"]);
  $id_role = valid($conn, $_SESSION["project_cafe_kupang"]["users"]["id_role"]);
  $role = valid($conn, $_SESSION["project_cafe_kupang"]["users"]["role"]);
  $email = valid($conn, $_SESSION["project_cafe_kupang"]["users"]["email"]);
  $name = valid($conn, $_SESSION["project_cafe_kupang"]["users"]["name"]);
  if (isset($_SESSION["project_cafe_kupang"]["users"]["time_message"]) && (time() - $_SESSION["project_cafe_kupang"]["users"]["time_message"]) > 2) {
    foreach ($messageTypes as $type) {
      if (isset($_SESSION["project_cafe_kupang"]["users"]["message_$type"])) {
        unset($_SESSION["project_cafe_kupang"]["users"]["message_$type"]);
      }
    }
    unset($_SESSION["project_cafe_kupang"]["users"]["time_message"]);
  }

  $count_users = "SELECT * FROM users WHERE id_user!='$id_user'";
  $count_users = mysqli_query($conn, $count_users);
  $counts_users = mysqli_num_rows($count_users);
  if ($id_role == 1) {
    $count_kafe = "SELECT * FROM kafe";
  } else {
    $count_kafe = "SELECT * FROM kafe WHERE id_user='$id_user'";
  }
  $count_kafe = mysqli_query($conn, $count_kafe);
  $counts_kafe = mysqli_num_rows($count_kafe);

  $select_profile = "SELECT users.*, user_role.role, user_status.status 
                      FROM users
                      JOIN user_role ON users.id_role=user_role.id_role 
                      JOIN user_status ON users.id_active=user_status.id_status 
                      WHERE users.id_user='$id_user'
                    ";
  $view_profile = mysqli_query($conn, $select_profile);
  if (isset($_POST["edit_profil"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (profil($conn, $validated_post, $action = 'update', $id_user) > 0) {
      $message = "Profil Anda berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["setting"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (setting($conn, $validated_post, $action = 'update') > 0) {
      $message = "Setting pada system login berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  $select_users = "SELECT users.*, user_role.role, user_status.status 
                    FROM users
                    JOIN user_role ON users.id_role=user_role.id_role 
                    JOIN user_status ON users.id_active=user_status.id_status
                  ";
  $views_users = mysqli_query($conn, $select_users);
  $select_user_role = "SELECT * FROM user_role";
  $views_user_role = mysqli_query($conn, $select_user_role);
  if (isset($_POST["edit_users"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (users($conn, $validated_post, $action = 'update') > 0) {
      $message = "data users berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["add_role"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (role($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Role baru berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["edit_role"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (role($conn, $validated_post, $action = 'update') > 0) {
      $message = "Role " . $_POST['roleOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["delete_role"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (role($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Role " . $_POST['role'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  $select_menu = "SELECT * 
                    FROM user_menu 
                    ORDER BY menu ASC
                  ";
  $views_menu = mysqli_query($conn, $select_menu);
  if (isset($_POST["add_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Menu baru berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["edit_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu($conn, $validated_post, $action = 'update') > 0) {
      $message = "Menu " . $_POST['menuOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["delete_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Menu " . $_POST['menu'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  $select_sub_menu = "SELECT user_sub_menu.*, user_menu.menu, user_status.status 
                        FROM user_sub_menu 
                        JOIN user_menu ON user_sub_menu.id_menu=user_menu.id_menu 
                        JOIN user_status ON user_sub_menu.id_active=user_status.id_status 
                        ORDER BY user_sub_menu.title ASC
                      ";
  $views_sub_menu = mysqli_query($conn, $select_sub_menu);
  $select_user_status = "SELECT * 
                          FROM user_status
                        ";
  $views_user_status = mysqli_query($conn, $select_user_status);
  if (isset($_POST["add_sub_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu($conn, $validated_post, $action = 'insert', $baseURL) > 0) {
      $message = "Sub Menu baru berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["edit_sub_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu($conn, $validated_post, $action = 'update', $baseURL) > 0) {
      $message = "Sub Menu " . $_POST['titleOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["delete_sub_menu"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu($conn, $validated_post, $action = 'delete', $baseURL) > 0) {
      $message = "Sub Menu " . $_POST['title'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  $select_user_access_menu = "SELECT user_access_menu.*, user_role.role, user_menu.menu
                                FROM user_access_menu 
                                JOIN user_role ON user_access_menu.id_role=.user_role.id_role 
                                JOIN user_menu ON user_access_menu.id_menu=user_menu.id_menu
                              ";
  $views_user_access_menu = mysqli_query($conn, $select_user_access_menu);
  $select_menu_check = "SELECT user_menu.* 
                    FROM user_menu 
                    ORDER BY user_menu.menu ASC
                  ";
  $views_menu_check = mysqli_query($conn, $select_menu_check);
  if (isset($_POST["add_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu_access($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Akses ke menu berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["edit_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu_access($conn, $validated_post, $action = 'update') > 0) {
      $message = "Akses menu " . $_POST['menu'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["delete_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (menu_access($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Akses menu " . $_POST['menu'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  $select_user_access_sub_menu = "SELECT user_access_sub_menu.*, user_role.role, user_sub_menu.title
                                FROM user_access_sub_menu 
                                JOIN user_role ON user_access_sub_menu.id_role=.user_role.id_role 
                                JOIN user_sub_menu ON user_access_sub_menu.id_sub_menu=user_sub_menu.id_sub_menu
                              ";
  $views_user_access_sub_menu = mysqli_query($conn, $select_user_access_sub_menu);
  $select_sub_menu_check = "SELECT user_sub_menu.* 
                    FROM user_sub_menu 
                    ORDER BY user_sub_menu.title ASC
                  ";
  $views_sub_menu_check = mysqli_query($conn, $select_sub_menu_check);
  if (isset($_POST["add_sub_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu_access($conn, $validated_post, $action = 'insert') > 0) {
      $message = "Akses ke sub menu berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["edit_sub_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu_access($conn, $validated_post, $action = 'update') > 0) {
      $message = "Akses sub menu " . $_POST['title'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["delete_sub_menu_access"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_menu_access($conn, $validated_post, $action = 'delete') > 0) {
      $message = "Akses sub menu " . $_POST['title'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  if ($id_role == 1) {
    $select_kafe = "SELECT * FROM kafe JOIN status_kafe ON kafe.id_status=status_kafe.id_status";
  } else {
    $select_kafe = "SELECT * FROM kafe JOIN status_kafe ON kafe.id_status=status_kafe.id_status WHERE kafe.id_user='$id_user'";
  }
  $views_kafe = mysqli_query($conn, $select_kafe);
  if (isset($_POST["add_kafe"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kafe($conn, $validated_post, $action = 'insert', $baseURL, $id_user) > 0) {
      $message = "Data kafe berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["edit_kafe"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kafe($conn, $validated_post, $action = 'update', $baseURL, $id_user) > 0) {
      $message = "Data kafe " . $_POST['nama_kafeOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["delete_kafe"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kafe($conn, $validated_post, $action = 'delete', $baseURL, $id_user) > 0) {
      $message = "Data kafe " . $_POST['nama_kafe'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  $select_kriteria = "SELECT * FROM kriteria";
  $views_kriteria = mysqli_query($conn, $select_kriteria);
  if (isset($_POST["add_kriteria"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kriteria($conn, $validated_post, $action = 'insert', $baseURL) > 0) {
      $message = "Data kriteria berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["edit_kriteria"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kriteria($conn, $validated_post, $action = 'update', $baseURL) > 0) {
      $message = "Data kriteria " . $_POST['nama_kriteriaOld'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["delete_kriteria"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (kriteria($conn, $validated_post, $action = 'delete', $baseURL) > 0) {
      $message = "Data kriteria " . $_POST['nama_kriteria'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  $select_sub_kriteria = "SELECT sub_kriteria.*, kriteria.kode_kriteria, kriteria.nama_kriteria, kriteria.bobot FROM sub_kriteria JOIN kriteria ON sub_kriteria.id_kriteria=kriteria.id_kriteria";
  $views_sub_kriteria = mysqli_query($conn, $select_sub_kriteria);
  if (isset($_POST["add_sub_kriteria"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_kriteria($conn, $validated_post, $action = 'insert', $baseURL) > 0) {
      $message = "Data sub kriteria berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["delete_sub_kriteria"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (sub_kriteria($conn, $validated_post, $action = 'delete', $baseURL) > 0) {
      $message = "Data sub kriteria " . $_POST['sub_kriteria'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  if ($id_role == 1) {
    $select_kafe_option = "SELECT * FROM kafe WHERE id_status<='2'";
    $select_alternatif = "SELECT alternatif.*, kafe.id_kafe, kafe.nama_kafe FROM alternatif JOIN kafe ON alternatif.id_kafe=kafe.id_kafe WHERE kafe.id_status<='2'";
  } else {
    $select_kafe_option = "SELECT * FROM kafe WHERE id_status<='2' AND id_user='$id_user'";
    $select_alternatif = "SELECT alternatif.*, kafe.id_kafe, kafe.nama_kafe FROM alternatif JOIN kafe ON alternatif.id_kafe=kafe.id_kafe WHERE kafe.id_status<='2' AND kafe.id_user='$id_user'";
  }
  $views_kafe_option = mysqli_query($conn, $select_kafe_option);
  $views_alternatif = mysqli_query($conn, $select_alternatif);
  if (isset($_POST["add_alternatif"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (alternatif($conn, $validated_post, $action = 'insert', $baseURL) > 0) {
      $message = "Data alternatif berhasil ditambahkan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["edit_alternatif"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (alternatif($conn, $validated_post, $action = 'update', $baseURL) > 0) {
      $message = "Data alternatif " . $_POST['kode_alternatif'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["delete_alternatif"])) {
    $validated_post = array_map(function ($value) use ($conn) {
      return valid($conn, $value);
    }, $_POST);
    if (alternatif($conn, $validated_post, $action = 'delete', $baseURL) > 0) {
      $message = "Data alternatif " . $_POST['kode_alternatif'] . " berhasil dihapus.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  if ($id_role == 1) {
    $select_nilai_alternatif = "SELECT nilai_alternatif.*, kafe.id_kafe, kafe.nama_kafe, kriteria.nama_kriteria
                                  FROM nilai_alternatif
                                  JOIN alternatif ON nilai_alternatif.id_alternatif = alternatif.id_alternatif
                                  JOIN kriteria ON nilai_alternatif.id_kriteria = kriteria.id_kriteria
                                  JOIN kafe ON alternatif.id_kafe = kafe.id_kafe
                                  WHERE kafe.id_status <= '2'
                                ";
  } else {
    $select_nilai_alternatif = "SELECT nilai_alternatif.*, kafe.id_kafe, kafe.nama_kafe, kriteria.nama_kriteria
                                  FROM nilai_alternatif
                                  JOIN alternatif ON nilai_alternatif.id_alternatif = alternatif.id_alternatif
                                  JOIN kriteria ON nilai_alternatif.id_kriteria = kriteria.id_kriteria
                                  JOIN kafe ON alternatif.id_kafe = kafe.id_kafe
                                  WHERE kafe.id_status <= '2'
                                  AND kafe.id_user='$id_user'
                                ";
  }
  $views_nilai_alternatif = mysqli_query($conn, $select_nilai_alternatif);
  if (isset($_POST["edit_nilai_alternatif"])) {
    if (nilai_alternatif($conn, $_POST, $action = 'update', $baseURL) > 0) {
      $message = "Data nilai alternatif " . $_POST['nama_kafe'] . " berhasil diubah.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }

  if ($id_role == 1) {
    $select_pemilihan_kafe = "SELECT * FROM alternatif JOIN kafe ON alternatif.id_kafe=kafe.id_kafe JOIN status_kafe ON kafe.id_status=status_kafe.id_status WHERE kafe.id_status<='2' ORDER BY kafe.nama_kafe ASC";
  } else {
    $select_pemilihan_kafe = "SELECT * FROM alternatif JOIN kafe ON alternatif.id_kafe=kafe.id_kafe JOIN status_kafe ON kafe.id_status=status_kafe.id_status WHERE kafe.id_status<='2' AND kafe.id_user='$id_user' ORDER BY kafe.nama_kafe ASC";
  }
  $views_pemilihan_kafe = mysqli_query($conn, $select_pemilihan_kafe);
  if (isset($_POST['perhitungan'])) {
    $selected = (array) $_POST['id_alternatif'];
    if (count($selected) < 2) {
      $message = "Maaf, anda harus memilih minimal 2 alternatif untuk melakukan perhitungan.";
      $message_type = "danger";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    } else {
      $_SESSION["project_cafe_kupang"]["perhitungan"] = [
        "akses" => 1,
        "selected" => $selected
      ];
      header("Location: perhitungan");
      exit();
    }
  }
  if (isset($_POST["pemilihan"])) {
    if (pemilihan($conn, $_POST, $action = 'insert', $baseURL) > 0) {
      $message = "Data perhitungan berhasil masukan.";
      $message_type = "success";
      alert($message, $message_type);
      $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
      $to_page = str_replace(" ", "-", $to_page);
      header("Location: $to_page");
      exit();
    }
  }
  if (isset($_POST["reset_perhitungan"])) {
    unset($_SESSION["project_cafe_kupang"]["perhitungan"]);
    $to_page = strtolower($_SESSION["project_cafe_kupang"]["name_page"]);
    $to_page = str_replace(" ", "-", $to_page);
    header("Location: $to_page");
    exit();
  }
}
