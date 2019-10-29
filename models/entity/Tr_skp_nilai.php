<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tr_skp_nilai extends MY_Model {

    public $sort_by = 'id_skp_nilai';
    public $sort_mode = 'desc';

//    public $master_schema = "sc_master";

    public function __construct() {
        parent::__construct("tr_skp_nilai");
        $this->primary_key = "id_skp_nilai";
        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_skp_nilai" => array("id_skp_nilai", "id_skp_nilai"),
        "id_turunan_dari" => array("id_turunan_dari", "Lanjutan Dari Penilaian"),
        "id_skpt" => array("id_skpt", "ID SKPT"),
        "tahun" => array("tahun", "Tahun"),
        "real_nilai_kualitas" => array("real_nilai_kualitas", "Real Kualitas"),
        "real_nilai_kuantitas" => array("real_nilai_kuantitas", "Real Kuantitas"),
        "real_nilai_waktu" => array("real_nilai_waktu", "Real Waktu"),
        "real_nilai_biaya" => array("real_nilai_biaya", "Real Biaya"),
        "real_output" => array("real_output", "Real Output"),
        "reject_by_pegawai" => array("reject_by_pegawai", "Pegawai Menolak"),
        "penilai_message" => array("penilai_message", "Catatan Penilai"),
        "pegawai_message" => array("pegawai_message", "Catatan Pegawai"),
        "current_active" => array("current_active", "Aktiv saat ini"),
    );
    protected $rules = array(
        array("id_turunan_dari", ""),
        array("id_skpt", "required|integer"),
        array("tahun", "required|integer"),
        array("real_nilai_kualitas", ""),
        array("real_nilai_kuantitas", ""),
        array("real_nilai_waktu", ""),
        array("real_nilai_biaya", ""),
        array("real_output", ""),
        array("reject_by_pegawai", ""),
        array("penilai_message", ""),
        array("pegawai_message", ""),
        array("current_active", ""),
    );
    protected $related_tables = array();
    protected $attribute_types = array();

}
