<script type="text/javascript">
    function showPassword(idElem) {
        if (isHasValue(idElem)) {
            var x = document.getElementById(idElem);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    }

    $(document).ready(function () {
        $("#btnGantiPasswd").click(function (e) {
            e.stopPropagation();
            modalConfirm({
                id: 'message-box-confirm',
                title: "Penggantian Password",
                msg: "Anda yakin akan mengganti password?",
                onOk: function () {
                    $("#frmGantiPassword").submit();
                }
            });
        });
    });
</script>