<?php
require_once '../config/db.php';
if (isset($_POST['id_kunjungan'], $_POST['diagnosis'], $_POST['catatan'], $_POST['tanggal_kontrol_selanjutnya'])) {

    $id_kunjungan = $_POST['id_kunjungan'];
    $diagnosis = $_POST['diagnosis'];
    $catatan = $_POST['catatan'];
    $tanggal_kontrol_selanjutnya = $_POST['tanggal_kontrol_selanjutnya'];

    $sql = "UPDATE kunjungan 
            SET diagnosis = ?, catatan = ?, tanggal_kontrol_selanjutnya = ? 
            WHERE id_kunjungan = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $diagnosis, $catatan, $tanggal_kontrol_selanjutnya, $id_kunjungan);

    if ($stmt->execute()) {
        header("Location: ../doctor.php?success=update");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

} else {
    echo "Data tidak lengkap!";
}
?>
