<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tr_petugas_penilai extends MY_Model {

    public $sort_by = 'id_petugas_penilai';
    public $sort_mode = 'desc';

//    public $master_schema = "sc_master";

    public function __construct() {
        parent::__construct("tr_petugas_penilai");
        $this->primary_key = "id_petugas_penilai";
        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_petugas_penilai" => array("id_petugas_penilai", "id_petugas_penilai"),
        "id_audien" => array("id_audien", "Audien"), // refer to id_pegawai
        "id_penilai" => array("id_penilai", "Penilai"), // refer to id_pegawai
    );
    protected $rules = array(
        array("id_audien", "integer"),
        array("id_penilai", "integer"),
    );
    protected $related_tables = array(
        "master_pegawai_audiens" => array(
            "table_name" => "master_pegawai",
            "table_alias" => "master_audiens",
            "fkey" => array("id_audien", "id_pegawai"),
            "columns" => array(
                array("pegawai_nama", "audiens_nama"),
                array("pegawai_nip", "audiens_nip"),
            ),
            "referenced" => "LEFT"
        ),
        "master_pegawai_penilai" => array(
            "table_name" => "master_pegawai",
            "table_alias" => "master_penilai",
            "fkey" => array("id_penilai", "id_pegawai"),
            "columns" => array(
                array("pegawai_nama", "penilai_nama"),
                array("pegawai_nip", "penilai_nip"),
            ),
            "referenced" => "LEFT"
        ),
    );
    protected $attribute_types = array();

}
