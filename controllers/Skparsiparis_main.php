<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Elink_main
 *
 * @author lahir
 */
class Skparsiparis_main extends Lws_Modular {

    protected $auto_load_model = FALSE;

    public function __construct($cmodul_name = FALSE, $header_title = FALSE) {
        parent::__construct($cmodul_name, $header_title);
        $this->_layout = "appui";
        $this->init_skparsiparismain();
    }

    private function init_skparsiparismain() {
        $this->check_called_class_before_execute(TRUE);
//        $this->my_location = "back_bone/";
        if (!$this->user_detail) {
            $this->user_detail = $this->lmanuser->get("user_detail", "BACK_END");
            
//            var_dump($this->user_detail);exit;
        }
        $this->set("active_user_detail", $this->user_detail);
        $this->set("current_foto", $this->user_detail["foto"]);
        $this->init_backend_menu();
    }

}
