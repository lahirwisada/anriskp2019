<?php
$app_author = isset($app_author) ? $app_author : 'Lahir Wisada Santoso';
$global_search_action = isset($global_search_action) ? $global_search_action : "#";
$page_title = isset($page_title) ? $page_title : "My Application";
$app_name = isset($app_name) ? $app_name : "My Application";
$app_tahun_pembuatan = isset($app_tahun_pembuatan) ? $app_tahun_pembuatan : date('Y');

$site_description = isset($meta_description) ? $meta_description : "";
$site_keyword = isset($site_keyword) ? $site_keyword : "";

$view_js_default = isset($js_default) ? $js_default : '';
$view_css_default = isset($css_default) ? $css_default : '';

$template_body_class = isset($template_body_class) ? $template_body_class : '';

/**
 * User information
 */
$target_sub_page = isset($target_sub_page) ? $target_sub_page : FALSE;
$slogan = isset($slogan) ? $slogan : FALSE;
$header_title = isset($header_title) ? $header_title : "";

$currentusername = isset($currentusername) ? $currentusername : "Tidak Dikenal";
$current_user_profil_name = isset($current_user_profil_name) ? $current_user_profil_name : "Tidak Dikenal";
$current_user_roles = isset($current_user_roles) ? $current_user_roles : "Tamu";

$current_base_url = isset($current_base_url) ? $current_base_url : '#';
?>
<!DOCTYPE html>
<html class="app-ui">

    <head>
        <!-- Meta -->
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

        <!-- Document title -->
        <title><?php echo $page_title; ?></title>

        <meta name="description" content="<?php echo $site_description; ?>" />
        <meta name="author" content="<?php echo $app_author; ?>" />
        <meta name="robots" content="noindex, nofollow" />

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="assets/img/favicons/apple-touch-icon.png" />
        <link rel="icon" href="<?php echo assets(); ?>/img/favicon.png" />

        <!-- Google fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,900%7CRoboto+Slab:300,400%7CRoboto+Mono:400" />

        <?php echo load_partial('template/appui/default_style'); ?>
        <?php /**
          <!-- Page JS Plugins CSS -->
          <link rel="stylesheet" href="<?php echo assets(); ?>css/plugins/slick/slick.min.css" />
          <link rel="stylesheet" href="<?php echo assets(); ?>css/plugins/slick/slick-theme.min.css" />
          <link rel="stylesheet" id="css-app-custom" href="<?php echo css(); ?>appui/app-custom.css" />
         * 
         */
        ?>
        <!-- End Stylesheets -->

        <?php echo isset($css) ? $css : ''; ?>
    </head>

    <body class="app-ui layout-has-drawer layout-has-fixed-header">
        <div class="app-layout-canvas">
            <div class="app-layout-container">

                <!-- Drawer -->
                <aside class="app-layout-drawer">

                    <!-- Drawer scroll area -->
                    <div class="app-layout-drawer-scroll">
                        <!-- Drawer logo -->
                        <div id="logo" class="drawer-header text-center">
                            <a href="<?php echo $current_base_url; ?>"><img class="img-responsive" style="height: 53px; margin-left: 5px;" src="<?php echo assets(); ?>/img/logo/logo-mini.png" title="Indonesia" alt="Indonesia" /></a>
                        </div>
                        <?php echo load_partial('template/appui/menu'); ?>
                        <?php /**
                          <div class="drawer-footer">
                          <p class="copyright">AppUI Template &copy;</p>
                          <a href="https://shapebootstrap.net/item/1525731-appui-admin-frontend-template/?ref=rustheme" target="_blank" rel="nofollow">Purchase a license</a>
                          </div>
                         * 
                         */
                        ?>
                    </div>
                    <!-- End drawer scroll area -->
                </aside>
                <!-- End drawer -->

                <!-- Header -->
                <header class="app-layout-header">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar-collapse" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <button class="pull-left hidden-lg hidden-md navbar-toggle" type="button" data-toggle="layout" data-action="sidebar_toggle">
                                    <span class="sr-only">Toggle drawer</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <span class="navbar-page-title">
                                    <?php echo $header_title; ?>
                                </span>
                            </div>

                            <?php echo load_partial('template/appui/vertical_menu'); ?>
                        </div>
                        <!-- .container-fluid -->
                    </nav>
                    <!-- .navbar-default -->
                </header>
                <!-- End header -->

                <main class="app-layout-content">

                    <!-- Page Content -->
                    <div class="container-fluid p-y-md">
                        <?php echo $content_for_layout; ?>
                        <!-- .row -->
                    </div>
                    <!-- .container-fluid -->
                    <!-- End Page Content -->

                </main>

            </div>
            <!-- .app-layout-container -->
        </div>
        <!-- .app-layout-canvas -->

        <!-- Apps Modal -->
        <!-- Opens from the button in the header -->
        <div id="apps-modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-sm modal-dialog modal-dialog-top">
                <div class="modal-content">
                    <!-- Apps card -->
                    <div class="card m-b-0">
                        <div class="card-header bg-app bg-inverse">
                            <h4>Apps</h4>
                            <ul class="card-actions">
                                <li>
                                    <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-block">
                            <div class="row text-center">
                                <div class="col-xs-6">
                                    <a class="card card-block m-b-0 bg-app-secondary bg-inverse" href="index.html">
                                        <i class="ion-speedometer fa-4x"></i>
                                        <p>Admin</p>
                                    </a>
                                </div>
                                <div class="col-xs-6">
                                    <a class="card card-block m-b-0 bg-app-tertiary bg-inverse" href="frontend_home.html">
                                        <i class="ion-laptop fa-4x"></i>
                                        <p>Frontend</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- .card-block -->
                    </div>
                    <!-- End Apps card -->
                </div>
            </div>
        </div>
        <!-- End Apps Modal -->

        <div class="app-ui-mask-modal"></div>
        <?php
        /**
          <!-- MESSAGE BOX-->
          <div class="modal" data-sound="alert" id="mb-signout">
          <div class="mb-container">
          <div class="mb-middle">
          <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
          <div class="mb-content">
          <p>Anda yakin melakukan log out?</p>
          <p>Tekan Tidak untuk batal log out. Tekan Ya untuk menutup sesi saat ini.</p>
          </div>
          <div class="mb-footer">
          <div class="pull-right">
          <a href="<?php echo base_url('back_bone/member/logout'); ?>" class="btn btn-success btn-lg">Ya</a>
          <button class="btn btn-default btn-lg mb-control-close">Tidak</button>
          </div>
          </div>
          </div>
          </div>
          </div>
         */
        ?>
        <div class="modal" data-sound="alert" id="mb-success">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">\
                    <div class="card-header bg-green bg-inverse">
                        <h4><span class="fa fa-check"></span> Input data sukses...!</h4>
                        <ul class="card-actions"><li><button data-dismiss="modal" type="button"><i class="ion-close"></i></button></li></ul>
                    </div>
                    <div class="card-block">
                        <p>Data yang Anda masukkan sudah tersimpan di database.</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Tutup</button>
                        <button class="btn btn-sm btn-app" type="button" data-dismiss="modal"><i class="ion-checkmark"></i> Ok</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <div id="whateverelement"></div>
        <div id="whateverformelement" style="display: none;"></div>
        
        <!-- START PRELOADS -->
        <audio id="audio-alert" src="<?php echo assets(); ?>audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="<?php echo assets(); ?>audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS --> 


        <!-- START SCRIPTS -->
        <?php echo load_partial('template/appui/default_scripts'); ?>


        <?php /**
          <script src="<?php echo assets(); ?>js/plugins/slick/slick.min.js"></script>
          <script src="<?php echo assets(); ?>js/appui/plugins/chartjs/Chart.min.js"></script>
          <script src="<?php echo assets(); ?>js/appui/plugins/flot/jquery.flot.min.js"></script>
          <script src="<?php echo assets(); ?>js/appui/plugins/flot/jquery.flot.pie.min.js"></script>
          <script src="<?php echo assets(); ?>js/appui/plugins/flot/jquery.flot.stack.min.js"></script>
          <script src="<?php echo assets(); ?>js/appui/plugins/flot/jquery.flot.resize.min.js"></script>
         * 
         */
        ?>


        <script type="text/javascript" src="<?php echo assets(); ?>js/helper/general_helper.js?v=070820181992"></script>

        <?php echo load_partial('template/additional_js'); ?>

        <?php
        /**
          <!-- Page JS Code for Dashboard (Examples)  -->
          <script src="<?php echo assets(); ?>js/appui/pages/index.js"></script>
          <script>
          $(function()
          {
          // Init page helpers (Slick Slider plugin)
          App.initHelpers('slick');
          });
          </script>
         */
        ?>

        <?php echo isset($js) ? $js : ''; ?>

    </body>

</html>