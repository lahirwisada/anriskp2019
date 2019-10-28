<?php
$header_title = isset($header_title) ? $header_title : '';
$message_error = isset($message_error) ? $message_error : '';
$records = isset($records) ? $records : FALSE;
$next_list_number = isset($next_list_number) ? $next_list_number : 1;
$penilai_detail = isset($penilai_detail) ? $penilai_detail : FALSE;
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

                    <div class="panel-body">
                        <?php if ($penilai_detail): ?>
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">NIP</label>
                                            <div class="col-md-10">
                                                <?php echo $penilai_detail->pegawai_nip; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Nama</label>
                                            <div class="col-md-10">
                                                <?php echo $penilai_detail->pegawai_nama; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                &nbsp;
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Pilih Audien</label>
                                            <div class="col-md-10">
                                                <?php echo lws_form_dropdown('nip', $pegawai, "", " id='slc_pegawai' class='form-control select'  data-live-search='true'"); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <input id="tambah_audien" type="button" value="Tambah" class="btn-primary btn pull-right">
                    </div>
                </div>
                <br />
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed table-bordered table-striped">
                                <thead>
                                    <tr role="row">
                                        <th width="5%">
                                            No
                                        </th>
                                        <th>
                                            Nama
                                        </th>
                                        <th width="20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($records != FALSE): ?>
                                        <?php foreach ($records as $key => $record): ?>
                                            <tr>
                                                <td class="text-right">
                                                    <?php echo $next_list_number; ?>
                                                </td>
                                                <td>
                                                    <?php echo $record->pegawai_nama . "<br />" . "NIP : " . $record->pegawai_nip; ?>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-group-sm">
                                                        <a class="btn btn-default rem-audien" rel="<?php echo base_url('penilai/remove_audien') . "/" . add_salt_to_string($record->id_user).'?pid='. $id_user; ?>">Hapus</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $next_list_number++; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5"> Kosong / Tidak ada Audien. </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="<?php echo base_url('penilai'); ?>" class="btn-default btn">Kembali</a>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>