<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_Master_Pegawai
 *
 * @author lahir
 */
class Model_Master_Pegawai  extends Master_Pegawai {

    public function __construct() {
        parent::__construct();
    }

    public function all($force_limit = FALSE, $force_offset = FALSE, $condition = FALSE) {
        return parent::get_all(array(
                    "pegawai_nip", "pegawai_nama"
                        ), $condition, TRUE, FALSE, 1, TRUE, $force_limit, $force_offset);
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
            if ($id_opd) {
                $where .= " AND " . $this->table_name . ".id_organisasi = '" . $id_opd . "'";
            }
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
