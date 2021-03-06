<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$header_title = isset($header_title) ? $header_title : '';
$active_modul = isset($active_modul) ? $active_modul : 'none';
$detail = isset($detail) ? $detail : FALSE;
$random_id = isset($random_id) ? $random_id : generate_random_id();
$skpb = isset($skpb) ? $skpb : FALSE;
$uploaded_files = isset($uploaded_files) ? $uploaded_files : FALSE;
$skpt_ouput = get_skpt_output();
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
                            <?php
                            $default_value_tahun = $detail ? $detail->skpt_tahun : date('Y');
                            echo dropdown_tahun('skpt_tahun', $default_value_tahun, 1, 'class="form-control select"');
                            ?>
                            <span class="help-block">Pilih periode tahun.</span>
                        </div>
                    </div>
                    <?php echo form_hidden('id_pegawai', $pegawai_id); ?>
                    <input type="hidden" id="is_tugas_tambahan" name="is_tugas_tambahan" value="<?php echo $detail ? $detail->is_tugas_tambahan : 0; ?>" />
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Tugas Tambahan</label>
                        <div class="col-md-3 col-xs-12">
                            <label class="css-input css-checkbox css-checkbox-info">
                                <input type="checkbox" id="cbtugastambahan" onclick=""><span></span>
                            </label>
                            <span class="help-block">Isikan dengan nama kegiatan yang akan dilakukan.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Nama Kegiatan *</label>
                        <div class="col-md-6 col-xs-12">
                            <?php
                            echo form_dropdown('id_dupnk', array(), set_value('id_dupnk', $detail ? $detail->id_dupnk : ''), 'id="id_dupnk" class="form-control select2-basic" ');
                            ?>
                            <span class="help-block">Isikan dengan nama kegiatan yang akan dilakukan.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Keterangan Kegiatan</label>
                        <div class="col-md-6 col-xs-12">
                            <?php
                            $default_value_tahun = $detail ? $detail->uraian_tgs_tambahan : "";
                            echo form_textarea('uraian_tgs_tambahan', $default_value_tahun, 'class="form-control"');
                            ?>
                            <span class="help-block">Pilih periode tahun.</span>
                        </div>
                    </div>
                    <div id="div-commonform">
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Lama Kegiatan (Waktu) *</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="col-xs-6">
                                    <label for="register5-lastname">Target</label>
                                    <?php echo form_input('skpt_waktu', set_value('skpt_waktu', $detail ? $detail->skpt_waktu : '0'), 'class="form-control"'); ?>
                                </div>
                                <div class="col-xs-6">
                                    <label for="register5-lastname">Real</label>
                                    <?php echo form_input('skpt_real_waktu', set_value('skpt_real_waktu', $detail ? $detail->skpt_real_waktu : '0'), 'class="form-control"'); ?>
                                </div>
                                <span class="help-block">Isikan dengan lama pengerjaan kegiatan dalam hitungan bulan.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Kuantitas Output *</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="row">
                                    <label for="register5-lastname">Target</label>
                                </div>
                                <div class="col-xs-4" style="padding: 0;">
                                    <?php echo form_input('skpt_kuantitas', set_value('skpt_kuantitas', $detail ? $detail->skpt_kuantitas : '0'), 'class="form-control"'); ?>
                                </div>
                                <div class="col-xs-8" style="padding-right: 0;">
                                    <?php echo form_dropdown('skpt_output', $skpt_ouput, set_value('skpt_output', $detail ? $detail->skpt_output : '0'), 'class="form-control select"'); ?>
                                </div>
                                <span class="help-block">Isikan dengan Target kuantitas output yang dihasilkan.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label"></label>
                            <div class="col-md-6 col-xs-12">
                                <div class="row">
                                    <label for="register5-lastname">Real</label>
                                </div>
                                <div class="col-xs-4" style="padding: 0;">
                                    <?php echo form_input('skpt_real_kuantitas', set_value('skpt_real_kuantitas', $detail ? $detail->skpt_real_kuantitas : '0'), 'class="form-control"'); ?>
                                </div>
                                <div class="col-xs-8" style="padding-right: 0;">
                                    <?php echo form_dropdown('skpt_real_output', $skpt_ouput, set_value('skpt_real_output', $detail ? $detail->skpt_real_output : '0'), 'class="form-control select"'); ?>
                                </div>
                                <span class="help-block">Isikan dengan kuantitas output real yang dihasilkan.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Kualitas Output *</label>
                            <div class="col-md-6 col-xs-12">
                                <div class="col-xs-6">
                                    <label for="register5-lastname">Target</label>
                                    <?php echo form_input('skpt_kualitas', set_value('skpt_kualitas', $detail ? $detail->skpt_kualitas : '0'), 'class="form-control"'); ?>
                                </div>
                                <div class="col-xs-6">
                                    <label for="register5-lastname">Real</label>
                                    <?php echo form_input('skpt_real_kualitas', set_value('skpt_real_kualitas', $detail ? $detail->skpt_real_kualitas : '0'), 'class="form-control"'); ?>
                                </div>
                                <span class="help-block">Isikan dengan kualitas kegiatan yang dihasilkan.<br />Kiri untuk isian <u>Target</u> dan Kanan untuk isian <u>Real penilaian</u> dari atasan.</span>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Biaya Kegiatan *</label>
                            <div class="col-md-6 col-xs-12">
                                <?php echo form_input('skpt_biaya', set_value('skpt_biaya', $detail ? $detail->skpt_biaya : '0'), 'class="form-control"'); ?>
                                <span class="help-block">Isikan dengan biaya yang akan dikeluarkan jika ada. Atau isi dengan "0" jika tidak ada.</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">File Bukti Kerja</label>
                        <div class="col-md-6 col-xs-12">
                            <input type="hidden" id="random_id" name="upload_random_id" value="<?php echo set_value('upload_random_id', $detail ? $detail->upload_random_id : $random_id); ?>"/>
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
                                <?php
                                if ($uploaded_files):
                                    foreach ($uploaded_files as $files):
                                        ?>
                                        <tr fname="<?php echo $files; ?>">
                                            <td class="td-nama-file">
                                                <?php echo $files; ?>
                                                <input name="uploadedFiles[]" type="hidden" value="<?php echo $files; ?>">
                                            </td>
                                            <td class="td-aksi">
                                                <a href="#" class="remove-button">
                                                    <span class="fa fa-trash text-danger"></span>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    endforeach;
                                endif;
                                ?>
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