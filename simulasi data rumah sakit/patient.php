<?php
include "config/db.php";

$id_pasien = '001';

$query = "
SELECT 
    p.nama AS nama_pasien,
    p.tgl_lahir,
    p.jenis_kelamin,
    p.tinggi_badan,
    p.berat_badan,
    p.alergi,

    k.id_kunjungan,
    k.tanggal_kontrol,
    k.keluhan,
    k.diagnosis,
    k.catatan,
    k.tanggal_kontrol_selanjutnya,

    d.nama AS nama_dokter,
    d.spesialisasi,

    r.dosis,
    r.instruksi,
    r.status
FROM pasien p
JOIN kunjungan k ON p.id_pasien = k.id_pasien
JOIN dokter d ON k.id_dokter = d.id_dokter
LEFT JOIN resep r ON k.id_kunjungan = r.id_kunjungan
WHERE p.id_pasien = '$id_pasien'
";

$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Pasien</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-info bg-opacity-10">

<div class="container mt-5 mb-5">

    <!-- HEADER -->
    <div class="card mb-4">
        <div class="card-header bg-danger text-white text-center">
            <h3 class="mb-0">Informasi Pasien</h3>
        </div>
        <div class="card-body text-center">
            <p class="text-muted">Sistem Informasi Rumah Sakit</p>
        </div>
    </div>

    <!-- DATA PRIBADI & KUNJUNGAN -->
    <div class="row">

        <!-- DATA PRIBADI PASIEN -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Data Pribadi Pasien
                </div>
                <div class="card-body">
                    <p><strong>Nama:</strong> <?= $data['nama_pasien']; ?></p>
                    <p><strong>Tanggal Lahir:</strong> <?= $data['tgl_lahir']; ?></p>
                    <p><strong>Jenis Kelamin:</strong> <?= $data['jenis_kelamin']; ?></p>
                    <p><strong>Tinggi Badan:</strong> <?= $data['tinggi_badan']; ?> cm</p>
                    <p><strong>Berat Badan:</strong> <?= $data['berat_badan']; ?> kg</p>
                    <p><strong>Alergi:</strong> <?= $data['alergi']; ?></p>
                </div>
            </div>
        </div>

        <!-- INFORMASI KUNJUNGAN -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Informasi Kunjungan
                </div>
                <div class="card-body">
                    <p><strong>Tanggal Kontrol:</strong> <?= $data['tanggal_kontrol']; ?></p>
                    <p><strong>Dokter:</strong> <?= $data['nama_dokter']; ?></p>
                    <p><strong>Spesialisasi:</strong> <?= $data['spesialisasi']; ?></p>
                    <p><strong>Diagnosis:</strong> <?= $data['diagnosis']; ?></p>
                    <p><strong>Catatan Dokter:</strong> <?= $data['catatan']; ?></p>
                    <p><strong>Kontrol Selanjutnya:</strong> <?= $data['tanggal_kontrol_selanjutnya']; ?></p>
                </div>
            </div>
        </div>

    </div>

    <!-- INFORMASI RESEP -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            Informasi Resep Obat
        </div>
        <div class="card-body">
            <p><strong>Dosis:</strong> <?= $data['dosis']; ?></p>
            <p><strong>Instruksi:</strong> <?= $data['instruksi']; ?></p>
            <p><strong>Status Resep:</strong> <?= $data['status']; ?></p>
        </div>
    </div>

    <!-- KELUHAN PASIEN -->
    <div class="card mb-4">
        <div class="card-header bg-warning">
            Keluhan Pasien
        </div>
        <div class="card-body">
            <form action="update_keluhan.php" method="post">
                <input type="hidden" name="id_kunjungan" value="<?= $data['id_kunjungan']; ?>">

                <div class="mb-3">
                    <textarea class="form-control" name="keluhan" rows="4"><?= $data['keluhan']; ?></textarea>
                </div>

                <button type="submit" class="btn btn-warning">
                    Simpan Perubahan Keluhan
                </button>
            </form>
        </div>
    </div>

</div>

</body>
</html>
