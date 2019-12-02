<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Skp extends Skarsiparis_cmain {

    public $model = 'model_tr_skp_tahunan';
    protected $auto_load_model = TRUE;

    const DIR_TEMP_UPLOAD = ASSET_UPLOAD . '/';
    const DIR_IMP_UPLOAD = ASSET_UPLOAD . '/final/';

    public function __construct() {
        parent::__construct('kelola_skp', 'Sasaran Kerja Pegawai');
//        $this->load->model('model_tr_skp_bulanan');
        $this->load->model(array('model_tr_akt', 'model_master_pegawai'));
    }

    public function index() {
        $this->session->set_userdata('referer', $this->_uri_before_login);
        $thn = $this->input->get('tahun', TRUE);
        $tahun = $thn ? $thn : date('Y');
        $this->get_attention_message_from_session();
        $records = $this->model_tr_skp_tahunan->all_skp_plan($this->id_pegawai, $tahun);
//        $records = (object) array(
//                    "record_set" => FALSE,
//                    "record_found" => 0,
//                    "keyword" => ''
//        );

        $this->read_bukti_tahunan($tahun);
        $this->set('records', $records->record_set);
        $this->set('total_record', $records->record_found);
        $this->set('keyword', $records->keyword);
        $this->set('tahun', $tahun);
//        $this->set("additional_js", "back_end/" . $this->_name . "/js/index_js");
        $this->set("bread_crumb", array(
            "#" => $this->_header_title
        ));
    }

    private function insert_default_akt($tahun) {
        $pegawai_detail = $this->model_master_pegawai->show_detail($this->id_pegawai);
        $random_id = generate_random_id();

        $data = [
                "id_pegawai" => $this->id_pegawai,
                "jabfungsional" => $this->user_detail["jabfungsional"],
                "ak_sebelumnya" => NULL,
                "tahun" => $tahun,
                "nilaikinerja" => NULL,
                "akt" => NULL,
                "akk" => NULL,
                "upload_random_id" => $random_id
            ];

        if ($pegawai_detail) {
            list($akk, $akkth_ini) = get_nilai_akk_akth($pegawai_detail);
            $data = [
                "id_pegawai" => $pegawai_detail->id_pegawai,
                "jabfungsional" => $pegawai_detail->jabfungsional,
                "ak_sebelumnya" => $pegawai_detail->akkthlalu,
                "tahun" => $tahun,
                "nilaikinerja" => $pegawai_detail->nilai_kinerja,
                "akt" => $akkth_ini,
                "akk" => $akk,
                "upload_random_id" => $random_id
            ];
        }
        $this->model_tr_akt->data_insert($data);
        unset($data, $pegawai_detail);
        return $random_id;
    }

    public function read_bukti_tahunan($tahun = FALSE) {

        $this->model_master_pegawai->set_by_berita_acara();
        $tahun = $tahun ? $tahun : date('Y');
        $this->model_master_pegawai->set_berita_acara_tahun($tahun);

        $detail_akt = $this->model_tr_akt->detail_by_id_pegawai_tahun($this->id_pegawai, $tahun);

        if (!$detail_akt) {
            $random_id = $this->insert_default_akt($tahun);
            $detail_akt = $this->model_tr_akt->detail_by_id_pegawai_tahun($this->id_pegawai, $tahun);
        } else {
            $random_id = $detail_akt->upload_random_id;
        }
        $this->set('random_id', $random_id);

        $uploaded_files = $this->get_uploaded_files($random_id);

        $this->set('uploaded_files', $uploaded_files);

        $this->set("additional_js", "skp/js/upload_bukti_kerja_js");
//        var_dump($detail_akt);
//        exit;
    }

    public function upload_bukti_tahunan() {
        
    }

    public function detail($id = false, $posted_data = [], $parent_id = false) {
//        var_dump($_POST);exit;
        parent::detail($id, array(
            "upload_random_id",
            "id_pegawai",
            "skpt_tahun",
            "id_dupnk",
            "uraian_tgs_tambahan",
            "is_tugas_tambahan",
            "skpt_waktu",
            "skpt_real_waktu",
            "skpt_kuantitas",
            "skpt_output",
            "skpt_real_kuantitas",
            "skpt_real_output",
            "skpt_kualitas",
            "skpt_real_kualitas",
            "skpt_biaya"
        ));

//        $this->set('pegawai_id', $this->pegawai_id);
        $this->set('pegawai_id', $this->user_detail["id_pegawai"]);
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

    protected function after_show_detail($detail = FALSE) {
        $uploaded_files = FALSE;
        if ($detail) {
            if ($detail && (!property_exists($detail, "upload_random_id"))) {
                $detail->upload_random_id = generate_random_id();
            } else {
                $uploaded_files = $this->get_uploaded_files($detail->upload_random_id);
            }
        } else {
            $random_id = generate_random_id();
            $this->set('random_id', $random_id);
        }
        $this->set('uploaded_files', $uploaded_files);
        return $detail;
    }

    public function ajukan($id = FALSE) {
        $this->set('referer', $this->session->userdata('referer'));
        if ($this->model_tr_skp_tahunan->update_status($id, 1)) {
            $this->set_attention_message('Pengajuan berhasil...');
        } else {
            $this->set_attention_message('Pengajuan gagal dilakukan...');
        }
        redirect('skp');
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
//        $idk = $id ? $id : $saved_id;
//        $kualitas = $this->input->post('skpt_kualitas', TRUE);
//        $kuantitas = $this->input->post('kuantitas', TRUE);
//        $biaya = $this->input->post('biaya');
//        $data = array();
//        for ($i = 1; $i <= 12; $i++) {
//            $data[] = array(
//                'skpt_id' => $idk,
//                'skpb_bulan' => $i,
//                'skpb_kuantitas' => $kuantitas[$i],
//                'skpb_kualitas' => $kualitas,
//                'skpb_biaya' => $biaya[$i],
//                'created_by' => $this->user_detail['username']
//            );
//        }
//        $this->model_tr_skp_bulanan->save_data($id, $data);
        unset($data);
    }

}
