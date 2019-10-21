<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Skp extends Skarsiparis_cmain {
    
    public $model = 'model_tr_skp_tahunan';
    protected $auto_load_model = TRUE;

    public function __construct() {
        parent::__construct('kelola_skp', 'Sasaran Kerja Pegawai');
//        $this->load->model('model_tr_skp_bulanan');
    }

    public function index() {
        $this->session->set_userdata('referer', $this->_uri_before_login);
        $thn = $this->input->get('tahun', TRUE);
        $tahun = $thn ? $thn : date('Y');
        $this->get_attention_message_from_session();
//        $records = $this->model_tr_skp_tahunan->all_skp_plan($this->pegawai_id, $tahun);
        $records = (object) array(
                    "record_set" => FALSE,
                    "record_found" => 0,
                    "keyword" => ''
        );;
        $this->set('records', $records->record_set);
        $this->set('total_record', $records->record_found);
        $this->set('keyword', $records->keyword);
        $this->set('tahun', $tahun);
//        $this->set("additional_js", "back_end/" . $this->_name . "/js/index_js");
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

    public function detail($id = false, $posted_data = [], $parent_id = false) {
        parent::detail($id, array("pegawai_id", "skpt_tahun", "skpt_kegiatan", "skpt_waktu", "skpt_kuantitas", "skpt_output", "skpt_kualitas", "skpt_biaya"));
//        $this->set('pegawai_id', $this->pegawai_id);
        $this->set('pegawai_id', 1);
//        $this->set('skpb', $this->model_tr_skp_bulanan->get_data_setahun($id));
        $this->set('skpb', FALSE);
        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Formulir ' . $this->_header_title
        ));
        
        $this->set("additional_js", "skp/js/detail_js");
        
        $this->add_cssfiles(array("plugins/select2/select2.min.css"));
        $this->add_jsfiles(array("plugins/select2/select2.full.min.js"));
//        $this->add_jsfiles(array("plugins/smartwizard/jquery.smartWizard-2.0.min.js"));
        $this->add_jsfiles(array("plugins/jquery-validation/jquery.validate.js"));
    }

    public function ajukan($id = FALSE) {
        $this->set('referer', $this->session->userdata('referer'));
        if ($this->model_tr_skp_tahunan->update_status($id, 1)) {
            $this->set_attention_message('Pengajuan berhasil...');
        } else {
            $this->set_attention_message('Pengajuan gagal dilakukan...');
        }
        redirect('back_end/skp');
    }

    public function read($id = FALSE) {
        $this->set('referer', $this->session->userdata('referer'));
        $this->set('skpt', $skpt = $this->model_tr_skp_tahunan->get_realisasi($id));
        $this->set('pegawai_id', $this->pegawai_id);
//        $this->set('skpb', $this->model_tr_skp_bulanan->get_data_setahun($id, TRUE));
        $this->set('skpb', FALSE);
        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Formulir ' . $this->_header_title
        ));
    }

    public function get_like() {
        $keyword = $this->input->post("keyword");
        $id_skpd = $this->input->post("id_skpd");
        $data_found = $this->{$this->model}->get_like($keyword, $id_skpd);
        $this->to_json($data_found);
    }

    protected function after_save($id = FALSE, $saved_id = FALSE) {
        $idk = $id ? $id : $saved_id;
        $kualitas = $this->input->post('skpt_kualitas', TRUE);
        $kuantitas = $this->input->post('kuantitas', TRUE);
        $biaya = $this->input->post('biaya');
        $data = array();
        for ($i = 1; $i <= 12; $i++) {
            $data[] = array(
                'skpt_id' => $idk,
                'skpb_bulan' => $i,
                'skpb_kuantitas' => $kuantitas[$i],
                'skpb_kualitas' => $kualitas,
                'skpb_biaya' => $biaya[$i],
                'created_by' => $this->user_detail['username']
            );
        }
        $this->model_tr_skp_bulanan->save_data($id, $data);
        unset($data);
    }
    
}
