<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Model_Tr_Perilaku
 *
 * @author lahir
 */
class Model_Tr_Perilaku extends Tr_perilaku {

    public function __construct() {
        parent::__construct();
    }

    public function all($id_skpt = FALSE, $force_limit = FALSE, $force_offset = FALSE) {
        if(!$id_skpt){
            return FALSE;
        }
        return parent::get_all(array("penilaian_message", "pegawai_message"), "id_skpt = '".$id_skpt."'", TRUE, FALSE, 1, TRUE, $force_limit, $force_offset, "id_skp_nilai desc");
    }
    
    public function check_data($id_pegawai, $tahun) {
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->where('perilaku_tahun', $tahun);
        $query = $this->db->get($this->table_name);
        return $query->num_rows() > 0 ? $query->row(0)->id_perilaku : FALSE;
    }
    
    public function get_perilaku_by_id($id_pegawai, $tahun) {
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->where('perilaku_tahun', $tahun);
        $query = $this->db->get($this->table_name);
        return $query->num_rows() > 0 ? $query->row(0) : FALSE;
    }
}
