<script>

    var slc_pegawai_cfg = {
        data: [],
        ajax: {
            url: "<?php echo base_url("vskp/get_like_pegawai_all_not_self"); ?>",
            placeholder: 'Pilih Pegawai',
            dataType: 'json',
            delay: 500,
            method: 'post',
            width: '100%',
            data: function (params) {
                return {
                    keyword: params.term, // search term
                    pid: '<?php echo $id_user; ?>', // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {
                var data = $.map(data, function (obj) {
                    obj.id = obj.id || obj.id_pegawai;
                    obj.text = obj.text || obj.pegawai_nip + ' - ' + obj.pegawai_nama;
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


    $(document).ready(function () {
//        $('#tr_aktifitas_mulai').timepicker({minuteStep: 1, showMeridian: false});
//        $('#tr_aktifitas_selesai').timepicker({showMeridian: false});
        $("#slc_pegawai").select2(slc_pegawai_cfg);
    });
</script>