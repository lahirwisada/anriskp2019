<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Model_Backbone_Coremodul extends Backbone_Coremodul {

    private $user_detail = FALSE;
    //protected $master_schema = 'sc_master';
    protected $rules = array(
        array("nama_coremodul", "required|min_length[3]|max_length[300]|alpha_dash"),
        array("deskripsi_coremodul", "required|min_length[3]|max_length[300]"),
    );

    public function __construct() {
        parent::__construct();
    }

    public function set_user_detail($user_detail) {
        $this->user_detail = $user_detail;
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "nama_coremodul",
                    "deskripsi_coremodul",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }
}

?>
