<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Home
 *
 * @author lahir
 */
class Dupnk extends Skparsiparis_main {

    protected $auto_load_model = TRUE;
    public $model = 'model_dupnk';

    public function __construct() {
        parent::__construct("wel", "Dashboard");
        $this->set('current_base_url', base_url('dupnk'));
//        $this->load->model('model_dupnk');
    }

    public function index() {
        $this->get_attention_message_from_session();
        $this->model_dupnk->change_offset_param("currpage_kelola_dupnk");
        $records = $this->model_dupnk->all();

        $paging_set = $this->get_paging($this->get_current_location(), $records->record_found, $this->default_limit_paging, "kelola_dupnk");
        $this->set('records', $records->record_set);
        $this->set("keyword", $records->keyword);
        $this->set('field_id', $this->model_backbone_modul->primary_key);
        $this->set("paging_set", $paging_set);
        $this->set("header_title", "Master DUPNK");

        $this->set("additional_js", "back_bone/modul/" . $this->_layout . "/js/index_js");

        $this->set("bread_crumb", array(
            "#" => 'Daftar Modul'
        ));

        $this->set("next_list_number", $this->model_dupnk->get_next_record_number_list());
    }

    public function detail($id = FALSE, $posted_data = array()) {
        parent::detail($id, array(
            "kode_nomor",
            "no_dupnk",
            "deskripsi_dupnk",
            "turunan_dari",
            "no_urut",
            "jabfungsional"));
        $this->set('enum_jabatan', $this->model_dupnk->enum_jabatan);
    }

    protected function redirect_after_save_detail($id) {
        redirect('master/' . $this->_name);
    }

    public function get_like_jab() {
        $keyword = $this->input->post("keyword");
        $jabatanfungsional = $this->input->post("jabfung");
        $kelompok_found = $this->model_dupnk->get_like($keyword, $jabatanfungsional);
        $this->to_json($kelompok_found);
    }

}
