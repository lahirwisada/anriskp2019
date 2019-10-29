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
                        redirect('back_end/' . $this->_name . '/index/' . $parent_id);
                    }
                    $referer = $this->session->userdata('referer');
                    if ($referer) {
                        $this->session->unset_userdata('referer');
                        redirect($referer);
                    }
                    redirect('back_end/' . $this->_name);
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

}
