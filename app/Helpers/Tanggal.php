<?php

/**
 * Function untuk meng-convert tanggal menjadi style (gaya) Bahasa Indonesia
 */
function tanggal($tgl, $tampil_hari = false)
{
    $nama_hari = array(
        "Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"
    );

    $nama_bulan = array(
        1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    );

    $tanggal = substr($tgl, 8, 2);
    $bulan   = $nama_bulan[(int) substr($tgl, 5, 2)];
    $tahun   = substr($tgl, 0, 4);
    $text    = "";

    if ($tampil_hari) {
        $urutan_hari = date('w', mktime(0, 0, 0, substr($tgl, 5, 2), $tanggal, $tahun));
        $hari = $nama_hari[$urutan_hari];
        $text .= $hari . ", ";
    }

    $text .= $tanggal . " " . $bulan . " " . $tahun;
    return $text;
}
