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
        text-align: left;
        margin-bottom: 30px;
    }

    .isi-konten p {
        line-height: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
    }
    td {
        vertical-align: top;
        padding: 0;
        margin:0;
    }
    .label {
        text-align: left;
        font-weight: bold;
        width:10px;
    }
    .colon {
        text-align: center;
        width:30px;
    }
    .value {
        text-align: left;
    }
    .date {
        text-align: right;
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
            <table>
                <tr>
                    <td class="label">Nomor</td>
                    <td class="colon">:</td>
                    <td class="value"><?= $surat_keluar['nomor_surat']; ?></td>
                    <!-- Tanggal Hijriyah format (tahun-bulan-tanggal) -->
                    <?php $tanggal_hijriyah = date('Y-m-d', $surat_keluar['date_created']); ?>
                    <td class="date"><u><?= Konversi_Hijriyah($tanggal_hijriyah); ?></u></td>
                    <!-- Akhit tanggal hijriyah -->
                </tr>
                <tr>
                    <td class="label">Lampiran</td>
                    <td class="colon">:</td>
                    <td class="value"><?= $surat_keluar['lampiran']; ?></td>
                    <td class="date"><?= date('d F Y', $surat_keluar['date_created']); ?> M</td>
                </tr>
                <tr>
                    <td class="label">Perihal</td>
                    <td class="colon">:</td>
                    <td class="value" colspan="2"><u><?= $surat_keluar['perihal']; ?></u></td>
                </tr>
            </table>
        </div>
        <div class="konten" style="margin-left: 70px;">
            <p class="m-0" style="margin-bottom:-5px;">Kepada Yth.</p>
            <p class="m-0" style="margin-bottom:-5px;"><?= $surat_keluar['penerima_surat']; ?></p>
            <p class="m-0" style="margin-bottom:-5px;">di -</p>
            <p class="m-0" style="margin-left: 30px;"><?= $surat_keluar['alamat_tujuan']; ?></p>
            <div class="img-bismillah" style="margin-bottom:-5px;">
                <img class="bismillah" src="<?= base_url('assets/img/setting/assalamualaikum.png'); ?>">
            </div>
            <!-- Isi -->
            <div class="isi-konten"><?= $surat_keluar['isi_surat']; ?></div>
            <!-- End Isi -->
            <div class="img-bismillah" style="margin-top:-5px;">
                <img class="bismillah" src="<?= base_url('assets/img/setting/wassalamualaikum.png'); ?>">
            </div>
        </div>
    </div>
    <!-- End Isi Surat -->

    <!-- TTD -->
    <div class="ttd-container">
        <!-- <p class="m-0"><?= $setting['alamat_ttd']; ?>, <?= date('d F Y', $surat_keluar['date_created']); ?></p> -->
        <p class="m-0">Dekan,</p>
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