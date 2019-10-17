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

    public $enum_jabatan = array(
        'mahir' => 'Mahir', 
        'muda' => 'Muda', 
        'penyelia' => "Penyelia", 
        'pertama' => 'Pertama', 
        'terampil' => 'Terampil'
    );

    public function __construct() {
        parent::__construct();
    }
    
    public function get_enum_jabatan_as_array(){
        return array_keys($this->enum_jabatan);
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "kode_nomor",
                    "deskripsi_dupnk",
                    "jabfungsional",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

    public function get_like($keyword = FALSE) {
        $result = FALSE;
        if ($keyword) {
//            $this->db->where(" lower(" . $this->table_name . ".aktifitas_kode) LIKE lower('%" . $keyword . "%') OR lower(" . $this->table_name . ".aktifitas_nama) LIKE lower('%" . $keyword . "%')", NULL, FALSE);
            $this->db->where(" lower(" . $this->table_name . ".kode_nomor) LIKE lower('%" . $keyword . "%') OR  lower(" . $this->table_name . ".deskripsi_dupnk) LIKE lower('%" . $keyword . "%')", NULL, FALSE);
            $this->db->order_by("deskripsi_dupnk", "asc");
            $result = $this->get_where();
        }
        return $result;
    }

}
