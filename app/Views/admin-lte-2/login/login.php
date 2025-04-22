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
                  alt="<?= $Pengaturan->judul?>" class="brand-image img-rounded"
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
                    'class' => 'form-control',
                    'placeholder' => 'Gunakan No RM anda (cth: pke00001) ...',
                    'value' => set_value('user'),
                    'required' => true
                  ]) ?>
                  <span class="input-group-addon"><i class="fa fa-user-alt"></i></span>
                </div>
              </div>
              <div class="form-group">
                <label for="pass">Kata Sandi</label>
                <div class="input-group">
                  <?= form_input([
                    'type' => 'text',
                    'name' => 'pass',
                    'id' => 'tgl',
                    'class' => 'form-control',
                    'placeholder' => 'Gunakan Tgl Lahir (cth: 17-08-1945) ...',
                    'readonly' => 'readonly',
                    'required' => true
                  ]) ?>
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
              <div class="form-group">
                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
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
                  <button type="submit" id="submitBtn" class="btn btn-primary btn-block btn-flat">
                    <span>Masuk</span>
                  </button>
                </div>
                <!-- /.col -->
              </div>
              <?= form_close() ?>
            </div>
            <div class="box-footer">
              <div class="social-auth-links text-center">
                <p>- ATAU -</p>
                <a href="<?= base_url('pasien/daftar_baru') ?>"
                  class="btn btn-block btn-primary btn-flat"><i class="fa fa-user-plus"></i> PASIEN BARU</a>
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

<!-- jQuery -->
<script src="<?= base_url('public/assets/theme/admin-lte-2/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- jQuery UI -->
<script src="<?= base_url('public/assets/theme/admin-lte-2/bower_components/jquery-ui/jquery-ui.min.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('public/assets/theme/admin-lte-2/bower_components/jquery-ui/themes/base/jquery-ui.min.css') ?>">
<!-- iCheck -->
<link rel="stylesheet" href="<?= base_url('public/assets/plugins/iCheck/square/blue.css') ?>">
<script src="<?= base_url('public/assets/plugins/iCheck/icheck.min.js') ?>"></script>

<!-- Add reCAPTCHA v3 -->
<script src="https://www.google.com/recaptcha/api.js?render=<?= config('Recaptcha')->siteKey ?>"></script>
<script>
  // Initialize iCheck
  $(document).ready(function () {
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
  });

  grecaptcha.ready(function () {
    const form = document.getElementById('login_form');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = submitBtn.querySelector('span');
    const btnLoader = submitBtn.querySelector('i');

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      // Show loading state
      submitBtn.disabled = true;
      btnText.classList.remove('d-none');
      btnLoader.classList.remove('d-none');
      form.classList.add('loading');

      // Execute reCAPTCHA
      grecaptcha.execute('<?= config('Recaptcha')->siteKey ?>', { action: 'login' })
        .then(function (token) {
          // Add token to form
          document.getElementById('recaptchaResponse').value = token;
          // Submit form
          form.submit();
        })
        .catch(function (error) {
          console.error('reCAPTCHA error:', error);
          alert('Error verifying reCAPTCHA. Please try again.');

          // Reset loading state
          submitBtn.disabled = false;
          btnText.classList.remove('d-none');
          btnLoader.classList.add('d-none');
          form.classList.remove('loading');
        });
    });
  });

  // Add toastr configuration and form handling
  $(document).ready(function() {
    // Configure toastr
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    // Form submission handling
    $('#login_form').on('submit', function(e) {
        e.preventDefault();
        
        var form = $(this);
        var submitBtn = $('#submitBtn');
        var btnText = submitBtn.find('span');
        
        // Disable button
        submitBtn.prop('disabled', true);
        
        // Submit form via AJAX
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Show success message
                    toastr.success(response.message);
                    // Redirect after a short delay
                    setTimeout(function() {
                        window.location.href = response.redirect || '<?= base_url('dashboard') ?>';
                    }, 1000);
                } else {
                    // Show error message
                    toastr.error(response.message || 'Login gagal. Silakan coba lagi.');
                    // Reset button state
                    submitBtn.prop('disabled', false);
                }
            },
            error: function(xhr, status, error) {
                // Show error message
                toastr.error('Terjadi kesalahan. Silakan coba lagi.');
                // Reset button state
                submitBtn.prop('disabled', false);
            }
        });
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
  });
</script>

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