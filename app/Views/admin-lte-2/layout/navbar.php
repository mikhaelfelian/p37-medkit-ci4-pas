<header class="main-header">
  <!-- Logo -->
  <a href="<?= base_url() ?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b></b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b><?= env('app.name', 'PASIEN') ?></b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?= (!empty($user->file_name)) ? $Pengaturan->url_app.'/'.$user->file_name : base_url('public/assets/theme/admin-lte-2/dist/img/user2-160x160.jpg') ?>" class="user-image"
              alt="User Image">
            <span class="hidden-xs"><?= $user->first_name ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?= (!empty($user->file_name)) ? $Pengaturan->url_app.'/'.$user->file_name : base_url('public/assets/theme/admin-lte-2/dist/img/user2-160x160.jpg') ?>"
                class="img-circle" alt="User Image">
              <p>
                <?= $user->first_name ?>
                <small>Sejak <?= tgl_indo5(date('Y-m-d', $user->created_on)) ?></small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="<?= base_url('auth/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>