<?php
$detail_pegawai = isset($detail_pegawai) ? $detail_pegawai : FALSE;
$detail_skpt = isset($detail_skpt) ? $detail_skpt : FALSE;
$records = isset($records) ? $records : FALSE;
$next_list_number = isset($next_list_number) ? $next_list_number : 1;

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
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">Ulasan</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group" >
                                                            <textarea id="pegawai_message" name="pegawai_message"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo base_url('rskp'); ?>" class="btn-default btn">Batal / Kembali</a>
                            <a class="btn btn-app-blue pull-right" id="btnscore" urlloc="<?php echo base_url($active_modul . "/banding") . "/" . $crypt_id_skpt; ?>">Banding</a>
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
                                            <tr class="<?php echo $record->current_active == 1 ? "active" : ""; ?>">
                                                <td class="text-right"><?php echo $next_list_number++ ?></td>
                                                <td <?php echo $record->current_active == 1 ? "id=\"tdpid\" pid=\"" . add_salt_to_string($record->id_skp_nilai) . "\"" : ""; ?>><?php echo $record->real_nilai_kualitas ?></td>
                                                <td><?php echo $record->real_nilai_waktu ?></td>
                                                <td><?php echo $record->real_nilai_kuantitas . " " . show_skpt_output($record->real_output); ?></td>
                                                <td><?php echo $record->real_nilai_biaya ?></td>
                                                <td><?php echo $record->reject_by_pegawai == 0 ? "<span class=\"label label-success\"><i class=\"ion-checkmark m-r-xs\"></i> Clear</span>" : "<span class=\"label label-danger\"><i class=\"ion-checkmark m-r-xs\"></i> Yes</span>"; ?></td>
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