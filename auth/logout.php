<?php if (!isset($_SESSION)) {
  session_start();
}
require_once("../controller/script.php");
if (isset($_SESSION["project_cafe_kupang"])) {
  unset($_SESSION["project_cafe_kupang"]);
  header("Location: ./");
  exit();
}
