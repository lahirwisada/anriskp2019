<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$header_title = isset($header_title) ? $header_title : '';
$active_modul = isset($active_modul) ? $active_modul : 'none';
$detail = isset($detail) ? $detail : FALSE;
$skpb = isset($skpb) ? $skpb : FALSE;
$skpt_ouput = get_skpt_output();
$random_id = isset($random_id) ? $random_id : generate_random_id();
?>

<div class="row">
    <div class="col-md-12">
        <form role="form" method="POST" class="form-horizontal" id="wizard-validation">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">Formulir <strong><?php echo $header_title; ?></strong></h3>
                </div>
                <div class="panel-body">
                    <p><?php echo load_partial("back_end/shared/attention_message"); ?></p>
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Periode Tahun *</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="hidden" id="random_id" name="random_id" value="<?php echo $random_id; ?>"/>
                            <input type="hidden" id="skpt_tahun" name="skpt_tahun" value="<?php echo $detail->skpt_tahun; ?>"/>
                            <input type="hidden" id="id_dupnk" name="id_dupnk" value="<?php echo $detail->id_dupnk; ?>"/>
                            <input type="hidden" id="skpt_waktu" name="skpt_waktu" value="<?php echo $detail->skpt_waktu; ?>"/>
                            <input type="hidden" id="skpt_kuantitas" name="skpt_kuantitas" value="<?php echo $detail->skpt_kuantitas; ?>"/>
                            <input type="hidden" id="skpt_output" name="skpt_output" value="<?php echo $detail->skpt_output; ?>"/>
                            <input type="hidden" id="skpt_kualitas" name="skpt_kualitas" value="<?php echo $detail->skpt_kualitas; ?>"/>
                            <input type="hidden" id="skpt_biaya" name="skpt_biaya" value="<?php echo $detail->skpt_biaya; ?>"/>
                            <input type="file" id="bukti_kerja" name="bukti_kerja" class="inputFile" required data-allowed-file-extensions='["png","jpg","jpeg","bmp","pdf"]' multiple>
                        </div>
                    </div>
                    <div class="row">
                        <table id="tableListFileUpload" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="70%">Nama File</th>
                                    <th width="30%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn-primary btn pull-right">Simpan</button>
                    <a href="<?php echo base_url('skp'); ?>" class="btn-default btn">Batal / Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>