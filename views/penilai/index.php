<?php
$header_title = isset($header_title) ? $header_title : '';
$message_error = isset($message_error) ? $message_error : '';
$record_active_column_name = isset($record_active_column_name) ? $record_active_column_name : FALSE;
$records = isset($records) ? $records : FALSE;
$paging_set = isset($paging_set) ? $paging_set : FALSE;
$keyword = isset($keyword) ? $keyword : "";
$next_list_number = isset($next_list_number) ? $next_list_number : 1;
$is_developer = isset($is_developer) ? $is_developer : TRUE;
?>

<div class="row">
    <div class="col-md-12">

        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
            <div class="panel-heading ui-draggable-handle">                                
                <h3 class="panel-title">Daftar Penilai</h3>
            </div>
            <div class="panel-body">
                <?php echo load_partial("back_bone/shared/attention_message"); ?>
                <p>Gunakan Formulir ini untuk melakukan pencarian pada halaman ini.</p>
                <form class="form-panel">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="keyword" value="<?php echo $keyword; ?>" class="form-control" placeholder="Silahkan masukkan kata kunci disini"/>
                            <div class="input-group-btn">
                                <button class="btn btn-default"><span class="fa fa-search"></span> Cari</button>
                            </div>
                        </div>
                    </div>
                </form>
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
                                            <?php echo $record->pegawai_nama."<br />"."NIP : ".$record->pegawai_nip; ?>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <a class="btn btn-default" href="<?php echo base_url('penilai/daftar_audien')."/".add_salt_to_string($record->id_user); ?>">Daftar Audiens</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $next_list_number++; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3"> Kosong / Data tidak ditemukan. </td>
                                </tr>
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