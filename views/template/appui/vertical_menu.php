<?php
$is_authenticated = isset($is_authenticated) ? $is_authenticated : FALSE;
$current_user_profil_name = isset($current_user_profil_name) ? $current_user_profil_name : "-";
$current_user_roles = isset($current_user_roles) ? $current_user_roles : "pengguna";
?>

<div class="collapse navbar-collapse" id="header-navbar-collapse">
    <?php /**
      <!-- Header search form -->
      <form class="navbar-form navbar-left app-search-form" role="search">
      <div class="form-group">
      <div class="input-group">
      <input class="form-control" type="search" id="search-input" placeholder="Search..." />
      <span class="input-group-btn">
      <button class="btn" type="button"><i class="ion-ios-search-strong"></i></button>
      </span>
      </div>
      </div>
      </form>
     * 
     */
    ?>

    <?php /**
      <ul id="main-menu" class="nav navbar-nav navbar-left">
      <li class="dropdown">
      <a href="#" data-toggle="dropdown">English <span class="caret"></span></a>

      <ul class="dropdown-menu">
      <li><a href="javascript:void(0)">French</a></li>
      <li><a href="javascript:void(0)">German</a></li>
      <li><a href="javascript:void(0)">Italian</a></li>
      </ul>
      </li>
      <li class="dropdown">
      <a href="#" data-toggle="dropdown">Pages <span class="caret"></span></a>

      <ul class="dropdown-menu">
      <li><a href="javascript:void(0)">Analytics</a></li>
      <li><a href="javascript:void(0)">Visits</a></li>
      <li><a href="javascript:void(0)">Changelog</a></li>
      </ul>
      </li>
      </ul>
      <!-- .navbar-left -->
     * 
     */
    ?>

    <ul class="nav navbar-nav navbar-right navbar-toolbar hidden-sm hidden-xs">

        <?php /**
          <li>
          <!-- Opens the modal found at the bottom of the page -->
          <a href="javascript:void(0)" data-toggle="modal" data-target="#apps-modal"><i class="ion-grid"></i></a>
          </li>
         * 
         */
        ?>

        <li class="dropdown">
            <a href="javascript:void(0)" data-toggle="dropdown">
                <span class="m-r-sm"><?php echo isset($active_user_detail['pegawai_nama']) ? $active_user_detail['pegawai_nama'] : 'User Menu'; ?><span class="caret"></span></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
                <li>
                    <a tabindex="-1" href="<?php echo base_url('profil/info'); ?>">Atribut Data</a>
                </li>
                <li>
                    <a tabindex="-1" href="<?php echo base_url('profil/passwd'); ?>">Ganti Password</a>
                </li>
                <li class="divider"></li>
                <?php if ($is_authenticated): ?>
                    <li>
                        <a href="<?php echo base_url('logout'); ?>"><span class="fa fa-sign-in"></span> Logout</a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="<?php echo base_url('login'); ?>"><span class="fa fa-sign-in"></span> Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </li>
    </ul>
    <!-- .navbar-right -->
</div>