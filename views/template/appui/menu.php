<?php
$is_authenticated = isset($is_authenticated) ? $is_authenticated : FALSE;
$active_modul = isset($active_modul) ? $active_modul : "";
$current_user_profil_name = isset($current_user_profil_name) ? $current_user_profil_name : "-";
$current_user_roles = isset($current_user_roles) ? $current_user_roles : "pengguna";
$menu_item = isset($menu_item) ? build_appui_menu($menu_item, $active_modul) : "";
?>

<!-- Drawer navigation -->
<nav class="drawer-main">
    <ul class="nav nav-drawer">
        <?php echo $menu_item; ?>
    </ul>
</nav>
<!-- End drawer navigation -->
