<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Master_Pegawai
 *
 * @author lahir
 */
class Master_Pegawai extends MY_Model {

    public $sort_by = 'pegawai_nama';
    public $sort_mode = 'asc';

    public function __construct() {
        parent::__construct("master_pegawai");
        $this->primary_key = "id_pegawai";
        $this->attribute_labels = array_merge_recursive($this->_continuously_attribute_label, $this->attribute_labels);
        $this->rules = array_merge_recursive($this->_continuously_rules, $this->rules);
    }

    protected $attribute_labels = array(
        "id_pegawai" => array("id_pegawai", "ID Pegawai"),
        "id_user" => array("id_user", "ID User"),
        "id_penilai" => array("id_penilai", "ID Penilai"),
        "jml_penilai" => array("jml_penilai", "Jumlah Penilai"),
        "pegawai_nip" => array("pegawai_nip", "NIP Pegawai"),
        "pegawai_nama" => array("pegawai_nama", "Nama Pegawai"),
        "jabfungsional" => array("jabfungsional", "Jabatan"),
        "tmtjabfungsional" => array("tmtjabfungsional", "TMT Jabatan"),
        "nokarpeg" => array("nokarpeg", "No Kartu Pegawai"),
        "tempatlahir" => array("tempatlahir", "Tempat Lahir"),
        "tgllahir" => array("tgllahir", "Tanggal Lahir"),
        "pangkat" => array("pangkat", "Pangkat"),
        "golongan" => array("golongan", "Golongan"),
        "tmtpangkat_gol" => array("tmtpangkat_gol", "TMT Pangkat Gol"),
        "jeniskelamin" => array("jeniskelamin", "Jenis Kelamin"),
        "unitkerja" => array("unitkerja", "Unit Kerja"),
        "foto" => array("foto", "Foto"),
    );
    protected $rules = array(
        array("pegawai_nip", "required|numeric|min_length[3]|max_length[20]"),
        array("pegawai_nama", "required|min_length[3]|max_length[50]"),
        array("jabfungsional", "required|min_length[3]|max_length[50]"),
//        array("kode_jabatan", "required|is_natural_no_zero"),
//        array("kode_organisasi", "required|is_natural_no_zero"),
        array("id_user", "required|is_natural_no_zero"),
        array("id_penilai", "required|is_natural_no_zero"),
        array("jml_penilai", ""),
        array("tmtjabfungsional", ""),
        array("nokarpeg", "max_length[50]"),
        array("tempatlahir", "max_length[90]"),
        array("tgllahir", ""),
        array("pangkat", "max_length[20]"),
        array("golongan", "max_length[20]"),
        array("tmtpangkat_gol", ""),
        array("jeniskelamin", ""),
        array("unitkerja", "max_length[300]"),
        array("foto", ""),
    );
    
    protected $default_rules = array(
        array("pegawai_nip", "required|numeric|min_length[3]|max_length[20]"),
        array("pegawai_nama", "required|min_length[3]|max_length[50]"),
        array("jabfungsional", "required|min_length[3]|max_length[50]"),
//        array("kode_jabatan", "required|is_natural_no_zero"),
//        array("kode_organisasi", "required|is_natural_no_zero"),
        array("id_user", "required|is_natural_no_zero"),
        array("id_penilai", "required|is_natural_no_zero"),
        array("jml_penilai", ""),
        array("tmtjabfungsional", ""),
        array("nokarpeg", "max_length[50]"),
        array("tempatlahir", "max_length[90]"),
        array("tgllahir", ""),
        array("pangkat", "max_length[20]"),
        array("golongan", "max_length[20]"),
        array("tmtpangkat_gol", ""),
        array("jeniskelamin", ""),
        array("unitkerja", "max_length[300]"),
        array("foto", ""),
    );
    
    protected $info_rules = array(
        array("jml_penilai", ""),
        array("tmtjabfungsional", ""),
        array("nokarpeg", "max_length[50]"),
        array("tempatlahir", "max_length[90]"),
        array("tgllahir", ""),
        array("pangkat", "max_length[20]"),
        array("golongan", "max_length[20]"),
        array("tmtpangkat_gol", ""),
        array("jeniskelamin", ""),
        array("unitkerja", "max_length[300]"),
        array("foto", ""),
    );
//    public $attr_not_null = array(
//        "is_guru" => '0'
//    );

    protected $related_tables = array();
    
    protected $attribute_types = array(
        "tmtjabfungsional" => "DATE",
        "tgllahir" => "DATE",
        "tmtpangkat_gol" => "DATE",
    );

}
