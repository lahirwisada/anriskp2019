<?php
$detail_pegawai = isset($detail_pegawai) ? $detail_pegawai : FALSE;
$detail_skpt = isset($detail_skpt) ? $detail_skpt : FALSE;
$records = isset($records) ? $records : FALSE;
$next_list_number = isset($next_list_number) ? $next_list_number : 1;

$skpt_ouput = get_skpt_output();
$status = get_skpt_status();
$label = get_skpt_label();
$crypt_id_skpt = isset($crypt_id_skpt) ? $crypt_id_skpt : FALSE;
$crypt_id_penilai = isset($crypt_id_penilai) ? $crypt_id_penilai : FALSE;
$current_val = isset($current_val) ? $current_val : FALSE;



?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading ui-draggable-handle">
                <h3 class="panel-title"><?php echo $header_title; ?></h3>
            </div>
            <div class="panel-body">
                <?php echo load_partial("back_end/shared/attention_message"); ?>
                <?php if ($detail_skpt): ?>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php if ($detail_pegawai): ?>

                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">NIP</label>
                                        <div class="col-md-9">                                        
                                            <?php echo $nip; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Nama</label>
                                        <div class="col-md-9">                                        
                                            <?php echo $detail_pegawai->pegawai_nama; ?>
                                        </div>
                                    </div>
                                </div>
                                <br />
                            <?php endif; ?>
                            <div class="row">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Nama Kegiatan</label>
                                                <div class="col-md-9">
                                                    <div class="input-group" >
                                                        <?php echo $detail_skpt->deskripsi_dupnk; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Tahun</label>
                                                <div class="col-md-9">
                                                    <div class="input-group" >
                                                        <?php echo $detail_skpt->skpt_tahun; ?>
                                                        <input type="hidden" id="skpt_tahun" value="<?php echo $detail_skpt->skpt_tahun; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Lama Kegiatan</label>
                                                <div class="col-md-9">
                                                    <div class="col-md-4">
                                                        Target : <?php echo $detail_skpt->skpt_waktu; ?> <?php echo $detail_skpt->skpt_waktu > 0 ? "Bulan" : "-"; ?>
                                                    </div>
                                                    <div class="col-md-3 text-blue">
                                                        Real : <?php echo $detail_skpt->skpt_real_waktu; ?> <?php echo $detail_skpt->skpt_real_waktu > 0 ? "Bulan" : "-"; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Kuantitas Output</label>
                                                <div class="col-md-9">
                                                    <div class="col-md-4">
                                                        Target : <?php echo $detail_skpt->skpt_kuantitas; ?> <?php echo $skpt_ouput[$detail_skpt->skpt_output]; ?>
                                                    </div>
                                                    <div class="col-md-3 text-blue">
                                                        Real : <?php echo $detail_skpt->skpt_real_kuantitas; ?> <?php echo $skpt_ouput[$detail_skpt->skpt_real_output]; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Kualitas Output</label>
                                                <div class="col-md-9">
                                                    <div class="col-md-4">
                                                        Target : <?php echo $detail_skpt->skpt_kualitas; ?>
                                                    </div>
                                                    <div class="col-md-3 text-blue">
                                                        Real : <?php echo $detail_skpt->skpt_real_kualitas; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Biaya</label>
                                                <div class="col-md-9">
                                                    <div class="input-group" >
                                                        <?php echo $detail_skpt->skpt_biaya; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Bukti Kerja</label>
                                                <div class="col-md-9">
                                                    <?php if ($detail_skpt->uploaded_files && !empty($detail_skpt->uploaded_files)): ?>
                                                        <?php foreach ($detail_skpt->uploaded_files as $uploaded_file): ?>
                                                            <a class="btn btn-xs btn-app-teal-outline" target="_blank" rel="noopener noreferrer" href="<?php echo base_url('_assets/uploads') . '/' . $detail_skpt->upload_random_id . '/' . $uploaded_file; ?>"><?php echo $uploaded_file ?></a>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="panel-body">
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Nilai Kualitas</label>
                                                        <div class="col-md-7">
                                                            <div class="input-group" >
                                                                <?php 
                                                                $vrnkw = $current_val ? $current_val->real_nilai_kualitas : $detail_skpt->skpt_real_kualitas;
                                                                echo form_input('real_nilai_kualitas', set_value('real_nilai_kualitas', number_format($vrnkw, 0, ',', '.')), 'id="real_nilai_kualitas" class="form-control"'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Nilai Kuantitas</label>
                                                        <div class="col-md-7">
                                                            <div class="input-group" >
                                                                <?php 
                                                                $vrnkn = $current_val ? $current_val->real_nilai_kuantitas : $detail_skpt->skpt_real_kuantitas;
                                                                echo form_input('real_nilai_kuantitas', set_value('real_nilai_kuantitas', number_format($vrnkn, 0, ',', '.')), 'id="real_nilai_kuantitas" class="form-control"'); 
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Output</label>
                                                        <div class="col-md-7">
                                                            <div class="input-group" >
                                                                <?php 
                                                                $vro = $current_val ? $current_val->real_output : $detail_skpt->skpt_real_output;
                                                                echo form_dropdown('real_output', $skpt_ouput, set_value('real_output', number_format($vro, 0, ',', '.')), 'id="real_output" class="form-control select"'); 
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php /**
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Biaya</label>
                                                        <div class="col-md-7">
                                                            <div class="input-group" >
                                                                <?php echo form_input('real_nilai_biaya', set_value('real_nilai_biaya', '0'), 'id="real_nilai_biaya" class="form-control"'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            *
                                             * 
                                             */
                                            echo form_hidden('real_nilai_biaya', 0);
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Waktu / Lama Kegiatan</label>
                                                        <div class="col-md-7">
                                                            <div class="input-group" >
                                                                <?php 
                                                                $vrnw = $current_val ? $current_val->real_nilai_waktu : $detail_skpt->skpt_real_waktu;
                                                                echo form_input('real_nilai_waktu', set_value('real_nilai_waktu', number_format($vrnw, 0, ',', '.')), 'id="real_nilai_waktu" class="form-control"'); 
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-md-5 control-label">Catatan</label>
                                                        <div class="col-md-7">
                                                            <div class="input-group" >
                                                                <textarea id="penilai_message" name="penilai_message"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo base_url('pskp'); ?>" class="btn-default btn">Batal / Kembali</a>
                            <a class="btn btn-app-blue pull-right" id="btnscore" urlloc="<?php echo base_url($active_modul . "/penilaian") . "/" . $crypt_id_skpt; ?>">Beri Nilai</a>
                        </div>
                    </div>
                    <br />
                <?php endif; ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-vcenter">
                                <thead>
                                    <tr role="row">
                                        <th>No</th>
                                        <th width="10%">Nilai Kualitas</th>
                                        <th width="10%">Nilai Waktu</th>
                                        <th width="10%">Nilai Kuantitas</th>
                                        <th width="10%">Nilai Biaya</th>
                                        <th width="10%">Banding</th>
                                        <th>Catatan Penilai</th>
                                        <th>Catatan Audien</th>
                                        <?php /* <th>Aksi</th> */ ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($records != FALSE): ?>
                                        <?php foreach ($records as $key => $record): ?>
                                            <tr>
                                                <td class="text-right"><?php echo $next_list_number++ ?></td>
                                                <td><?php echo $record->real_nilai_kualitas ?></td>
                                                <td><?php echo $record->real_nilai_waktu ?></td>
                                                <td><?php echo $record->real_nilai_kuantitas . " " . show_skpt_output($record->real_output) ?></td>
                                                <td><?php echo $record->real_nilai_biaya ?></td>
                                                <td><?php echo $record->reject_by_pegawai == 0 ? "<span class=\"label label-success\"><i class=\"ion-checkmark m-r-xs\"></i> Clear</span>" : "<span class=\"label label-danger\"><i class=\"ion-checkmark m-r-xs\"></i> Yes</span>" ; ?></td>
                                                <td class="text-left"><?php echo beautify_text($record->penilai_message) ?></td>
                                                <td class="text-left"><?php echo beautify_text($record->pegawai_message) ?></td>
                                                <?php /**
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm">
                                                        <a class="btn btn-sm btn-default" href="<?php echo base_url($active_modul . "/lembar_penilaian") . "/" . add_salt_to_string($record->id_skpt); ?>">Beri Nilai</a>
                                                    </div>
                                                </td>
                                                 * 
                                                 */
                                                ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="14"> Kosong / Data tidak ditemukan. </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>