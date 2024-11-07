<?php
date_default_timezone_set($_ENV['DEFAULT_TIMEZONE']); // Mengatur zona waktu ke Jakarta
?>

<style>
    *, p, a, td, tr, table {
        font-family: "Times New Roman", Times, serif !important;
    }
    body {
        font-family: "Times New Roman", Times, serif;
        font-size: 14px;
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

    .faculty_name {
        letter-spacing: 1.4px;
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

    /* Isi Surat */
    .isi-surat {
        margin-top: 15px;
        text-align: justify;
    }

    .isi-surat .judul {
        text-align: center;
    }

    .isi-surat .judul .tentang {
        text-transform: uppercase;
        font-weight: bold;
        font-size: 1.8rem;
        text-decoration: underline;
    }

    .konten p {
        line-height: 25px;
    }

    .img-bismillah {
        text-align: center;
        margin-top: 20px;
        margin-bottom: 10px;
    }

    .bismillah {
        width: 200px;
    }

    .isi-surat .konten table {
        width: 100%;
    }

    .isi-surat .konten table th,
    .isi-surat .konten table td {
        padding: 5px 0;
    }

    /* End Isi Surat */

    /* TTD */
    .ttd-container {
        margin-top: 20px;
        width: 40%;
        text-align: left;
        float: right;
    }

    .ttd-image {
        margin: 5px 0;
    }

    .ttd {
        width: 200px;
        /* border: 1px solid #333; */
    }

    .clear-float {
        clear: right;
    }

    /* Catatan Kaki */
    .catatan-kaki {
        margin-top: 20px;
        font-size: 11px;
    }

    .container-stampleCap {
        position: absolute;
        bottom: 0;
        right: 0;
        z-index: 1;
    }

    .stampleCap {
        width: 150px;
        opacity: .4;
        transform: rotate(-50deg);
    }
</style>

<!DOCTYPE html>
<html>

<head>
    <title>Surat Keluar</title>
</head>

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

    <!-- Isi Surat -->
    <div class="isi-surat">
        <div class="judul">
            <p class="tentang m-0"><?= $surat_keluar['tentang_surat']; ?></p>
            <p class="no-surat m-0">Nomor: <?= $surat_keluar['nomor_surat']; ?></p>
        </div>
        <div class="konten">
            <div class="img-bismillah">
                <img class="bismillah" src="<?= base_url('assets/img/setting/bismillah.png'); ?>">
            </div>
            <p class="isi-konten"><?= $surat_keluar['isi_surat']; ?></p>
        </div>
    </div>
    <!-- End Isi Surat -->

    <!-- TTD -->
    <div class="ttd-container">
        <!-- Tanggal Hijriyah format (tahun-bulan-tanggal) -->
        <?php $tanggal_hijriyah = date('Y-m-d', $surat_keluar['date_created']); ?>
        <p class="m-0"><?= $setting['alamat_ttd']; ?>, &nbsp; <u><?= Konversi_Hijriyah($tanggal_hijriyah); ?></u></p>
        <!-- Akhit tanggal hijriyah -->
        <p class="m-0" style="margin-left: 77px;"><?= date('d F Y', $surat_keluar['date_created']); ?> M</p>
        <p class="m-0" style="margin-left: 77px;">Dekan,</p>
        <div class="ttd-image">
            <img class="ttd" src="<?= base_url('assets/img/setting/') . $setting['ttd_image']; ?>">
        </div>
        <p class="m-0"><strong><u><?= $setting['lead_name']; ?></u></strong></p>
        <p class="m-0">NBM : <?= $setting['nktam']; ?></p>
    </div>
    <!-- End TTD -->

    <div class="clear-float"></div>

    <!-- Catatan Kaki -->
    <div class="catatan-kaki">
        <?= $surat_keluar['catatan_kaki']; ?>
    </div>
    <!-- End Catatan Kaki -->

    <!-- CAP Stampel -->
    <!-- <div class="container-stampleCap">
        <img class="stampleCap" src="<?= base_url('assets/img/setting/default-stample.png'); ?>">
    </div> -->

</body>

</html>