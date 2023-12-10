<?php
if (isset($_SESSION["project_cafe_kupang"]["users"])) {
  header("Location: ../views/");
  exit;
}
