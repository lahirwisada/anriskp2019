<main class="app-layout-content">

    <!-- Page header -->
    <div class="page-header bg-green bg-inverse">
        <div class="container">
            <!-- Section Content -->
            <div class="p-y-lg text-center">
                <h1 class="display-2">Masuk SKP ARSIPARIS</h1>
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
                            <form action="index.html" method="post">
                                <div class="form-group">
                                    <label class="sr-only" for="frontend_login_email">NIP</label>
                                    <input type="numeric" class="form-control" id="nip" placeholder="NIP" />
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="frontend_login_password">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Password" />
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