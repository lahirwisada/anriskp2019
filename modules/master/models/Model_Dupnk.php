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
        'terampil' => 'Terampil',
        'mahir' => 'Mahir',
        'penyelia' => "Penyelia",
        'pertama' => 'Pertama',
        'muda' => 'Muda',
    );

    public function __construct() {
        parent::__construct();
    }

    public function get_enum_jabatan_as_array() {
        return array_keys($this->enum_jabatan);
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array(
                    "kode_nomor",
                    "deskripsi_dupnk",
                    "jabfungsional",
                    "is_tugastambahan",
                        ), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

    public function get_like($keyword = FALSE, $jabatan_fungsional = FALSE, $is_tugastambahan = FALSE) {
        $result = FALSE;
        $arr_tingkatan = array_keys($this->enum_jabatan);
        
        $alternate_condition_1 = " ";
        $alternate_condition_2 = " ";
        
        $key_found = array_search($jabatan_fungsional, $arr_tingkatan);
        $key_alternate_1 = $key_found;
        $key_alternate_2 = $key_found;
        
        if($key_found > 0){
            $key_alternate_1 = $key_found - 1;
            $alternate_condition_1 = " lower(" . $this->table_name . ".jabfungsional) = lower('" . $arr_tingkatan[$key_alternate_1] . "') OR ";
        }
        
        if($key_found < 4){
            $key_alternate_2 = $key_found + 1;
            $alternate_condition_2 = " lower(" . $this->table_name . ".jabfungsional) = lower('" . $arr_tingkatan[$key_alternate_2] . "') OR ";
        }
        
        if ($keyword) {
            if ($jabatan_fungsional && !is_null($jabatan_fungsional)) {
                $this->db->where("(".$alternate_condition_1." ".$alternate_condition_2." "." lower(" . $this->table_name . ".jabfungsional) = lower('" . $jabatan_fungsional . "'))", NULL, FALSE);
            }
            $this->db->where("( lower(" . $this->table_name . ".kode_nomor) LIKE lower('%" . $keyword . "%') OR  lower(" . $this->table_name . ".deskripsi_dupnk) LIKE lower('%" . $keyword . "%'))", NULL, FALSE);
            
            if($is_tugastambahan !== FALSE){
                $this->db->where($this->table_name.".is_tugastambahan = '".$is_tugastambahan."'");
            }
            
            $this->db->order_by("deskripsi_dupnk", "asc");
            $result = $this->get_where();
        }
        return $result;
    }

}
