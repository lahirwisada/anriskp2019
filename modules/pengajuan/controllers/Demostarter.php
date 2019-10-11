<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Home
 *
 * @author lahir
 */
class Demostarter extends Elink_main {

    protected $auto_load_model = FALSE;
    private $harga = [
        "starter" => "@Rp. 2266,66667 / bulan",
        "basic" => "@Rp. 3400 / bulan",
        "Hemat" => "@Rp. 3400 / bulan",
        "Reguler" => "@Rp. 4800 / bulan",
    ];

    public function __construct() {
        parent::__construct("wel", "Dashboard");
        $this->set('current_base_url', base_url('demostarter'));
    }

    public function index() {
        $this->add_jsfiles(array('appui/plugins/chartjs/Chart.min.js'));
        $this->set('additional_js', $this->_name . '/js/index_js');
    }

    private function arrange_banner_area() {
//        $banner_view = $this->load->view('homepage/homepage/banner_area', [], TRUE);
//        $this->set('homepage_banner_area', $banner_view);
//        unset($banner_view);
    }

}
