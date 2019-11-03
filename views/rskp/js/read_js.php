<script type="text/javascript">
    $(document).ready(function () {
        $("#btnscore").click(function (e) {
            e.stopPropagation();

            var pid = $("#tdpid").attr("pid");

            if (isDefined(pid) && isHasValue($("#pegawai_message").val())) {

                $.ajax({
                    url: "<?php echo base_url('rskp/banding')."/"; ?>"+pid,
                    type: "POST",
                    data: {
                        pegawai_message: $("#pegawai_message").val(),
                        cip: $("#cipdd").val(),
                        cis: '<?php echo $crypt_id_skpt; ?>',
                        ajxon: true,
                    },
                    success: function (resp) {
                        location.reload();
                    }
                });
            }
        });
        
        $("#anchor-tab-0").click();
    });
</script>