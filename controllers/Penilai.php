<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

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

    public function daftar_audien($crypt_id_user = FALSE) {
        if (!$crypt_id_user) {
            redirect('penilai');
        }

        $id_user = extract_id_with_salt($crypt_id_user);

        $penilai_detail = $this->model_master_pegawai->get_pegawai_by_id($id_user);

        $records = (object) array(
                    "record_set" => FALSE,
                    "record_found" => 0,
                    "keyword" => ''
        );
        if ($penilai_detail) {
            $records = $this->model_master_pegawai->all(FALSE, FALSE, "id_penilai = '" . $id_user . "'");
        }

        $this->set('records', $records->record_set);
        $this->set('total_record', $records->record_found);
        $this->set('id_user', $crypt_id_user);
        $this->set('pegawai', $this->get_rs_combobox_pegawai("reset"));
        $this->set('penilai_detail', $penilai_detail);

        $this->set("additional_js", "penilai/js/daftar_audien_js");

        $this->add_cssfiles(array("plugins/select2/select2.min.css"));
        $this->add_jsfiles(array("plugins/select2/select2.full.min.js"));
    }

    public function add_audien($id_pegawai = FALSE) {
        if (!$id_pegawai) {
            redirect('penilai');
        }

        $id_penilai = $this->input->get_post('pid');
        
        if($id_penilai !== FALSE){
            
            $this->model_master_pegawai->add_remove_penilai($id_pegawai, extract_id_with_salt($id_penilai));
            
            $uri_redirection = 'penilai/daftar_audien/'.$id_penilai;
            redirect($uri_redirection);
            exit;
        }
        redirect('penilai');
    }

    public function remove_audien($crypt_id_user = FALSE) {
        if (!$crypt_id_user) {
            redirect('penilai');
        }

        $id_user = extract_id_with_salt($crypt_id_user);

        $id_penilai = $this->input->get_post('pid');
        
        if($id_penilai !== FALSE){
            
            $this->model_master_pegawai->add_remove_penilai($id_user);
            
            $uri_redirection = 'penilai/daftar_audien/'.$id_penilai;
            redirect($uri_redirection);
            exit;
        }
        redirect('penilai');
    }

}
