<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of main_controller
 *
 * @author nurfadillah
 */
class Main_controller extends LWS_Controller {

    protected $user_profil = NULL;
    protected $id_pegawai = FALSE;

    public function __construct() {
        parent::__construct();
        $this->is_front_end = FALSE;
        $this->init_skparsiparis_main_controller();
//        $this->grab_another_session();
    }

    public function init_skparsiparis_main_controller() {
        $this->get_jab_fungsional_current_user();
        $this->get_id_pegawai_from_session();
    }

    public function get_id_pegawai_from_session() {
        if ($this->is_authenticated() && is_array($this->user_detail) && array_key_exists("id_pegawai", $this->user_detail)) {
            $this->id_pegawai = $this->user_detail["id_pegawai"];
            $this->set("current_id_pegawai", $this->user_detail["id_pegawai"]);
            return $this->user_detail["id_pegawai"];
        }
        return FALSE;
    }

    public function index() {
        show_404();
    }

    protected function get_bawahan_from_user_detail() {
        $bawahan1 = isset($this->user_detail['bawahan1']) ? $this->user_detail['bawahan1'] : FALSE;
        $bawahan2 = isset($this->user_detail['bawahan2']) ? $this->user_detail['bawahan2'] : FALSE;

        /**
         * PLT
         */
        $bawahan1_plt = isset($this->user_detail['bawahan1_plt']) ? $this->user_detail['bawahan1_plt'] : FALSE;
        $bawahan2_plt = isset($this->user_detail['bawahan2_plt']) ? $this->user_detail['bawahan2_plt'] : FALSE;

        $idx_current_user = $bawahan1 ? array_search($this->user_detail["pegawai_nip"], array_column($bawahan1, "NIP")) : FALSE;

        if ($idx_current_user !== FALSE) {
            unset($bawahan1[$idx_current_user]);
        }

        $bawahan1_all_star = FALSE;
        if ($bawahan1 && $bawahan1_plt) {
            $bawahan1_all_star = array_merge($bawahan1, $bawahan1_plt);
        } elseif (!$bawahan1 && $bawahan1_plt) {
            $bawahan1_all_star = $bawahan1_plt;
        } elseif ($bawahan1 && !$bawahan1_plt) {
            $bawahan1_all_star = $bawahan1;
        }

        $bawahan2_all_star = FALSE;
        if ($bawahan2 && $bawahan2_plt) {
            $bawahan2_all_star = array_merge($bawahan2, $bawahan2_plt);
        } elseif (!$bawahan2 && $bawahan2_plt) {
            $bawahan2_all_star = $bawahan2_plt;
        } elseif ($bawahan2 && !$bawahan2_plt) {
            $bawahan2_all_star = $bawahan2;
        }

        return array($bawahan1_all_star, $bawahan2_all_star);
    }

    protected function get_bawahan() {

        list($bawahan1_all_star, $bawahan2_all_star) = $this->get_bawahan_from_user_detail();

        $arr_bawahan1 = $bawahan1_all_star ? array_column($bawahan1_all_star, 'NIP') : array();
        $arr_bawahan2 = $bawahan2_all_star ? array_column($bawahan2_all_star, 'NIP') : array();

        return array($arr_bawahan1, $arr_bawahan2);
    }

    protected function get_user_detail_from_session() {
        return $this->lmanuser->get("user_detail", $this->my_side);
    }

    protected function get_post_bulan_tahun($ibln = FALSE, $ithn = FALSE, $input_name = array("bln" => "bulan", "thn" => "tahun")) {
        $bln = $this->input->get_post($input_name["bln"], TRUE);
        $thn = $this->input->get_post($input_name["thn"], TRUE);

        if ($ibln && !$bln) {
            $bln = $ibln;
        }

        if ($ithn && !$thn) {
            $thn = $ithn;
        }

        return array($bln, $thn);
    }

    protected function get_rs_combobox_pegawai($action_can_write = FALSE) {
        $this->load->model("model_master_pegawai");
        $query_condition = "";
        if (!$action_can_write || !$this->can_write($action_can_write)) {
//            $query_condition = "id_organisasi = '" . $this->user_detail['id_organisasi'] . "' ";
        }
        return $this->model_master_pegawai->combobox(array(
                    "key" => "id_pegawai",
                    "value" => "value_pegawai",
                    "cb_using_default_value" => TRUE,
                    "record_active_only" => TRUE,
//                    "where" => $query_condition,
                    "custom_select" => "id_pegawai, concat(pegawai_nip,' - ',pegawai_nama) as value_pegawai"
                        )
        );
    }
    
    protected function get_rs_combobox_rekomendasi($action_can_write = FALSE) {
        $this->load->model("model_master_rekomendasi");
        $query_condition = "";
        if (!$action_can_write || !$this->can_write($action_can_write)) {
//            $query_condition = "id_organisasi = '" . $this->user_detail['id_organisasi'] . "' ";
        }
        return $this->model_master_rekomendasi->combobox(array(
                    "key" => "id_rekomendasi",
                    "value" => "uraian_rekomendasi",
                    "cb_using_default_value" => TRUE,
                    "record_active_only" => TRUE,
                    "cb_default_value" => "12",
//                    "where" => $query_condition,
//                    "custom_select" => "id_rekomendasi, uraian_rekomendasi"
                        )
        );
    }

    public function get_like_penilaian_audien() {
        $this->load->model(array("model_master_pegawai", "model_petugas_penilai"));
        $query_condition = $this->model_petugas_penilai->table_name.".id_penilai = '" . $this->user_detail["id_pegawai"] . "'";
        return $this->model_petugas_penilai->combobox(array(
                    "key" => "id_audien",
                    "value" => "value_pegawai",
                    "cb_using_default_value" => TRUE,
                    "record_active_only" => TRUE,
                    "where" => $query_condition,
                    "custom_select" => $this->model_petugas_penilai->table_name.".id_audien, concat(mp.pegawai_nip,' - ',mp.pegawai_nama) as value_pegawai"
                        )
        );
    }

    public function get_like_pegawai_audien() {
        $this->load->model("model_master_pegawai");
        $keyword = $this->input->post("keyword");
        $id_user = extract_id_with_salt($this->input->post("pid"));

        $data_found = $this->model_master_pegawai->get_like_audien($keyword, $id_user);
        $this->to_json($data_found);
    }
    
    public function get_like_pegawai_all_not_self() {
        $this->load->model("model_master_pegawai");
        $keyword = $this->input->post("keyword");
        $id_user = extract_id_with_salt($this->input->post("pid"));

        $data_found = $this->model_master_pegawai->get_like($keyword, $id_user);
        
        $this->to_json($data_found);
    }

    protected function get_post_nip($inip = FALSE) {
        $nip = $this->input->get_post('nip', TRUE);
        if ($inip && !$nip) {
            $nip = $inip;
        }

        return $nip;
    }

    protected function get_post_bln_thn_nip($ibln = FALSE, $ithn = FALSE, $inip = FALSE) {
        list($bln, $thn) = $this->get_post_bulan_tahun($ibln, $ithn);
        $nip = $this->get_post_nip($inip);

        return array($bln, $thn, $nip);
    }

    protected function redirect_with_message($message_error, $redirect_to) {
        $params_cb = "";
        if (stripos($redirect_to, '?') !== FALSE) {
            $redirect_to = explode('?', $redirect_to, 2);
            $params_cb = ( isset($redirect_to[1]) && trim($redirect_to[1]) != "" ? trim($redirect_to[1]) . '&' : "" );
            $redirect_to = $redirect_to[0];
        }
        $url = $redirect_to . '?' . $params_cb . http_build_query([
                    'ref' => 'apik',
                    'msg' => $message_error,
                    'data' => base64_encode(json_encode(['session' => $_SESSION, 'result' => strip_tags($this->attention_messages)]))
        ]);
        header('Location: ' . $url);
        exit;
    }

    protected function __get_last_upacara() {
        $last = $this->db->order_by('upacara_tanggal', 'desc')->get('sc_presensi.master_upacara', 1);
        return $last->num_rows() > 0 ? $last->row() : FALSE;
    }

    protected function check_is_cron() {
//        return $this->input->is_cli_request();
        return FALSE;
    }

//    protected function after_check_is_authenticated($is_auth) {
////        $called_class = get_called_class();
//        var_dump(base_url('login'));exit;
//        if (!$is_auth && !$this->check_is_cron()) {
//            
//            header('Location: ' . base_url('login'));
//            exit;
//        }
//
//        return $is_auth;
//    }

    protected function after_login_success($replace_redirect = "") {
//        if (@file_get_contents($this->user_profil->foto_url, 0, NULL, 0, 1)) {
//            $this->lmanuser->set_user_detail('user_foto', $this->user_profil->foto_url);
//        }
//
//        $this->lmanuser->set_user_detail('nama_jabatan', $this->user_profil->user->nama_jabatan);
//        $this->lmanuser->set_user_detail('nama_organisasi', $this->user_profil->user->nama_organisasi);
        //if (!empty($this->user_profil->atasan)) {
//            $atasan = array();
//            foreach ($this->user_profil->atasan as $row) {
//                $a = array_map('trim', array_keys((array) $row));
//                $b = array_map('trim', (array) $row);
//                $atasan[] = array_combine($a, $b);
//            }
//            if (isset($this->user_profil->atasan[0])) {
//                $this->lmanuser->set_user_detail('atasan_langsung', (array) $this->user_profil->atasan[0]);
//            }
//            if (isset($this->user_profil->atasan[1])) {
//                $this->lmanuser->set_user_detail('atasan_atasan', (array) $this->user_profil->atasan[1]);
//            }
        //}

        /**
          if (!empty($this->user_profil->bawahan1)) {
          $bawahan1 = array();
          foreach ($this->user_profil->bawahan1 as $bawahan) {
          $bawahan1[] = (array) $bawahan;
          }
          $this->lmanuser->set_user_detail('bawahan1', $bawahan1);
          }
          if (!empty($this->user_profil->bawahan2)) {
          $bawahan2 = array();
          foreach ($this->user_profil->bawahan2 as $bawahan) {
          $bawahan2[] = (array) $bawahan;
          }
          $this->lmanuser->set_user_detail('bawahan2', $bawahan2);
          }
          if (!empty($this->user_profil->bawahan1_plt)) {
          $bawahan2 = array();
          foreach ($this->user_profil->bawahan1_plt as $bawahan) {
          $bawahan2[] = (array) $bawahan;
          }
          $this->lmanuser->set_user_detail('bawahan1_plt', $bawahan2);
          }
          if (!empty($this->user_profil->bawahan2_plt)) {
          $bawahan2 = array();
          foreach ($this->user_profil->bawahan2_plt as $bawahan) {
          $bawahan2[] = (array) $bawahan;
          }
          $this->lmanuser->set_user_detail('bawahan2_plt', $bawahan2);
          }
         * 
         */
        if ($replace_redirect && trim($replace_redirect) != "") {
            $params_cb = "";
            if (stripos($replace_redirect, '?') !== FALSE) {
                $replace_redirect = explode('?', $replace_redirect, 2);
                $params_cb = ( isset($replace_redirect[1]) && trim($replace_redirect[1]) != "" ? trim($replace_redirect[1]) . '&' : "" );
                $replace_redirect = $replace_redirect[0];
            }
            $url = $replace_redirect . '?' . $params_cb . http_build_query([
                        'ref' => 'apik',
                        'msg' => 'Login dari Lasik v2 Sukses!',
                        'data' => base64_encode(json_encode(['session' => md5(json_encode($_SESSION))]))
            ]);
        } else {
            $url = SERVER_LOCATION;
        }
        header('Location: ' . $url);
        exit;
    }

    protected function get_jab_fungsional_current_user() {
        if ($this->is_authenticated() && is_array($this->user_detail) && array_key_exists("jabfungsional", $this->user_detail)) {
            $this->set("current_jab_fungsional", $this->user_detail["jabfungsional"]);
            $this->set("current_foto", $this->user_detail["foto"]);
            return $this->user_detail["jabfungsional"];
        }
        return FALSE;
    }

    protected function __registering_login($login, $username, $password, $auto_login = FALSE) {
        $login_success = FALSE;

        $data_simpeg = $login['data'];
        $this->load->model(array('model_user', 'model_backbone_user', 'model_backbone_user_role', 'model_backbone_profil', 'model_master_pegawai'));
        $ada = $this->model_user->get_user_detail_username($username);


        if (!(isset($data_simpeg->user->id_organisasi) && $data_simpeg->user->id_organisasi > 0)) {
            redirect("/");
        }
        $this->load->model('model_master_organisasi');
        $data_organisasi = $this->model_master_organisasi->get_organisasi_by_id($data_simpeg->user->id_organisasi);
        if (!$data_organisasi) {
            $this->model_master_organisasi->data_insert(array(
                "id_organisasi" => $data_simpeg->user->id_organisasi,
                "nama_organisasi" => $data_simpeg->user->nama_organisasi,
                "tahun" => date('Y')
            ));
        }

        if (!$ada) {
            $user_data = array(
                'username' => $username,
                'password' => $this->lmanuser->generate_password($username, $password)
            );
            $id_user = $this->model_backbone_user->data_insert($user_data);
            $profil_data = array(
                'id_user' => $id_user,
                'nama_profil' => $data_simpeg->user->nama,
                'email_profil' => NULL
            );
            $id_profil = $this->model_backbone_profil->data_insert($profil_data);
            $pegawai_data = array(
                'pegawai_id' => $data_simpeg->user->id,
                'id_profil' => $id_profil,
                'pegawai_nip' => $username,
                'pegawai_nama' => $data_simpeg->user->nama,
                'id_organisasi' => $data_simpeg->user->id_organisasi
            );
            $this->model_master_pegawai->data_insert($pegawai_data);
            $this->model_backbone_user_role->save($id_user, 5);
            if (!empty($data_simpeg->bawahan1) || !empty($data_simpeg->bawahan2)) {
                $this->model_backbone_user_role->save($id_user, 4);
            }
        } else {
            if (!empty($data_simpeg->bawahan1) || !empty($data_simpeg->bawahan2)) {
                $roles_atasan = $this->model_backbone_user_role->get_where('id_user = ' . $ada->id_user . ' AND id_role = 4');
                if (!$roles_atasan) {
                    $this->model_backbone_user_role->save($ada->id_user, 4);
                }
            }
            if ($data_simpeg->user->nama != $ada->nama_profil || $data_simpeg->user->id_organisasi != $ada->id_organisasi) {
                $data_pegawai = array(
                    'nama_profil' => $data_simpeg->user->nama,
                    'id_organisasi' => $data_simpeg->user->id_organisasi
                );
                $this->model_master_pegawai->data_update($data_pegawai, 'pegawai_id = ' . $ada->pegawai_id);
            }
        }
        $this->user_profil = $data_simpeg;

        if ($auto_login) {
            $this->model_user->auto_login = TRUE;
        }

        $this->model_user->set_login_rules();

        if ($this->model_user->get_data_post()) {
            if ($this->model_user->login($this->my_side)) {
                $login_success = TRUE;
            } else {
                if ($ada && $login['status'] == 1) {
                    $id_user = $ada->id_user;
                    $user_data = array(
                        'username' => $username,
                        'password' => $this->lmanuser->generate_password($username, $password)
                    );
                    $this->model_backbone_user->data_update($user_data, 'id_user = ' . $id_user);
                    if ($this->model_user->login($this->my_side)) {
                        $login_success = TRUE;
                    } else {
                        $this->attention_messages = "Password Anda telah disesuaikan dengan data SIMPEG.";
                    }
                } else {
                    $this->attention_messages = $this->model_user->errors->get_html_errors("<br />", "line-wrap");
                    if (trim($this->attention_messages) == "<div id=\"model_error\" class=\"line-wrap\"></div>") {
                        $this->attention_messages = "<div id=\"model_error\" class=\"line-wrap\">Username atau password tidak ditemukan.</div>";
                    }
                }
            }
        }
        return $login_success;
    }

    protected function ___call_api($path, $params = FALSE) {
        $url = $path;

        $options = array();

        if ($params) {
            $options = array(
                'http' => array(
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($params),
//                    'content' => $params,
                ),
            );
        }
        $context = stream_context_create($options);
        try {
            $result = file_get_contents($url, false, $context);
        } catch (Exception $e) {
            $this->___call_api($path, $params);
        }

        return $result;
    }

}
