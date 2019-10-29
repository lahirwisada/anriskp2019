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

    public function read($crypt_id_skpt = FALSE) {
        
        if (!$crypt_id_skpt) {
            redirect('pskp');
        }

        $id_skpt = extract_id_with_salt($crypt_id_skpt);
        
        $this->load->model("model_tr_skp_nilai");

        $detail_skpt = $this->model_tr_skp_tahunan->show_detail($id_skpt);
        $records = $this->model_tr_skp_nilai->all($id_skpt);

        $this->set('records', $records->record_set);
        $this->set('total_record', $records->record_found);
        $this->set('detail_skpt', $detail_skpt);
        $this->set('crypt_id_skpt', $crypt_id_skpt);
        $this->set("additional_js", "rskp/js/read_js");
    }
    
    protected function after_detail($id = FALSE) {
        $request_by_ajax = $this->input->get_post('ajxon');

        if ($request_by_ajax) {
            echo toJsonString((object)array(
                "success" => '1',
                "res_id" => $id
            ));
            exit;
        }

        return;
    }
    
    public function banding($crypt_id_skp_nilai = FALSE, $posted_data = array()){
        $this->model = "model_tr_skp_nilai";
        $this->load->model("model_tr_skp_nilai");
        
        $id_skp_nilai = extract_id_with_salt($crypt_id_skp_nilai);
        
        $_POST["reject_by_pegawai"] = 1;
        
        parent::detail($id_skp_nilai, array(
            "pegawai_message",
            "reject_by_pegawai",
        ));
        
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
