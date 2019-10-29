
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Ganti Password</h4>
            </div>
            <div class="card-block">
                <div class="row">
                    <p><?php echo load_partial("back_end/shared/attention_message"); ?></p>
                </div>
                <div class="row">
                    <form id="frmGantiPassword" class="form-horizontal" method="post">
                        <div class="form-group">
                            <label class="col-xs-12" for="register1-password">Password Lama</label>
                            <div class="col-xs-12">
                                <input class="form-control" type="password" id="oldpassword" name="oldpassword" placeholder="Password Lama" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="css-input switch switch-sm switch-primary">
                                    <input type="checkbox" id="lihatoldpassword" onclick="showPassword('oldpassword');"><span></span>Perlihatkan Password
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12" for="register1-password2">Password Baru</label>
                            <div class="col-xs-12">
                                <input class="form-control" type="password" id="newpassword" name="newpassword" placeholder="Password Baru" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label class="css-input switch switch-sm switch-primary">
                                    <input type="checkbox" id="lihatnewpassword" onclick="showPassword('newpassword');"><span></span>Perlihatkan Password
                                </label>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div class="col-xs-12">
                                <button id="btnGantiPasswd" class="btn btn-app" type="button">Ganti</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>