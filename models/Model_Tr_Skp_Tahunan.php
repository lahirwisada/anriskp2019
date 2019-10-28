<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Model_Tr_Skp_Tahunan extends Tr_skp_tahunan {

    public function __construct() {
        parent::__construct();
    }

    public function all($force_limit = FALSE, $force_offset = FALSE) {
        return parent::get_all(array("skpt_kegiatan", "pegawai_nip", "pegawai_nama"), FALSE, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }
    
    public function get_all_skpt($tahun = FALSE) {
        if(!$tahun){
            $tahun = date('Y');
        }
        
        $conditions = array(
            'sc_ppk.tr_skp_tahunan.skpt_tahun = ' . $tahun
        );
        
        return $this->get_all(array("skpt_kegiatan", "pegawai_nip", "pegawai_nama"), $conditions, TRUE, FALSE);
    }

    public function all_skp_plan($id_pegawai = FALSE, $tahun = FALSE, $force_limit = FALSE, $force_offset = FALSE) {
        $conditions = array();
        if ($id_pegawai !== FALSE) {
            $conditions[] = $this->table_name . ".id_pegawai = '" . $id_pegawai . "'";
        }
        if ($tahun !== FALSE) {
            $conditions[] = $this->table_name . ".skpt_tahun = '" . $tahun . "'";
        }
        return parent::get_all(array("deskripsi_dupnk"), $conditions, TRUE, TRUE, 1, TRUE, $force_limit, $force_offset);
    }
    
    protected function after__get_all($records) {
        if($records){
            foreach($records as $key => $record){
                $records[$key]->uploaded_files = FALSE;
                if(!is_null($record->upload_random_id)){
                    $dir = ASSET_UPLOAD . '/'.$record->upload_random_id;
                    if(is_dir($dir)){
                        $records[$key]->uploaded_files = array_diff(scandir($dir), array('..', '.'));
                    }
                }
            }
        }
        return $records;
    }

    public function get_persetujuan($id_bawahan = array(), $tahun = FALSE, $force_limit = FALSE, $force_offset = FALSE) {
//        $conditions[] = $this->table_name . ".skpt_status > 0";
        $conditions[] = $this->table_name . ".skpt_status = 1";
        if ($id_bawahan) {
            $bawahan = is_array($id_bawahan) ? implode(',', $id_bawahan) : $id_bawahan;
            $conditions[] = $this->table_name . ".id_pegawai in (" . $bawahan . ")";
        } else {
            $conditions[] = $this->table_name . ".id_pegawai = 0";
        }
        if ($tahun) {
            $conditions[] = $this->table_name . ".skpt_tahun = '" . $tahun . "'";
        }
        return parent::get_all(array("deskripsi_dupnk", "pegawai_nama", "pegawai_nip"), $conditions, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

    public function get_realisasi_tahunan($id_pegawai = FALSE, $tahun = FALSE, $force_limit = FALSE, $force_offset = FALSE) {
        $this->db->select("skpt.id_skpt,dupnk.deskripsi_dupnk as skpt_kegiatan,skpt.skpt_kuantitas,skpt.skpt_output,skpt.skpt_waktu,skpt.skpt_biaya,skpt.skpt_status,skpt.skpt_kualitas,0 jml");
//        $this->db->select_sum("skpb_real_kuantitas", "real_kuantitas");
//        $this->db->select_sum("skpb_real_biaya", "real_biaya");
//        $this->db->select_sum("skpb_real_kualitas", "real_kualitas");
//        $this->db->select_sum("skpb_hitung", "real_hitung");
//        $this->db->select_sum("skpb_nilai", "real_nilai");
        $this->db->from($this->table_name . " skpt");
        $this->db->join("master_pegawai p", "p.id_pegawai = skpt.id_pegawai", "left");
        $this->db->join("master_dupnk dupnk", "skpt.id_dupnk = dupnk.id_dupnk", "left");
        $this->db->where("skpt.id_pegawai", $id_pegawai);
        $this->db->where("skpt.skpt_tahun", $tahun);
        $this->db->where("skpt.skpt_status in (2,3)");
        $this->db->group_by('skpt.id_skpt');
        $this->db->group_by('p.id_pegawai');
        $query = $this->db->get();
//        print_r($this->db->last_query());
//        var_dump($query);
//        exit();
        return (object) array(
                    "record_set" => $query->num_rows() > 0 ? $query->result() : FALSE,
                    "record_found" => $query->num_rows(),
                    "keyword" => $this->get_keyword()
        );
    }

    public function get_realisasi($id_skpt = FALSE) {
        $this->db->select($this->table_name . '.*', FALSE);
        $this->db->select_sum('skpb_kuantitas', 'kuantitas');
        $this->db->select_sum('skpb_biaya', 'biaya');
        $this->db->select_sum('skpb_real_kuantitas', 'real_kuantitas');
        $this->db->select_sum('skpb_real_biaya', 'real_biaya');
        $this->db->select_sum('skpb_kualitas', 'kualitas');
        $this->db->join($this->schema_name . '.tr_skp_bulanan', $this->schema_name . '.tr_skp_bulanan.id_skpt = ' . $this->table_name . '.id_skpt', 'left');
        $this->db->where($this->table_name . '.id_skpt', $id_skpt);
//        $this->db->where($this->table_name . '.skpt_status >', 1);
        $this->db->where($this->table_name . '.record_active', 1);
        $this->db->group_by($this->table_name . '.id_skpt');
        $query = $this->db->get($this->table_name);
        return $query->num_rows() && $query->num_rows() > 0 ? $query->row() : FALSE;
    }

    public function update_status($id = FALSE, $value = FALSE) {
        $this->db->set('skpt_status', $value);
        $this->db->where('id_skpt', $id);
        $this->db->update($this->table_name);
        return $this->db->affected_rows() > 0 ? TRUE : FALSE;
    }

}
