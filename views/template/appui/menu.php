<?php
$is_authenticated = isset($is_authenticated) ? $is_authenticated : FALSE;
$active_modul = isset($active_modul) ? $active_modul : "";
$current_user_profil_name = isset($current_user_profil_name) ? $current_user_profil_name : "-";
$current_user_roles = isset($current_user_roles) ? $current_user_roles : "pengguna";
$menu_item = isset($menu_item) ? build_appui_menu($menu_item, $active_modul) : "";
?>

<?php if ($is_authenticated): ?>
        <div class="profile">
            <div class="profile-image" style="border:none;">
                <img style="border:none;" src="<?php echo isset($active_user_detail['user_foto']) ? (isset($_SERVER['HTTPS']) ? str_ireplace("http://", "https://", $active_user_detail['user_foto']) : $active_user_detail['user_foto']) : upload_location("images/users/user_default_avatar.jpg"); ?>" alt="<?php echo $current_user_profil_name; ?>"/>
            </div>
            <div class="profile-data">
                <div class="profile-data-name" style="font-weight: bold;"><?php echo $current_user_profil_name; ?></div>
                <div class="profile-data-name" style="font-size: 11px;">NIP. <?php echo isset($active_user_detail['pegawai_nip']) ? $active_user_detail['pegawai_nip'] : ''; ?></div>
                <div class="profile-data-name" style="font-size: 11px;"><?php echo ucwords(strtolower(isset($active_user_detail['nama_jabatan']) ? $active_user_detail['nama_jabatan'] : '')); ?></div>
                <div class="profile-data-name" style="font-size: 11px;border-top: 1px solid #ccc;"><?php echo ucwords(strtolower(isset($active_user_detail['nama_jabatan']) ? $active_user_detail['nama_organisasi'] : '')); ?></div>
            </div>
            <div class="profile-controls">
                <?php /*
                  <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                  <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                 * 
                 */
                ?>
            </div>
        </div>
    <?php else: ?>
        <a href="#" class="profile-mini">
            <img src="<?php echo upload_location("images/users/user_default_avatar.jpg"); ?>" alt="User"/>
        </a>
        <div class="profile">
            <div class="profile-image">
                <img src="<?php echo upload_location("images/users/user_default_avatar.jpg"); ?>" alt="User"/>
            </div>
            <div class="profile-data">
                <div class="profile-data-name">User</div>
                <div class="profile-data-title">Tamu</div>
            </div>
        </div>
    <?php endif ?>
<!-- Drawer navigation -->
<nav class="drawer-main">
    <ul class="nav nav-drawer">
        <li>
            &nbsp;
        </li>
        <?php echo $menu_item; ?>
    </ul>
</nav>
<!-- End drawer navigation -->
