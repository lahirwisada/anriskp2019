<script type="text/javascript">
    $(document).ready(function () {
        $(".btncetak").click(function (e) {
            e.stopPropagation();
            
            var url = $(this).attr('urlloc');
            
            location.href = url;
        });
    });
</script>