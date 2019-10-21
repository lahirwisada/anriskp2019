<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$header_title = isset($header_title) ? $header_title : '';
$active_modul = isset($active_modul) ? $active_modul : 'none';
$detail = isset($detail) ? $detail : FALSE;
$skpb = isset($skpb) ? $skpb : FALSE;
$skpt_ouput = array('Laporan', 'Dokumen', 'Paket', 'Orang', 'Unit');
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h3 class="panel-title">Formulir <strong><?php echo $header_title; ?></strong></h3>
            </div>
            <div class="panel-body">
                <?php echo load_partial("back_end/shared/attention_message"); ?>
                <form role="form" method="POST" class="form-horizontal" id="wizard-validation">
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Periode Tahun *</label>
                        <div class="col-md-6 col-xs-12">
                            <?php
                            $default_value_tahun = $detail ? $detail->skpt_tahun : date('Y');
                            echo dropdown_tahun('skpt_tahun', $default_value_tahun, 1, 'class="form-control select"');
                            ?>
                            <span class="help-block">Pilih periode tahun.</span>
                        </div>
                    </div>
                    <?php echo form_hidden('pegawai_id', $pegawai_id); ?>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Nama Kegiatan *</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <?php // echo form_input('skpt_kegiatan', set_value('skpt_kegiatan', $detail ? $detail->skpt_kegiatan : ''), 'class="form-control"'); ?>
                            
                            <?php
                            echo form_dropdown('id_dupnk', array(), set_value('id_dupnk', $detail ? $detail->id_dupnk : ''), 'id="id_dupnk" class="form-control select2-basic" ');
                            ?>
                            
                            <span class="help-block">Isikan dengan nama kegiatan yang akan dilakukan.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Lama Kegiatan *</label>
                        <div class="col-md-6 col-xs-12">
                            <?php echo form_input('skpt_waktu', set_value('skpt_waktu', $detail ? $detail->skpt_waktu : '0'), 'class="form-control"'); ?>
                            <span class="help-block">Isikan dengan lama pengerjaan kegiatan dalam hitungan bulan.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Kuantitas Output *</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="col-xs-4" style="padding: 0;">
                                <?php echo form_input('skpt_kuantitas', set_value('skpt_kuantitas', $detail ? $detail->skpt_kuantitas : '0'), 'class="form-control"'); ?>
                            </div>
                            <div class="col-xs-8" style="padding-right: 0;">
                                <?php echo form_dropdown('skpt_output', $skpt_ouput, set_value('skpt_output', $detail ? $detail->skpt_output : '0'), 'class="form-control select"'); ?>
                            </div>
                            <span class="help-block">Isikan dengan kuantitas output yang akan dihasilkan.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Kualitas Output *</label>
                        <div class="col-md-6 col-xs-12">
                            <?php echo form_input('skpt_kualitas', set_value('skpt_kualitas', $detail ? $detail->skpt_kualitas : '0'), 'class="form-control"'); ?>
                            <span class="help-block">Isikan dengan kualitas kegiatan yang akan dihasilkan.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Biaya Kegiatan *</label>
                        <div class="col-md-6 col-xs-12">
                            <?php echo form_input('skpt_biaya', set_value('skpt_biaya', $detail ? $detail->skpt_biaya : '0'), 'class="form-control"'); ?>
                            <span class="help-block">Isikan dengan biaya yang akan dikeluarkan jika ada. Atau isi dengan "0" jika tidak ada.</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>