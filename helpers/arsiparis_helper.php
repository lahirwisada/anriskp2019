<?php

if (!function_exists('show_nilai_huruf')) {

    function show_nilai_huruf($total_nilai_skp, $jumlah_laporan, $nilai_tgs_tambahan) {
        $nilai_capaian = $jumlah_laporan > 0 ? $total_nilai_skp / $jumlah_laporan : 0;
        $total_nilai_capaian = $nilai_capaian + $nilai_tgs_tambahan;
        $nilai_huruf = get_nilai_huruf($total_nilai_capaian);
        return array($nilai_huruf, $total_nilai_capaian);
    }

}

if (!function_exists('filter_skp_tugaspokok')) {

    function filter_skp_tugaspokok($record) {
        return $record->is_tugas_tambahan != 1;
    }

}

if (!function_exists('filter_skp_tugastambahan')) {

    function filter_skp_tugastambahan($record) {
        return $record->is_tugas_tambahan == 1;
    }

}

if (!function_exists('get_summary_nilai_tgs_tambahan_from_json')) {

    function get_summary_nilai_tgs_tambahan_from_json($json_tgs_tambahan) {
        $obj_nilai_tambahan = json_decode($json_tgs_tambahan);
        if (is_null($json_tgs_tambahan) || $obj_nilai_tambahan === NULL) {
            return NULL;
        }

        /**
         * Template JSON nilai Tugas Tambahan
         *  {"array": [{"id": "203", "status_nilai": "0"}], "status_summary": "0"}
         */
        $arr_id_penilai = array_column($obj_nilai_tambahan->array, "id");
        $arr_status_nilai = array_column($obj_nilai_tambahan->array, "status_nilai");
        $arr_len = count($arr_status_nilai);
        $tot = array_sum($arr_status_nilai);

        $status_nilai = 0;

        if (($arr_len > 2 && $tot >= 2) || ($arr_len == 2 && $tot > 1) || ($arr_len == 1 && $tot >= 1))
            $status_nilai = 1;

        unset($obj_nilai_tambahan, $arr_id_penilai, $arr_status_nilai);

        return $status_nilai;
    }

}

if (!function_exists('get_nilai_tgs_tambahan_by_ipeg_from_json')) {

    function get_nilai_tgs_tambahan_by_ipeg_from_json($json_tgs_tambahan, $id_pegawai) {
        $obj_nilai_tambahan = json_decode($json_tgs_tambahan);
        if (is_null($json_tgs_tambahan) || !$id_pegawai || $obj_nilai_tambahan === NULL) {
            return NULL;
        }

        /**
         * Template JSON nilai Tugas Tambahan
         *  {"array": [{"id": "203", "status_nilai": "0"}], "status_summary": "0"}
         */
        $arr_id_penilai = array_column(toArray($obj_nilai_tambahan->array), "id");
        $arr_status_nilai = array_column(toArray($obj_nilai_tambahan->array), "status_nilai");
        $found_penilai = array_search($id_pegawai, $arr_id_penilai);
        $status_nilai = NULL;
        if ($found_penilai !== FALSE) {
            $status_nilai = $arr_status_nilai[$found_penilai];
        }
        $summary = $obj_nilai_tambahan->status_summary;

        unset($obj_nilai_tambahan, $arr_id_penilai, $arr_status_nilai, $found_penilai);

        return array($status_nilai, $summary);
    }

}

if (!function_exists('show_nilai_tgstambahan')) {

    function show_nilai_tgstambahan($jml_tgs_tambahan) {
        $nilai = ceil(lws_divide($jml_tgs_tambahan, 3));
        return $nilai > 3 ? 3 : $nilai;
    }

}

if (!function_exists('get_nilai_akk_akth')) {

    function get_nilai_akk_akth($pegawai_detail = FALSE) {
        if ($pegawai_detail) {
            $akkth_ini = $pegawai_detail->akt_ini;
            if (is_null($pegawai_detail->akt_ini)):
                $akkth_ini = calculate_nilai_akt($pegawai_detail->nilai_kinerja, $pegawai_detail->jabfungsional);
            endif;
            $akk = $pegawai_detail->akk_ini;
            if (is_null($pegawai_detail->akk_ini)):
                $akk = $akkth_ini + $pegawai_detail->akkthlalu;
            endif;
            return [$akk, $akkth_ini];
        }
        return [NULL, NULL];
    }

}

if (!function_exists('get_nilai_huruf')) {

    function get_nilai_huruf($nilai_capaian, $as_numeric = FALSE) {
        $nilai_huruf = $as_numeric ? FALSE : '';
        if ($nilai_capaian <= 50) {
            $nilai_huruf = $as_numeric ? 4 : 'Buruk';
        } elseif ($nilai_capaian <= 60) {
            $nilai_huruf = $as_numeric ? 3 : 'Sedang';
        } elseif ($nilai_capaian <= 75) {
            $nilai_huruf = $as_numeric ? 2 : 'Cukup';
        } elseif ($nilai_capaian < 91) {
            $nilai_huruf = $as_numeric ? 1 : 'Baik';
        } else {
            $nilai_huruf = $as_numeric ? 0 : 'Sangat Baik';
        }
        return $nilai_huruf;
    }

}

if (!function_exists('convert_nilai_huruf_to_prosentase')) {

    function convert_nilai_huruf_to_prosentase($nilai_capaian) {
        $key = get_nilai_huruf($nilai_capaian, TRUE);
        $arr_prosentase = [150, 125, 100, 75, 50];
        if (array_key_exists($key, $arr_prosentase)) {
            return $arr_prosentase[$key];
        }
        return '-';
    }

}

if (!function_exists('get_syarat_angka_kredit')) {

    function get_syarat_angka_kredit($key = FALSE) {
        $syarat_angka_kredit = [
            0 => '5',
            1 => '12.5',
            2 => '25',
            3 => '12.5',
            4 => '25',
        ];
        if (!$key) {
            return $syarat_angka_kredit;
        }

        if (is_string($key)) {
            $key = get_array_tingkatan($key);
        }

        if (array_key_exists($key, $syarat_angka_kredit)) {
            return $syarat_angka_kredit[$key];
        }

        return FALSE;
    }

}

if (!function_exists('get_array_tingkatan')) {

    function get_array_tingkatan($key = FALSE) {
        $array_tingkatan = [
            0 => 'terampil',
            1 => 'mahir',
            2 => 'penyelia',
            3 => 'pertama',
            4 => 'muda',
        ];
        if (!$key) {
            return $array_tingkatan;
        }

        if (is_numeric($key) && array_key_exists($key, $array_tingkatan)) {
            return $array_tingkatan[$key];
        }

        if (is_string($key)) {
            $array_tingkatan = array_flip($array_tingkatan);
            if (array_key_exists($key, $array_tingkatan)) {
                return $array_tingkatan[$key];
            }
        }

        return FALSE;
    }

}

if (!function_exists('calculate_nilai_akt')) {

    function calculate_nilai_akt($nilai_kinerja, $jabatan) {
        $nilai_prosentase = !is_null($nilai_kinerja) ? convert_nilai_huruf_to_prosentase($nilai_kinerja) : 0;
        $ak_minimal_jab = get_syarat_angka_kredit(strtolower(trim($jabatan)));

        return lws_divide(($nilai_prosentase * $ak_minimal_jab), 100);
    }

}

if (!function_exists('show_skpt_output')) {

    function show_skpt_output($skpt_output = NULL) {
        if (!is_null($skpt_output) && $skpt_output !== FALSE) {
            $arr_skpt_output = get_skpt_output();
            if (array_key_exists($skpt_output, $arr_skpt_output)) {
                return $arr_skpt_output[$skpt_output];
            }
        }
        return "";
    }

}

if (!function_exists('get_skpt_output')) {

    function get_skpt_output($skpt_output = FALSE) {
        return array('Laporan', 'Dokumen', 'Daftar Arsip', 'Paket', 'Orang', 'Unit');
    }

}

if (!function_exists('get_skpt_status')) {

    function get_skpt_status() {
        return array('Draft', 'Verifikasi', 'Penilaian', 'Selesai', 'Ditolak', 'Tidak Sesuai');
    }

}

if (!function_exists('get_skpt_label')) {

    function get_skpt_label() {
        return array('label-warning', 'label-default', 'label-info', 'label-success', 'label-danger', 'label-warning');
    }

}

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
            $pw = (lws_divide($row_skp_tahunan->real_nilai_waktu, $row_skp_tahunan->skpt_waktu) * 100);
            $persen_waktu = $pw > 0 ? 100 - $pw : 0;
        }

        if (!is_null($row_skp_tahunan->real_nilai_biaya)) {
            $pb = (lws_divide($row_skp_tahunan->real_nilai_biaya, $row_skp_tahunan->skpt_biaya) * 100);
            $persen_biaya = $pb > 0 ? 100 - $pb : 0;
        }

        $biaya_less24 = lws_divide((1.76 * $row_skp_tahunan->skpt_biaya - (is_null($row_skp_tahunan->real_nilai_biaya) ? 0 : $row_skp_tahunan->real_nilai_biaya)), $row_skp_tahunan->skpt_biaya) * 100;
        $biaya_up24 = 76 - ($biaya_less24 - 100);

        $waktu_less24 = lws_divide((1.76 * $row_skp_tahunan->skpt_waktu - (is_null($row_skp_tahunan->real_nilai_waktu) ? 0 : $row_skp_tahunan->real_nilai_waktu)), $row_skp_tahunan->skpt_waktu) * 100;
        $waktu_up24 = 76 - ($waktu_less24 - 100);

        $nilai_biaya = $persen_biaya > 24 ? $biaya_up24 : $biaya_less24;
        $nilai_waktu = $persen_waktu > 24 ? $waktu_up24 : $waktu_less24;

        $hitung = $persen_kualitas + $persen_kuantitas + $nilai_waktu + $nilai_biaya;

//        $nilai_capaian = (!is_null($row_skp_tahunan->real_nilai_biaya) && $row_skp_tahunan->real_nilai_biaya > 0) ? $hitung / 3 : $hitung / 4;
        $nilai_capaian = hitung_nilai_capaian($row_skp_tahunan->real_nilai_biaya, $hitung);

        unset($persen_kualitas, $persen_kuantitas, $nilai_biaya, $nilai_waktu, $biaya_less24, $biaya_up24, $waktu_less24, $waktu_up24);
        return array($hitung, $nilai_capaian);
    }

}

if (!function_exists('hitung_nilai_capaian')) {

    function hitung_nilai_capaian($rnb = NULL, $hitung = 0) {
        return (!is_null($rnb) && $rnb > 0) ? lws_divide($hitung, 4) : lws_divide($hitung, 3);
    }

}

if (!function_exists('crypt_array')) {

    function crypt_array($arr_string = []) {
        if (empty($arr_string))
            return [];


        return array_map('add_salt_to_string', $arr_string);
    }

}

if (!function_exists('array_key_for_caption')) {

    function array_key_for_caption($arr_string = [], $caption = '', $key_is_default = TRUE) {
        if (empty($arr_string)) {
            return [];
        }

        $arr_string = array_keys($arr_string);

        foreach ($arr_string as $key => $val) {
            $arr_string[$key] = $caption . " " . $val;
            if ($key_is_default) {
                $arr_string[$key] = $caption . " " . ($val + 1);
            }
        }

        return $arr_string;
    }

}