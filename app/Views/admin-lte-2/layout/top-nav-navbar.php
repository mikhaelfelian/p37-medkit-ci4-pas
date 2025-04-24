<header class="main-header">
  <nav class="navbar navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <a href="<?= base_url() ?>" class="navbar-brand"><b>Pendaftaran</b> Pasien</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Info Rawat Inap <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="<?= base_url('pasien/data_kamar.php') ?>">Data Kamar</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
      <!-- Navbar Right Menu -->
    </div>
    <!-- /.container-fluid -->
  </nav>
</header> 