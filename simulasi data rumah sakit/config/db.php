<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "sistem_rumah_sakit";
$koneksi = mysqli_connect($host, $user, $password, $database);
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
