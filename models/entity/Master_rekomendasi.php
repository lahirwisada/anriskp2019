<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Master_rekomendasi extends MY_Model {

    public $sort_by = 'id_rekomendasi';
    public $sort_mode = 'desc';

//    public $master_schema = "sc_master";

    public function __construct() {
        parent::__construct("master_rekomendasi");
        $this->primary_key = "id_rekomendasi";
        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_rekomendasi" => array("id_rekomendasi", "id_rekomendasi"),
        "uraian_rekomendasi" => array("uraian_rekomendasi", "uraian_rekomendasi"),
        "keyword" => array("keyword", "keyword"),
    );
    protected $rules = array(
        array("uraian_rekomendasi", ""),
        array("keyword", ""),
    );
    protected $related_tables = array();
    protected $attribute_types = array();

}
