<?php
include "config/db.php";

$id_pasien = '001';

$query = "
SELECT
    p.id_pasien,
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

    r.id_resep,
    r.dosis,
    r.instruksi

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
    <title>Halaman Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-info bg-opacity-10">

<div class="container mt-5 mb-5">

    <div class="card mb-4">
        <div class="card-header bg-success text-white text-center">
            <h3 class="mb-0">Halaman Dokter</h3>
        </div>
        <div class="card-body text-center">
            <p class="mb-1"><strong>Dokter:</strong> <?= $data['nama_dokter']; ?></p>
            <p class="text-muted"><?= $data['spesialisasi']; ?></p>
        </div>
    </div>


    <div class="row">

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Data Pasien
                </div>
                <div class="card-body">
                    <p><strong>Nama:</strong> <?= $data['nama_pasien']; ?></p>
                    <p><strong>Tanggal Lahir:</strong> <?= $data['tgl_lahir']; ?></p>
                    <p><strong>Jenis Kelamin:</strong> <?= $data['jenis_kelamin']; ?></p>
                    <p><strong>Tinggi / Berat:</strong> <?= $data['tinggi_badan']; ?> cm / <?= $data['berat_badan']; ?> kg</p>
                    <p><strong>Alergi:</strong> <?= $data['alergi']; ?></p>
                </div>
            </div>
        </div>

 
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-warning">
                    Pemeriksaan & Diagnosis
                </div>
                <div class="card-body">
                    <p><strong>Keluhan Pasien:</strong></p>
                    <div class="border rounded p-3 bg-light mb-3">
                        <?= $data['keluhan']; ?>
                    </div>

                    <form action="update_medical_record.php" method="post">
                        <input type="hidden" name="id_kunjungan" value="<?= $data['id_kunjungan']; ?>">

                        <div class="mb-3">
                            <label class="form-label"><strong>Diagnosis</strong></label>
                            <textarea name="diagnosis" class="form-control mb-3" rows="3"><?= $data['diagnosis']; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Catatan Dokter</strong></label>
                            <textarea name="catatan" class="form-control mb-3" rows="3"><?= $data['catatan']; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Tanggal Kontrol Selanjutnya</strong></label>
                            <input type="date" name="tanggal_kontrol_selanjutnya" class="form-control mb-3"
                                   value="<?= $data['tanggal_kontrol_selanjutnya']; ?>">
                        </div>

                        <button type="submit" class="btn btn-warning">Simpan Pemeriksaan</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

 
    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            Resep Obat
        </div>
        <div class="card-body">
            <form action="update_prescription.php" method="post">
                <input type="hidden" name="id_kunjungan" value="<?= $data['id_kunjungan']; ?>">

                <div class="mb-3">
                    <label class="form-label"><strong>Dosis</strong></label>
                    <input type="text" name="dosis" class="form-control" value="<?= $data['dosis']; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label"><strong>Instruksi Pemakaian</strong></label>
                    <textarea name="instruksi" class="form-control" rows="2"><?= $data['instruksi']; ?></textarea>
                </div>

                <button type="submit" class="btn btn-info text-white">Simpan Resep</button>
            </form>
        </div>
    </div>

    <div class="text-center">
        <a href="menu.php" class="btn btn-secondary">Kembali ke Menu</a>
    </div>

</div>

</body>
</html>
