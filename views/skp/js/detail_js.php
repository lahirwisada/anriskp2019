<?php
$detail = isset($detail) ? $detail : FALSE;
$current_jab_fungsional = isset($current_jab_fungsional) && $current_jab_fungsional ? $current_jab_fungsional : 0;
?>
<script>

    var slc_aktifitas_cfg = {
        data: [],
        ajax: {
            url: "<?php echo base_url(); ?>master/dupnk/get_like_jab",
            placeholder: 'Pilih Kegiatan',
            dataType: 'json',
            delay: 500,
            method: 'post',
            width: '100%',
            data: function (params) {
                return {
                    keyword: params.term, // search term
                    jabfung: '<?php echo $current_jab_fungsional; ?>', // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {
                var data = $.map(data, function (obj) {
                    obj.id = obj.id || obj.id_dupnk;
                    obj.text = obj.text || obj.deskripsi_dupnk;
                    return obj;
                });
                params.page = params.page || 1;
                return {
                    results: data
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) {
            return markup;
        }, // let our custom formatter work
        minimumInputLength: 4
    };
<?php if ($detail && $detail->id_dupnk != ""): ?>
        slc_aktifitas_cfg.data = [
            {
                id: '<?php echo $detail->id_dupnk ?>',
                text: '<?php echo show_first_line_from_multiple_line($detail->deskripsi_dupnk); ?>'
            }
        ];
<?php endif; ?>


    $(document).ready(function () {
//        $('#tr_aktifitas_mulai').timepicker({minuteStep: 1, showMeridian: false});
//        $('#tr_aktifitas_selesai').timepicker({showMeridian: false});
        $("#id_dupnk").select2(slc_aktifitas_cfg);
<?php if ($detail && $detail->id_dupnk != ""): ?>
            $("#id_dupnk").val(<?php echo $detail->id_dupnk ?>).trigger("change");
<?php endif; ?>
    
        $("#simpan").click(function(){
            var cL = modalLoading({
                title: "Mohon Tunggu ...",
                titleIcon: 'fa fa-times',
                msg: "Sedang Mencatat Aktivitas baru ..."
            });
        });
    });
</script>

<script>

    var uploadInput = {
        init: function () {
            this.initFrmUpload();
        },
        addFileUpload: function (rowUpload) {

            if (isDefined(rowUpload)) {
//                var tableRef = document.getElementById('tableListFileUpload').getElementsByTagName('tbody')[0];
                var tr = "<tr class=\"tr-upload-file\"><td>" + rowUpload[1] + "</td><td>" + rowUpload[2] + "</td></tr>"

                var td1 = $("<td class=\"td-nama-file\"></td>")
                        .append(document.createTextNode(rowUpload[0]))
                        .append(rowUpload[4]);
//                var td2 = $("<td class=\"td-lhkpn-excel\"></td>")
//                        .append(rowUpload[1])
//                        .append(rowUpload[4]);
                var td3 = $("<td class=\"td-aksi\"></td>").append(rowUpload[2]);

                var tr = $("<tr></tr>");
                $(tr).append(td1);
//                $(tr).append(td2);
                $(tr).append(td3);

                $("#tableListFileUpload tbody").prepend(tr);
            }
        },
        resetAllRemoveButton: function () {
            $(".td-aksi a.remove-button").remove();

            $(".td-aksi").each(function (index) {
                uploadInput.addRemoveButton(this);
            });
        },
        addRemoveButton: function (progressBarcell) {
            var removeButton = $("<a href=\"#\" class=\"remove-button\" ><span class=\"fa fa-trash text-danger\"></span></a>");

            $(progressBarcell).append(removeButton);

            $(removeButton).click(function () {
                $(progressBarcell).parent().remove();
            });
        },
        afterUpload: function (status, xhr, progressBarcell) {
            if (status == 200) {
                $(progressBarcell).html('');

                uploadInput.addRemoveButton(progressBarcell);
            }
        },
        sendUpload: function (self, fileName, file) {
            var divProgressbarProgress = $("<div class=\"progress-bar\" role=\"progressbar\" aria-valuenow=\"0\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 40%\"><span class=\"sr-only\">40% Complete (success)</span></div>");

            var divProgressbar = $("<div class=\"progress\"></div>");

            $(divProgressbar).append(divProgressbarProgress);

//            var radioExcel = $("<input name=\"isfileexcel\" type=\"radio\" value=\"" + fileName + "\">");
            var radioBtn = "";
            var hiddenFileList = $("<input name=\"uploadedFiles[]\" type=\"hidden\" value=\"" + fileName + "\">");
            self.addFileUpload([
                fileName,
                radioBtn,
                $(divProgressbar),
                $("<a href=\"#\" class=\"removeFile text-danger\"><span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span></a>"),
                hiddenFileList,
            ]);

/**
            $(radioBtn).click(function () {
                uploadInput.resetAllRemoveButton();
                var tr = $(this).parent().parent();
                var lastTd = $(tr).children(":nth-last-child(1)");
                $(lastTd).find("a.remove-button").remove();
            });*/

            return UploadFile(file, "<?php echo base_url("skp/temp_upload"); ?>", divProgressbar, undefined, self.afterUpload, "file_bukti_kerja");
        },
        getFilename: function (value) {
            return value.split('\\').pop();
        },
        initFrmUpload: function () {
            var input = document.getElementById("bukti_kerja"), self = this;

            input.addEventListener('change', function (e)
            {
                if (this.files.length > 0) {
                    var i = 0;
                    while (i < this.files.length) {
                        self.sendUpload(self, this.files[i].name, this.files[i]);
                        i++;
                    }
                }
            });
        }
    };

    $(document).ready(function () {
        uploadInput.init();
    });

</script>