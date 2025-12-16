<?php
include "config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_resep = $_POST['id_resep'];
    $status = $_POST['status'];

    $query = "
        UPDATE resep
        SET status = '$status'
        WHERE id_resep = '$id_resep'
    ";

    if (mysqli_query($koneksi, $query)) {
        header("Location: pharmacy.php");
        exit;
    } else {
        echo "Gagal memperbarui status obat: " . mysqli_error($koneksi);
    }

} else {
    echo "Akses tidak valid.";
}
?>


