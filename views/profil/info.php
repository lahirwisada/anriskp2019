
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Atribut Data</h4>
            </div>
            <div class="card-block">
                <div class="row">
                    <p><?php echo load_partial("back_end/shared/attention_message"); ?></p>
                </div>
                <div class="row">
                    <form id="frmGantiPassword" class="form-horizontal" method="post">
                        <div class="form-group">
                            <label class="col-xs-12" for="tmtjabfungsional">TMT Jabatan Fungsional</label>
                            <div class="col-xs-12">
                                <?php echo form_input('tmtjabfungsional', set_value('tmtjabfungsional', $detail ? show_date_with_format($detail->tmtjabfungsional) : ''), 'class="js-datepicker form-control"  data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy"'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12" for="nokarpeg">No Kartu Pegawai</label>
                            <div class="col-xs-12">
                                <?php echo form_input('nokarpeg', set_value('nokarpeg', $detail ? $detail->nokarpeg : ''), 'class="form-control" '); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12" for="tempatlahir">Tempat Lahir</label>
                            <div class="col-xs-12">
                                <?php echo form_input('tempatlahir', set_value('tempatlahir', $detail ? $detail->tempatlahir : ''), 'class="form-control" '); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12" for="tgllahir">Tanggal Lahir</label>
                            <div class="col-xs-12">
                                <?php echo form_input('tgllahir', set_value('tgllahir', $detail ? show_date_with_format($detail->tgllahir) : ''), 'class="js-datepicker form-control"  data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy"'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12" for="pangkat">Pangkat</label>
                            <div class="col-xs-12">
                                <?php echo form_input('pangkat', set_value('pangkat', $detail ? $detail->pangkat : ''), 'class="form-control" '); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12" for="golongan">Golongan</label>
                            <div class="col-xs-12">
                                <?php echo form_input('golongan', set_value('golongan', $detail ? $detail->golongan : ''), 'class="form-control" '); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12" for="tmtpangkat_gol">TMT Pangkat Golongan</label>
                            <div class="col-xs-12">
                                <?php echo form_input('tmtpangkat_gol', set_value('tmtpangkat_gol', $detail ? show_date_with_format($detail->tmtpangkat_gol) : ''), 'class="js-datepicker form-control"  data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy"'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12" for="jeniskelamin">Jenis Kelamin</label>
                            <div class="col-xs-12">
                                <?php echo form_dropdown('jeniskelamin', ["1" => "Laki - Laki", "0" => "Perempuan"], set_value('jeniskelamin', $detail ? $detail->jeniskelamin : '1'), 'class="form-control select"'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12" for="unitkerja">Unit Kerja</label>
                            <div class="col-xs-12">
                                <?php echo form_input('unitkerja', set_value('unitkerja', $detail ? $detail->unitkerja : ''), 'class="form-control" '); ?>
                            </div>
                        </div>

                        <div class="form-group m-b-0">
                            <div class="col-xs-12">
                                <button id="btnGantiPasswd" class="btn btn-app" type="Submit">Perbarui</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>