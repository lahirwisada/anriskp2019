<?php
$detail_pegawai = isset($detail_pegawai) ? $detail_pegawai : FALSE;
$detail_skpt = isset($detail_skpt) ? $detail_skpt : FALSE;
$records = isset($records) ? $records : FALSE;

$skpt_ouput = array('Laporan', 'Dokumen', 'Paket', 'Orang', 'Unit');
$status = array('Draft', 'Verifikasi', 'Penilaian', 'Selesai', 'Ditolak', 'Tidak Sesuai');
$label = array('label-warning', 'label-default', 'label-info', 'label-success', 'label-danger', 'label-warning');
$crypt_id_skpt = isset($crypt_id_skpt) ? $crypt_id_skpt : FALSE;
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
                                                                <?php echo form_input('real_nilai_kualitas', set_value('real_nilai_kualitas', '0'), 'class="form-control"'); ?>
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
                                                                <?php echo form_input('real_nilai_kualitas', set_value('real_nilai_kualitas', '0'), 'class="form-control"'); ?>
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
                                                                <?php echo form_dropdown('real_output', $skpt_ouput, set_value('real_output', '0'), 'class="form-control select"'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
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
                            <a class="btn btn-app-blue" href="<?php echo base_url($active_modul . "/penilaian") . "/" . $crypt_id_skpt; ?>">Beri Nilai</a>
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
                                        <th>Nilai Kualitas</th>
                                        <th>Nilai Kuantitas</th>
                                        <th>Catatan Penilai</th>
                                        <th>Catatan Audien</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($records != FALSE): ?>
                                        <?php foreach ($records as $key => $record): ?>
                                            <tr>
                                                <td class="text-right" rowspan="3"><?php echo $next_list_number++ ?></td>
                                                <td rowspan="2"><?php echo beautify_str($record->deskripsi_dupnk) ?></td>
                                                <td><?php echo $record->skpt_kuantitas . " " . $skpt_ouput[$record->skpt_output] ?></td>
                                                <td class="text-right"><?php echo $record->skpt_kualitas ?></td>
                                                <td class="text-right"><?php echo $record->skpt_waktu ?></td>
                                                <td class="text-center" rowspan="2">
                                                    <div class="btn-group btn-group-sm">
                                                        <a class="btn btn-sm btn-default" href="<?php echo base_url($active_modul . "/lembar_penilaian") . "/" . add_salt_to_string($record->id_skpt); ?>">Beri Nilai</a>
                                                    </div>
                                                </td>
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