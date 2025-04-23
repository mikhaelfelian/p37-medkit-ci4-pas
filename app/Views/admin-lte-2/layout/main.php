<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?? 'AdminLTE 2' ?></title>
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?= base_url($Pengaturan->favicon) ?>">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet"
    href="<?= base_url('public/assets/theme/admin-lte-2/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet"
    href="<?= base_url('public/assets/theme/admin-lte-2/bower_components/font-awesome/css/font-awesome.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet"
    href="<?= base_url('public/assets/theme/admin-lte-2/bower_components/Ionicons/css/ionicons.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('public/assets/theme/admin-lte-2/dist/css/AdminLTE.min.css') ?>">
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="<?= base_url('public/assets/theme/admin-lte-2/dist/css/skins/_all-skins.min.css') ?>">
  <!-- Custom styles -->
  <?= $this->renderSection('styles') ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?= $this->include('admin-lte-2/layout/navbar') ?>

    <!-- Main Sidebar Container -->
    <?= $this->include('admin-lte-2/layout/sidebar') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?= $title ?? 'Dashboard' ?>
          <small><?= $subtitle ?? 'Control panel' ?></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><?= $title ?? 'Dashboard' ?></li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <?= $this->renderSection('content') ?>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Footer -->
    <?= $this->include('admin-lte-2/layout/footer') ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="<?= base_url('public/assets/theme/admin-lte-2/bower_components/jquery/dist/jquery.min.js') ?>"></script>
  <!-- Bootstrap 3.3.7 -->
  <script
    src="<?= base_url('public/assets/theme/admin-lte-2/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
  <!-- SlimScroll -->
  <script
    src="<?= base_url('public/assets/theme/admin-lte-2/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
  <!-- FastClick -->
  <script src="<?= base_url('public/assets/theme/admin-lte-2/bower_components/fastclick/lib/fastclick.js') ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('public/assets/theme/admin-lte-2/dist/js/adminlte.min.js') ?>"></script>
  <!-- Custom scripts -->
  <?= $this->renderSection('scripts') ?>
</body>

</html>