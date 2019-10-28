<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tr_skp_nilai extends MY_Model {

    public $sort_by = 'id_skp_nilai';
    public $sort_mode = 'asc';

//    public $master_schema = "sc_master";

    public function __construct() {
        parent::__construct("tr_skp_nilai");
        $this->primary_key = "id_skp_nilai";
        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_skp_nilai" => array("id_skp_nilai", "id_skp_nilai"),
        "id_turunan_dari" => array("id_turunan_dari", "id_turunan_dari"),
        "id_skpt" => array("id_skpt", "id_skpt"),
        "tahun" => array("tahun", "tahun"),
        "real_nilai_kualitas" => array("real_nilai_kualitas", "real_nilai_kualitas"),
        "real_nilai_kuantitas" => array("real_nilai_kuantitas", "real_nilai_kuantitas"),
        "reject_by_pegawai" => array("reject_by_pegawai", "reject_by_pegawai"),
        "penilai_message" => array("penilai_message", "penilai_message"),
        "pegawai_message" => array("pegawai_message", "pegawai_message"),
        "current_active" => array("current_active", "current_active"),
    );
    protected $rules = array(
        array("id_turunan_dari", ""),
        array("id_skpt", "required|integer"),
        array("tahun", "required|integer"),
        array("real_nilai_kualitas", ""),
        array("real_nilai_kuantitas", ""),
        array("reject_by_pegawai", ""),
        array("penilai_message", ""),
        array("pegawai_message", ""),
        array("current_active", ""),
    );
    protected $related_tables = array();
    protected $attribute_types = array();

}
