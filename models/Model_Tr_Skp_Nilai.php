<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Model_Tr_Skp_Nilai
 *
 * @author lahir
 */
class Model_Tr_Skp_Nilai extends Tr_skp_nilai {

    public $active_module = 'default';
    public $set_optional_attributes = array();

    public function __construct() {
        parent::__construct();
    }

    protected function before_get_data_post() {
        if ($this->active_module == 'pskp') {

            if (array_key_exists('cip', $_POST)) {
                $_POST['id_pegawai_penilai'] = extract_id_with_salt($this->input->get_post('cip'));
            }
        }
    }

    public function all($id_skpt = FALSE, $id_penilai = FALSE, $force_limit = FALSE, $force_offset = FALSE) {
        if (!$id_skpt || !$id_penilai) {
            return FALSE;
        }
        return parent::get_all(array("penilaian_message", "pegawai_message"), "id_skpt = '" . $id_skpt . "' and id_pegawai_penilai = '" . $id_penilai . "'", TRUE, FALSE, 1, TRUE, $force_limit, $force_offset, "id_skp_nilai desc");
    }
    
    public function audien_all($id_skpt = FALSE, $force_limit = FALSE, $force_offset = FALSE) {
        if (!$id_skpt) {
            return FALSE;
        }
        return parent::get_all(array("penilaian_message", "pegawai_message"), "id_skpt = '" . $id_skpt . "'", TRUE, FALSE, 1, TRUE, $force_limit, $force_offset, "id_skp_nilai desc");
    }

    protected function before_data_insert($data = FALSE) {
//        $confirm_notfirst_record = $this->get_where("id_skpt = '" . $data["id_skpt"] . "' and id_pegawai_penilai = '" . $data["id_pegawai_penilai"] . "'");
//
//        if ($confirm_notfirst_record) {
        $this->db->set('current_active', 0);
        $this->db->where('id_pegawai_penilai', $data["id_pegawai_penilai"]);
        $this->db->where('id_skpt', $data["id_skpt"]);
        $this->db->update($this->table_name);
//        }
        return $data;
    }

}
