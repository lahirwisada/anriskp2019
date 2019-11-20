<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Tr_Vskp extends Model_Tr_Skp_Tahunan {

    public function __construct() {
        parent::__construct();
    }

    protected function before_get_persetujuan() {
        $this->related_tables["tr_skp_nilai"] = array(
            "fkey" => "id_skpt",
            "columns" => array(
                array("id_skp_nilai", "id_skp_nilai"),
                array("real_nilai_kualitas", "real_nilai_kualitas"),
                array("real_nilai_kuantitas", "real_nilai_kuantitas"),
                array("real_output", "real_output"),
                array("real_nilai_waktu", "real_nilai_waktu"),
                array("real_nilai_biaya", "real_nilai_biaya"),
                array("penilai_message", "penilai_message"),
                array("pegawai_message", "pegawai_message"),
//                array("current_active", "current_active"),
            ),
            "conditions" => array("current_active = 1"),
            "referenced" => "LEFT"
        );
        $sql = "IFNULL(real_nilai_kualitas, 0) as telahdinilai";
        $this->db->select($sql);
        $this->db->where("is_tugas_tambahan = 0");
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array("skpt_kegiatan", "pegawai_nip", "pegawai_nama"), 'status = 1', TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

}
