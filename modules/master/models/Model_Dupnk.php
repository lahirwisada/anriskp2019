<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
} include_once "entity/Master_dupnk.php";

/**
 * Description of Model_Dupnk
 *
 * @author lahir
 */
class Model_Dupnk extends Master_Dupnk {

    public function __construct() {
        parent::__construct();
    }
    
    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "kode_nomor",
                    "deskripsi_dupnk",
                    "jabfungsional",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }
}
