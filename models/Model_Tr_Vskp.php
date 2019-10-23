<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Model_Tr_Vskp extends Model_Tr_Skp_Tahunan {

    public function __construct() {
        parent::__construct();
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array("skpt_kegiatan", "pegawai_nip", "pegawai_nama"), 'status = 1', TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

}
