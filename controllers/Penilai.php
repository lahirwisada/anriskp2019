<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Penilai extends Skarsiparis_cmain {
    
    public $model = 'model_master_pegawai';
    protected $auto_load_model = TRUE;
    
    public function __construct() {
        parent::__construct('kelola_penilai', 'Penilai');
        $this->load->model(array("model_user", "model_backbone_user", "model_backbone_profil", "model_backbone_user_role", "model_backbone_role"));
    }
    
    public function index() {
        $this->session->set_userdata('referer', $this->_uri_before_login);
        $thn = $this->input->get('tahun', TRUE);
        $tahun = $thn ? $thn : date('Y');
        $this->get_attention_message_from_session();
        $records = $this->model_master_pegawai->get_pegawai_by_role_penilai();
//        var_dump($records);exit;
//        $records = (object) array(
//                    "record_set" => FALSE,
//                    "record_found" => 0,
//                    "keyword" => ''
//        );
        $this->set('records', $records->record_set);
        $this->set('total_record', $records->record_found);
        $this->set('keyword', $records->keyword);
        $this->set('tahun', $tahun);
//        $this->set("additional_js", "back_end/" . $this->_name . "/js/index_js");
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

}
