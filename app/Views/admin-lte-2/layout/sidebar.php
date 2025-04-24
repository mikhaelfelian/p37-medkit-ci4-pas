<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?= (!empty($user->file_name)) ? $Pengaturan->url_app.'/'.$user->file_name : base_url('public/assets/theme/admin-lte-2/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="<?= $user->first_name ?>">
      </div>
      <div class="pull-left info">
        <p><?= $user->first_name ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li<?= isMenuActive('dashboard') ? ' class="active"' : '' ?>>
        <a href="<?= base_url('dashboard') ?>">
          <i class="fa fa-dashboard"></i> <span>Beranda</span>
        </a>
      </li>
      <li<?= isMenuActive('pasien/pendaftaran.php') ? ' class="active"' : '' ?>>
        <a href="<?= base_url('pasien/pendaftaran.php') ?>">
          <i class="fa fa-user-plus"></i> <span>Pendaftaran</span> 
        </a>
      </li>
      <li>
        <a href="#">
          <i class="fa fa-flask"></i> <span>Riwayat Lab</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i class="fa fa-file-text"></i> <span>Riwayat Rontgen</span>
        </a>
      </li>
      <li>
        <a href="#">
          <i class="fa fa-paperclip"></i> <span>Riwayat Berkas</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside> 