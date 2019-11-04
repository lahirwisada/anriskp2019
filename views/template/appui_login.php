<?php
$app_author = isset($app_author) ? $app_author : 'Lahir Wisada Santoso';
$global_search_action = isset($global_search_action) ? $global_search_action : "#";
$page_title = isset($page_title) ? $page_title : "My Application";
$app_name = isset($app_name) ? $app_name : "My Application";

$site_description = isset($site_description) ? $site_description : "";
$site_keyword = isset($site_keyword) ? $site_keyword : "";

$view_js_default = isset($js_default) ? $js_default : '';
$view_css_default = isset($css_default) ? $css_default : '';

$template_body_class = isset($template_body_class) ? $template_body_class : '';

/**
 * User information
 */
$nama_profil = isset($nama_profil) ? $nama_profil : 'Tidak Dikenal';
$username = isset($username) ? $username : 'tidakdikenal';
$user_role = isset($user_role) ? $user_role : '';
/*
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
  <link rel="apple-touch-icon" href="<?php echo img(); ?>appui/favicons/apple-touch-icon.png" />
  <link rel="icon" href="<?php echo img(); ?>appui/favicons/favicon.ico" />

  <!-- Google fonts -->
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,900%7CRoboto+Slab:300,400%7CRoboto+Mono:400" />

  <!-- AppUI CSS stylesheets -->
  <link rel="stylesheet" id="css-font-awesome" href="<?php echo css(); ?>appui/font-awesome.css" />
  <link rel="stylesheet" id="css-ionicons" href="<?php echo css(); ?>appui/ionicons.css" />
  <link rel="stylesheet" id="css-bootstrap" href="<?php echo css(); ?>appui/bootstrap.css" />
  <link rel="stylesheet" id="css-app" href="<?php echo css(); ?>appui/app.css" />
  <!--<link rel="stylesheet" id="css-app-custom" href="assets/css/app-custom.css" />-->
  <?php echo isset($css) ? $css : ''; ?>
  <?php echo load_partial('template/additional_css'); ?>
  <?php echo $view_css_default; ?>
  <!-- End Stylesheets -->
  </head>

  <body class="app-ui">
  <div class="app-layout-canvas">
  <div class="app-layout-container">
  <?php echo $content_for_layout; ?>
  </div>
  <!-- .app-layout-container -->
  </div>
  <!-- .app-layout-canvas -->


  </body>

  </html>
 */
?>
<!DOCTYPE html>
<!-- saved from url=(0044)https://lasik.tangerangselatankota.go.id/v2/ -->
<html class=" js cssanimations" lang="en-US"><!--<![endif]--><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $page_title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, target-densitydpi=device-dpi">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="icon" href="<?php echo assets(); ?>/img/favicon.png" />

        <meta name="description" content="<?php echo $site_description; ?>">
        <meta name="author" content="<?php echo $app_author; ?>">
        <?php /**
          <link rel="canonical" href="https://lasik.tangerangselatankota.go.id/v2/">
          <link rel="shortcut icon" href="https://lasik.tangerangselatankota.go.id/v2/images/favicon.ico" type="image/x-icon">
          <link rel="icon" href="https://lasik.tangerangselatankota.go.id/v2/images/icon32.png" sizes="32x32">
          <link rel="icon" href="https://lasik.tangerangselatankota.go.id/v2/images/icon192.png" sizes="192x192">
          <link rel="apple-touch-icon-precomposed" href="https://lasik.tangerangselatankota.go.id/v2/images/icon180.png">
          <meta name="msapplication-TileImage" content="https://lasik.tangerangselatankota.go.id/v2/images/icon270.png">
         * 
         */
        ?>
        <link rel="stylesheet" id="css-app" href="<?php echo css(); ?>appui/login_base.css" />
        <link rel="stylesheet" id="css-app" href="<?php echo css(); ?>appui/login_styles.css" />

        <style>.grecaptcha-badge{display:none !important; visibility:hidden !important;}.btn_disable,input.btn_disable{background-color:#555 !important;color:#999 !important;cursor:default !important;}</style>
    </head>
    <body id="page">

        <ul class="cb-slideshow animate-bg">
            <li><span class="no-animation-bg">ANRI</span><div><h3 style="color:#00ffe6;">ANRI</h3><h4>Arsip Nasional Republik Indonesia</h4></div></li>
            <li><span class="static-bg">SEMAKIN JAGO</span><div><h3 style="color:#8cccff;">SEMAKIN JAGO</h3><h4>Sistem Informasi Penilaian Kinerja Jabatan Fungsional Arsiparis Go Online</h4></div></li>
        </ul>

        <div class="container">
            <header>
                <h1><span class="main-title"></span></h1>
            </header>
        </div>


        <?php echo $content_for_layout; ?>

        <script type="text/javascript" src="<?php echo assets(); ?>js/appui/core/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo assets(); ?>js/appui/plugins/modernizr.custom.86080.js"></script>
    </body>
</html>