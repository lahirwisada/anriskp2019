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