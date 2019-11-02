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