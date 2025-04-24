<?= $this->extend(theme_path('main')) ?>

<?= $this->section('content') ?>

<!-- Include DataTables CSS -->
<link rel="stylesheet"
  href="<?= base_url('assets/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">

<div class="callout callout-info">
  <h4>Pesan</h4>
  <p>
    Selamat datang <?= $user->first_name ?> di <?= $Pengaturan->judul ?>.
  </p>
</div>
<!-- /.box -->
<!-- Jadwal Dokter -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Jadwal Dokter</h3>
  </div>
  <div class="box-body">
    <div class="table-responsive">
      <table id="jadwalTable" class="table table-bordered table-striped" width="100%">
        <thead>
          <tr>
            <th width="5%">No</th>
            <th>Dokter</th>
            <th>Senin</th>
            <th>Selasa</th>
            <th>Rabu</th>
            <th>Kamis</th>
            <th>Jumat</th>
            <th>Sabtu</th>
            <th>Minggu</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($jadwal)):
            $no = 1;
            foreach ($jadwal as $dok):
          ?>
              <tr>
                <td><?= $no++ ?></td>
                <td>
                  <?php
                  $fullName = '';
                  if (!empty($dok->nama_dpn)) {
                    $fullName .= $dok->nama_dpn . ' ';
                  }
                  $fullName .= $dok->nama;
                  if (!empty($dok->nama_blk)) {
                    $fullName .= ' ' . $dok->nama_blk;
                  }
                  echo trim($fullName);
                  ?>
                </td>
                <td><?= $dok->hari_1 ?></td>
                <td><?= $dok->hari_2 ?></td>
                <td><?= $dok->hari_3 ?></td>
                <td><?= $dok->hari_4 ?></td>
                <td><?= $dok->hari_5 ?></td>
                <td><?= $dok->hari_6 ?></td>
                <td><?= $dok->hari_7 ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else:
          ?>
            <tr>
              <td colspan="9" class="text-center">Tidak ada jadwal dokter</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- /.box -->
<?= $this->endSection() ?>