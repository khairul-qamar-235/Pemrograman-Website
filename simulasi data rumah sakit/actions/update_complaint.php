<?php
// Hubungkan ke database
include "config/db.php";

// Pastikan data dikirim melalui POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data dari form
    $id_kunjungan = $_POST['id_kunjungan'];
    $keluhan = $_POST['keluhan'];

    // Query update keluhan pasien
    $query = "
        UPDATE kunjungan
        SET keluhan = '$keluhan'
        WHERE id_kunjungan = '$id_kunjungan'
    ";

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil, kembali ke halaman pasien
        header("Location: patient.php");
        exit;
    } else {
        echo "Gagal memperbarui keluhan: " . mysqli_error($koneksi);
    }
} else {
    echo "Akses tidak valid.";
}
?>
