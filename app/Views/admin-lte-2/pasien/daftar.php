<?= $this->extend(theme_path('main')) ?>
<?= $this->section('content') ?>
<!-- Jadwal Dokter -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Pendaftaran Mandiri</h3>
  </div>
  <?= form_open('pasien/set_daftar.php', ['autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'method' => 'post', 'accept-charset' => 'utf-8']) ?>
    <?= form_input(['type' => 'hidden', 'name' => 'id_pasien', 'value' => '6I7OQnzxHCYbASzXbbtblweDA2MT-q6eZCWPvkkl7Yc']) ?>
    <?= form_input(['type' => 'hidden', 'name' => 'pekerjaan', 'value' => '8']) ?>
    <?= form_input(['type' => 'hidden', 'name' => 'jns_klm', 'value' => 'P']) ?>
    <?= form_input(['type' => 'hidden', 'name' => 'alamat', 'value' => 'TLOGOMULYO RT 002 RW 004 PEDURUNGAN SEMARANG']) ?>
    <?= form_input(['type' => 'hidden', 'name' => 'alamat_dom', 'value' => 'TLOGOMULYO RT 002 RW 004 PEDURUNGAN SEMARANG']) ?>
    <?= form_input(['type' => 'hidden', 'name' => 'instansi', 'value' => '']) ?>
    <?= form_input(['type' => 'hidden', 'name' => 'instansi_almt', 'value' => '']) ?>

    <div class="box-body">
      <div class="row">
        <div class="col-md-12"><p>Pendaftaran melalui website bisa dilakukan untuk hari yang sama ketika Anda mendaftar pada formulir di bawah ini. Untuk membuat jadwal bertemu dengan dokter kami pada hari yang sama, silakan menghubungi rumah sakit via telepon.</p></div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">NIK <small><i>(* KTP / Passport / KIA)</i></small></label>
            <?= form_input(['type' => 'text', 'name' => 'nik', 'value' => '3374066606720003', 'id' => 'nik', 'class' => 'form-control', 'placeholder' => 'John Doe ...', 'readonly' => 'TRUE']) ?>
          </div>

          <div class="row">
            <div class="col-xs-3">
              <?= form_input(['type' => 'hidden', 'name' => 'gelar', 'value' => '3']) ?>
              <div class="form-group">
                <label class="control-label">Gelar*</label>
                <select name="" class="form-control" readonly="TRUE">
                  <option value="">- Pilih -</option>
                  <option value="1">TN.</option>
                  <option value="2">NN.</option>
                  <option value="3" selected="">NY.</option>
                  <option value="4">AN.</option>
                </select>
              </div>
            </div>
            <div class="col-xs-9">
              <div class="form-group">
                <label class="control-label">Nama Lengkap*</label>
                <?= form_input(['type' => 'text', 'name' => 'nama', 'value' => 'SITI HALIMAH', 'id' => 'nama', 'class' => 'form-control', 'placeholder' => 'John Doe ...', 'readonly' => 'TRUE']) ?>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">No. Rmh</label>
            <?= form_input(['type' => 'text', 'name' => 'no_rmh', 'value' => '', 'id' => 'no_rmh', 'class' => 'form-control', 'placeholder' => 'Nomor kontak pasien / keluarga pasien ...']) ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label class="control-label">Tempat Lahir</label>
            <?= form_input(['type' => 'text', 'name' => 'tmp_lahir', 'value' => 'SEMARANG', 'id' => 'tmp_lahir', 'class' => 'form-control', 'placeholder' => 'Semarang ...', 'readonly' => 'TRUE']) ?>
          </div>
          <div class="form-group">
            <label>Tanggal Lahir</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <?= form_input(['type' => 'text', 'name' => 'tgl_lahir', 'value' => '06/26/1972', 'id' => 'tgl_lahir', 'class' => 'form-control', 'placeholder' => 'Semarang ...', 'readonly' => 'TRUE']) ?>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label">No. HP</label>
            <?= form_input(['type' => 'text', 'name' => 'no_hp', 'value' => '085726751295', 'id' => 'no_hp', 'class' => 'form-control', 'placeholder' => 'Nomor kontak pasien / keluarga pasien ...']) ?>
          </div>
        </div>

        <div class="col-md-10">
          <div class="form-group">
            <label class="control-label">Penjamin</label>
            <select id="platform" name="platform" class="form-control rounded-0">
              <option value="">- PENJAMIN -</option>
              <option value="1">UMUM</option>
              <option value="2">ASURANSI</option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Poli</label>
            <select id="poli" name="poli" class="form-control select2bs4">
              <option value="">- Poli -</option>
              <option value="5">POLI UMUM</option>
              <option value="63">POLI MATA</option>
              <option value="74">POLI ANAK</option>
              <option value="75">POLI OBGYN</option>
              <option value="77">POLI THT</option>
              <option value="78">POLI DALAM</option>
              <option value="79">POLI GIGI</option>
              <option value="80">POLI KULIT</option>
              <option value="81">POLI JIWA</option>
              <option value="83">POLI KECANTIKAN</option>
              <option value="89">POLI NEUROLOGI</option>
            </select>
          </div>
          <div class="form-group">
            <label id="dokter_label" class="control-label" style="display: none;">Dokter</label>
            <select id="dokter" name="dokter" class="form-control select2bs4" style="display: none;">
              <option value="">- Dokter -</option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Alergi Obat ?</label>
            <?= form_input(['type' => 'text', 'name' => 'alergi', 'value' => '', 'id' => 'alergi', 'class' => 'form-control', 'placeholder' => 'Ada alergi obat ...']) ?>
          </div>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Tgl Periksa*</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <?= form_input(['type' => 'text', 'name' => 'tgl_masuk', 'value' => '24-04-2025', 'id' => 'tgl_masuk', 'class' => 'form-control pull-right', 'placeholder' => 'Silahkan isi tgl periksa ...']) ?>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Jam*</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                  </div>
                  <?= form_input(['type' => 'time', 'name' => 'jam', 'class' => 'form-control']) ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="box-footer">
      <button type="submit" class="btn btn-primary btn-flat">Daftar</button>
    </div>
  <?= form_close() ?>
</div>
<!-- /.box -->
<?= $this->endSection() ?>