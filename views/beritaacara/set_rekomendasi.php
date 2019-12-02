<?php
$tahun = isset($tahun) ? $tahun : date('Y');
$pegawai_detail = isset($pegawai_detail) ? $pegawai_detail : FALSE;
$rekomendasi = isset($rekomendasi) ? $rekomendasi : [];
//var_dump($pegawai_detail);exit;
?>

<div class="panel panel-midnightblue">
    <div class="panel-heading">
        <h4>Pencatatan Rekomendasi</h4>
    </div>
    <div class="panel-body collapse in">
        <?php echo load_partial("back_bone/shared/attention_message"); ?>
        <form method="POST" class="form-horizontal row-border">

            <?php
            /**
             * @deprecated 
             * @see after this commentary
            $akkth_ini = $pegawai_detail->akt_ini;
            if (is_null($pegawai_detail->akt_ini)):
                $akkth_ini = calculate_nilai_akt($pegawai_detail->nilai_kinerja, $pegawai_detail->jabfungsional);
            endif;
            $akk = $pegawai_detail->akk_ini;
            if (is_null($pegawai_detail->akk_ini)):
                $akk = $akkth_ini + $pegawai_detail->akkthlalu;
            endif;
             * 
             */
            list($akk, $akkth_ini) = get_nilai_akk_akth($pegawai_detail);
            echo form_hidden('id_pegawai', $pegawai_detail->id_pegawai);
            echo form_hidden('jabfungsional', $pegawai_detail->jabfungsional);
            echo form_hidden('ak_sebelumnya', $pegawai_detail->akkthlalu);
            echo form_hidden('nilaikinerja', $pegawai_detail->nilai_kinerja);
            echo form_hidden('akt', $akkth_ini);
            echo form_hidden('akk', $akk);
            echo form_hidden('tahun', $tahun);
            ?>
            <div class="form-group">
                <label class="col-sm-3 control-label">Rekomendasi</label>
                <div class="col-sm-6">
                    <?php echo lws_form_dropdown('id_rekomendasi', $rekomendasi, !is_null($pegawai_detail->id_rekomendasi_ini) ? $pegawai_detail->id_rekomendasi_ini : "", " id=\"slc_rekomendasi\" class='form-control select'  data-live-search='true'"); ?>
                </div>
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="btn-toolbar">
                            <button type="submit" class="btn-primary btn">Simpan</button>
                            <a href="<?php echo base_url('beritaacara'); ?>" class="btn-default btn">Batal / Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>