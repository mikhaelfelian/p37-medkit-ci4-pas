<?= $this->extend(theme_path('main')) ?>
<?= $this->section('content') ?>
<!-- Jadwal Dokter -->
<div class="row">
  <div class="col-lg-9">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Pendaftaran Mandiri</h3>
      </div>
      <?= form_open('pasien/set_daftar.php', ['autocomplete' => 'off', 'enctype' => 'multipart/form-data', 'method' => 'post', 'accept-charset' => 'utf-8']) ?>
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group<?= validation_show_error('nik') ? ' has-error' : '' ?>">
              <label class="control-label">NIK <small><i>(* KTP / Passport / KIA)</i></small> <span
                  class="text-danger">*</span></label>
              <?= form_input([
                'name' => 'nik',
                'id' => 'nik',
                'class' => 'form-control required',
                'placeholder' => 'Nomor Identitas ...',
                'value' => set_value('nik', $pasien->nik ?? '')
              ]) ?>
              <?php if (session()->getFlashdata('errors.nik')): ?>
                <div class="text-danger"><?= session()->getFlashdata('errors.nik') ?></div>
              <?php endif; ?>
            </div>
            <div class="row">
              <div class="col-xs-3">
                <div class="form-group<?= validation_show_error('gelar') ? ' has-error' : '' ?>">
                  <label class="control-label">Gelar <span class="text-danger">*</span></label>
                  <select name="gelar" class="form-control required">
                    <option value="">- Pilih -</option>
                    <?php foreach ($gelar as $g): ?>
                      <option value="<?= $g->id ?>" <?= set_select('gelar', $g->id, ($pasien->id_gelar ?? '') == $g->id) ?>><?= $g->gelar ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php if (session()->getFlashdata('errors.gelar')): ?>
                    <div class="text-danger"><?= session()->getFlashdata('errors.gelar') ?></div>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-xs-9">
                <div class="form-group<?= validation_show_error('nama') ? ' has-error' : '' ?>">
                  <label class="control-label">Nama Lengkap <span class="text-danger">*</span></label>
                  <?= form_input([
                    'name' => 'nama',
                    'id' => 'nama',
                    'class' => 'form-control required',
                    'placeholder' => 'John Doe ...',
                    'value' => set_value('nama', $pasien->nama ?? '')
                  ]) ?>
                  <?php if (session()->getFlashdata('errors.nama')): ?>
                    <div class="text-danger"><?= session()->getFlashdata('errors.nama') ?></div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <div class="form-group<?= validation_show_error('jns_klm') ? ' has-error' : '' ?>">
              <label class="control-label">Jenis Kelamin <span class="text-danger">*</span></label>
              <select name="jns_klm" class="form-control required">
                <option value="">- Pilih -</option>
                <option value="L" <?= set_select('jns_klm', 'L', ($pasien->jns_klm ?? '') == 'L') ?>>Laki - laki</option>
                <option value="P" <?= set_select('jns_klm', 'P', ($pasien->jns_klm ?? '') == 'P') ?>>Perempuan</option>
              </select>
              <?php if (session()->getFlashdata('errors.jns_klm')): ?>
                <div class="text-danger"><?= session()->getFlashdata('errors.jns_klm') ?></div>
              <?php endif; ?>
            </div>
            <div class="form-group<?= validation_show_error('tmp_lahir') ? ' has-error' : '' ?>">
              <label class="control-label">Tempat Lahir <span class="text-danger">*</span></label>
              <?= form_input([
                'name' => 'tmp_lahir',
                'id' => 'tmp_lahir',
                'class' => 'form-control',
                'placeholder' => 'Isikan Tempat Lahir ...',
                'value' => set_value('tmp_lahir', $pasien->tmp_lahir ?? '')
              ]) ?>
            </div>
            <div class="form-group<?= validation_show_error('tgl_lahir') ? ' has-error' : '' ?>">
              <label class="control-label">Tanggal Lahir <span class="text-danger">*</span></label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <?= form_input([
                  'name' => 'tgl_lahir',
                  'id' => 'tgl_lahir',
                  'class' => 'form-control',
                  'placeholder' => 'dd-mm-yyyy ...',
                  'readonly' => 'TRUE',
                  'value' => set_value('tgl_lahir', $pasien->tgl_lahir ?? '')
                ]) ?>
              </div>
            </div>
            <div class="form-group<?= validation_show_error('no_hp') ? ' has-error' : '' ?>">
              <label class="control-label">No. HP / WA <span class="text-danger">*</span></label>
              <?= form_input([
                'name' => 'no_hp',
                'id' => 'no_hp',
                'class' => 'form-control',
                'placeholder' => 'Nomor kontak WA pasien / keluarga pasien ...',
                'value' => set_value('no_hp', $pasien->no_hp ?? '')
              ]) ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group<?= validation_show_error('alamat') ? ' has-error' : '' ?>">
              <label class="control-label">Alamat KTP<small><i>* Sesuai Identitas</i></small></label>
              <?= form_textarea([
                'name' => 'alamat',
                'id' => 'alamat',
                'class' => 'form-control',
                'style' => 'height: 108px;',
                'placeholder' => 'Mohon diisi alamat sesuai pada identitas ...',
                'value' => set_value('alamat', $pasien->alamat ?? '')
              ]) ?>
            </div>
            <div class="form-group<?= validation_show_error('alamat_dom') ? ' has-error' : '' ?>">
              <label class="control-label">Alamat Domisili<small><i>* Sesuai
                    Domisili</i></small></label>
              <?= form_textarea([
                'name' => 'alamat_dom',
                'id' => 'alamat_dom',
                'class' => 'form-control',
                'style' => 'height: 108px;',
                'placeholder' => 'Mohon diisi alamat sesuai domisili ...',
                'value' => set_value('alamat_dom', $pasien->alamat_dom ?? '')
              ]) ?>
            </div>
            <div class="form-group">
              <label class="control-label">Pekerjaan</label>
              <select name="pekerjaan" id="pekerjaan" class="form-control select2bs4" style="width: 100%;">
                <option value="">- Pilih -</option>
                <?php foreach ($jenisKerja as $j): ?>
                  <option value="<?= $j->id ?>" <?= set_select('pekerjaan', $j->id, ($pasien->id_pekerjaan ?? '') == $j->id) ?>><?= $j->jenis ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">No. Rmh</label>
              <?= form_input([
                'name' => 'no_rmh',
                'id' => 'no_rmh',
                'class' => 'form-control',
                'placeholder' => 'Isikan Nomor rumah (PSTN) pasien / keluarga pasien ...',
                'value' => set_value('no_rmh', $pasien->no_rmh ?? '')
              ]) ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group<?= validation_show_error('platform') ? ' has-error' : '' ?>">
              <label class="control-label">Penjamin <span class="text-danger">*</span></label>
              <select id="platform" name="platform" class="form-control rounded-0">
                <option value="">- PENJAMIN -</option>
                <?php foreach ($penjamin as $p): ?>
                  <option value="<?= $p->id ?>" <?= set_select('platform', $p->id, ($pasien->id_kategori ?? '') == $p->id) ?>><?= $p->penjamin ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group<?= validation_show_error('poli') ? ' has-error' : '' ?>">
              <label class="control-label">Poli <span class="text-danger">*</span></label>
              <select id="poli" name="poli" class="form-control select2bs4">
                <option value="">- Poli -</option>
                <?php foreach ($poli as $p): ?>
                  <option value="<?= $p->id ?>"><?= $p->lokasi ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group" id="dokter_container">
              <label id="dokter_label" class="control-label" style="display: none;">Dokter</label>
              <select id="dokter" name="dokter" class="form-control select2bs4" style="display: none;">
                <option value="">- Dokter -</option>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Alergi Obat ?</label>
              <?= form_input([
                'name' => 'alergi',
                'id' => 'alergi',
                'class' => 'form-control',
                'placeholder' => 'Ada alergi obat ...',
                'value' => set_value('alergi', $pasien->alergi ?? '')
              ]) ?>
            </div>
            <div class="form-group<?= validation_show_error('tgl_masuk') ? ' has-error' : '' ?>">
              <label class="control-label">Tgl Periksa <span class="text-danger">*</span></label>
              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <?= form_input([
                  'name' => 'tgl_masuk',
                  'id' => 'tgl_masuk',
                  'class' => 'form-control pull-right',
                  'placeholder' => 'Silahkan isi tgl periksa ...',
                  'value' => set_value('tgl_masuk', '23-04-2025')
                ]) ?>
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
              <?php if (session()->getFlashdata('errors.recaptcha_response')): ?>
                <div class="text-danger"><?= session()->getFlashdata('errors.recaptcha_response') ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary btn-flat">Daftar</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>
<!-- /.box -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
  $(document).ready(function () {
    $('#dokter_container').hide();

    $('#tgl_masuk').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy',
      todayHighlight: true,
      clearBtn: false // opsional, karena cuma bisa pilih 1 tanggal
    });

    // Initialize datepicker
    $('#tgl_lahir').datepicker({
      dateFormat: 'dd-mm-yy',
      changeMonth: true,
      changeYear: true,
      yearRange: '1930:<?php echo date('Y'); ?>',
      showButtonPanel: true,
      closeText: 'Clear',
      defaultDate: new Date(),
      onClose: function (dateText, inst) {
        if ($(window.event.srcElement).hasClass('ui-datepicker-close')) {
          document.getElementById(this.id).value = '';
        }
      }
    });

    // Initialize Select2 for all select elements
    $('.select2bs4').select2({
      theme: 'bootstrap4',
      placeholder: '- PILIH -',
      width: '100%',
      dropdownCssClass: 'select2-dropdown-middle',
      selectionCssClass: 'select2-selection-middle'
    });

    // Pilih poli
    $("#poli").change(function () {
      var id_poli = $(this).val();

      $.ajax({
        type: "GET",
        dataType: "html",
        url: "<?= base_url('pasien/data_dokter?') ?>",
        data: "id_poli=" + id_poli,
        success: function (msg) {
          $("#dokter_container").show();
          $("#dokter").show();
          $("#dokter_label").show();
          $("select#dokter").html(msg);
        }
      });
    });

    // Clear validation on input
    $('.required').on('input', function () {
      $(this).removeClass('is-invalid');
    });
  });
</script>
<?= $this->endSection() ?>