<?php
include "config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_kunjungan = $_POST['id_kunjungan'];
    $keluhan = $_POST['keluhan'];

    $query = "
        UPDATE kunjungan
        SET keluhan = '$keluhan'
        WHERE id_kunjungan = '$id_kunjungan'
    ";

    if (mysqli_query($koneksi, $query)) {
        header("Location: patient.php");
        exit;
    } else {
        echo "Gagal memperbarui keluhan: " . mysqli_error($koneksi);
    }
} else {
    echo "Akses tidak valid.";
}
?>

