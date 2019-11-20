<script type="text/javascript">
    $(document).ready(function () {
        $("#cbtugastambahan").click(function (e) {
            if ($(this).is(":checked")) {
                $("#is_tugastambahan").val(1);
            } else {
                $("#is_tugastambahan").val(0);
            }
        });
        
        var dupnk_form = {
            init: function(){
                if($("#is_tugastambahan").val() == 0){
                    $("#cbtugastambahan").prop("checked", false);
                }else{
                    $("#cbtugastambahan").prop("checked", true);
                }
            },
        };
        
        dupnk_form.init();
    });
</script>