<?= $this->extend(theme_path('top-nav')) ?>

<?= $this->section('content') ?>
<!-- Main content -->
<section class="content">
  <div class="content-wrapper">
    <div class="container">
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-lg-8">
            <div class="box box-primary rounded-0">
              <div class="box-header with-border">
                <h3 class="box-title">ALUR PENDAFTARAN</h3>
              </div>
              <div class="box-body">
                <p><img src="https://perjanjian.esensia.co.id/assets/theme/admin-lte-2/dist/img/alur_pendaftaran.jpg">
                </p>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="box box-primary rounded-0">
              <div class="box-header with-border text-center">
                <a href="https://esensia.co.id" class="h1"><img
                    src="https://perjanjian.esensia.co.id/assets/theme/admin-lte-3/dist/img/logo-header-es1.png"
                    alt="<?= $Pengaturan->judul ?>" class="brand-image img-rounded"
                    style="width: 209px; height: 94px; background-color: #fff;"></a>
              </div>
              <div class="box-body">
                <?= form_open('auth/cek_login', [
                  'id' => 'login_form',
                  'method' => 'post',
                  'autocomplete' => 'off'
                ]) ?>
                <div class="form-group">
                  <label for="user">No. RM</label>
                  <div class="input-group">
                    <?= form_input([
                      'name' => 'user',
                      'id' => 'user',
                      'class' => 'form-control' . (session()->getFlashdata('errors.user') ? ' is-invalid' : ''),
                      'placeholder' => 'Gunakan No RM anda (cth: pke00001) ...',
                      'value' => set_value('user'),
                      'required' => true
                    ]) ?>
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  </div>
                  <?php if (session()->getFlashdata('errors.user')): ?>
                    <div class="text-danger"><?= session()->getFlashdata('errors.user') ?></div>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <label for="pass">Kata Sandi</label>
                  <div class="input-group">
                    <?= form_input([
                      'type' => 'text',
                      'name' => 'pass',
                      'id' => 'tgl',
                      'class' => 'form-control' . (session()->getFlashdata('errors.pass') ? ' is-invalid' : ''),
                      'placeholder' => 'Gunakan Tgl Lahir (cth: 17-08-1945) ...',
                      'readonly' => 'readonly',
                      'required' => true
                    ]) ?>
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  </div>
                  <?php if (session()->getFlashdata('errors.pass')): ?>
                    <div class="text-danger"><?= session()->getFlashdata('errors.pass') ?></div>
                  <?php endif; ?>
                </div>
                <div class="form-group">
                  <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                  <?php if (session()->getFlashdata('errors.recaptcha_response')): ?>
                    <div class="text-danger"><?= session()->getFlashdata('errors.recaptcha_response') ?></div>
                  <?php endif; ?>
                </div>

                <div class="row">
                  <div class="col-xs-8">
                    <div class="checkbox icheck">
                      <label>
                        <input type="checkbox" name="ingat" value="1" class="square-blue"> Ingat Saya
                      </label>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
                  </div>
                  <!-- /.col -->
                </div>
                <?= form_close() ?>
              </div>
              <div class="box-footer">
                <div class="social-auth-links text-center">
                  <p>- ATAU -</p>
                  <a href="<?= base_url('pasien/pendaftaran_baru.php') ?>" class="btn btn-block btn-primary btn-flat"><i
                      class="fa fa-user-plus"></i> PASIEN BARU</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
</section>
<!-- /.content -->

<!-- Style for loading indicator -->
<style>
  .loading {
    position: relative;
    pointer-events: none;
  }

  .loading:after {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.8) url('<?= base_url('public/assets/img/loading.gif') ?>') center no-repeat;
    z-index: 2;
  }

  /* Style for reCAPTCHA badge */
  .grecaptcha-badge {
    bottom: 60px !important;
  }

  /* iCheck custom styles */
  .icheckbox_square-blue {
    margin-right: 5px;
  }
</style>
<!-- iCheck -->
<link rel="stylesheet" href="<?= base_url('public/assets/plugins/iCheck/square/blue.css') ?>">
<script src="<?= base_url('public/assets/plugins/iCheck/icheck.min.js') ?>"></script>
<!-- Add reCAPTCHA v3 -->
<script src="https://www.google.com/recaptcha/api.js?render=<?= config('Recaptcha')->siteKey ?>"></script>
<script>
  $(document).ready(function () {
    // Initialize iCheck
    $('input[type="checkbox"].square-blue').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%'
    });

    // Initialize datepicker
    $('#tgl').datepicker({
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

    // Handle form submission
    $('#login_form').on('submit', function (e) {
      e.preventDefault();

      // Execute reCAPTCHA
      grecaptcha.ready(function () {
        grecaptcha.execute('<?= config('Recaptcha')->siteKey ?>', { action: 'login' })
          .then(function (token) {
            // Add token to form
            $('#recaptchaResponse').val(token);
            // Submit form
            document.getElementById('login_form').submit();
          });
      });
    });
  });
</script>

<?= $this->endSection() ?>