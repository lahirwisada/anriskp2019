<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Master_dupnk extends MY_Model {

    public $sort_by = 'id_dupnk';
    public $sort_mode = 'asc';

//    public $master_schema = "sc_master";

    public function __construct() {
        parent::__construct("master_dupnk");
        $this->primary_key = "id_dupnk";
        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_dupnk" => array("id_dupnk", "id_dupnk"),
        "kode_nomor" => array("kode_nomor", "kode_nomor"),
        "no_dupnk" => array("no_dupnk", "no_dupnk"),
        "deskripsi_dupnk" => array("deskripsi_dupnk", "deskripsi_dupnk"),
        "turunan_dari" => array("turunan_dari", "turunan_dari"),
        "no_urut" => array("no_urut", "no_urut"),
        "jabfungsional" => array("jabfungsional", "jabfungsional"),
        "is_tugastambahan" => array("is_tugastambahan", "is_tugastambahan"),
    );
    protected $rules = array(
        array("id_dupnk", ""),
        array("kode_nomor", ""),
        array("no_dupnk", ""),
        array("deskripsi_dupnk", ""),
        array("turunan_dari", ""),
        array("no_urut", ""),
        array("jabfungsional", ""),
        array("is_tugastambahan", ""),
    );
    protected $related_tables = array();
    protected $attribute_types = array();

}
