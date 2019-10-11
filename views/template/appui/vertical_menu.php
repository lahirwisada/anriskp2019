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

        <?php /**
          <li class="dropdown">
          <a href="javascript:void(0)" data-toggle="dropdown"><i class="ion-ios-bell"></i> <span class="badge">3</span></a>
          <ul class="dropdown-menu dropdown-menu-right">
          <li class="dropdown-header">Profile</li>
          <li>
          <a tabindex="-1" href="javascript:void(0)"><span class="badge pull-right">3</span> News </a>
          </li>
          <li>
          <a tabindex="-1" href="javascript:void(0)"><span class="badge pull-right">1</span> Messages </a>
          </li>
          <li class="divider"></li>
          <li class="dropdown-header">More</li>
          <li>
          <a tabindex="-1" href="javascript:void(0)">Edit Profile..</a>
          </li>
          </ul>
          </li>
         * 
         */
        ?>
        <?php if ($is_authenticated): ?>
            <li class="dropdown dropdown-profile">
                <a href="javascript:void(0)" data-toggle="dropdown">
                    <span class="m-r-sm">John Doe <span class="caret"></span></span>
                    <img class="img-avatar img-avatar-48" src="assets/img/avatars/avatar3.jpg" alt="User profile pic" />
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-header">
                        Pages
                    </li>
                    <li>
                        <a href="base_pages_profile.html">Profile</a>
                    </li>
                    <li>
                        <a href="base_pages_profile.html"><span class="badge badge-success pull-right">3</span> Blog</a>
                    </li>
                    <li>
                        <a href="frontend_login_signup.html">Logout</a>
                    </li>
                </ul>
            </li>
        <?php else: ?>
            <li>
                <a href="<?php echo base_url('login'); ?>"><span class="fa fa-sign-in"></span> Login</a>
            </li>
        <?php endif; ?>
    </ul>
    <!-- .navbar-right -->
</div>