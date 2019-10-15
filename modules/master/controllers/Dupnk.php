<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Home
 *
 * @author lahir
 */
class Dupnk extends Skparsiparis_main {

    protected $auto_load_model = FALSE;

    public function __construct() {
        parent::__construct("wel", "Dashboard");
        $this->set('current_base_url', base_url('dupnk'));
    }

    public function index() {}

}
