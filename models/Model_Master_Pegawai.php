<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

/**
 * Description of Model_Master_Pegawai
 *
 * @author lahir
 */
class Model_Master_Pegawai extends Master_Pegawai {

    const ID_ROLE_PENILAI = 3;
    const ID_ROLE_ARSIPARIS = 4;

    public $by_berita_acara = FALSE;
    public $berita_acara_tahun = FALSE;
    public $berita_acara_by_id_pegawai = FALSE;

    public function __construct() {
        parent::__construct();
    }

    public function set_by_berita_acara() {
        $this->by_berita_acara = TRUE;
    }

    public function unset_by_berita_acara() {
        $this->by_berita_acara = FALSE;
    }
    
    public function set_berita_acara_id_pegawai($id_pegawai = FALSE) {
        $this->berita_acara_by_id_pegawai = $id_pegawai;
    }
    
    public function unset_berita_acara_id_pegawai() {
        $this->berita_acara_by_id_pegawai = FALSE;
    }

    public function set_berita_acara_tahun($tahun = FALSE) {
        if (!$tahun)
            $tahun = date('Y');

        $this->berita_acara_tahun = $tahun;
    }

    private function __get_sql_nilai_kinerja($id_pegawai = FALSE) {

        $condition_id_pegawai = "  ";
        if ($id_pegawai || $this->berita_acara_by_id_pegawai) {
            $id_pegawai = $this->berita_acara_by_id_pegawai ? $this->berita_acara_by_id_pegawai : $id_pegawai;
            $condition_id_pegawai = " skpt.id_pegawai = '" . $id_pegawai . "' AND ";
        }

        $sql_nilai_kinerja = "SELECT "
                . "`skpt`.`id_pegawai`"
                . " , CAST(IF(dp3.perilaku_kepemimpinan IS NOT NULL OR dp3.perilaku_kepemimpinan > 0, ((dp3.perilaku_pelayanan + dp3.perilaku_integritas + dp3.perilaku_komitmen + dp3.perilaku_disiplin + dp3.perilaku_kerjasama + dp3.perilaku_kepemimpinan)/6),((dp3.perilaku_pelayanan + dp3.perilaku_integritas + dp3.perilaku_komitmen + dp3.perilaku_disiplin + dp3.perilaku_kerjasama)/5)) AS DECIMAL(10,2)) nilai_dp3"
                . " , fnilaicapaian(AVG(tsn.real_nilai_biaya), fhitung(AVG(tsn.real_nilai_kualitas), skpt.skpt_kualitas, AVG(tsn.real_nilai_kuantitas), skpt.skpt_kuantitas, AVG(tsn.real_nilai_waktu), skpt.skpt_waktu, AVG(tsn.real_nilai_biaya), skpt.skpt_biaya)) real_capaian "
                . " FROM "
                . "`tr_skp_tahunan` `skpt`LEFT JOIN `tr_skp_nilai` `tsn` "
                . " ON `skpt`.`id_skpt` = `tsn`.`id_skpt` "
                . " AND `tsn`.`current_active` = '1' "
                . " LEFT JOIN `master_pegawai` `p` "
                . " ON `p`.`id_pegawai` = `skpt`.`id_pegawai` "
                . " LEFT JOIN `tr_perilaku` `dp3` "
                . " ON dp3.`id_pegawai` = skpt.`id_pegawai` AND dp3.perilaku_tahun = '" . $this->berita_acara_tahun . "' "
                . " WHERE "
                . $condition_id_pegawai
                . " `skpt`.`skpt_tahun` = '" . $this->berita_acara_tahun . "' AND "
                . " `skpt`.`skpt_status` IN (2, 3) "
                . " GROUP BY `skpt`.`id_skpt`, "
                . " dp3.perilaku_pelayanan, "
                . " dp3.perilaku_integritas, "
                . " dp3.perilaku_komitmen, "
                . " dp3.perilaku_disiplin, "
                . " dp3.perilaku_kerjasama, "
                . " dp3.perilaku_kepemimpinan, "
                . " `p`.`id_pegawai` ";

        $sql_agg = "select id_pegawai, nilai_dp3, AVG(real_capaian) total_capaian, fnilaikinerja(nilai_dp3, AVG(real_capaian)) nilai_kinerja FROM (" . $sql_nilai_kinerja . ") htcapaian GROUP BY id_pegawai, nilai_dp3";


        $this->db->join("(" . $sql_agg . ") AS kin", "kin.id_pegawai = " . $this->table_name . ".id_pegawai", "LEFT");
        $th_lalu = $this->berita_acara_tahun - 1;
        $this->db->join("tr_angka_kredit_tahunan as akkthlalu", "akkthlalu.id_pegawai = " . $this->table_name . ".id_pegawai AND akkthlalu.tahun = '" . $th_lalu . "'", "LEFT");
        $this->db->join("tr_angka_kredit_tahunan as akkthini", "akkthini.id_pegawai = " . $this->table_name . ".id_pegawai AND akkthini.tahun = '" . $this->berita_acara_tahun . "'", "LEFT");

        $this->db->join("backbone_user_role bur", "bur.id_user = ".$this->table_name.".id_user and bur.id_role = '".self::ID_ROLE_ARSIPARIS."'");

        $this->db->join("master_rekomendasi mrek", "mrek.id_rekomendasi = akkthini.id_rekomendasi", "LEFT");
        $this->db->select("kin.nilai_dp3, kin.total_capaian, kin.nilai_kinerja, akkthlalu.akk as akkthlalu");
        $this->db->select("akkthini.id_akt as id_akt_ini, akkthini.ak_sebelumnya as ak_sebelumnya_ini, akkthini.nilaikinerja as nilaikinerja_ini, akkthini.akt as akt_ini, akkthini.akk as akk_ini, akkthini.id_rekomendasi as id_rekomendasi_ini, mrek.uraian_rekomendasi");
    }

//    protected function before__get_all() {
    protected function before__get_where() {
        if (!$this->by_berita_acara) {
            return;
        }

        $this->__get_sql_nilai_kinerja();
    }
    
    public function before_show_detail($id = FALSE, $record_active = TRUE) {
        if (!$this->by_berita_acara) {
            return;
        }
        
        $this->__get_sql_nilai_kinerja();
    }

    public function all($force_limit = FALSE, $force_offset = FALSE, $condition = FALSE) {
        return parent::get_all(array(
                    "pegawai_nip", "pegawai_nama"
                        ), $condition, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }
    
    public function all_bap(){
        return parent::get_all(array(
                    "pegawai_nip", "pegawai_nama"
                        ), FALSE, FALSE, TRUE);
    }

    public function get_all_pegawai() {
        $condition = FALSE;
//        if ($id_organisasi) {
//            $condition = $this->table_name . ".id_organisasi = '" . $id_organisasi . "'";
//        }
        return parent::get_all(array(), $condition);
    }

    /**
     * 
     * @param int $id_pegawai
     * @param int $id_opd
     * @return mixed
     */
    public function get_pegawai_by_id($id_pegawai = FALSE, $id_opd = FALSE) {
        $data = FALSE;
        if ($id_pegawai) {
            $where = $this->table_name . ".id_pegawai = '" . $id_pegawai . "'";
//            if ($id_opd) {
//                $where .= " AND " . $this->table_name . ".id_organisasi = '" . $id_opd . "'";
//            }
            $data = $this->get_detail($where);
        }
        return $data;
    }

    public function get_pegawai_by_id_user($id_user = FALSE, $id_opd = FALSE) {
        $data = FALSE;
        if ($id_user) {
            $where = $this->table_name . ".id_user = '" . $id_user . "'";
//            if ($id_opd) {
//                $where .= " AND " . $this->table_name . ".id_organisasi = '" . $id_opd . "'";
//            }
            $data = $this->get_detail($where);
        }
        return $data;
    }

    public function get_pegawai_by_nip($pegawai_nip = FALSE) {
        if (!$pegawai_nip) {
            return FALSE;
        }

        $where = $this->table_name . ".pegawai_nip = '" . $pegawai_nip . "'";
        $data = $this->get_detail($where);
        return $data;
    }

    public function get_pegawai_by_role_penilai($force_limit = FALSE, $force_offset = FALSE, $condition = FALSE) {
        $this->db->join("backbone_user_role bur", $this->table_name . ".id_user = bur.id_user and bur.id_role = '" . self::ID_ROLE_PENILAI . "'");
        return parent::get_all(array(
                    "pegawai_nip", "pegawai_nama"
                        ), $condition, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
    }

    public function get_by_opd($id_opd) {
        $this->db->where($this->table_name . ".record_active = 1");
        return $this->get_where("id_organisasi = '" . $id_opd . "'");
    }

    public function get_nip_by_opd($id_opd) {
        return $this->get_where("id_organisasi = '" . $id_opd . "'", "pegawai_nip");
    }

    public function get_like($keyword = FALSE) {
        $result = FALSE;
        if ($keyword) {
            $this->db->order_by("pegawai_nama", "asc");
            $this->db->where(" lower(" . $this->table_name . ".pegawai_nip) LIKE lower('%" . $keyword . "%') OR lower(" . $this->table_name . ".pegawai_nama) LIKE lower('%" . $keyword . "%')", NULL, FALSE);
            $result = $this->get_where();
        }
        return $result;
    }

    public function get_like_audien($keyword = FALSE, $is_not_this_id = FALSE) {
        $result = FALSE;
        if ($keyword) {
            $this->db->order_by("pegawai_nama", "asc");
            $condition = " (lower(" . $this->table_name . ".pegawai_nip) LIKE lower('%" . $keyword . "%') OR lower(" . $this->table_name . ".pegawai_nama) LIKE lower('%" . $keyword . "%'))";
//            $condition .= " AND " . $this->table_name . ".id_penilai IS NULL ";
            $condition .= " AND " . $this->table_name . ".jml_penilai < '3' ";
            if ($is_not_this_id) {
                $condition .= " AND  " . $this->table_name . ".id_user <> '" . $is_not_this_id . "'";
            }
            $this->db->where($condition, NULL, FALSE);
            $result = $this->get_where();
        }
        return $result;
    }

    /**
     * @obsolete since 03 nov 2019
     * @param type $id_user
     * @param type $id_penilai
     * @return type
     */
    public function add_remove_penilai($id_user = FALSE, $id_penilai = NULL) {
        $this->db->set('id_penilai', $id_penilai);
        if (is_null($id_penilai)) {
            $this->db->where('id_user', $id_user);
        } else {
            $this->db->where('id_pegawai', $id_user);
        }
        $this->db->update($this->table_name);
        return;
    }

    /**
     * 
     * @param type $record_audien
     * @param type $operation addition or subtraction
     */
    public function update_jml_penilai($record_audien = FALSE, $operation = 'addition') {
        if ($record_audien) {
            if ($operation == 'addition') {
                $this->db->set('jml_penilai', ($record_audien->jml_penilai + 1));
            } elseif ($operation == 'subtraction') {
                $this->db->set('jml_penilai', ($record_audien->jml_penilai - 1));
            }
            $this->db->where('id_pegawai', $record_audien->id_pegawai);
            $this->db->update($this->table_name);
        }
        return $record_audien;
    }

    public function get_role_id_by_role_name($role_name = FALSE, $additional_condition = FALSE) {
        if ($role_name) {
            $pg_array = to_pg_array($role_name);

            if ($additional_condition) {
                $this->db->where($additional_condition);
            }

            $response = $this->get_where("nama_role = any('" . $pg_array . "')", "id_role", "id_role", FALSE, "sc_master.backbone_role");
//            echo $this->db->last_query();exit;
            return $response;
        }
        return FALSE;
    }

    public function get_all_bawahan_by_nip($all_nip_bawahan) {
        $conditions = $this->table_name . ".pegawai_nip in ('" . $all_nip_bawahan . "')";
        return $this->get_all(array("pegawai_nip", "pegawai_nama"), $conditions, TRUE);
    }

    public function get_all_perilaku_bawahan($all_nip_bawahan, $tahun = 0, $bulan = 0) {
        $keyword = $this->get_keyword();
        $this->db->select('p.id_pegawai,p.pegawai_nip,p.pegawai_nama,(case when tp.perilaku_kepemimpinan > 0 then (tp.perilaku_pelayanan + tp.perilaku_integritas + tp.perilaku_komitmen + tp.perilaku_disiplin + tp.perilaku_kerjasama + tp.perilaku_kepemimpinan)/6'
                . ' else (tp.perilaku_pelayanan + tp.perilaku_integritas + tp.perilaku_komitmen + tp.perilaku_disiplin + tp.perilaku_kerjasama)/5 end) as tpn');
        $this->db->join('tr_perilaku tp', 'tp.id_pegawai = p.id_pegawai and tp.perilaku_tahun = ' . $tahun . ' and tp.perilaku_bulan = ' . $bulan, 'left');
        if ($keyword) {
            $this->db->where($this->get_keyword_where(array('pegawai_nama')));
        }
        $this->db->where("p.pegawai_nip in ('" . $all_nip_bawahan . "')");
        $query = $this->db->get($this->table_name . ' p');
        return (object) array(
                    "record_set" => $query->result(),
                    "record_found" => $query->num_rows(),
                    "keyword" => $keyword
        );
    }

    public function get_all_perilaku_bawahan__backup($all_nip_bawahan, $tahun = 0, $bulan = 0) {
        $keyword = $this->get_keyword();
        $this->db->select('p.id_pegawai,p.pegawai_nip,p.pegawai_nama');
        $this->db->select('(tp.perilaku_pelayanan + tp.perilaku_integritas + tp.perilaku_komitmen + tp.perilaku_disiplin + tp.perilaku_kerjasama + tp.perilaku_kepemimpinan)/6 as tpn');
        $this->db->join('sc_ppk.tr_perilaku tp', 'tp.id_pegawai = p.id_pegawai and tp.perilaku_tahun = ' . $tahun . ' and tp.perilaku_bulan = ' . $bulan, 'left');
        if ($keyword) {
            $this->db->where($this->get_keyword_where(array('pegawai_nama')));
        }
        $this->db->where("p.pegawai_nip in ('" . $all_nip_bawahan . "')");
        $query = $this->db->get($this->table_name . ' p');
        return (object) array(
                    "record_set" => $query->result(),
                    "record_found" => $query->num_rows(),
                    "keyword" => $keyword
        );
    }

}
