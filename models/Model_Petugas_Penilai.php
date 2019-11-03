<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

/**
 * Description of Model_Master_Pegawai
 *
 * @author lahir
 */
class Model_Petugas_Penilai extends Tr_petugas_penilai {

    const ID_ROLE_PENILAI = 3;

    public function __construct() {
        parent::__construct();
    }

    public function all($force_limit = FALSE, $force_offset = FALSE, $condition = FALSE) {
        return parent::get_all(array(
                    "audiens_nip", "audiens_nama"
                        ), $condition, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

    public function get_all_pegawai() {
        $condition = FALSE;
//        if ($id_organisasi) {
//            $condition = $this->table_name . ".id_organisasi = '" . $id_organisasi . "'";
//        }
        return parent::get_all(array(), $condition);
    }

    public function add_remove_penilai($id_audien = FALSE, $id_penilai = NULL, $remove = FALSE) {

        $confirm_false = $this->get_detail($this->table_name.".id_audien = '" . $id_audien . "' and ".$this->table_name.".id_penilai = '" . $id_penilai . "'");

        if (!$confirm_false && !$remove) {

            $this->id_audien = $id_audien;
            $this->id_penilai = $id_penilai;

            return parent::save();
        }
        
        if($remove){
            
        }
        return FALSE;
    }
    
    public function before_combobox_get($cb_args){
        $this->db->join("master_pegawai mp", "mp.id_pegawai = ".$this->table_name.".id_audien", "LEFT");
    }
    
    public function get_petugas_by_id_audien($id_pegawai = FALSE){
        if(!$id_pegawai){
            return FALSE;
        }
        
        return $this->get_where("id_audien = '".$id_pegawai."'", "id_penilai");
    }

}
