<?php
$header_title = isset($header_title) ? $header_title : '';
$active_modul = isset($active_modul) ? $active_modul : 'none';
$detail = isset($detail) ? $detail : FALSE;
$enum_jabatan = isset($enum_jabatan) ? $enum_jabatan : array(
                                'mahir'=>'Mahir','muda'=>'Muda','penyelia'=>"Penyelia",'pertama'=>'Pertama','terampil'=>'Terampil'
                            );
?>

<div class="row">
    <div class="col-md-12">

        <form enctype="multipart/form-data" method="POST" class="form-horizontal">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <h3 class="panel-title">Formulir <strong><?php echo $header_title; ?></strong></h3>
                </div>
                <div class="panel-body">
                    <p><?php echo load_partial("back_end/shared/attention_message"); ?></p>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Untuk Jabatan *</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <?php
                            echo form_dropdown('jabfungsional', $enum_jabatan, $detail ? $detail->jabfungsional : '', 'class="form-control select" data-live-search="true"');
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Nomor Kode </label>
                        <div class="col-md-6 col-xs-12">                                            
                            <div class="input-group">
                                <!--<span class="input-group-addon"><span class="fa fa-pencil"></span></span>-->
                                <span class="input-group-addon"></span>
                                <?php echo form_input('kode_nomor', $detail ? $detail->kode_nomor : '', 'class="form-control"'); ?>
                            </div>
                            <span class="help-block">Untuk memudahkan Pencarian.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Uraian / Deskripsi *</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <div class="input-group">
                                <!--<span class="input-group-addon"><span class="fa fa-pencil"></span></span>-->
                                <span class="input-group-addon"></span>
                                <?php echo form_input('deskripsi_dupnk', $detail ? $detail->deskripsi_dupnk : '', 'class="form-control"'); ?>
                            </div>
                            <span class="help-block">Isikan sesuai dengan uraian DUPNK.</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Turunan Dari</label>
                        <div class="col-md-6 col-xs-12">                                            
                            <div class="input-group">
                                <input type="hidden" value="1" name="no_dupnk">
                                <input type="hidden" value="1" name="no_urut">
                                <!--<span class="input-group-addon"><span class="fa fa-pencil"></span></span>-->
                                <span class="input-group-addon"></span>
                                <?php echo form_input('turunan_dari', $detail ? $detail->turunan_dari : '', 'class="form-control"'); ?>
                            </div>
                            <span class="help-block">
                                Isikan sesuai urutan turunannya, diisi berdasarkan <strong>Nomor Kode</strong>.<br />
                                Isian ini digunakan untuk penyesuaian otomatis ketika melakukan cetak.
                            </span>
                        </div>
                    </div>
                    
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn-primary btn pull-right">Simpan</button>
                    <!--<a href="<?php echo base_url("back_end/" . $active_modul . "/index"); ?>" class="btn-default btn">Batal / Kembali</a>-->
                    <a href="<?php echo base_url($referer); ?>" class="btn-default btn">Batal / Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>