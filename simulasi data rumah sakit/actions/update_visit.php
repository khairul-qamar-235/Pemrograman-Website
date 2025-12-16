<?php
include "config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_kunjungan = $_POST['id_kunjungan'];
    $diagnosis = $_POST['diagnosis'];
    $catatan = $_POST['catatan'];
    $tanggal_kontrol_selanjutnya = $_POST['tanggal_kontrol_selanjutnya'];

    $query = "
        UPDATE kunjungan
        SET diagnosis = '$diagnosis',
            catatan = '$catatan',
            tanggal_kontrol_selanjutnya = '$tanggal_kontrol_selanjutnya'
        WHERE id_kunjungan = '$id_kunjungan'
    ";

    if (mysqli_query($koneksi, $query)) {
        header("Location: doctor.php");
        exit;
    } else {
        echo "Gagal memperbarui kunjungan: " . mysqli_error($koneksi);
    }
} else {
    echo "Akses tidak valid.";
}
?>
