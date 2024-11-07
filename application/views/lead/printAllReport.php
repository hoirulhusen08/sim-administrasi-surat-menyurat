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
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }
    </style>
</head>
<title>Laporan <?= htmlspecialchars($results[0]['jenis_surat']) ?></title>
<body>
    <div class="logo-kop">
        <img class="logo" src="<?= base_url('assets/img/setting/') . $setting['logo']; ?>">
    </div>
    <div class="kop-surat">
        <div class="container-kop">
            <h2 class="institution_name"><?= $setting['institution_name']; ?></h2>
            <h3 class="faculty_name"><?= $setting['faculty_name']; ?></h3>
            <h4 class="prodi_name"><?= $setting['prodi_name']; ?></h4>
            <p class="address m-0"><?= $setting['address']; ?></p>
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
        <h1>Laporan <?= htmlspecialchars($results[0]['jenis_surat']) ?></h1>
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
                    <?php if($results[0]['jenis_surat'] == "Surat Masuk") : ?>
                        Penerima
                    <?php else : ?>
                        Tujuan
                    <?php endif; ?>
                </th>
                <th>Perihal</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($results)) : ?>
                <?php foreach ($results as $index => $result): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
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
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Tidak ada data untuk ditampilkan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
