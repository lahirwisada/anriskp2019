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
        parent::detail($id, array(
            "upload_random_id",
            "id_pegawai",
            "skpt_tahun",
            "id_dupnk",
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
        if ($detail && property_exists($detail, "upload_random_id") && is_null($detail->upload_random_id)) {
            $detail->upload_random_id = generate_random_id();
        } else {
            $dir = self::DIR_TEMP_UPLOAD . $detail->upload_random_id . "/";
            if (is_dir($dir)) {
                $uploaded_files = array_diff(scandir($dir), array('..', '.'));
            }
        }
        $this->set('uploaded_files', $uploaded_files);
        return $detail;
    }

    public function temp_upload() {
//        $postdata = file_get_contents("php://input");
        $file_id = $this->input->post('file_id');
        if (!empty($_POST) && !empty($_FILES) && array_key_exists("file_bukti_kerja", $_FILES) && $file_id) {

            $file_received = @$_FILES['file_bukti_kerja'];

            $extension = strtolower(@substr($file_received['name'], -4));

            $dir = self::DIR_TEMP_UPLOAD . "$file_id/";

            if (is_dir($dir) === FALSE) {
                mkdir($dir);
            }

            $allowedFileType = [
                "application/vnd.ms-excel",
                "application/vnd.ms-excel.sheet.macroEnabled.12",
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                "text/xml",
                "application/msword",
                "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                "application/pdf",
                "application/x-zip-compressed",
                "text/plain",
                "image/jpeg",
                "image/png",
                "image/bmp",
                "image/gif",
            ];

            if ($file_received['error'] == 0) {
                $extension = strtolower(@substr($file_received['name'], -4));
                if (in_array($file_received['type'], $allowedFileType) && $file_received['size'] != '') {
                    $c = save_file($file_received['tmp_name'], $file_received['name'], $file_received['size'], $dir, 0, 0, FALSE, FALSE, TRUE);
                    if (is_array($c) && $c['error'] == 1) {
                        header($_SERVER['SERVER_PROTOCOL'] . ' 415 Unsupported Media Type', true, 415);
                        exit;
                    }
                    header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK', true, 200);
                    exit;
                } else {
                    header($_SERVER['SERVER_PROTOCOL'] . ' 415 Unsupported Media Type', true, 415);
                    exit;
                }
            }
        }
        header($_SERVER['SERVER_PROTOCOL'] . ' 204 No Content', true, 204);
        exit;
    }

    public function remove_file() {
        $file_id = $this->input->get_post('file_id');
        if (!empty($_POST) && $file_id) {
            $filename = $this->input->get_post('fname');

            $filepath = self::DIR_TEMP_UPLOAD . "$file_id/" . $filename;

            if (file_exists($filepath)) {
                echo unlink($filepath) ? 1 : 0;
                exit;
            }
        }
        exit;
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
