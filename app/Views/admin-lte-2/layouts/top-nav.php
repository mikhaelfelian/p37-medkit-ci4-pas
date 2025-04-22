<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title ?? 'AdminLTE 2' ?> | Top Navigation</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
  <!-- Toastr -->
  <script src="<?= base_url('public/assets/plugins/toastr/toastr.min.js') ?>"></script>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-blue layout-top-nav">
  <div class="wrapper">

    <?= $this->include('admin-lte-2/layouts/top-nav-navbar') ?>

    <!-- Full Width Column -->
    <div class="content-wrapper">
      <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?= $title ?? 'Top Navigation' ?>
            <small><?= $subtitle ?? 'Example 2.0' ?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?= $title ?? 'Top Navigation' ?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <?php if (isset($view)): ?>
            <?= view('admin-lte-2/' . $view, $this->data) ?>
          <?php else: ?>
            <?= $this->renderSection('content') ?>
          <?php endif; ?>
        </section>
        <!-- /.content -->
      </div>
      <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="container">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.4.18
        </div>
        <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
        reserved.
      </div>
      <!-- /.container -->
    </footer>
  </div>
  <!-- ./wrapper -->
  <!-- Custom scripts -->
  <?= $this->renderSection('scripts') ?>
</body>

</html>