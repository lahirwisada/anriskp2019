<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tr_skp_tahunan extends MY_Model {

    public $sort_by = 'id_skpt';
    public $sort_mode = 'asc';
//    public $master_schema = "sc_master";

    public function __construct() {
        parent::__construct("tr_skp_tahunan");
        $this->primary_key = "id_skpt";
        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_skpt" => array("id_skpt", "ID SKP Tahunan"),
        "id_pegawai" => array("id_pegawai", "ID Pegawai"),
        "id_dupnk" => array("id_dupnk", "Nama Kegiatan"),
        "skpt_tahun" => array("skpt_tahun", "Periode Tahun"),
        "skpt_waktu" => array("skpt_waktu", "Lama Kegiatan"),
        "skpt_kuantitas" => array("skpt_kuantitas", "Kuantitas Output"),
        "skpt_output" => array("skpt_output", "Jenis Output"),
        "skpt_kualitas" => array("skpt_kualitas", "Kualitas Output"),
        "skpt_kredit" => array("skpt_kredit", "Kredit Kegiatan"),
        "skpt_biaya" => array("skpt_biaya", "Biaya Kegiatan"),
        "skpt_status" => array("skpt_status", "Status Kegiatan"),
        "bukti_kerja" => array("bukti_kerja", "Bukti Kerja")
    );
    protected $rules = array(
        array("id_pegawai", "required|integer"),
        array("id_dupnk", "required|min[10]|max[200]"),
        array("skpt_tahun", "required|integer"),
        array("skpt_waktu", "required|integer"),
        array("skpt_kuantitas", "required|integer"),
        array("skpt_output", "required|integer"),
        array("skpt_kualitas", "required|integer"),
        array("skpt_kredit", "integer"),
        array("skpt_biaya", "required|integer"),
        array("skpt_status", "integer"),
        array("bukti_kerja", ""),
    );
    protected $related_tables = array(
        "master_pegawai" => array(
            "fkey" => "id_pegawai",
            "columns" => array(
                "pegawai_nama",
                "pegawai_nip"
            ),
            "referenced" => "LEFT"
        ),
        "master_dupnk" => array(
            "fkey" => "id_dupnk",
            "columns" => array(
                "deskripsi_dupnk",
                "kode_nomor"
            ),
            "referenced" => "LEFT"
        ),
    );
    protected $attribute_types = array();

}
