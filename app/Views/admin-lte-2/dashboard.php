<?= $this->extend(theme_path('main')) ?>

<?= $this->section('content') ?>
<div class="callout callout-info">
  <h4>Pesan</h4>
  <p>
    Selamat datang di <?= $user->first_name ?> di <?= $Pengaturan->judul ?>.
  </p>
</div>
<!-- /.box -->
<?= $this->endSection() ?> 