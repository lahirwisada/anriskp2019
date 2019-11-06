<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Profil
 *
 * @author lahir
 */
class Profil extends Skarsiparis_cmain {

    public $model = 'model_user';
    protected $auto_load_model = TRUE;
    protected $on_update_info = FALSE;

    public function __construct() {
        parent::__construct('kelola_skp', ' ');
//        $this->load->model('model_tr_skp_bulanan');
    }
    
    public function passwd(){
        $this->model_user->set_update_password_rules();
        $this->model_user->set_primary_key("id_user");
        
        $this->session->set_userdata('referer', "profil/passwd");
        $this->model_user->username = $this->user_detail["username"];
        
        parent::detail($this->user_detail["id_user"], array(
            "oldpassword",
            "newpassword",
        ));
        $this->set("additional_js", "profil/js/passwd_js");
        $this->set("attention_messages", $this->attention_messages);
        
    }
    
    private function before_save_info($posted_data){
        
        return TRUE;
    }
    
    protected function before_save($posted_data) {
        
        if($this->on_update_info){
            return $this->before_save_info($posted_data);
        }
        
        return TRUE;
    }
    
    public function info(){
        $this->model = "model_master_pegawai";
        
        $this->load->model("model_master_pegawai");
        $this->model_master_pegawai->set_rules_for_infoupdate();
        $this->on_update_info = TRUE;
        
        $this->set('referer', 'profil/info');
        
        parent::detail($this->user_detail["id_pegawai"], array(
            "tmtjabfungsional",
            "nokarpeg",
            "tempatlahir",
            "tgllahir",
            "pangkat",
            "golongan",
            "tmtpangkat_gol",
            "jeniskelamin",
            "unitkerja",
        ));
        
        $this->add_cssfiles(array("appui/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css"));
        $this->add_jsfiles(array("appui/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"));
        
        $this->set("additional_js", "profil/js/info_js");
        $this->set("attention_messages", $this->attention_messages);
    }
}
