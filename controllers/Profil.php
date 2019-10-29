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
}
