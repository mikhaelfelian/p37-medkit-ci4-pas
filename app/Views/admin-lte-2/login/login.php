<div class="content-wrapper">
  <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-8">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">ALUR PENDAFTARAN</h3>
            </div>
            <div class="box-body">
              <p><img src="https://perjanjian.esensia.co.id/assets/theme/admin-lte-2/dist/img/alur_pendaftaran.jpg"></p>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="box box-primary">
            <div class="box-header with-border text-center">
              <a href="https://esensia.co.id" class="h1"><img
                  src="https://perjanjian.esensia.co.id/assets/theme/admin-lte-3/dist/img/logo-header-es1.png"
                  alt="KLINIK UTAMA &amp; LABORATORIUM " esensia"="" logo"="" class="brand-image img-rounded"
                  style="width: 209px; height: 94px; background-color: #fff;"></a>
            </div>
            <div class="box-body">
              <?= form_open('auth/cek_login', ['autocomplete' => 'off']) ?>
                <div class="form-group ">
                  <label for="exampleInputPassword1">No. RM</label>
                  <div class="input-group">
                    <?= form_input([
                      'name' => 'user',
                      'class' => 'form-control',
                      'placeholder' => 'Gunakan No RM anda (cth: pke00001) ...',
                      'value' => set_value('user')
                    ]) ?>
                    <span class="input-group-addon"><i class="fa fa-user-alt"></i></span>
                  </div>
                </div>
                <div class="form-group ">
                  <label for="exampleInputPassword1">Kata Sandi</label>
                  <div class="input-group">
                    <?= form_password([
                      'name' => 'pass',
                      'id' => 'tgl',
                      'class' => 'form-control',
                      'placeholder' => 'Gunakan Tgl Lahir (cth: 17-08-1945) ...',
                      'readonly' => 'TRUE'
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
                        <input type="checkbox" name="ingat" value="1"> Ingat Saya
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

              <a href="<?= base_url('auth/forgot_password') ?>">Lupa kata sandi</a><br>
            </div>
            <div class="box-footer">
              <div class="social-auth-links text-center">
                <p>- ATAU -</p>
                <a href="https://perjanjian.esensia.co.id/pasien/pendaftaran_baru.php"
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

<!-- Google reCAPTCHA v4 -->
<script src="https://www.google.com/recaptcha/api.js?render=<?= config('Recaptcha')->siteKey ?>"></script>
<script>
  grecaptcha.ready(function() {
    grecaptcha.execute('<?= config('Recaptcha')->siteKey ?>', {action: 'login'}).then(function(token) {
      document.getElementById('recaptchaResponse').value = token;
    });
  });
</script>