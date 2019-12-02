<div class="row">
    <div class="col-md-12">

        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
            <div class="panel-heading ui-draggable-handle label">                                
                <h3 class="panel-title"><?php echo $header_title; ?></h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Upload : </label>
                    <div class="col-md-6 col-xs-12">
                        <input type="hidden" id="random_id" name="upload_random_id" value="<?php echo set_value('upload_random_id', $final_random_id); ?>"/>
                        <input type="file" id="bukti_kerja" name="bukti_kerja" class="inputFile" required data-allowed-file-extensions='["png","jpg","jpeg","bmp","pdf"]' multiple>
                    </div>
                </div>
                <div class="row">
                    <table id="tableListFileUpload" class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="70%">File Bukti</th>
                                <th width="30%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($uploaded_files):
                                foreach ($uploaded_files as $files):
                                    ?>
                                    <tr fname="<?php echo $files; ?>">
                                        <td class="td-nama-file">
                                            <a class="btn btn-xs btn-app-blue-outline" target="_blank" rel="noopener noreferrer" href="<?php echo base_url('_assets/uploads') . '/' . $random_id . '/' . $files; ?>"><?php echo $files ?></a>
                                            <?php // echo $files; ?>
                                            <input name="uploadedFiles[]" type="hidden" value="<?php echo $files; ?>">
                                        </td>
                                        <td class="td-aksi">
                                            <a href="#" class="remove-button">
                                                <span class="fa fa-trash text-danger"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <a href="<?php echo base_url('beritaacara'); ?>" class="btn-default btn">Batal / Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>