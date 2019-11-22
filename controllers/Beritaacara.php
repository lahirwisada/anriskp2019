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

        $tahun = $this->input->get_post('tahun');

        $this->__reconfigure_model($tahun);

        parent::index();

        $this->set('tahun', $tahun);
    }

    private function __reconfigure_model($tahun = FALSE) {
        $this->model_master_pegawai->set_by_berita_acara();
        $tahun = $tahun ? $tahun : date('Y');
        $this->model_master_pegawai->set_berita_acara_tahun($tahun);
    }

    private function get_detail_pertahun($id_pegawai, $tahun) {
        $arr_pegawai_detail = [];
        for ($y = ($tahun - 4); $y < $tahun; $y++) {
            if ($y > 2017) {
                $this->__reconfigure_model($y);
                $arr_pegawai_detail[$y] = $this->model_master_pegawai->show_detail($id_pegawai);
            }
        }
        return $arr_pegawai_detail;
    }

    private function generate_akt_akk($arr_pegawai_detail, $pegawai_detail, $tahun, $zip = FALSE) {
        if (!empty($arr_pegawai_detail) && $pegawai_detail) {
            $this->load->library('Calcel');

            //$template_path = APPPATH . '../_assets/template/Template_Rekapitulasi_TPP.xls';
            $template_path = ASSET_TEMPLATE . '/template_akt_akk.xls';

            $genid = md5(date('Y-m-d H:i:s:u'));
            $save_path = APPPATH . '../_assets/generated_bap/' . $genid . '.xls';
            $nama_file = '' . $genid . '.xls';

            $tempat_tanggal_lahir = beautify_str($pegawai_detail->nokarpeg) . ", " . show_date_with_format($pegawai_detail->tgllahir);
            $jenis_kelamin = ["Perempuan", "Laki-laki"];

            $this->calcel->load($template_path);

            $active_sheet = $this->calcel->setActiveSheetIndexByName("AKK");

            $baseRow = 27;

            $record_count = count($arr_pegawai_detail) - 1;
            $active_sheet->insertNewRowBefore($baseRow, $record_count);
            $row = 0;

            $active_sheet->setCellValue('G11', $tahun);
            $active_sheet->setCellValue('D13', $pegawai_detail->pegawai_nama);
            $active_sheet->setCellValue('D14', $pegawai_detail->pegawai_nip . " ");
            $active_sheet->setCellValue('D15', $pegawai_detail->nokarpeg . " ");
            $active_sheet->setCellValue('D16', $tempat_tanggal_lahir);
            if (!is_null($pegawai_detail->jeniskelamin)) {
                $active_sheet->setCellValue('D17', $jenis_kelamin[$pegawai_detail->jeniskelamin]);
            }
            $active_sheet->setCellValue('D18', $pegawai_detail->pangkat);
            $active_sheet->setCellValue('E18', $pegawai_detail->golongan);
            $active_sheet->setCellValue('F18', $pegawai_detail->tmtpangkat_gol);
            $active_sheet->setCellValue('D19', 'Arsiparis ' . beautify_str($pegawai_detail->jabfungsional));
            $active_sheet->setCellValue('F19', $pegawai_detail->tmtjabfungsional);
            $active_sheet->setCellValue('D20', $pegawai_detail->unitkerja);

            $key = 0;
            foreach ($arr_pegawai_detail as $tahun => $record) {

                $row = $baseRow + $key;

                $active_sheet->setCellValue('A' . $row, $tahun)
                        ->setCellValue('B' . $row, number_format($record->nilai_kinerja, 2, '.', ','))
                        ->setCellValue('E' . $row, lws_divide(convert_nilai_huruf_to_prosentase($record->nilai_kinerja), 100))
                        ->setCellValue('F' . $row, get_syarat_angka_kredit($record->jabfungsional))
                        ->setCellValue('G' . $row, "=F" . $row . "*E" . $row);
                $key++;
            }

            $active_sheet->setCellValue('A' . ($row + 4), $pegawai_detail->uraian_rekomendasi);

            $active_sheet = $this->calcel->setActiveSheetIndexByName("AKT");

            $active_sheet->setCellValue('F12', $tahun);
            $active_sheet->setCellValue('D14', $pegawai_detail->pegawai_nama);
            $active_sheet->setCellValue('D15', $pegawai_detail->pegawai_nip . " ");
            
            
            $active_sheet->setCellValue('D16', $pegawai_detail->nokarpeg . " ");
            $active_sheet->setCellValue('D17', $tempat_tanggal_lahir);
            if (!is_null($pegawai_detail->jeniskelamin)) {
                $active_sheet->setCellValue('D18', $jenis_kelamin[$pegawai_detail->jeniskelamin]);
            }
            $active_sheet->setCellValue('D19', $pegawai_detail->pangkat);
            $active_sheet->setCellValue('E19', $pegawai_detail->golongan);
            $active_sheet->setCellValue('F19', $pegawai_detail->tmtpangkat_gol);
            $active_sheet->setCellValue('D20', 'Arsiparis ' . beautify_str($pegawai_detail->jabfungsional));
//            $active_sheet->setCellValue('F19', $pegawai_detail->tmtjabfungsional);
            $active_sheet->setCellValue('D21', $pegawai_detail->unitkerja);
            
            $active_sheet->setCellValue('A27', number_format($pegawai_detail->nilai_kinerja, 2, '.', ','));
            $active_sheet->setCellValue('D27', lws_divide(convert_nilai_huruf_to_prosentase($pegawai_detail->nilai_kinerja), 100));
            $active_sheet->setCellValue('E27', get_syarat_angka_kredit($pegawai_detail->jabfungsional));

            if ($zip) {
                $this->calcel->save($save_path);
                return $save_path;
            }
            $this->calcel->stream($genid . '.xls');

            echo $genid . '.xls';
            exit;
        }
    }

    public function cetak_akt_akk($crypt_id_pegawai = FALSE) {
        $tahun = $this->input->get_post('tahun');

        if (!$tahun) {
            $tahun = date('Y');
        }

        $id_pegawai = FALSE;
        if ($crypt_id_pegawai) {
            $id_pegawai = extract_id_with_salt($crypt_id_pegawai);
        }

        $show_years = 4;

        $this->__reconfigure_model($tahun);

        $pegawai_detail = FALSE;

        $arr_pegawai_detail = [];
        if ($id_pegawai) {
            $this->model_master_pegawai->set_berita_acara_id_pegawai($id_pegawai);

            $pegawai_detail = $this->model_master_pegawai->show_detail($id_pegawai);
            
            $arr_pegawai_detail = $this->get_detail_pertahun($id_pegawai, $tahun);

            $arr_pegawai_detail[$tahun] = $pegawai_detail;

            $this->generate_akt_akk($arr_pegawai_detail, $pegawai_detail, $tahun);
        } else {
//            $records = $this->model_master_pegawai->all_bap();
//            if ($records) {
//                foreach ($records as $key => $record) {
//                    
//                }
//            }
        }


        redirect('beritaacara');
    }

    public function cetak_bap() {
        $tahun = $this->input->get_post('tahun');

        if (!$tahun) {
            $tahun = date('Y');
        }

        $this->__reconfigure_model($tahun);
        $records = $this->model_master_pegawai->all_bap();
//        var_dump($records);
//        exit;
        if ($records) {
            $this->load->library('Excel');

            //$template_path = APPPATH . '../_assets/template/Template_Rekapitulasi_TPP.xls';
            $template_path = ASSET_TEMPLATE . '/template_bap.xls';

            $genid = md5(date('Y-m-d H:i:s:u'));
            $save_path = APPPATH . '../_assets/generated_bap/' . $genid . '.xls';
            $nama_file = '' . $genid . '.xls';

            $this->excel->load($template_path);

            $active_sheet = $this->excel->setActiveSheetIndexByName("Sheet1");

            $baseRow = 11;

            $record_count = count($records) - 1;
            $active_sheet->insertNewRowBefore($baseRow, $record_count);
            $row = 0;

            foreach ($records as $key => $record) {

                $row = $baseRow + $key;

                $akkth_ini = $record->akt_ini;
                if (is_null($record->akt_ini)) {
                    $akkth_ini = calculate_nilai_akt($record->nilai_kinerja, $record->jabfungsional);
                }

                $akk = $record->akk_ini;
                if (is_null($record->akk_ini)) {
                    $akk = $akkth_ini + $record->akkthlalu;
                }

                $active_sheet->setCellValue('A' . $row, $key + 1)
                        ->setCellValue('B' . $row, $record->pegawai_nama)
                        //->setCellValue('C' . $row, '=TEXT('.strval($record->nip).';"#")')
                        ->setCellValue('C' . $row, ' ' . $record->pegawai_nip . ' ')
                        ->setCellValue('D' . $row, "Arsiparis " . beautify_str($record->jabfungsional))
//                        ->setCellValue('E' . $row, $record->tppaktf)
//                        ->setCellValue('F' . $row, $record->tppppk)
                        ->setCellValue('I' . $row, !is_null($record->nilaikinerja_ini) ? number_format($record->nilaikinerja_ini, 2, ',', '.') : number_format($record->nilai_kinerja, 2, ',', '.'))
                        ->setCellValue('J' . $row, number_format($akkth_ini, 2, ',', '.'))
                        ->setCellValue('K' . $row, number_format($akk, 2, ',', '.'))
                        ->setCellValue('L' . $row, beautify_text($record->uraian_rekomendasi));
            }
            $this->excel->stream($genid . '.xls');

            echo $genid . '.xls';
            exit;
        }
        redirect('beritaacara');
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
