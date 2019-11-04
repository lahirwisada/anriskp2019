<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tr_angka_kredit_tahunan extends MY_Model {

    public $sort_by = 'id_akt';
    public $sort_mode = 'desc';

//    public $master_schema = "sc_master";

    public function __construct() {
        parent::__construct("tr_angka_kredit_tahunan");
        $this->primary_key = "id_akt";
        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_akt" => array("id_akt", "id_akt"),
        "id_pegawai" => array("id_pegawai", "id_pegawai"),
        "jabfungsional" => array("jabfungsional", "jabfungsional"),
        "tmtjab" => array("tmtjab", "tmtjab"),
        "pangkatgol" => array("pangkatgol", "pangkatgol"),
        "tmtpangkatgol" => array("tmtpangkatgol", "tmtpangkatgol"),
        "unitkerja" => array("unitkerja", "unitkerja"),
        "idunitkerja" => array("idunitkerja", "idunitkerja"),
        "ak_sebelumnya" => array("ak_sebelumnya", "ak_sebelumnya"),
        "tahun" => array("tahun", "tahun"),
        "nilaikinerja" => array("nilaikinerja", "nilaikinerja"),
        "akt" => array("akt", "akt"),
        "akk" => array("akk", "akk"),
        "id_rekomendasi" => array("id_rekomendasi", "id_rekomendasi"),
    );
    protected $rules = array(
        array("id_pegawai", ""),
        array("jabfungsional", ""),
        array("tmtjab", ""),
        array("pangkatgol", ""),
        array("tmtpangkatgol", ""),
        array("unitkerja", ""),
        array("idunitkerja", ""),
        array("ak_sebelumnya", ""),
        array("tahun", ""),
        array("nilaikinerja", ""),
        array("akt", ""),
        array("akk", ""),
        array("id_rekomendasi", ""),
    );
    protected $related_tables = array();
    protected $attribute_types = array();

}
