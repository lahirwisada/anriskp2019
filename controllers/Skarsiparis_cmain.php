<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Skarsiparis_cmain extends Lwpustaka_Data {

    protected $backend_controller_location = "/";
    protected $myid = 0;
    protected $pegawai_id = 0;
    protected $pegawai_nip = 0;
    protected $resource_api_link = NULL;
    protected $saved_id = FALSE;
    protected $user_profil = NULL;
    public $perwal = NULL;
    protected $backend_url_query;
    
    protected $auto_load_model = FALSE;
    
    const DIR_TEMP_UPLOAD = ASSET_UPLOAD . '/';
    const DIR_IMP_UPLOAD = ASSET_UPLOAD . '/final/';

    public function __construct($cmodul_name = FALSE, $header_title = FALSE) {
        $this->is_front_end = FALSE;
        parent::__construct($cmodul_name, $header_title);
        $this->init_cmain();

        $this->check_called_class_before_execute(TRUE);
    }

    protected function after_detail($id = FALSE) {
        return;
    }
    
    protected function after_show_detail($detail = FALSE){
        return $detail;
    }

    protected function detail($id = FALSE, $posted_data = array(), $parent_id = FALSE) {
        $this->set('referer', $this->session->userdata('referer'));
        if ($this->{$this->model}->get_data_post(FALSE, $posted_data)) {
            if ($this->{$this->model}->is_valid()) {

                $this->before_save_response = $this->before_save($posted_data);

                $saved_id = FALSE;
                if ($this->before_save_response !== FALSE) {
                    $saved_id = $this->save_detail($id);
                }

                $this->after_save_response = $this->after_save($id, $saved_id);

                $this->saved_id = $id;
                if (!$id) {
                    $id = $saved_id;
                    $this->saved_id = $saved_id;
                }

                $this->after_detail($id);

                if ($this->before_save_response) {
                    $this->attention_messages = "Data baru telah disimpan.";
                    if ($id) {
                        $this->attention_messages = "Perubahan telah disimpan.";
                    }
                    if ($parent_id) {
                        redirect($this->_name . '/index/' . $parent_id);
                    }
                    $referer = $this->session->userdata('referer');
                    if ($referer) {
                        $this->session->unset_userdata('referer');
                        redirect($referer);
                    }
                    redirect($this->_name);
                }
                $this->attention_messages = "Terdapat Kesalahan, Periksa kembali isian anda.";
            } else {
                $this->attention_messages = $this->{$this->model}->errors->get_html_errors("<br />", "line-wrap");
            }
        }

        $detail = $this->after_show_detail($this->{$this->model}->show_detail($id));
        $this->set("detail", $detail);
    }

    private function init_cmain() {
        $this->my_location = "/";
        $this->_layout = "appui";
//        var_dump($this->user_detail);exit;
        $this->set("active_user_detail", $this->user_detail);
        $this->init_backend_menu();
        $this->backend_controller_location = $this->my_location . $this->_name;
        $this->set("controller_location", $this->backend_controller_location);

//        $user_detail = $this->lmanuser->get("user_detail");
        
    }
    
    protected function get_uploaded_files($upload_random_id) {
        $uploaded_files = FALSE;
        $dir = self::DIR_TEMP_UPLOAD . $upload_random_id . "/";
        if (is_dir($dir)) {
            $uploaded_files = array_diff(scandir($dir), array('..', '.'));
        }
        return $uploaded_files;
    }
    
    public function temp_upload() {
//        $postdata = file_get_contents("php://input");
        $file_id = $this->input->post('file_id');
        if (!empty($_POST) && !empty($_FILES) && array_key_exists("file_bukti_kerja", $_FILES) && $file_id) {

            $file_received = @$_FILES['file_bukti_kerja'];

            $extension = strtolower(@substr($file_received['name'], -4));

            $dir = self::DIR_TEMP_UPLOAD . "$file_id/";

            if (is_dir($dir) === FALSE) {
                mkdir($dir);
            }

            $allowedFileType = [
                "application/vnd.ms-excel",
                "application/vnd.ms-excel.sheet.macroEnabled.12",
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                "text/xml",
                "application/msword",
                "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                "application/pdf",
                "application/x-zip-compressed",
                "text/plain",
                "image/jpeg",
                "image/png",
                "image/bmp",
                "image/gif",
            ];

            if ($file_received['error'] == 0) {
                $extension = strtolower(@substr($file_received['name'], -4));
                if (in_array($file_received['type'], $allowedFileType) && $file_received['size'] != '') {
                    $c = save_file($file_received['tmp_name'], $file_received['name'], $file_received['size'], $dir, 0, 0, FALSE, FALSE, TRUE);
                    if (is_array($c) && $c['error'] == 1) {
                        header($_SERVER['SERVER_PROTOCOL'] . ' 415 Unsupported Media Type', true, 415);
                        exit;
                    }
                    header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK', true, 200);
                    exit;
                } else {
                    header($_SERVER['SERVER_PROTOCOL'] . ' 415 Unsupported Media Type', true, 415);
                    exit;
                }
            }
        }
        header($_SERVER['SERVER_PROTOCOL'] . ' 204 No Content', true, 204);
        exit;
    }

    public function remove_file() {
        $file_id = $this->input->get_post('file_id');
        if (!empty($_POST) && $file_id) {
            $filename = $this->input->get_post('fname');

            $filepath = self::DIR_TEMP_UPLOAD . "$file_id/" . $filename;

            if (file_exists($filepath)) {
                echo unlink($filepath) ? 1 : 0;
                exit;
            }
        }
        exit;
    }
    
    private function generate_cetak_skp($pegawai_detail, $skpt, $perilaku = FALSE) {

        $this->load->library('Calcel');

        //$template_path = APPPATH . '../_assets/template/Template_Rekapitulasi_TPP.xls';
        $template_path = ASSET_TEMPLATE . '/TemplateSKP.xls';

        $genid = md5(date('Y-m-d H:i:s:u'));
        $save_path = APPPATH . '../_assets/generated_bap/' . $genid . '.xls';
        $nama_file = '' . $genid . '.xls';

        $this->calcel->load($template_path);

        $active_sheet = $this->calcel->setActiveSheetIndexByName("SKP");

        $baseRow = 15;

        $skp_tugas_pokok = array_filter($skpt, "filter_skp_tugaspokok");
        $skp_tugas_tambahan = array_filter($skpt, "filter_skp_tugastambahan");

        unset($skpt);
        $rc_tugas_pokok = count($skp_tugas_pokok) - 1;
        $active_sheet->insertNewRowBefore($baseRow, $rc_tugas_pokok);
        $row = 0;

        $active_sheet->setCellValue('E4', $pegawai_detail->pegawai_nama);
        $active_sheet->setCellValue('E5', $pegawai_detail->tmtjabfungsional);
        $panggol = $pegawai_detail->pangkat . ", " . $pegawai_detail->golongan;
        $active_sheet->setCellValue('E6', $panggol);
        $active_sheet->setCellValue('E7', $pegawai_detail->unitkerja);

        $total = 0;
        $key = 0;
        foreach ($skp_tugas_pokok as $key => $record) {

            $nilai_skp = hitung_nilai_capaian($record->real_nilai_biaya, $record->real_hitung);

            $total += $nilai_skp;
            $row = $baseRow + $key;

            $active_sheet->setCellValue('A' . $row, $key + 1)
                    ->setCellValue('B' . $row, beautify_str($record->skpt_kegiatan))
                    ->setCellValue('D' . $row, number_format($record->skpt_kuantitas, 2, '.', ','))
                    ->setCellValue('E' . $row, show_skpt_output($record->skpt_output))
                    ->setCellValue('F' . $row, number_format($record->skpt_kualitas, 2, '.', ','))
                    ->setCellValue('G' . $row, $record->skpt_waktu)
                    ->setCellValue('H' . $row, "Bulan")
                    ->setCellValue('J' . $row, number_format($record->skpt_real_kuantitas, 2, '.', ','))
                    ->setCellValue('K' . $row, number_format($record->skpt_real_kualitas, 2, '.', ','))
                    ->setCellValue('L' . $row, number_format($record->real_nilai_kuantitas, 2, '.', ','))
                    ->setCellValue('M' . $row, show_skpt_output($record->skpt_output))
                    ->setCellValue('N' . $row, number_format($record->real_nilai_kualitas, 2, '.', ','))
                    ->setCellValue('O' . $row, $record->real_nilai_waktu)
                    ->setCellValue('P' . $row, "Bulan")
                    ->setCellValue('R' . $row, number_format($record->real_hitung, 2, '.', ','))
                    ->setCellValue('S' . $row, number_format($nilai_skp, 2, '.', ','));
            $key++;
        }
        $baseRow = $row + 3;
        $row = 0;
        $rc_tugas_tambahan = count($skp_tugas_tambahan) - 1;
        $active_sheet->insertNewRowBefore($baseRow, $rc_tugas_tambahan);
        $key = 0;
        $three = 3;
        foreach ($skp_tugas_tambahan as $record) {
            
            $nilai_skp = hitung_nilai_capaian($record->real_nilai_biaya, $record->real_hitung);

            $total += $nilai_skp;

            $row = $baseRow + $key;
            $val = "";
            if ($three == 3 && $key < 8) {
                $val = "1";
            }
            $three--;
            if ($three == 0) {
                $three = 3;
            }
            $active_sheet->setCellValue('A' . $row, $key + 1)
                    ->setCellValue('B' . $row, beautify_str($record->skpt_kegiatan))
                    ->setCellValue('S' . $row, $val);
            $key++;
        }

        $nilai_tgs_tambahan = show_nilai_tgstambahan($rc_tugas_tambahan+1);
        list($nilai_huruf, $nilai_capaian) = show_nilai_huruf($total, ($rc_tugas_pokok+1), $nilai_tgs_tambahan);

        $active_sheet->setCellValue('S'.($row+1), number_format($nilai_capaian, 2, '.', ','));
        $active_sheet->setCellValue('S'.($row+2), beautify_str($nilai_huruf));
        
        $active_sheet = $this->calcel->setActiveSheetIndexByName("DP3");

        $active_sheet->setCellValue('E6', $perilaku->perilaku_pelayanan);
        $active_sheet->setCellValue('E7', $perilaku->perilaku_integritas);
        $active_sheet->setCellValue('E8', $perilaku->perilaku_komitmen);
        $active_sheet->setCellValue('E9', $perilaku->perilaku_disiplin);
        $active_sheet->setCellValue('E10', $perilaku->perilaku_kerjasama);
        $active_sheet->setCellValue('E11', $perilaku->perilaku_kepemimpinan);
        
        $active_sheet = $this->calcel->setActiveSheetIndexByName("SKP");

//        if ($zip) {
//            $this->calcel->save($save_path);
//            return $save_path;
//        }
        $this->calcel->stream($genid . '.xls');

        echo $genid . '.xls';
        exit;
    }

    public function cetakskp($tahun = FALSE) {
        if (!$tahun || !array_key_exists('cip', $_GET)) {
            redirect('rskp');
        }
        $this->load->model(array('model_master_pegawai', 'model_tr_perilaku', 'model_tr_skp_tahunan'));
        $cipeg = $this->input->get_post('cip');
        $idpeg = extract_id_with_salt($cipeg);
//        $pegawai_found = $this->model_master_pegawai->get_pegawai_by_id($this->id_pegawai);
        $pegawai_found = $this->model_master_pegawai->get_pegawai_by_id($idpeg);

//        $skpt = $this->model_tr_skp_tahunan->get_realisasi_tahunan($this->id_pegawai, $tahun)->record_set;
        $skpt = $this->model_tr_skp_tahunan->get_realisasi_tahunan($idpeg, $tahun)->record_set;
//        $perilaku = $this->model_tr_perilaku->get_perilaku_by_id($this->id_pegawai, $tahun);
        $perilaku = $this->model_tr_perilaku->get_perilaku_by_id($idpeg, $tahun);

        if ($pegawai_found && !empty($pegawai_found) && $skpt && !empty($skpt) && is_array($skpt)) {
            $this->generate_cetak_skp($pegawai_found, $skpt, $perilaku);
        } else {
            redirect('rskp');
        }
        exit;
    }

}
