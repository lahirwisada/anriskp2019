<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Beritaacara extends Skarsiparis_cmain {

    public $model = 'model_tr_skp_tahunan';
    protected $auto_load_model = TRUE;

    public function __construct() {
        parent::__construct('kelola_realisasi_skp_tahunan', 'Berita Acara Tahunan');
//        $this->load->model('model_tr_skp_bulanan');
        $this->load->model('model_master_pegawai');
    }

    public function index() {
        $this->model = 'model_master_pegawai';
        
        $this->model_master_pegawai->set_by_berita_acara();
        $this->model_master_pegawai->set_berita_acara_tahun(date('Y'));
        
        parent::index();
    }
    
    public function set_rekomendasi(){
        
    }

}
