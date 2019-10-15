<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

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
        $records = $this->model_tr_skp_tahunan->get_realisasi_tahunan($this->pegawai_id, $tahun);
        $this->set('records', $records->record_set);
        $this->set('total_record', $records->record_found);
        $this->set('keyword', $records->keyword);
        $this->set('tahun', $tahun);
//        $this->set("additional_js", "back_end/" . $this->_name . "/js/index_js");
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

    public function read($id = FALSE) {
        $this->set('referer', $this->session->userdata('referer'));
        $this->set('skpt', $this->model_tr_skp_tahunan->get_realisasi($id));
        $this->set('pegawai_id', $this->pegawai_id);
//        $this->set('skpb', $this->model_tr_skp_bulanan->get_data_setahun($id, TRUE));
        $this->set('skpb', FALSE);
        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Laporan ' . $this->_header_title
        ));
    }

    public function laporan($tahun = FALSE) {
        $this->set('referer', $this->session->userdata('referer'));
        $tahun = $tahun ? $tahun : date('Y');
        $this->load->model(array('model_master_pegawai', 'model_tr_perilaku'));
        $pegawai_found = $this->model_master_pegawai->get_pegawai_by_id($this->pegawai_id);

        $is_fungsional = TRUE;
        $dummy = ( $pegawai_found ? (Array) $pegawai_found : FALSE );
        if ($dummy) {
            $dummy['data'] = NULL;
            $pegawai_found = (object) $dummy;

            $user_pass = "";
            $data = $this->test_simpeg_api_login($dummy['pegawai_nip'], $user_pass);
            $pegawai_found->data = $data;

            if ($data && (
                    (isset($data['bawahan1']) && $data['bawahan1']) ||
                    (isset($data['bawahan2']) && $data['bawahan2']) ||
                    (isset($data['bawahan1_plt']) && $data['bawahan1_plt']) ||
                    (isset($data['bawahan2_plt']) && $data['bawahan2_plt'])
                    )
            )
                $is_fungsional = FALSE;
        }

        $this->set('pegawai', $pegawai_found);
        $this->set('is_fungsional', $is_fungsional);
        $this->set('skpt', $this->model_tr_skp_tahunan->get_realisasi_tahunan($this->pegawai_id, $tahun)->record_set);
        $this->set('perilaku', $this->model_tr_perilaku->get_perilaku_setahun($this->pegawai_id, $tahun));
        $this->set('tahun', $tahun);
        $this->set("bread_crumb", array(
            "back_end/" . $this->_name => $this->_header_title,
            "#" => 'Laporan SKP Tahunan'
        ));
    }
    
}
