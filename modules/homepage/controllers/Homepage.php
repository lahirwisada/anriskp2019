<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of demo_warga
 *
 * @author lahir
 */
class Homepage extends Skparsiparis_main {
    
    public function __construct() {
        parent::__construct("homepage", "Homepage");
        $this->set('current_base_url', base_url('homepage'));
    }
    
    public function index(){
        
    }
    
    public function login(){
        $this->_layout = "appui_login";
    }
}
