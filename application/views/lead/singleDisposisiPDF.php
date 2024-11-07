<?php
date_default_timezone_set($_ENV['DEFAULT_TIMEZONE']); // Mengatur zona waktu ke Jakarta
?>

<style>
    body {
        font-family: "Times New Roman", Times, serif;
        font-size: 14px;
    }

    a {
        text-decoration: none;
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

    .logo-kop {
        position: absolute;
        top: 15px;
        left: 35px;
    }

    .logo {
        width: 100px;
    }

    .address {
        font-size: 12px;
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

    .disposisi-surat .judul {
        text-align: center;
        margin-top: 10px;
    }

    .disposisi-surat .judul h2 {
        text-transform: uppercase;
        text-decoration: underline;
    }

    /* Tabel 1 */
    table.greyGridTable td.field {
        background: #EBEBEB;
        width: 20%;
    }

    table.greyGridTable td.colon {
        width: 3%;
        text-align: center;
    }

    table.greyGridTable td.value {
        width: 25%;
    }

    table.greyGridTable {
        border: 2px solid #fff;
        width: 100%;
        border-collapse: collapse;
    }

    table.greyGridTable td,
    table.greyGridTable th {
        border: 2px solid #fff;
        padding: 3px 4px;
    }

    /* Tebel 2 */
    table.minimalistBlack {
        width: 100%;
        text-align: left;
        border-collapse: collapse;
    }

    table.minimalistBlack td,
    table.minimalistBlack th {
        border: 1px solid #EBEBEB;
        padding: 5px 4px;
    }

    /* End Tabel */

    /* TTD */
    .ttd-container {
        position: relative;
        margin-top: 50px;
        width: 40%;
        text-align: left;
        float: right;
        z-index: 5;
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
        margin-top: 50px;
    }

    .container-stampleCap {
        position: absolute;
        bottom: 260px;
        right: 250px;
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
    <title>Surat Disposisi</title>
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

    <div class="disposisi-surat">
        <div class="judul">
            <h2 class="m-0">Lembar Disposisi</h2>
            <p class="m-0">Kode: <?= $disposisi_surat['kode_disposisi']; ?></p>
            <p>PERHATIAN : Dilarang memisahkan sehelai surat pun yang digabung dalam berkas ini.</p>
        </div>
        <div class="isi">
            <table class="greyGridTable">
                <tbody>
                    <tr>
                        <td class="field">Nomor Surat</td>
                        <td class="colon">:</td>
                        <td class="value"><?= $disposisi_surat['nomor_surat']; ?></td>
                        <td class="field">Status Surat</td>
                        <td class="colon">:</td>
                        <td class="value">ACC</td>
                    </tr>
                    <tr>
                        <td class="field">Tanggal Surat</td>
                        <td class="colon">:</td>
                        <td class="value"><?= $disposisi_surat['tanggal_surat']; ?></td>
                        <td class="field">Sifat Surat</td>
                        <td class="colon">:</td>
                        <td class="value"><?= $disposisi_surat['nama']; ?></td>
                    </tr>
                    <tr>
                        <td class="field">Sumber Surat</td>
                        <td class="colon">:</td>
                        <td class="value"><?= $disposisi_surat['sumber_surat']; ?></td>
                        <td class="field">Batas Waktu</td>
                        <td class="colon">:</td>
                        <td class="value"><?= $disposisi_surat['batas_waktu']; ?></td>
                    </tr>
                    <tr>
                        <td class="field">Perihal</td>
                        <td class="colon">:</td>
                        <td class="value"><?= $disposisi_surat['perihal']; ?></td>
                        <td class="field">&nbsp;</td>
                        <td class="colon">&nbsp;</td>
                        <td class="value">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="field">Penerima Surat</td>
                        <td class="colon">:</td>
                        <td class="value"><?= $disposisi_surat['penerima_surat']; ?></td>
                        <td class="field">&nbsp;</td>
                        <td class="colon">&nbsp;</td>
                        <td class="value">&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="field">Diteruskan Kepada</td>
                        <td class="colon">:</td>
                        <td class="value"><?= $disposisi_surat['tujuan']; ?></td>
                        <td class="field">&nbsp;</td>
                        <td class="colon">&nbsp;</td>
                        <td class="value">&nbsp;</td>
                    </tr>
                </tbody>
            </table>

            <table class="minimalistBlack" style="margin-top: 30px;">
                <tbody>
                    <tr>
                        <td style="width: 48%;text-align:center;"><strong>Disposisi kepada Departemen</strong></td>
                        <td style="width: 48%;text-align:center;"><strong>Petunjuk / Tindak Lanjut</strong></td>
                    </tr>
                    <tr>
                        <td style="width: 48%;height:100px;text-align:center;"><?= $disposisi_surat['departemen']; ?></td>
                        <td style="width: 48%;text-align:center;"><?= $disposisi_surat['tindakan']; ?></td>
                    </tr>
                </tbody>
            </table>

            <table style="width:100%;border: 1px solid #EBEBEB;padding:10px;">
                <tbody>
                    <tr>
                        <td style="width: 10%;">Catatan</td>
                        <td style="width: 4%;text-align:center">:</td>
                        <td><?= $disposisi_surat['disposisi_catatan']; ?></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>

    <!-- TTD -->
    <div class="ttd-container">
        <!-- Tanggal Hijriyah format (tahun-bulan-tanggal) -->
        <?php $tanggal_hijriyah = date('Y-m-d', $disposisi_surat['date_created']); ?>
        <p class="m-0"><?= $setting['alamat_ttd']; ?>, &nbsp; <u><?= Konversi_Hijriyah($tanggal_hijriyah); ?></u></p>
        <!-- Akhit tanggal hijriyah -->
        <p class="m-0" style="margin-left: 77px;"><?= date('d F Y', $disposisi_surat['date_created']); ?></p>
        <p class="m-0">Dekan,</p>
        <div class="ttd-image">
            <img class="ttd" src="<?= base_url('assets/img/setting/') . $setting['ttd_image']; ?>">
        </div>
        <p class="m-0"><strong><u><?= $setting['lead_name']; ?></u></strong></p>
        <p class="m-0">NBM : <?= $setting['nktam']; ?></p>
    </div>
    <!-- End TTD -->

    <div class="clear-float"></div>

    <!-- Catatan kaki -->
    <div class="catatan-kaki">
        <p class="m-0">Catatan kaki :</p>
        <hr class="m-0">
        <small class="m-0">* Lembar disposisi ini dicetak otomatis oleh komputer dan telah disetujui secara digital.</small>
    </div>
    <!-- End Catatan kaki -->

    <!-- Cap or Stample -->
    <!-- <div class="container-stampleCap">
        <img class="stampleCap" src="<?= base_url('assets/img/setting/default-stample.png'); ?>">
    </div> -->

</body>

</html>