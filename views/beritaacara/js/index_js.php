<script type="text/javascript">
    $(document).ready(function () {
        $(".btnrekomendasi").click(function (e) {
            e.stopPropagation();
            
            var url = $(this).attr('urlloc');
            
            location.href = url;
        });
        
        
        $("#btncetakbap").click(function(e){
            e.stopPropagation();
            
            var url = "<?php echo base_url('beritaacara/cetak_bap'); ?>?tahun="+$("#slctahun").val();
            alert(url);
            location.href = url;
        });
    });
</script>