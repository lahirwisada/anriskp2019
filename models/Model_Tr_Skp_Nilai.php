<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Model_Tr_Skp_Nilai
 *
 * @author lahir
 */
class Model_Tr_Skp_Nilai extends Tr_skp_nilai {

    public function __construct() {
        parent::__construct();
    }

    public function all($id_skpt = FALSE, $force_limit = FALSE, $force_offset = FALSE) {
        if(!$id_skpt){
            return FALSE;
        }
        return parent::get_all(array("penilaian_message", "pegawai_message"), "id_skpt = '".$id_skpt."'", TRUE, FALSE, 1, TRUE, $force_limit, $force_offset, "id_skp_nilai desc");
    }
    
    protected function before_data_insert($data = FALSE) {
        $this->db->set('current_active', 0);
        $this->db->where('id_skpt', $data["id_skpt"]);
        $this->db->update($this->table_name);
        return $data;
    }
}
