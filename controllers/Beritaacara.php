<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Beritaacara extends Skarsiparis_cmain {

    public $model = 'model_tr_skp_tahunan';
    protected $auto_load_model = TRUE;

    public function __construct() {
        parent::__construct('kelola_realisasi_skp_tahunan', 'Berita Acara Tahunan');
//        $this->load->model('model_tr_skp_bulanan');
        $this->load->model(array('model_master_pegawai', 'model_tr_akt'));
    }

    public function index() {
        $this->model = 'model_master_pegawai';


        $tahun = date('Y');

        $this->__reconfigure_model($tahun);

        parent::index();

        $this->set('tahun', $tahun);
    }

    private function __reconfigure_model($tahun = FALSE) {
        $this->model_master_pegawai->set_by_berita_acara();
        $tahun = $tahun ? $tahun : date('Y');
        $this->model_master_pegawai->set_berita_acara_tahun($tahun);
    }

    public function set_rekomendasi($crypt_id_akt = FALSE) {
        $this->model = 'model_tr_akt';

        $id_akt = extract_id_with_salt($crypt_id_akt);
        $id_pegawai = extract_id_with_salt($this->input->get_post('cip'));
        $tahun = $this->input->get_post('tahun');

        $this->__reconfigure_model($tahun);

        $pegawai_detail = FALSE;

        if ($id_pegawai) {
            $pegawai_detail = $this->model_master_pegawai->show_detail($id_pegawai);
        } else {
            redirect('beritaacara');
        }

        /**
         * bagian yg dikoemntari menunggu API dari simpeg
         */
        parent::detail($id_akt, array(
            "id_pegawai",
            "jabfungsional",
//  "tmtjab",
//  "pangkatgol",
//  "tmtpangkatgol",
//  "unitkerja",
//  "idunitkerja",
            "ak_sebelumnya",
            "tahun",
            "nilaikinerja",
            "akt",
            "akk",
            "id_rekomendasi",
        ));

        $this->set('tahun', $tahun);
        $this->set('pegawai_detail', $pegawai_detail);
        $this->set('rekomendasi', $this->get_rs_combobox_rekomendasi());
    }

}
