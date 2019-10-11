<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Demowargatidaktetap
 *
 * @author lahir
 */
class Demowargatidaktetap extends Elink_main_demo {
    
    public function __construct() {
        parent::__construct("demo_warga_tidak_tetap", "Tabel Warga Tdk Tetap");
        $this->set('current_base_url', base_url('demostarter'));
    }
    
    public function index(){
        
    }
}
