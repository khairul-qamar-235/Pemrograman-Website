

CREATE DATABASE IF NOT EXISTS sistem_rumah_sakit;
USE sistem_rumah_sakit;

CREATE TABLE pasien (
    id_pasien INT PRIMARY KEY,
    nama VARCHAR(100),
    tgl_lahir DATE,
    jenis_kelamin VARCHAR(20),
    tinggi_badan INT,
    berat_badan INT,
    alergi VARCHAR(100)
);

INSERT INTO pasien VALUES
(1, 'Budi', '1997-09-17', 'Laki-laki', 168, 65, 'Tidak ada');

CREATE TABLE dokter (
    id_dokter INT PRIMARY KEY,
    nama VARCHAR(100),
    spesialisasi VARCHAR(150),
    no_handphone VARCHAR(20)
);

INSERT INTO dokter VALUES
(26001, 'Hamzah', 'Penyakit jantung dan pembuluh darah', '088855500001');


CREATE TABLE penyakit (
    id_penyakit INT PRIMARY KEY,
    nama_penyakit VARCHAR(100),
    deskripsi TEXT
);

INSERT INTO penyakit VALUES
(45001, 'Aterosklerosis', 'Pengerasan dan penyempitan pembuluh darah arteri');

CREATE TABLE kunjungan (
    id_kunjungan INT PRIMARY KEY,
    id_pasien INT,
    id_dokter INT,
    tanggal_kontrol DATE,
    keluhan TEXT,
    diagnosis TEXT,
    catatan TEXT,
    tanggal_kontrol_selanjutnya DATE,
    FOREIGN KEY (id_pasien) REFERENCES pasien(id_pasien),
    FOREIGN KEY (id_dokter) REFERENCES dokter(id_dokter)
);

INSERT INTO kunjungan VALUES
(
    11001,
    1,
    26001,
    '2025-12-21',
    'Napas terasa sesak dan cepat merasa letih',
    'Penyumbatan pembuluh darah arteri pada jantung',
    'Pasien merupakan pekerja bangunan dan kerap tidak memberikan waktu untuk tubuh beristirahat',
    '2026-01-21'
);

CREATE TABLE obat (
    id_obat INT PRIMARY KEY,
    nama_obat VARCHAR(100),
    deskripsi TEXT
);

INSERT INTO obat VALUES
(901, 'Obat A', 'Menangani gejala A'),
(902, 'Obat B', 'Memperbaiki kondisi B'),
(903, 'Obat C', 'Membantu fungsi tubuh C'),
(904, 'Obat D', 'Menjaga kestabilan kondisi pasien');

CREATE TABLE resep (
    id_resep INT PRIMARY KEY,
    id_kunjungan INT,
    id_obat INT,
    dosis VARCHAR(100),
    instruksi TEXT,
    status VARCHAR(50),
    FOREIGN KEY (id_kunjungan) REFERENCES kunjungan(id_kunjungan),
    FOREIGN KEY (id_obat) REFERENCES obat(id_obat)
);

INSERT INTO resep VALUES
(501, 11001, 901, '1 tablet setiap 8 jam', 'Diminum setelah makan', 'Sudah diberikan');
