<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?= base_url('public/assets/theme/admin-lte-2/dist/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Alexander Pierce</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="active">
        <a href="<?= base_url('dashboard') ?>">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="<?= base_url('widgets') ?>">
          <i class="fa fa-th"></i> <span>Widgets</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-green">new</small>
          </span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-files-o"></i>
          <span>Layout Options</span>
          <span class="pull-right-container">
            <span class="label label-primary pull-right">4</span>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?= base_url('layout/top-nav') ?>"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
          <li><a href="<?= base_url('layout/boxed') ?>"><i class="fa fa-circle-o"></i> Boxed</a></li>
          <li><a href="<?= base_url('layout/fixed') ?>"><i class="fa fa-circle-o"></i> Fixed</a></li>
          <li><a href="<?= base_url('layout/collapsed-sidebar') ?>"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside> 