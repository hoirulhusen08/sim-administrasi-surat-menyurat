<?php
date_default_timezone_set($_ENV['DEFAULT_TIMEZONE']); // Mengatur zona waktu ke Jakarta
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        a {
            text-decoration: none;
        }
        hr {
            margin: 0;
        }
        .m-0 {
            margin: 0;
        }
        .kop-surat {
            text-align: center;
        }
        .container-kop {
            margin-top: 0;
            margin-bottom: 0;
            margin-left: 100px;
            margin-right: 0;
        }
        .institution_name,
        .faculty_name {
            font-family: Arial, Helvetica, sans-serif;
            text-transform: uppercase;
            margin: 0;
            font-size: 1.8rem;
            color: #254dc2;
            font-weight: bold;
        }
        .prodi_name {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1.5rem;
            margin: 0;
            color: #254dc2;
        }
        .address {
            font-size: 12px !important;
        }
        .logo-kop {
            position: absolute;
            top: 15px;
            left: 35px;
        }
        .logo {
            width: 100px;
        }
        .hr1-kop {
            height: 5px;
            border: none;
            color: #193ea8;
            margin: 0;
            margin-top: 6px;
        }
        .hr2-kop {
            height: 2px;
            border: none;
            color: #193ea8;
            margin: 0;
            margin-top: 2px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow untuk efek kedalaman */
            background-color: #fff; /* Latar belakang tabel putih */
        }
        th, td {
            border: 1px solid #ddd; /* Border yang lebih lembut */
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007bff; /* Warna latar belakang header tabel */
            color: #fff; /* Warna teks header tabel */
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9; /* Warna latar belakang baris genap */
        }
        tr:hover {
            background-color: #f1f1f1; /* Warna latar belakang saat hover */
        }
        .bg-secondary {
            background-color: #eaeaea;
        }
        .title {
            text-align: center;
            margin-top: 20px;
        }
        .title h1 {
            font-size: 24px;
            color: #333;
            margin: 0;
        }
        .date-info {
            text-align: center;
            margin-top: -15px;
            font-style: italic;
            color: #555;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }
        .details-table th, .details-table td {
            border: 1px solid #ddd;
            padding: 10px;
        }
        .details-table th {
            background-color: #007bff;
            color: #fff;
            text-align: left;
        }
        .details-table td {
            text-align: left;
        }

        /* Badge Label */
        .badge {
            display: inline-block;
            padding: 0.5em 1em;
            font-size: 0.875em;
            font-weight: 700;
            text-align: center;
            border-radius: 0.25em;
            color: #fff;
        }
        .badge-secondary {
            background-color: #6c757d;
        }
        .badge-danger {
            background-color: #dc3545;
        }
        .badge-info {
            background-color: #17a2b8;
        }
        .badge-success {
            background-color: #28a745;
        }
        .badge i {
            margin-left: 0.5em;
        }

        .text-muted {
            color: #6c757d; /* Warna abu-abu pudar yang mirip dengan Bootstrap */
        }
    </style>
    
<title>Detail Laporan <?= htmlspecialchars($result['jenis_surat']) ?></title>
</head>
<body>
    <div class="logo-kop">
        <img class="logo" src="<?= base_url('assets/img/setting/') . htmlspecialchars($setting['logo']); ?>" alt="Logo">
    </div>
    <div class="kop-surat">
        <div class="container-kop">
            <h2 class="institution_name"><?= htmlspecialchars($setting['institution_name']); ?></h2>
            <h3 class="faculty_name"><?= htmlspecialchars($setting['faculty_name']); ?></h3>
            <h4 class="prodi_name"><?= htmlspecialchars($setting['prodi_name']); ?></h4>
            <p class="address m-0"><?= htmlspecialchars($setting['address']); ?></p>
            <p class="address m-0">
                <span>Telp/Fax: <a href="#"><?= $setting['telp_or_fax']; ?></a></span> |
                <span>E-mail: <a href="mailto:<?= $setting['email']; ?>"><?= $setting['email']; ?></a></span> |
                <span>Laman: <a href="<?= $setting['web']; ?>"><?= $setting['web']; ?></a></span>
            </p>
        </div>
        <hr class="hr1-kop">
        <hr class="hr2-kop">
    </div>
    
    <div class="title">
        <h1>Detail Laporan <?= htmlspecialchars($result['jenis_surat']) ?></h1>
    </div>
    <div class="date-info">
        <p>Dicetak Pada: <?= date('d F Y g:i:s A') ?></p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Jenis Surat</th>
                <th>No. Surat</th>
                <th>Tgl. Dibuat</th>
                <th>
                    <?php if($result['jenis_surat'] == "Surat Masuk") : ?>
                        Penerima
                    <?php else : ?>
                        Tujuan
                    <?php endif; ?>
                </th>
                <th>Perihal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><?= htmlspecialchars($result['jenis_surat']) ?></td>
                <td><?= htmlspecialchars($result['nomor_surat']) ?></td>
                <td><?= date('d F Y', $result['date_created']) ?></td>
                <?php if($result['jenis_surat'] == 'Surat Keluar') : ?>
                    <td><?= htmlspecialchars($result['alamat_tujuan']) ?></td>
                <?php else : ?>
                    <td><?= htmlspecialchars($result['penerima_surat']) ?></td>
                <?php endif; ?>
                <td><?= htmlspecialchars($result['perihal']) ?></td>
            </tr>
        </tbody>
    </table>

    <!-- Tambahkan Detail Atribut -->
    <div class="title">
        <h2>Detail Lainnya</h2>
    </div>
    <table class="details-table">
        <thead>
            <tr>
                <th>Atribut</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result['jenis_surat'] == 'Surat Masuk') : ?>
                <tr><td class="bg-secondary">Sifat</td><td><?= htmlspecialchars($result['nama_klasifikasi']) ?></td></tr>
                <tr><td class="bg-secondary">Tanggal Surat</td><td><?= htmlspecialchars($result['tanggal_surat']) ?></td></tr>
                <tr><td class="bg-secondary">Sumber Surat</td><td><?= htmlspecialchars($result['sumber_surat']) ?></td></tr>
                <tr><td class="bg-secondary">Lampiran</td><td><?= htmlspecialchars($result['lampiran']) ?></td></tr>
                <tr>
                    <td class="bg-secondary">Status</td>
                    <td>
                        <!-- Status Surat -->
                        <?php if ($result['status'] == 0) : ?>
                            <span class="badge badge-secondary">Diajukan</span>
                        <?php elseif ($result['status'] == 1) : ?>
                            <span class="badge badge-danger"><i class="bi bi-pencil-square"></i> Revisi</span>
                        <?php elseif ($result['status'] == 2) : ?>
                            <span class="badge badge-info">Dilanjutkan <i class="bi bi-arrow-right-circle-fill"></i></span>
                        <?php elseif ($result['status'] == 3) : ?>
                            <span class="badge badge-success">Menunggu TTD</span>
                        <?php elseif ($result['status'] == 4) : ?>
                            <span class="badge badge-success">Disetujui <i class="bi bi-check2-all"></i></span>
                        <?php elseif ($result['status'] == 5) : ?>
                            <span class="badge badge-success">Terdisposisi <i class="bi bi-check2-all"></i></span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-secondary">Tindak Lanjut</td>
                    <td>
                        <?php if(!empty($result['tindak_lanjut'])) : ?>
                            <?= htmlspecialchars($result['tindak_lanjut']) ?>
                        <?php else : ?>
                            <small class="text-muted">Tindak Lanjut tidak diberikan...</small>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-secondary">Catatan</td>
                    <td>
                        <?php if(!empty($result['catatan'])) : ?>
                            <?= htmlspecialchars($result['catatan']) ?>
                        <?php else : ?>
                            <small class="text-muted">Catatan tidak diberikan...</small>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-secondary">TTD</td>
                    <td>
                        <?php if ($result['ttd'] == 1) : ?>
                            <span class="badge badge-success">ACC Tanda Tangan</span>
                        <?php else : ?>
                            <span class="badge badge-secondary">Belum ACC Tanda Tangan <i class="bi bi-check2-all"></i></span>
                        <?php endif; ?>
                    </td>
                </tr>
                <!-- <tr><td class="bg-secondary">Isi Surat</td><td><?= htmlspecialchars($result['isi_surat']) ?></td></tr> -->
            <?php elseif ($result['jenis_surat'] == 'Surat Keluar') : ?>
                <?php if(!empty($result['nama_klasifikasi'])) : ?>
                <tr><td class="bg-secondary">Sifat</td><td><?= htmlspecialchars($result['nama_klasifikasi']) ?></td></tr>
                <?php endif; ?>

                <?php if(!empty($result['tentang_surat'])) : ?>
                <tr><td class="bg-secondary">Tentang Surat</td><td><?= htmlspecialchars($result['tentang_surat']) ?></td></tr>
                <?php endif; ?>

                <?php if(!empty($result['nama_mahasiswa'])) : ?>
                <tr><td class="bg-secondary">Nama Mahasiswa</td><td><?= htmlspecialchars($result['nama_mahasiswa']) ?></td></tr>
                <?php endif; ?>

                <?php if(!empty($result['npm'])) : ?>
                <tr><td class="bg-secondary">NPM</td><td><?= htmlspecialchars($result['npm']) ?></td></tr>
                <?php endif; ?>

                <?php if(!empty($result['semester'])) : ?>
                <tr><td class="bg-secondary">Semester</td><td><?= htmlspecialchars($result['semester']) ?></td></tr>
                <?php endif; ?>

                <?php if(!empty($result['tahun_akademik'])) : ?>
                <tr><td class="bg-secondary">Tahun Akademik</td><td><?= htmlspecialchars($result['tahun_akademik']) ?></td></tr>
                <?php endif; ?>

                <?php if($result['tgl_pelaksanaan'] !== '0000-00-00') : ?>
                <tr><td class="bg-secondary">Tgl. Pelaksanaan</td><td><?= htmlspecialchars($result['tgl_pelaksanaan']) ?></td></tr>
                <?php endif; ?>

                <?php if(!empty($result['lampiran'])) : ?>
                <tr><td class="bg-secondary">Lampiran</td><td><?= htmlspecialchars($result['lampiran']) ?></td></tr>
                <?php endif; ?>

                <tr>
                    <td class="bg-secondary">Status</td>
                    <td>
                        <!-- Status Surat -->
                        <?php if ($result['status'] == 0) : ?>
                            <span class="badge badge-secondary">Diajukan</span>
                        <?php elseif ($result['status'] == 1) : ?>
                            <span class="badge badge-danger"><i class="bi bi-pencil-square"></i> Revisi</span>
                        <?php elseif ($result['status'] == 2) : ?>
                            <span class="badge badge-info">Dilanjutkan <i class="bi bi-arrow-right-circle-fill"></i></span>
                        <?php elseif ($result['status'] == 3) : ?>
                            <span class="badge badge-success">Menunggu TTD</span>
                        <?php elseif ($result['status'] == 4) : ?>
                            <span class="badge badge-success">Disetujui <i class="bi bi-check2-all"></i></span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-secondary">Tindak Lanjut</td>
                    <td>
                        <?php if(!empty($result['tindak_lanjut'])) : ?>
                            <?= htmlspecialchars($result['tindak_lanjut']) ?>
                        <?php else : ?>
                            <small class="text-muted">Tindak Lanjut tidak diberikan...</small>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-secondary">Catatan</td>
                    <td>
                        <?php if(!empty($result['catatan'])) : ?>
                            <?= htmlspecialchars($result['catatan']) ?>
                        <?php else : ?>
                            <small class="text-muted">Catatan tidak diberikan...</small>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td class="bg-secondary">TTD</td>
                    <td>
                        <?php if ($result['ttd'] == 1) : ?>
                            <span class="badge badge-success">ACC Tanda Tangan</span>
                        <?php else : ?>
                            <span class="badge badge-secondary">Belum ACC Tanda Tangan <i class="bi bi-check2-all"></i></span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
