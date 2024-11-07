<?php

// Fungsi nama-nama bulan Hijriyah
function bln_hijriyah($i)
{
    $bln = ["Muharam", "Shafar", "Rabi'ul Awal", "Rabi'ul Akhir", "Jumadil Awal", "Jumadil Akhir", "Rajab", "Sya'ban", "Ramadhan", "Syawwal", "Dzulqaidah", "Zulhijjah"];

    return isset($bln[$i - 1]) ? $bln[$i - 1] : 'Invalid Month';
}

// Fungsi Kalender Gregorian ke Hijriyah
function Gregorian_ke_Hijriyah($tgl = null)
{
    if ($tgl === null) {
        $tgl = date('m-d-Y');
    }

    // Validasi tanggal input
    if (!DateTime::createFromFormat('Y-m-d', $tgl)) {
        return 'Invalid Date Format';
    }

    $m = date('m', strtotime($tgl));
    $d = date('d', strtotime($tgl));
    $y = date('Y', strtotime($tgl));

    return Hari_Julian_ke_Hijriyah(cal_to_jd(CAL_GREGORIAN, $m, $d, $y));
}

// Fungsi Hitung Hari Julian ke Hijriyah
function Hari_Julian_ke_Hijriyah($jd)
{
    $jd     = $jd - 1948440 + 10632;
    $n      = (int)(($jd - 1) / 10631);
    $jd     = $jd - 10631 * $n + 354;
    $j      = ((int)((10985 - $jd) / 5316)) *
              ((int)(50 * $jd / 17719)) +
              ((int)($jd / 5670)) *
              ((int)(43 * $jd / 15238));
    $jd     = $jd - ((int)((30 - $j) / 15)) *
              ((int)((17719 * $j) / 50)) -
              ((int)($j / 16)) *
              ((int)((15238 * $j) / 43)) + 29;
    $m      = ((int)(24 * $jd / 709));
    $d      = $jd - (int)(709 * $m / 24);
    $y      = 30 * $n + $j - 30;

    return [$m, $d, $y];
}

// Fungsi konversi ke Hijriyah
function Konversi_Hijriyah($tgl = null)
{
    $hijriyah = Gregorian_ke_Hijriyah($tgl);

    if (is_string($hijriyah)) {
        return $hijriyah; // Menangani kasus kesalahan
    }
    
    return $hijriyah[1] . ' ' . bln_hijriyah($hijriyah[0]) . ' ' . $hijriyah[2] . ' H';
}

?>