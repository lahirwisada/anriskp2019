<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Skarsiparis_cmain extends Lwpustaka_Data {

    protected $backend_controller_location = "/";
    protected $myid = 0;
    protected $pegawai_id = 0;
    protected $pegawai_nip = 0;
    protected $resource_api_link = NULL;
    protected $saved_id = FALSE;
    protected $user_profil = NULL;
    public $perwal = NULL;
    protected $backend_url_query;
    
    protected $auto_load_model = FALSE;
    
    const DIR_TEMP_UPLOAD = ASSET_UPLOAD . '/';
    const DIR_IMP_UPLOAD = ASSET_UPLOAD . '/final/';

    public function __construct($cmodul_name = FALSE, $header_title = FALSE) {
        $this->is_front_end = FALSE;
        parent::__construct($cmodul_name, $header_title);
        $this->init_cmain();

        $this->check_called_class_before_execute(TRUE);
    }

    protected function after_detail($id = FALSE) {
        return;
    }
    
    protected function after_show_detail($detail = FALSE){
        return $detail;
    }

    protected function detail($id = FALSE, $posted_data = array(), $parent_id = FALSE) {
        $this->set('referer', $this->session->userdata('referer'));
        if ($this->{$this->model}->get_data_post(FALSE, $posted_data)) {
            if ($this->{$this->model}->is_valid()) {

                $this->before_save_response = $this->before_save($posted_data);

                $saved_id = FALSE;
                if ($this->before_save_response !== FALSE) {
                    $saved_id = $this->save_detail($id);
                }

                $this->after_save_response = $this->after_save($id, $saved_id);

                $this->saved_id = $id;
                if (!$id) {
                    $id = $saved_id;
                    $this->saved_id = $saved_id;
                }

                $this->after_detail($id);

                if ($this->before_save_response) {
                    $this->attention_messages = "Data baru telah disimpan.";
                    if ($id) {
                        $this->attention_messages = "Perubahan telah disimpan.";
                    }
                    if ($parent_id) {
                        redirect($this->_name . '/index/' . $parent_id);
                    }
                    $referer = $this->session->userdata('referer');
                    if ($referer) {
                        $this->session->unset_userdata('referer');
                        redirect($referer);
                    }
                    redirect($this->_name);
                }
                $this->attention_messages = "Terdapat Kesalahan, Periksa kembali isian anda.";
            } else {
                $this->attention_messages = $this->{$this->model}->errors->get_html_errors("<br />", "line-wrap");
            }
        }

        $detail = $this->after_show_detail($this->{$this->model}->show_detail($id));
        $this->set("detail", $detail);
    }

    private function init_cmain() {
        $this->my_location = "/";
        $this->_layout = "appui";
//        var_dump($this->user_detail);exit;
        $this->set("active_user_detail", $this->user_detail);
        $this->init_backend_menu();
        $this->backend_controller_location = $this->my_location . $this->_name;
        $this->set("controller_location", $this->backend_controller_location);

//        $user_detail = $this->lmanuser->get("user_detail");
        
    }
    
    protected function get_uploaded_files($upload_random_id) {
        $uploaded_files = FALSE;
        $dir = self::DIR_TEMP_UPLOAD . $upload_random_id . "/";
        if (is_dir($dir)) {
            $uploaded_files = array_diff(scandir($dir), array('..', '.'));
        }
        return $uploaded_files;
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

}
