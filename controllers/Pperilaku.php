<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pperilaku extends Skarsiparis_cmain {
    
    public function __construct() {
        parent::__construct('kelola_penilai', 'Penilaian Perilaku');
    }
    
    public function index() {
        $this->session->set_userdata('referer', $this->_uri_before_login);
        $this->get_attention_message_from_session();
        
        $this->load->model('model_master_pegawai');
        
        $records = $this->model_master_pegawai->all(FALSE, FALSE, "id_penilai = '" . $this->user_detail['id_user'] . "'");
//        var_dump($records);exit;
//        $records = (object) array(
//                    "record_set" => FALSE,
//                    "record_found" => 0,
//                    "keyword" => ''
//        );
        $this->set('records', $records->record_set);
        $this->set('total_record', $records->record_found);
        $this->set('keyword', $records->keyword);
//        $this->set("additional_js", "back_end/" . $this->_name . "/js/index_js");
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }
    
}
