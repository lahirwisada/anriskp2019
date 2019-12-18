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
        "uraian_tgs_tambahan" => array("uraian_tgs_tambahan", "Uraian Tugas Tambahan"),
        "is_tugas_tambahan" => array("is_tugas_tambahan", "Tugas Tambahan"),
        "skpt_tahun" => array("skpt_tahun", "Periode Tahun"),
        "skpt_waktu" => array("skpt_waktu", "Lama Kegiatan"),
        "skpt_kuantitas" => array("skpt_kuantitas", "Kuantitas Output"),
        "skpt_output" => array("skpt_output", "Jenis Output"),
        "skpt_kualitas" => array("skpt_kualitas", "Kualitas Output"),
        "skpt_kredit" => array("skpt_kredit", "Kredit Kegiatan"),
        "skpt_biaya" => array("skpt_biaya", "Biaya Kegiatan"),
        "skpt_status" => array("skpt_status", "Status Kegiatan"),
        "bukti_kerja" => array("bukti_kerja", "Bukti Kerja"),
        "skpt_real_kuantitas" => array("skpt_real_kuantitas", "skpt_real_kuantitas"),
        "skpt_real_output" => array("skpt_real_output", "skpt_real_output"),
        "skpt_real_kualitas" => array("skpt_real_kualitas", "skpt_real_kualitas"),
        "skpt_real_waktu" => array("skpt_real_waktu", "skpt_real_waktu"),
        "upload_random_id" => array("upload_random_id", "upload_random_id"),
        "nilai_tugas_tambahan" => array("nilai_tugas_tambahan", "nilai_tugas_tambahan"),
    );
    
    protected $rules = array(
        array("id_pegawai", "required|integer"),
        array("id_dupnk", "min[10]|max[200]"),
        array("skpt_tahun", "required|integer"),
        array("skpt_waktu", "integer"),
        array("skpt_kuantitas", "integer"),
        array("skpt_output", "integer"),
        array("skpt_kualitas", "integer"),
        array("skpt_kredit", "integer"),
        array("skpt_biaya", "integer"),
        array("skpt_status", "integer"),
        array("bukti_kerja", "max[200]"),
        array("skpt_real_kuantitas", "integer"),
        array("skpt_real_output", "integer"),
        array("skpt_real_kualitas", "integer"),
        array("uraian_tgs_tambahan", ""),
        array("is_tugas_tambahan", "integer"),
        array("skpt_real_waktu", "integer"),
        array("upload_random_id", "max[200]"),
        array("nilai_tugas_tambahan", ""),
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
