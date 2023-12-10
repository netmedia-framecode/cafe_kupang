<?php
$conn = mysqli_connect("localhost", "root", "", "cafe_kupang");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
