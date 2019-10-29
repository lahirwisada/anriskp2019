<?php
$login_success = isset($login_success) ? $login_success : FALSE;
$model_user_attributes = isset($model_user_attributes) && array_have_value($model_user_attributes) ? $model_user_attributes : FALSE;
$attention_messages = isset($attention_messages) ? $attention_messages : FALSE;
?>

<div class="block">
    <?php echo load_partial("back_bone/shared/attention_message"); ?>
</div>






<main class="app-layout-content">

    <!-- Page header -->
    <div class="page-header bg-green bg-inverse">
        <div class="container">
            <!-- Section Content -->
            <div class="p-y-lg text-center">
                <h1 class="display-2">SEMAKIN JAGO</h1>
                <p class="text-center">Sistem Informasi Penilaian Kinerja Jabatan Fungsional Arsiparis Go Online</p>
                <p class="text-muted">Gunakan NIP sebagai username untuk masuk.</p>
            </div>
            <!-- End Section Content -->
        </div>
    </div>
    <!-- End Page header -->

    <!-- Page content -->
    <div class="page-content">
        <div class="container">
            <div class="row">
                <!-- Login card -->
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="card">
                        <div class="card-block">
                            <div class="block">
                                <?php echo load_partial("back_bone/shared/attention_message"); ?>
                            </div>
                            <form class="form-horizontal" method="post">
                                <div class="form-group">
                                    <label class="sr-only" for="frontend_login_email">NIP</label>
                                    <input type="numeric" class="form-control" name="username" id="username" placeholder="NIP" value="<?php echo $model_user_attributes ? $model_user_attributes['username'] : ""; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="frontend_login_password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $model_user_attributes ? $model_user_attributes['password'] : ""; ?>">
                                </div>
                                <button type="submit" class="btn btn-app btn-block">Masuk</button>
                            </form>
                        </div>
                        <!-- .card-block -->
                    </div>
                    <!-- .card -->
                </div>
                <!-- .col-md-6 -->
                <!-- End login -->

            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </div>
    <!-- End page content -->

</main>