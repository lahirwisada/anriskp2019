<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Demo_pencarian_warga
 *
 * @author lahir
 */
class Demo_pencarian_warga extends Elink_main_demo {
    
    public function __construct() {
        parent::__construct("demo_pencarian_warga", "Pencarian Warga");
        $this->set('current_base_url', base_url('demostarter'));
    }
    
    public function index(){
        
    }
}
