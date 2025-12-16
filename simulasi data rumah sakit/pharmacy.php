<?php
include "config/db.php";
$id_pasien = '001';

$query = "
SELECT
    p.id_pasien,
    p.nama AS nama_pasien,
    p.tgl_lahir,
    p.jenis_kelamin,
    p.alergi,

    k.id_kunjungan,
    k.diagnosis,

    r.id_resep,
    r.dosis,
    r.instruksi,
    r.status AS status_obat,

    o.id_obat,
    o.nama_obat,
    o.deskripsi AS deskripsi_obat

FROM pasien p
JOIN kunjungan k ON p.id_pasien = k.id_pasien
LEFT JOIN resep r ON k.id_kunjungan = r.id_kunjungan
LEFT JOIN obat o ON r.id_obat = o.id_obat
WHERE p.id_pasien = '$id_pasien'
";

$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Farmasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #e9f7fe; 
        }
        .card-header i {
            margin-right: 8px;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .divider {
            height: 2px;
            background: linear-gradient(to right, #0d6efd, #0dcaf0);
            margin: 10px 0 15px 0;
            border-radius: 2px;
        }
    </style>
</head>

<body>

<div class="container mt-4 mb-5">

    <div class="card mb-3">
        <div class="card-header bg-danger text-white text-center">
            <h3><i class="bi bi-bag-heart-fill"></i>Halaman Farmasi</h3>
        </div>
        <div class="card-body p-3">
            <div class="row text-center text-md-start">
                <div class="col-md-3"><strong>Nama Pasien:</strong> <?= $data['nama_pasien']; ?></div>
                <div class="col-md-3"><strong>Tanggal Lahir:</strong> <?= $data['tgl_lahir']; ?></div>
                <div class="col-md-3"><strong>Jenis Kelamin:</strong> <?= $data['jenis_kelamin']; ?></div>
                <div class="col-md-3"><strong>Alergi:</strong> <?= $data['alergi']; ?></div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-clipboard-data"></i> Diagnosis & Resep
        </div>
        <div class="card-body p-3">
            <p class="mb-1"><strong>Diagnosis:</strong></p>
            <div class="border rounded p-2 bg-light mb-3 shadow-sm">
                <?= $data['diagnosis']; ?>
            </div>

            <form action="med_status.php" method="post" class="mb-2">
                <input type="hidden" name="id_resep" value="<?= $data['id_resep']; ?>">
                <div class="mb-2">
                    <label class="form-label"><strong>Status Obat</strong></label>
                    <select name="status" class="form-select">
                        <option value="Belum diberikan" <?= $data['status_obat'] == 'Belum diberikan' ? 'selected' : ''; ?>>Belum diberikan</option>
                        <option value="Sudah diberikan" <?= $data['status_obat'] == 'Sudah diberikan' ? 'selected' : ''; ?>>Sudah diberikan</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success btn-sm">
                    <i class="bi bi-arrow-repeat"></i> Perbarui Status Obat
                </button>
            </form>
        </div>
    </div>
  
    <div class="card mb-3">
        <div class="card-header bg-info text-white">
            <i class="bi bi-capsule"></i> Data Obat
        </div>
        <div class="card-body p-3">
            <form action="update_prescription_status.php" method="post">
                <input type="hidden" name="id_obat" value="<?= $data['id_obat']; ?>">

                <div class="mb-2">
                    <label class="form-label"><strong>Nama Obat</strong></label>
                    <input type="text" name="nama_obat" class="form-control form-control-sm" value="<?= $data['nama_obat']; ?>">
                </div>

                <div class="mb-2">
                    <label class="form-label"><strong>Deskripsi Obat</strong></label>
                    <textarea name="deskripsi" class="form-control form-control-sm" rows="2"><?= $data['deskripsi_obat']; ?></textarea>
                </div>

                <button type="submit" class="btn btn-info btn-sm text-white">
                    <i class="bi bi-save"></i> Simpan Perubahan Obat
                </button>
            </form>
        </div>
    </div>
    <div class="text-center mt-3">
        <a href="menu.php" class="btn btn-secondary btn-sm"><i class="bi bi-arrow-left-circle"></i> Kembali ke Menu</a>
    </div>

</div>

</body>
</html>
