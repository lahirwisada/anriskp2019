<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Verifikasi 
 */
class Vskp extends Skarsiparis_cmain {
    
    public $model = 'model_tr_vskp';
    protected $auto_load_model = TRUE;
    
    public function __construct() {
        parent::__construct('verifikasi_skp', 'Verifikasi SKP');
        $this->load->model(array('model_tr_akt', 'model_tr_perilaku'));
    }
    
    public function index(){
        $tahun_skp = $this->input->get_post('tahun_skp', TRUE);
        $nip = trim($this->get_post_nip(0));
        
        $url_query_string = get_url_query_string();
        
        if($url_query_string != ""){
            $url_query_string = "?".$url_query_string;
        }

        $pegawai = FALSE;
//        $id_organisasi = $this->user_detail['id_organisasi'];
//        $action_hapus = "kelolaaktivitas/hapus_umpeg/";
//        $action_reset = "kelolaaktivitas/reset_umpeg/";
//        if ($this->can_write("reset")) {
//            $id_organisasi = FALSE;
//            $action_hapus = "kelolaaktivitas/hapus/";
//            $action_reset = "kelolaaktivitas/reset/";
//        }
        
        $this->load->model(array('model_master_pegawai'));
        
        if ($nip != '') {
            $pegawai = $this->model_master_pegawai->get_pegawai_by_id($nip);
        }
        
        $show_date = date('d-m-Y');
        if (!$tahun_skp) {
            $tahun_skp = date('Y');
        }

        $pegawai_id = 0;
        $uploaded_files = FALSE;
        $pegawai_nama = FALSE;
        $perilaku = FALSE;
        if ($pegawai) {
            $pegawai_id = $pegawai->id_pegawai;
            $pegawai_nama = $pegawai->pegawai_nama;
            
            $rakt = $this->model_tr_akt->detail_by_id_pegawai_tahun($pegawai_id, $tahun_skp);
            if($rakt){
                $random_id = $rakt->upload_random_id;
                $uploaded_files = $this->get_uploaded_files($random_id);
            }
            
            $perilaku = $this->model_tr_perilaku->get_perilaku_by_id($pegawai_id, $tahun_skp);
            
            unset($rakt);
        }

        

        $records = (object) array(
                    "record_set" => FALSE,
                    "record_found" => 0,
                    "keyword" => ''
        );
        if ($pegawai) {
            $records = $this->model_tr_vskp->get_persetujuan($pegawai_id, $tahun_skp);
        }

        $this->get_attention_message_from_session();

        $this->set("additional_js", $this->_name . "/js/index_js");
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));

        $this->set('perilaku', $perilaku);
        $this->set('thrandom_id', $random_id);
        $this->set('thuploaded_files', $uploaded_files);
        $this->set('records', $records->record_set);
        $this->set('total_record', $records->record_found);
//        $this->set('action_hapus', $action_hapus);
//        $this->set('action_reset', $action_reset);
        $this->set('tgl_aktivitas', $show_date);
        $this->set('nip', $nip);
        $this->set('tahun_skp', $tahun_skp);
        $this->set('detail_pegawai', $pegawai);
        $this->set('url_query_string', $url_query_string);
        $this->set('pegawai', $this->get_rs_combobox_pegawai("reset"));
        
        $this->set('id_user', add_salt_to_string($this->user_detail["id_user"]));
        
        $this->add_cssfiles(array("plugins/select2/select2.min.css"));
        $this->add_jsfiles(array("plugins/select2/select2.full.min.js"));
    }
    
    private function __update_status($id = FALSE, $status = 1){
        $this->set('referer', $this->session->userdata('referer'));
        if ($this->model_tr_vskp->update_status($id, $status)) {
            $this->set_attention_message('Pengajuan berhasil...');
        } else {
            $this->set_attention_message('Pengajuan gagal dilakukan...');
        }
        $url = 'vskp?'.get_url_query_string();
        redirect($url);
    }
    
    public function accept($id = FALSE) {
        $this->__update_status($id, 2);
    }
    
    public function reject($id = FALSE) {
        $this->__update_status($id, 5);
    }
    
}
