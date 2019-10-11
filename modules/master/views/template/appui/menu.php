<?php
$is_authenticated = isset($is_authenticated) ? $is_authenticated : FALSE;
$active_modul = isset($active_modul) ? $active_modul : "";
$current_user_profil_name = isset($current_user_profil_name) ? $current_user_profil_name : "-";
$current_user_roles = isset($current_user_roles) ? $current_user_roles : "pengguna";
$menu_item = isset($menu_item) ? build_appui_menu($menu_item, $active_modul) : "";
?>
<?php
/**
<!-- Drawer navigation -->
<nav class="drawer-main">
    <ul class="nav nav-drawer">

        <?php echo $menu_item; ?>

    </ul>
</nav>
<!-- End drawer navigation -->
*/
?>

<!-- Drawer navigation -->
<nav class="drawer-main">
    <ul class="nav nav-drawer">

        <!--<li class="nav-item nav-drawer-header">Apps</li>-->

        <li class="nav-item active">
            <a href="<?php echo base_url('demostarter'); ?>"><i class="ion-ios-speedometer-outline"></i> Dashboard</a>
        </li>

        <li class="nav-item nav-item-has-subnav">
            <a href="javascript:void(0)"><i class="ion-ios-people-outline"></i> Warga</a>
            <ul class="nav nav-subnav">
                <li class="nav-item">
                    <a href="<?php echo base_url('demostarter/demowarga'); ?>">Tabel Warga</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('demostarter/demo_pencarian_warga'); ?>">Pencarian Warga</a>
                </li>
            </ul>
        </li>
        
        <li class="nav-item nav-item-has-subnav">
            <a href="javascript:void(0)"><i class="ion-ios-people"></i> Warga Tidak Tetap</a>
            <ul class="nav nav-subnav">
                <li class="nav-item">
                    <a href="<?php echo base_url('demostarter/demowargatidaktetap'); ?>">Tabel Warga</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('demostarter/demopencarianwargatidaktetap'); ?>">Pencarian Warga</a>
                </li>
            </ul>
        </li>
        
        <li class="nav-item nav-item-has-subnav">
            <a href="javascript:void(0)"><i class="ion-social-yen-outline"></i> Keuangan Lingkungan</a>
            <ul class="nav nav-subnav">
                <li class="nav-item">
                    <a href="<?php echo base_url('demostarter/democashflow'); ?>">Cash Flow</a>
                </li>
            </ul>
        </li>
        
        <li class="nav-item nav-item-has-subnav">
            <a href="javascript:void(0)"><i class="ion-ios-paper-outline"></i> Surat Menyurat</a>
            <ul class="nav nav-subnav">
                <li class="nav-item">
                    <a href="<?php echo base_url('demostarter/democashflow'); ?>">Surat Pengantar</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('demostarter/democashflow'); ?>">Surat Pengantar Nikah</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('demostarter/democashflow'); ?>">Surat Pengantar SKU</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('demostarter/democashflow'); ?>">Surat Pengantar Pindah Alamat</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('demostarter/democashflow'); ?>">Surat Pengantar Ahli Waris</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('demostarter/democashflow'); ?>">Surat Pengantar Belum Memiliki Rumah</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('demostarter/democashflow'); ?>">Surat Pengantar Cerai</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('demostarter/democashflow'); ?>">Surat Pengantar Akte Kelahiran</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('demostarter/democashflow'); ?>">Surat Pengantar Akte Kematian</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('demostarter/democashflow'); ?>">Surat Keterangan Domisili</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('demostarter/democashflow'); ?>">Surat Keterangan Tidak Mampu</a>
                </li>
            </ul>
        </li>
        
        <li class="nav-item nav-item-has-subnav">
            <a href="javascript:void(0)"><i class="ion-social-yen-outline"></i> Statistik</a>
            <ul class="nav nav-subnav">
                <li class="nav-item">
                    <a href="<?php echo base_url('demostarter/democashflow'); ?>">Pertumbuhan Warga</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('demostarter/democashflow'); ?>">Keuangan Lingkungan</a>
                </li>
            </ul>
        </li>
        
        <li class="nav-item nav-item-has-subnav">
            <a href="javascript:void(0)"><i class="ion-social-yen-outline"></i> Detil Aplikasi</a>
            <ul class="nav nav-subnav">
                <li class="nav-item">
                    <a href="<?php echo base_url('demostarter/democashflow'); ?>">Sejarah Pembayaran</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('demostarter/democashflow'); ?>">Kontrak Paket</a>
                </li>
            </ul>
        </li>

    </ul>
</nav>
<!-- End drawer navigation -->
