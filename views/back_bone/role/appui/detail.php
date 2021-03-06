<?php
$detail = isset($detail) ? $detail : FALSE;
$modul_role_access = isset($modul_role_access) ? $modul_role_access : FALSE;
?>

<div class="row">
    <div class="col-md-12">

        <form enctype="multipart/form-data" method="POST" class="form-horizontal">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">Formulir <strong>Role</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="block">
                        <p><?php echo load_partial("back_bone/shared/attention_message"); ?></p>
                    </div>
                    <div class="block">
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Nama Role *</label>
                            <div class="col-md-6 col-xs-12">                                            
                                <div class="input-group">
                                    <input type="text" name="nama_role" class="form-control" value="<?php echo $detail ? $detail->nama_role : ""; ?>">
                                </div>                                            
                                <span class="help-block">
                                    Nama Role adalah sebuah deskripsi singkat untuk mewakili peran tertentu terhadap pengoperasian dan pengelolaan aplikasi ini.
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="block">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <h4>Daftar Hak Akses</h4>
                                <div class="row">
                                    <div class="dataTables_wrapper no-footer">
                                        <table class="table no-footer" id="DataTables_Table_0">
                                            <thead>
                                                <tr>
                                                    <td rowspan="2">
                                                        Nama Modul
                                                    </td>
                                                    <td rowspan="1" colspan="4">
                                                        Hak Akses&nbsp;<?php /* <input name="ck_check_all" type="checkbox" id="ck_check_all" value="1"> (check semua) */ ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td rowspan="1">
                                                        Baca&nbsp;<?php /* <input name="ck_check_all_read" type="checkbox" id="ck_check_all_read" value="1"> <!-- is_read --> */ ?>
                                                    </td>
                                                    <td rowspan="1">
                                                        Buat Baru&nbsp;<?php /* <input name="ck_check_all_write" type="checkbox" id="ck_check_all_write" value="1"> <!-- is_write --> */ ?>
                                                    </td>
                                                    <td rowspan="1">
                                                        Perbarui (update)&nbsp;<?php /* <input name="ck_check_all_update" type="checkbox" id="ck_check_all_update" value="1"> <!-- is_update --> */ ?>
                                                    </td>
                                                    <td rowspan="1">
                                                        Hapus&nbsp;<?php /* <input name="ck_check_all_delete" type="checkbox" id="ck_check_all_delete" value="1"> <!-- is_delete --> */ ?>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($modul_role_access != FALSE && is_array($modul_role_access) && !empty($modul_role_access)): ?>
                                                    <?php foreach ($modul_role_access as $key => $record_role_access): ?>
                                                        <tr>
                                                            <td rowspan="1">
                                                                <?php echo beautify_str($record_role_access->deskripsi_modul); ?>
                                                                <input type="hidden" name="id_modul[<?php echo $record_role_access->nama_modul; ?>]" value="<?php echo $record_role_access->id_modul; ?>" id="txtInputIdx<?php echo $record_role_access->nama_modul; ?>">
                                                            </td>
                                                            <td rowspan="1">
                                                                <input class="ck_hakakses ck_hakakses_is_read" name="ck_<?php echo $record_role_access->nama_modul; ?>[is_read]" type="checkbox" <?php echo ($record_role_access->access->is_read == 1 ? "checked=\"checked\"" : ""); ?> id="<?php echo $record_role_access->nama_modul; ?>_is_read" value="1">
                                                            </td>
                                                            <td rowspan="1">
                                                                <input class="ck_hakakses ck_hakakses_is_write" name="ck_<?php echo $record_role_access->nama_modul; ?>[is_write]" type="checkbox" <?php echo ($record_role_access->access->is_write == 1 ? "checked=\"checked\"" : ""); ?> id="<?php echo $record_role_access->nama_modul; ?>_is_write" value="1">
                                                            </td>
                                                            <td rowspan="1">
                                                                <input class="ck_hakakses ck_hakakses_is_update" name="ck_<?php echo $record_role_access->nama_modul; ?>[is_update]" type="checkbox" <?php echo ($record_role_access->access->is_update == 1 ? "checked=\"checked\"" : ""); ?> id="<?php echo $record_role_access->nama_modul; ?>_is_update" value="1">
                                                            </td>
                                                            <td rowspan="1">
                                                                <input class="ck_hakakses ck_hakakses_is_delete" name="ck_<?php echo $record_role_access->nama_modul; ?>[is_delete]" type="checkbox" <?php echo ($record_role_access->access->is_delete == 1 ? "checked=\"checked\"" : ""); ?> id="<?php echo $record_role_access->nama_modul; ?>_is_delete" value="1">
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="5"> Kosong / Data tidak ditemukan. </td>
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
                <div class="panel-footer">
                    <button type="submit" class="btn-primary btn pull-right">Simpan</button>
                    <a href="<?php echo base_url("back_bone/role/index"); ?>" class="btn-default btn">Batal / Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>