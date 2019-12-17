<?php
$header_title = isset($header_title) ? $header_title : '';
$message_error = isset($message_error) ? $message_error : '';
$records = isset($records) ? $records : FALSE;
$next_list_number = isset($next_list_number) ? $next_list_number : 1;
$tgl_aktivitas = isset($tgl_aktivitas) ? $tgl_aktivitas : date('d-m-Y');
$nip = isset($nip) ? $nip : '';
$perilaku = isset($perilaku) ? $perilaku : FALSE;
$detail_pegawai = isset($detail_pegawai) ? $detail_pegawai : '';

$skpt_ouput = get_skpt_output();
$status = get_skpt_status();
$label = get_skpt_label();
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading ui-draggable-handle">
                <h3 class="panel-title"><?php echo $header_title; ?></h3>
            </div>
            <div class="panel-body">
                <?php echo load_partial("back_end/shared/attention_message"); ?>
                <div class="panel panel-default">
                    <form class="form-panel" method="get">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Tahun</label>
                                                    <div class="col-md-9">
                                                        <div class="input-group" >
                                                            <?php echo dropdown_tahun('tahun_skp', $tahun_skp, 5, 'class="form-control"') ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="col-md-2 control-label">NIP</label>
                                                    <div class="col-md-10">
                                                        <?php echo lws_form_dropdown('nip', $pegawai, "", " id=\"slc_pegawai\" class='form-control select'  data-live-search='true'"); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if ($detail_pegawai): ?>
                                <br />
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
                            <?php endif; ?>
                            <br />
                            <input id="simpan" type="submit" value="Cari" class="btn-primary btn pull-right">
                        </div>
                    </form>
                </div>
                <br />
                <div class="panel panel-default">
                    <div class="panel-body">


                        <div class="card">
                            <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs">
                                <li class="active">
                                    <a href="#btabs-alt-static-home">Daftar SKP</a>
                                </li>
                                <li>
                                    <a href="#btabs-alt-static-files">SKP dan SPMK</a>
                                </li>
                                <li>
                                    <a href="#btabs-alt-static-dp3">DP 3</a>
                                </li>
                            </ul>
                            <div class="card-block tab-content">
                                <div class="tab-pane active" id="btabs-alt-static-home">

                                    <div class="table-responsive">
                                        <table class="table table-striped table-vcenter">
                                            <thead>
                                                <tr role="row">
                                                    <th>No</th>
                                                    <th class="text-center">Nama Kegiatan</th>
                                                    <th>Kuantitas</th>
                                                    <th>Kualitas</th>
                                                    <th>Waktu</th>
                                                    <th>Biaya</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($records != FALSE): ?>
                                                    <?php foreach ($records as $key => $record): ?>
                                                        <tr class="<?php echo $record->telahdinilai > 0 ? "bg-cyan-lighter-important" : ""; ?>">
                                                            <td class="text-right" rowspan="3"><?php echo $next_list_number++ ?></td>
                                                            <td rowspan="2"><?php echo beautify_str($record->deskripsi_dupnk) ?></td>
                                                            <td><?php echo $record->skpt_kuantitas . " " . $skpt_ouput[$record->skpt_output] ?></td>
                                                            <td class="text-right"><?php echo $record->skpt_kualitas ?></td>
                                                            <td class="text-right"><?php echo $record->skpt_waktu ?></td>
                                                            <td class="text-right" rowspan="2"><span class="pull-left">Rp. </span><?php echo number_format($record->skpt_biaya, 0, ',', '.') ?></td>
                                                            <td class="text-center" rowspan="2"><span class="label <?php echo $label[$record->skpt_status] ?>"><?php echo $status[$record->skpt_status] ?></span></td>
                                                            <td class="text-center" rowspan="2">
                                                                <div class="btn-group btn-group-sm">
                                                                    <a class="btn btn-sm btn-default" href="<?php echo base_url($active_modul . "/lembar_penilaian") . "/" . add_salt_to_string($record->id_skpt); ?>">Nilai</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr class="<?php echo $record->telahdinilai > 0 ? "bg-cyan-lighter-important" : ""; ?>">
                                                            <td><strong><?php echo $record->skpt_real_kuantitas . " " . $skpt_ouput[$record->skpt_real_output] ?></strong></td>
                                                            <td class="text-right"><strong><?php echo $record->skpt_real_kualitas ?></strong></td>
                                                            <td class="text-right"><strong><?php echo $record->skpt_real_waktu ?></strong></td>
                                                        </tr>
                                                        <tr class="<?php echo $record->telahdinilai > 0 ? "bg-cyan-lighter-important" : ""; ?>">
                                                            <td colspan="7">
                                                                <?php if ($record->uploaded_files && !empty($record->uploaded_files)): ?>
                                                                    <?php foreach ($record->uploaded_files as $uploaded_file): ?>
                                                                        <a class="btn btn-xs btn-app-blue-outline" target="_blank" rel="noopener noreferrer" href="<?php echo base_url('_assets/uploads') . '/' . $record->upload_random_id . '/' . $uploaded_file; ?>"><?php echo $uploaded_file ?></a>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
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
                                <div class="tab-pane" id="btabs-alt-static-files">
                                    <?php if ($thuploaded_files && !empty($thuploaded_files)): ?>
                                        <?php foreach ($thuploaded_files as $uploaded_file): ?>
                                            <a class="btn btn-xs btn-app-teal-outline" target="_blank" rel="noopener noreferrer" href="<?php echo base_url('_assets/uploads') . '/' . $thrandom_id . '/' . $uploaded_file; ?>"><?php echo $uploaded_file ?></a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="tab-pane" id="btabs-alt-static-dp3">

                                    <table>
                                        <tr>
                                            <td>Orientasi Pelayanan</td>
                                            <td>:</td>
                                            <td><?php echo ($perilaku) ? $perilaku->perilaku_pelayanan : 0; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Integritas</td>
                                            <td>:</td>
                                            <td><?php echo ($perilaku) ? $perilaku->perilaku_integritas : 0; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Komitmen</td>
                                            <td>:</td>
                                            <td><?php echo ($perilaku) ? $perilaku->perilaku_komitmen : 0; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Disiplin</td>
                                            <td>:</td>
                                            <td><?php echo ($perilaku) ? $perilaku->perilaku_disiplin : 0; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kerjasama</td>
                                            <td>:</td>
                                            <td><?php echo ($perilaku) ? $perilaku->perilaku_kerjasama : 0; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Kepemimpinan</td>
                                            <td>:</td>
                                            <td><?php echo ($perilaku) ? $perilaku->perilaku_kepemimpinan : 0; ?></td>
                                        </tr>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>