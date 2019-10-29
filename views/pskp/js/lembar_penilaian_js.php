<script type="text/javascript">
    $(document).ready(function () {
        $("#btnscore").click(function (e) {
            e.stopPropagation();

            var url = $(this).attr("urlloc");

            $.ajax({
                url: "<?php echo base_url('pskp/penilaian'); ?>",
                type: "POST",
                data: {
                    real_nilai_kualitas: $("#real_nilai_kualitas").val(),
                    real_nilai_kuantitas: $("#real_nilai_kuantitas").val(),
                    real_nilai_waktu: $("#real_nilai_waktu").val(),
                    real_nilai_biaya: $("#real_nilai_biaya").val(),
                    real_output: $("#real_output").val(),
                    penilai_message: $("#penilai_message").val(),
                    tahun: $("#skpt_tahun").val(),
                    id_turunan_dari: null,
                    id_skpt: '<?php echo extract_id_with_salt($crypt_id_skpt); ?>',
                    ajxon: true,
                },
                success: function (resp) {
                    console.log(resp);
                }
            });
        });
    });
</script>