<?php
include "config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_obat = $_POST['id_obat'];
    $nama_obat = $_POST['nama_obat'];
    $deskripsi = $_POST['deskripsi'];

    $query = "
        UPDATE obat
        SET nama_obat = '$nama_obat',
            deskripsi = '$deskripsi'
        WHERE id_obat = '$id_obat'
    ";

    if (mysqli_query($koneksi, $query)) {
        header("Location: pharmacy.php");
        exit;
    } else {
        echo "Gagal memperbarui data obat: " . mysqli_error($koneksi);
    }

} else {
    echo "Akses tidak valid.";
}
?>


