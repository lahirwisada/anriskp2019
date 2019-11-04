<?php
$header_title = isset($header_title) ? $header_title : '';
$message_error = isset($message_error) ? $message_error : '';
$record_active_column_name = isset($record_active_column_name) ? $record_active_column_name : FALSE;
$records = isset($records) ? $records : FALSE;
$paging_set = isset($paging_set) ? $paging_set : FALSE;
$keyword = isset($keyword) ? $keyword : "";
$next_list_number = isset($next_list_number) ? $next_list_number : 1;
$tahun = isset($tahun) ? $tahun : date('Y');
//var_dump($records);exit;
?>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-sky">
            <?php echo load_partial("back_end/shared/attention_message"); ?>
            <div class="panel-body collapse in">
                <div class="row msg-reset-pass">
                </div>
                <div class="row">
                    <form action="" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" value="<?php echo $keyword; ?>">
                                    <div class="input-group-btn">
                                        <button type="Submit" class="btn btn-info">Cari!</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="table-type-of-leave">
                        <thead>
                            <tr>
                                <th>
                                    No
                                </th>
                                <th>
                                    Arsiparis
                                </th>
                                <th>
                                    Jabatan
                                </th>
                                <th>
                                    Nilai Kerja
                                </th>
                                <th>
                                    AKT
                                </th>
                                <th>
                                    AKK
                                </th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($records != FALSE): ?>
                                <?php foreach ($records as $key => $record): ?>
                                    <tr>
                                        <td>
                                            <?php echo $next_list_number; ?>
                                        </td>
                                        <td>
                                            <?php echo beautify_str($record->pegawai_nama) ?><br />
                                            NIP. <?php echo beautify_str($record->pegawai_nip) ?>
                                        </td>
                                        <td>
                                            Arsiparis <?php echo beautify_str($record->jabfungsional) ?>
                                        </td>
                                        <td>
                                            <?php echo!is_null($record->nilaikinerja_ini) ? number_format($record->nilaikinerja_ini, 2, ',', '.') : number_format($record->nilai_kinerja, 2, ',', '.'); ?>
                                        </td>
                                        <td>
                                            <?php
                                            $akkth_ini = $record->akt_ini;
                                            if (is_null($record->akt_ini)):
                                                ?>
                                                <?php $akkth_ini = calculate_nilai_akt($record->nilai_kinerja, $record->jabfungsional); ?>
                                            <?php endif; ?>
        <?php echo number_format($akkth_ini, 2, ',', '.'); ?>

                                        </td>
                                        <td>
                                            <?php 
                                            $akk = $record->akk_ini;
                                            if (is_null($record->akk_ini)): ?>
                                                <?php $akk = $akkth_ini + $record->akkthlalu; ?>
                                            <?php endif; ?>
                                                <?php echo number_format($akk, 2, ',', '.'); ?>
                                        </td>
                                        <td>
                                            <div class="btn-group">
        <?php
        $crypt_id_akt = is_null($record->id_akt_ini) ? FALSE : add_salt_to_string($record->id_akt_ini);
        ?>
                                                <a class="btn btn-default pull-right btnrekomendasi" urlloc="<?php echo base_url($active_modul . "/set_rekomendasi") . "/" . $crypt_id_akt; ?>?cip=<?php echo add_salt_to_string($record->id_pegawai); ?>&tahun=<?php echo $tahun; ?>">
                                                    Rekomendasi
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
        <?php $next_list_number++; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                        </tbody>
                    </table>
<?php
echo $paging_set;
?>
                </div>
            </div>
        </div>
    </div>
</div>