<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of demo_warga
 *
 * @author lahir
 */
class Demowarga extends Elink_main_demo {
    
    public function __construct() {
        parent::__construct("demo_warga", "Tabel Warga");
        $this->set('current_base_url', base_url('demostarter'));
    }
    
    public function index(){
        
    }
}
