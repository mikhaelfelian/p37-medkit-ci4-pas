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
      <?php if (isset($login)) : ?>
        <?= view($login) ?>
      <?php else : ?>
        <?= $this->renderSection('content') ?>
      <?php endif; ?>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.container -->
</div>
<!-- /.content-wrapper --> 