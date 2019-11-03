<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pperilaku extends Skarsiparis_cmain {

    public $model = 'model_tr_perilaku';
    protected $auto_load_model = TRUE;

    public function __construct() {
        parent::__construct('kelola_penilai', 'Penilaian Perilaku');

        $this->load->model('model_master_pegawai');
    }

    public function index() {
        $pegawai = $this->model_master_pegawai->get_pegawai_by_id_user($this->user_detail["id_user"]);

//        if ($pegawai) {
            $id = $this->model_tr_perilaku->check_data($this->id_pegawai, date('Y'));
            parent::detail($id, array(
                "id_pegawai",
                "perilaku_tahun",
                "perilaku_pelayanan",
                "perilaku_integritas",
                "perilaku_komitmen",
                "perilaku_disiplin",
                "perilaku_kerjasama",
                "perilaku_kepemimpinan"
            ));
//        }else{
//            redirect('Pperilaku');
//        }

        $this->set('pegawai', $pegawai);
        $this->set('tahun', date('Y'));
        $this->set('id_user', add_salt_to_string($this->user_detail["id_user"]));
    }
    
    public function index_obsolete() {
        $this->session->set_userdata('referer', $this->_uri_before_login);
        $this->get_attention_message_from_session();

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

    public function penilaian_obsolete($crypt_id_user = FALSE) {
        if (!$crypt_id_user) {
            redirect('Pperilaku');
        }

        $id_user = extract_id_with_salt($crypt_id_user);
        $pegawai = $this->model_master_pegawai->get_pegawai_by_id_user($id_user);

        if ($pegawai) {
            $id = $this->model_tr_perilaku->check_data($pegawai->id_pegawai, date('Y'));
            parent::detail($id, array(
                "id_pegawai",
                "perilaku_tahun",
                "perilaku_pelayanan",
                "perilaku_integritas",
                "perilaku_komitmen",
                "perilaku_disiplin",
                "perilaku_kerjasama",
                "perilaku_kepemimpinan"
            ));
        }else{
            redirect('Pperilaku');
        }

        $this->set('pegawai', $pegawai);
        $this->set('tahun', date('Y'));
        $this->set('id_user', $crypt_id_user);
    }

}
