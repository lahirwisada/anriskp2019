<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!function_exists('hitung_nilai_skp')) {

    /**
     * @dependency common_helper
     * @param object $row_skp_tahunan
     * @return array
     */
    function hitung_nilai_skp($row_skp_tahunan = FALSE) {
        if (!$row_skp_tahunan) {
            return array(0, 0);
        }

        $persen_kualitas = 0;
        $persen_kuantitas = 0;
        $persen_waktu = 0;
        $persen_biaya = 0;

        if (!is_null($row_skp_tahunan->real_nilai_kualitas)) {
            $persen_kualitas = lws_divide($row_skp_tahunan->real_nilai_kualitas, $row_skp_tahunan->skpt_kualitas) * 100;
        }

        if (!is_null($row_skp_tahunan->real_nilai_kuantitas)) {
            $persen_kuantitas = lws_divide($row_skp_tahunan->real_nilai_kuantitas, $row_skp_tahunan->skpt_kuantitas) * 100;
        }

        if (!is_null($row_skp_tahunan->real_nilai_waktu)) {
            $persen_waktu = 100 - (lws_divide($row_skp_tahunan->real_nilai_waktu, $row_skp_tahunan->skpt_waktu) * 100);
        }

        if (!is_null($row_skp_tahunan->real_nilai_biaya)) {
            $persen_biaya = 100 - (lws_divide($row_skp_tahunan->real_nilai_biaya, $row_skp_tahunan->skpt_biaya) * 100);
        }

        $biaya_less24 = lws_divide((1.76 * $row_skp_tahunan->skpt_biaya - (is_null($row_skp_tahunan->real_nilai_biaya) ? 0 : $row_skp_tahunan->real_nilai_biaya)), $row_skp_tahunan->skpt_biaya) * 100;
        $biaya_up24 = 76 - ($biaya_less24 - 100);

        $waktu_less24 = lws_divide((1.76 * $row_skp_tahunan->skpt_waktu - (is_null($row_skp_tahunan->real_nilai_waktu) ? 0 : $row_skp_tahunan->real_nilai_waktu)), $row_skp_tahunan->skpt_waktu) * 100;
        $waktu_up24 = 76 - ($waktu_less24 - 100);

        $nilai_biaya = $persen_biaya > 24 ? $biaya_up24 : $biaya_less24;
        $nilai_waktu = $persen_waktu > 24 ? $waktu_up24 : $waktu_less24;

        $hitung = $persen_kualitas + $persen_kuantitas + $nilai_waktu + $nilai_biaya;

        $nilai_capaian = (!is_null($row_skp_tahunan->real_nilai_biaya) && $row_skp_tahunan->real_nilai_biaya > 0) ? $hitung / 3 : $hitung / 4;
        
        unset($persen_kualitas, $persen_kuantitas, $nilai_biaya, $nilai_waktu, $biaya_less24, $biaya_up24, $waktu_less24, $waktu_up24);
        return array($hitung, $nilai_capaian);
    }

}