<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tr_perilaku extends MY_Model {

    public $sort_by = 'id_perilaku';
    public $sort_mode = 'desc';

//    public $master_schema = "sc_master";

    public function __construct() {
        parent::__construct("tr_perilaku");
        $this->primary_key = "id_perilaku";
        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_perilaku" => array("id_perilaku", "ID Perilaku"),
        "id_pegawai" => array("id_pegawai", "ID Pegawai"),
        "perilaku_tahun" => array("perilaku_tahun", "Perilaku Tahun"),
        "perilaku_pelayanan" => array("perilaku_pelayanan", "Perilaku Pelayanan"),
        "perilaku_integritas" => array("perilaku_integritas", "Perilaku Integritas"),
        "perilaku_komitmen" => array("perilaku_komitmen", "Perilaku Komitmen"),
        "perilaku_disiplin" => array("perilaku_disiplin", "Perilaku Disiplin"),
        "perilaku_kerjasama" => array("perilaku_kerjasama", "Perilaku Kerjasama"),
        "perilaku_kepemimpinan" => array("perilaku_kepemimpinan", "perilakuK epemimpinan"),
    );
    protected $rules = array(
        array("id_pegawai", ""),
        array("perilaku_tahun", "required|integer"),
        array("perilaku_pelayanan", "required|integer"),
        array("perilaku_integritas", "required|integer"),
        array("perilaku_komitmen", "required|integer"),
        array("perilaku_disiplin", "required|integer"),
        array("perilaku_kerjasama", "required|integer"),
        array("perilaku_kepemimpinan", "required|integer"),
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
    );
    protected $attribute_types = array();

}
