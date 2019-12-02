<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Model_tr_akt
 *
 * @author lahir
 */
class Model_Tr_Akt extends Tr_angka_kredit_tahunan {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function detail_by_id_pegawai_tahun($id_pegawai = FALSE, $tahun = FALSE){
        if($id_pegawai){
            $tahun = $tahun ? $tahun : date('Y');
            
            $where = $this->table_name.".id_pegawai = '".$id_pegawai."' AND ".$this->table_name.".tahun = '".$tahun."'";
            $detail = $this->get_detail($where);
            return $detail;
        }
        return FALSE;
    }
    
}
