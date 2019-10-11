<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Demopencarianwargatidaktetap
 *
 * @author lahir
 */
class Demopencarianwargatidaktetap extends Elink_main_demo {
    
    public function __construct() {
        parent::__construct("demo_pencarian_warga_tidak_Tetap", "Pencarian Warga Tidak Tetap");
        $this->set('current_base_url', base_url('demostarter'));
    }
    
    public function index(){
        
    }
}