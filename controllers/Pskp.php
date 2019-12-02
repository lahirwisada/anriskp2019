<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pskp extends Skarsiparis_cmain {

    public $model = 'model_tr_skp_nilai';
    protected $auto_load_model = TRUE;

    public function __construct() {
        parent::__construct('kelola_penilai', 'Penilaian SKP');
        $this->load->model(array('model_tr_akt', 'model_tr_vskp', 'model_tr_perilaku'));
    }

    public function index() {
        $tahun_skp = $this->input->get_post('tahun_skp', TRUE);
        $id_pegawai = trim($this->get_post_nip(0));

        $pegawai = FALSE;
        $nip = "";

        $this->load->model(array('model_master_pegawai'));

        if ($id_pegawai != '') {
            $pegawai = $this->model_master_pegawai->get_pegawai_by_id($id_pegawai);
            if ($pegawai) {
                $nip = $pegawai->pegawai_nip;
            }
        }

        $pegawai_id = 0;
        $pegawai_nama = FALSE;
        if ($pegawai) {
            $pegawai_id = $pegawai->id_pegawai;
            $pegawai_nama = $pegawai->pegawai_nama;
        }

        $show_date = date('d-m-Y');
        if (!$tahun_skp) {
            $tahun_skp = date('Y');
        }

        $records = (object) array(
                    "record_set" => FALSE,
                    "record_found" => 0,
                    "keyword" => ''
        );
        
        $uploaded_files = FALSE;
        $perilaku = FALSE;
        if ($pegawai) {
            $records = $this->model_tr_vskp->get_persetujuan($pegawai_id, $tahun_skp, 2);
            
            $rakt = $this->model_tr_akt->detail_by_id_pegawai_tahun($pegawai_id, $tahun_skp);
            if($rakt){
                $random_id = $rakt->upload_random_id;
                $uploaded_files = $this->get_uploaded_files($random_id);
            }
            
            $perilaku = $this->model_tr_perilaku->get_perilaku_by_id($pegawai_id, $tahun_skp);
            
            unset($rakt);
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
        $this->set('id_user', add_salt_to_string($this->user_detail["id_user"]));
        $this->set('total_record', $records->record_found);
//        $this->set('action_hapus', $action_hapus);
//        $this->set('action_reset', $action_reset);
        $this->set('tgl_aktivitas', $show_date);
        $this->set('nip', $nip);
        $this->set('tahun_skp', $tahun_skp);
        $this->set('detail_pegawai', $pegawai);
        $this->set('pegawai', $this->get_like_penilaian_audien());

        $this->set("additional_js", "pskp/js/index_js");

        $this->add_cssfiles(array("plugins/select2/select2.min.css"));
        $this->add_jsfiles(array("plugins/select2/select2.full.min.js"));
    }

    public function lembar_penilaian($crypt_id_skpt = FALSE) {
        if (!$crypt_id_skpt) {
            redirect('pskp');
        }

        $id_skpt = extract_id_with_salt($crypt_id_skpt);

        $detail_skpt = $this->model_tr_vskp->show_detail($id_skpt);
        $records = $this->model_tr_skp_nilai->all($id_skpt, $this->user_detail["id_pegawai"]);
        $current_val = $records->record_set ? current($records->record_set) : FALSE;

        $this->set('records', $records->record_set);
        $this->set('total_record', $records->record_found);
        $this->set('detail_skpt', $detail_skpt);
        $this->set('crypt_id_skpt', $crypt_id_skpt);
        $this->set('current_val', $current_val);
        $this->set('crypt_id_penilai', add_salt_to_string($this->user_detail["id_pegawai"]));
        $this->set("additional_js", "pskp/js/lembar_penilaian_js");
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

    public function penilaian($id_skp_nilai = FALSE, $posted_data = array()) {
        $this->model_tr_skp_nilai->active_module = 'pskp';
        parent::detail($id_skp_nilai, array(
            "id_skpt",
            "tahun",
            "id_pegawai_penilai",
            "id_turunan_dari",
            "real_nilai_kualitas",
            "real_nilai_kuantitas",
            "real_nilai_waktu",
            "real_nilai_biaya",
            "penilai_message",
            "real_output",
        ));
        
        $request_by_ajax = $this->input->get_post('ajxon');

        if ($request_by_ajax) {
            echo toJsonString((object) array(
                "success" => '0',
                "res_id" => FALSE
            ));
            exit;
        }
        redirect('pskp');
    }

}
