<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?? 'AdminLTE 2' ?></title>
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?= base_url($Pengaturan->favicon) ?>">

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
  <!-- jQuery UI CSS -->
  <link rel="stylesheet"
    href="<?= base_url('public/assets/theme/admin-lte-2/bower_components/jquery-ui/themes/base/jquery-ui.min.css') ?>">
  <!-- Toastr CSS -->
  <link rel="stylesheet" href="<?= base_url('public/assets/plugins/toastr/toastr.min.css') ?>">
  <!-- Select2 CSS -->
  <link rel="stylesheet" href="<?= base_url('public/assets/plugins/select2/css/select2.min.css') ?>">
  <link rel="stylesheet"
    href="<?= base_url('public/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

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
  <!-- jQuery UI -->
  <script src="<?= base_url('public/assets/theme/admin-lte-2/bower_components/jquery-ui/jquery-ui.min.js') ?>"></script>
  <!-- Bootstrap 3.3.7 -->
  <script
    src="<?= base_url('public/assets/theme/admin-lte-2/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
  <!-- SlimScroll -->
  <script
    src="<?= base_url('public/assets/theme/admin-lte-2/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
  <!-- FastClick -->
  <script src="<?= base_url('public/assets/theme/admin-lte-2/bower_components/fastclick/lib/fastclick.js') ?>"></script>
  <!-- Toastr JS -->
  <script src="<?= base_url('public/assets/plugins/toastr/toastr.min.js') ?>"></script>
  <!-- Select2 JS -->
  <script src="<?= base_url('public/assets/plugins/select2/js/select2.full.min.js') ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('public/assets/theme/admin-lte-2/dist/js/adminlte.min.js') ?>"></script>
  <!-- Custom scripts -->
  <?= $this->renderSection('scripts') ?>
</body>

</html>