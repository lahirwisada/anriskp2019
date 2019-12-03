<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rskp extends Skarsiparis_cmain {

    public $model = 'model_tr_skp_tahunan';
    protected $auto_load_model = TRUE;

    public function __construct() {
        parent::__construct('kelola_realisasi_skp_tahunan', 'Realisasi SKP Tahunan');
        $this->load->model('model_tr_akt');
    }

    public function index() {
        $this->session->set_userdata('referer', $this->_uri_before_login);
        $thn = $this->input->get('tahun', TRUE);
        $tahun = $thn ? $thn : date('Y');
        $this->get_attention_message_from_session();
        $records = $this->model_tr_skp_tahunan->get_realisasi_tahunan($this->id_pegawai, $tahun);

        $rakt = $this->model_tr_akt->detail_by_id_pegawai_tahun($this->id_pegawai, $tahun);

        $final_uploaded_files = FALSE;
        if ($rakt) {
            $final_random_id = $rakt->final_random_id;
            $final_uploaded_files = $this->get_uploaded_files($final_random_id);
        }

        $this->set('final_random_id', $final_random_id);
        $this->set('final_uploaded_files', $final_uploaded_files);
        $this->set('records', $records->record_set);
        $this->set('total_record', $records->record_found);
        $this->set('keyword', $records->keyword);
        $this->set('tahun', $tahun);
//        $this->set("additional_js", "back_end/" . $this->_name . "/js/index_js");
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

    private function get_kelompok_penilai() {
        $rs_kelompok_penilai = $this->model_petugas_penilai->get_petugas_by_id_audien($this->user_detail["id_pegawai"]);
        if ($rs_kelompok_penilai) {
            foreach ($rs_kelompok_penilai as $key => $record) {
                $rs_kelompok_penilai[$key] = $record->id_penilai;
            }
            return $rs_kelompok_penilai;
        }
        return [];
    }

    public function read($crypt_id_skpt = FALSE) {

        if (!$crypt_id_skpt) {
            redirect('pskp');
        }

        $id_skpt = extract_id_with_salt($crypt_id_skpt);

        $this->load->model(array("model_tr_skp_nilai", "model_petugas_penilai"));

        $detail_skpt = $this->model_tr_skp_tahunan->show_detail($id_skpt);
        $records = $this->model_tr_skp_nilai->audien_all($id_skpt);
        $kelompok_penilai = $this->get_kelompok_penilai();

        $this->set('records', $records->record_set);
        $this->set('total_record', $records->record_found);
        $this->set('detail_skpt', $detail_skpt);
        $this->set('kelompok_penilai', $kelompok_penilai);
        $this->set('crypt_id_skpt', $crypt_id_skpt);
        $this->set("additional_js", "rskp/js/read_js");
    }

    protected function after_detail($id = FALSE) {
        $request_by_ajax = $this->input->get_post('ajxon');

        if ($request_by_ajax) {
            echo toJsonString((object) array(
                        "success" => '1',
                        "res_id" => $id
            ));
            exit;
        }

        return;
    }

    public function banding($crypt_id_skp_nilai = FALSE, $posted_data = array()) {
        $this->model = "model_tr_skp_nilai";
        $this->load->model("model_tr_skp_nilai");

        $id_skp_nilai = extract_id_with_salt($crypt_id_skp_nilai);

        $cis = $this->input->get_post('cis');
        $cip = $this->input->get_post('cip');

        $id_skpt = FALSE;
        $id_penilai = FALSE;
        if ($cis) {
            $id_skpt = extract_id_with_salt($cis);
        }

        if ($cip) {
            $id_penilai = extract_id_with_salt($cip);
        }

        $penilaian = $this->model_tr_skp_nilai->get_detail("id_skpt = '" . $id_skpt . "' and id_pegawai_penilai = '" . $id_penilai . "' and current_active = '1'");

        $_POST["reject_by_pegawai"] = 1;

        if ($penilaian) {
            parent::detail($penilaian->id_skp_nilai, array(
                "pegawai_message",
                "reject_by_pegawai",
            ));
        }

        $request_by_ajax = $this->input->get_post('ajxon');

        if ($request_by_ajax) {
            echo toJsonString((object) array(
                        "success" => '0',
                        "res_id" => FALSE
            ));
            exit;
        }
    }

    private function generate_cetak_skp($pegawai_detail, $skpt, $perilaku = FALSE) {

        $this->load->library('Calcel');

        //$template_path = APPPATH . '../_assets/template/Template_Rekapitulasi_TPP.xls';
        $template_path = ASSET_TEMPLATE . '/TemplateSKP.xls';

        $genid = md5(date('Y-m-d H:i:s:u'));
        $save_path = APPPATH . '../_assets/generated_bap/' . $genid . '.xls';
        $nama_file = '' . $genid . '.xls';

        $this->calcel->load($template_path);

        $active_sheet = $this->calcel->setActiveSheetIndexByName("SKP");

        $baseRow = 15;

        $skp_tugas_pokok = array_filter($skpt, "filter_skp_tugaspokok");
        $skp_tugas_tambahan = array_filter($skpt, "filter_skp_tugastambahan");

        unset($skpt);
        $rc_tugas_pokok = count($skp_tugas_pokok) - 1;
        $active_sheet->insertNewRowBefore($baseRow, $rc_tugas_pokok);
        $row = 0;

        $active_sheet->setCellValue('E4', $pegawai_detail->pegawai_nama);
        $active_sheet->setCellValue('E5', $pegawai_detail->tmtjabfungsional);
        $panggol = $pegawai_detail->pangkat . ", " . $pegawai_detail->golongan;
        $active_sheet->setCellValue('E6', $panggol);
        $active_sheet->setCellValue('E7', $pegawai_detail->unitkerja);

        $total = 0;
        $key = 0;
        foreach ($skp_tugas_pokok as $key => $record) {

            $nilai_skp = hitung_nilai_capaian($record->real_nilai_biaya, $record->real_hitung);

            $total += $nilai_skp;
            $row = $baseRow + $key;

            $active_sheet->setCellValue('A' . $row, $key + 1)
                    ->setCellValue('B' . $row, beautify_str($record->skpt_kegiatan))
                    ->setCellValue('D' . $row, number_format($record->skpt_kuantitas, 2, '.', ','))
                    ->setCellValue('E' . $row, show_skpt_output($record->skpt_output))
                    ->setCellValue('F' . $row, number_format($record->skpt_kualitas, 2, '.', ','))
                    ->setCellValue('G' . $row, $record->skpt_waktu)
                    ->setCellValue('H' . $row, "Bulan")
                    ->setCellValue('J' . $row, number_format($record->skpt_real_kuantitas, 2, '.', ','))
                    ->setCellValue('K' . $row, number_format($record->skpt_real_kualitas, 2, '.', ','))
                    ->setCellValue('L' . $row, number_format($record->real_nilai_kuantitas, 2, '.', ','))
                    ->setCellValue('M' . $row, show_skpt_output($record->skpt_output))
                    ->setCellValue('N' . $row, number_format($record->real_nilai_kualitas, 2, '.', ','))
                    ->setCellValue('O' . $row, $record->real_nilai_waktu)
                    ->setCellValue('P' . $row, "Bulan")
                    ->setCellValue('R' . $row, number_format($record->real_hitung, 2, '.', ','))
                    ->setCellValue('S' . $row, number_format($nilai_skp, 2, '.', ','));
            $key++;
        }
        $baseRow = $row + 3;
        $row = 0;
        $rc_tugas_tambahan = count($skp_tugas_tambahan) - 1;
        $active_sheet->insertNewRowBefore($baseRow, $rc_tugas_tambahan);
        $key = 0;
        $three = 3;
        foreach ($skp_tugas_tambahan as $record) {
            
            $nilai_skp = hitung_nilai_capaian($record->real_nilai_biaya, $record->real_hitung);

            $total += $nilai_skp;

            $row = $baseRow + $key;
            $val = "";
            if ($three == 3 && $key < 8) {
                $val = "1";
            }
            $three--;
            if ($three == 0) {
                $three = 3;
            }
            $active_sheet->setCellValue('A' . $row, $key + 1)
                    ->setCellValue('B' . $row, beautify_str($record->skpt_kegiatan))
                    ->setCellValue('S' . $row, $val);
            $key++;
        }

        $nilai_tgs_tambahan = show_nilai_tgstambahan($rc_tugas_tambahan+1);
        list($nilai_huruf, $nilai_capaian) = show_nilai_huruf($total, ($rc_tugas_pokok+1), $nilai_tgs_tambahan);

        $active_sheet->setCellValue('S'.($row+1), number_format($nilai_capaian, 2, '.', ','));
        $active_sheet->setCellValue('S'.($row+2), beautify_str($nilai_huruf));
        
        $active_sheet = $this->calcel->setActiveSheetIndexByName("DP3");

        $active_sheet->setCellValue('E6', $perilaku->perilaku_pelayanan);
        $active_sheet->setCellValue('E7', $perilaku->perilaku_integritas);
        $active_sheet->setCellValue('E8', $perilaku->perilaku_komitmen);
        $active_sheet->setCellValue('E9', $perilaku->perilaku_disiplin);
        $active_sheet->setCellValue('E10', $perilaku->perilaku_kerjasama);
        $active_sheet->setCellValue('E11', $perilaku->perilaku_kepemimpinan);
        
        $active_sheet = $this->calcel->setActiveSheetIndexByName("SKP");

//        if ($zip) {
//            $this->calcel->save($save_path);
//            return $save_path;
//        }
        $this->calcel->stream($genid . '.xls');

        echo $genid . '.xls';
        exit;
    }

    public function cetakskp($tahun = FALSE) {
        if (!$tahun || !array_key_exists('cip', $_GET)) {
            redirect('rskp');
        }
        $this->load->model(array('model_master_pegawai', 'model_tr_perilaku'));
        $pegawai_found = $this->model_master_pegawai->get_pegawai_by_id($this->id_pegawai);

        $skpt = $this->model_tr_skp_tahunan->get_realisasi_tahunan($this->id_pegawai, $tahun)->record_set;
        $perilaku = $this->model_tr_perilaku->get_perilaku_by_id($this->id_pegawai, $tahun);

        if ($pegawai_found && !empty($pegawai_found) && $skpt && !empty($skpt) && is_array($skpt)) {
            $this->generate_cetak_skp($pegawai_found, $skpt, $perilaku);
        } else {
            redirect('rskp');
        }
        exit;
    }

    public function laporan($tahun = FALSE) {
        $this->set('referer', $this->session->userdata('referer'));
        $tahun = $tahun ? $tahun : date('Y');
        $this->load->model(array('model_master_pegawai', 'model_tr_perilaku'));

        $pegawai_found = $this->model_master_pegawai->get_pegawai_by_id($this->id_pegawai);

        $is_fungsional = TRUE;

        $this->set('pegawai', $pegawai_found);
        $this->set('is_fungsional', $is_fungsional);
        $this->set('crypted_id_pegawai', add_salt_to_string($this->id_pegawai));
        $this->set('skpt', $this->model_tr_skp_tahunan->get_realisasi_tahunan($this->id_pegawai, $tahun)->record_set);
        $this->set('perilaku', $this->model_tr_perilaku->get_perilaku_by_id($this->id_pegawai, $tahun));
        $this->set('tahun', $tahun);
        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Laporan SKP Tahunan'
        ));

        $this->set("additional_js", $this->_name . "/js/laporan_js");
    }

}
