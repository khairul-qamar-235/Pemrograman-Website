<?php
include "config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_resep = $_POST['id_resep'];
    $status = $_POST['status'];
    $jadwal_pemberian = isset($_POST['jadwal_pemberian']) ? $_POST['jadwal_pemberian'] : null;
    $deskripsi = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : null;

    $query = "
        UPDATE resep
        SET status = '$status',
            " . ($jadwal_pemberian !== null ? "instruksi = '$jadwal_pemberian'," : "") . "
            " . ($deskripsi !== null ? "instruksi = '$deskripsi'" : "") . "
        WHERE id_resep = '$id_resep'
    ";

    // Bersihkan koma berlebih jika hanya satu field yang diupdate
    $query = preg_replace('/,\s+WHERE/', ' WHERE', $query);

    if (mysqli_query($koneksi, $query)) {
        header("Location: pharmacy.php");
        exit;
    } else {
        echo "Gagal memperbarui resep: " . mysqli_error($koneksi);
    }
} else {
    echo "Akses tidak valid.";
}
?>

