<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Democashflow
 *
 * @author lahir
 */
class Democashflow extends Elink_main_demo {
    
    public function __construct() {
        parent::__construct("demo_cash_flow", "Cash FLow");
        $this->set('current_base_url', base_url('demostarter'));
    }
    
    public function index(){
        
    }
}