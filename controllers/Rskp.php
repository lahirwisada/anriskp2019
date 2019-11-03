<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rskp extends Skarsiparis_cmain {

    public $model = 'model_tr_skp_tahunan';
    protected $auto_load_model = TRUE;

    public function __construct() {
        parent::__construct('kelola_realisasi_skp_tahunan', 'Realisasi SKP Tahunan');
//        $this->load->model('model_tr_skp_bulanan');
    }

    public function index() {
        $this->session->set_userdata('referer', $this->_uri_before_login);
        $thn = $this->input->get('tahun', TRUE);
        $tahun = $thn ? $thn : date('Y');
        $this->get_attention_message_from_session();
        $records = $this->model_tr_skp_tahunan->get_realisasi_tahunan($this->id_pegawai, $tahun);
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

    public function laporan($tahun = FALSE) {
        $this->set('referer', $this->session->userdata('referer'));
        $tahun = $tahun ? $tahun : date('Y');
        $this->load->model(array('model_master_pegawai', 'model_tr_perilaku'));

        $pegawai_found = $this->model_master_pegawai->get_pegawai_by_id($this->id_pegawai);

        $is_fungsional = TRUE;

        $this->set('pegawai', $pegawai_found);
        $this->set('is_fungsional', $is_fungsional);
        $this->set('skpt', $this->model_tr_skp_tahunan->get_realisasi_tahunan($this->id_pegawai, $tahun)->record_set);
        $this->set('perilaku', $this->model_tr_perilaku->get_perilaku_by_id($this->id_pegawai, $tahun));
        $this->set('tahun', $tahun);
        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Laporan SKP Tahunan'
        ));
    }

}
