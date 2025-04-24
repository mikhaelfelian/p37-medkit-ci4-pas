<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-10">
            <form action="https://perjanjian.esensia.co.id/pasien/set_daftar_baru.php" autocomplete="off"
                enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">FORM PENDAFTARAN PASIEN BARU</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="control-label">NIK <small><i>(* KTP /
                                                Passport / KIA)</i></small></label>
                                    <input type="text" name="nik" value="" id="nik" class="form-control"
                                        placeholder="Nomor Identitas ...">
                                </div>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="form-group ">
                                            <label class="control-label">Gelar*</label>
                                            <select name="gelar" class="form-control ">
                                                <option value="">- Pilih -</option>
                                                <option value="1">TN.</option>
                                                <option value="2">NN.</option>
                                                <option value="3">NY.</option>
                                                <option value="4">AN.</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="form-group ">
                                            <label class="control-label">Nama
                                                Lengkap*</label>
                                            <input type="text" name="nama" value="" id="nama" class="form-control"
                                                placeholder="John Doe ...">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label">Jenis Kelamin*</label>
                                    <select name="jns_klm" class="form-control ">
                                        <option value="">- Pilih -</option>
                                        <option value="L">Laki - laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Tempat Lahir</label>
                                    <input type="text" name="tmp_lahir" value="" id="tmp_lahir" class="form-control"
                                        placeholder="Isikan Tempat Lahir ...">
                                </div>
                                <div class="form-group ">
                                    <label>Tanggal Lahir</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="tgl_lahir" value="" id="tgl_lahir" class="form-control"
                                            placeholder="dd-mm-yyyy ..." readonly="TRUE">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label">No. HP / WA</label>
                                    <input type="text" name="no_hp" value="" id="no_hp" class="form-control"
                                        placeholder="Nomor kontak WA pasien / keluarga pasien ...">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Instansi /
                                        Perusahaan</label>
                                    <input type="text" name="instansi" value="" id="instansi" class="form-control"
                                        placeholder="Isikan nama Instansi / Perusahaan ...">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="control-label">Alamat KTP<small><i>*
                                                Sesuai Identitas</i></small></label>
                                    <textarea name="alamat" cols="40" rows="10" id="alamat" class="form-control"
                                        style="height: 108px;"
                                        placeholder="Mohon diisi alamat sesuai pada identitas ..."></textarea>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label">Alamat Domisili<small><i>*
                                                Sesuai Domisili</i></small></label>
                                    <textarea name="alamat_dom" cols="40" rows="10" id="alamat_dom" class="form-control"
                                        style="height: 108px;"
                                        placeholder="Mohon diisi alamat sesuai domisili ..."></textarea>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label">Pekerjaan</label>
                                    <select name="pekerjaan" class="form-control select2bs4">
                                        <option value="">- Pilih -</option>
                                        <option value="1">Pelajar / Mahasiswa</option>
                                        <option value="2">Belum / Tidak Bekerja</option>
                                        <option value="3">Karyawan Swasta</option>
                                        <option value="4">Karyawan BUMN / BUMD Dll</option>
                                        <option value="5">PNS</option>
                                        <option value="6">TNI / POLRI</option>
                                        <option value="7">Profesi</option>
                                        <option value="8">Ibu Rumah Tangga</option>
                                        <option value="9">Pensiunan</option>
                                        <option value="10">Karyawan Honorer</option>
                                        <option value="11">Buruh Tani</option>
                                        <option value="12">Buruh Harian Lepas</option>
                                        <option value="13">Anggota DPR RI</option>
                                        <option value="14">Anggota DPD</option>
                                        <option value="15">Anggota BPK</option>
                                        <option value="16">Gubernur</option>
                                        <option value="17">Wakil Gubernur</option>
                                        <option value="18">Bupati</option>
                                        <option value="19">Wakil Bupati</option>
                                        <option value="20">Walikota</option>
                                        <option value="21">Wakil Walikota</option>
                                        <option value="22">Anggota DPRD Provinsi</option>
                                        <option value="23">Anggota DPRD Kab/Kota</option>
                                        <option value="24">Dosen</option>
                                        <option value="25">Guru</option>
                                        <option value="26">Pilot</option>
                                        <option value="27">Pengacara</option>
                                        <option value="28">Notaris</option>
                                        <option value="29">Arsitek</option>
                                        <option value="30">Dokter</option>
                                        <option value="31">Bidan</option>
                                        <option value="32">Perawat</option>
                                        <option value="33">Polisi</option>
                                        <option value="34">TNI</option>
                                        <option value="35">Apoteker</option>
                                        <option value="36">Psikiater/Psikolog</option>
                                        <option value="37">Pelaut</option>
                                        <option value="38">Supir</option>
                                        <option value="39">Peneliti</option>
                                        <option value="40">Pedagang</option>
                                        <option value="41">Pendeta</option>
                                        <option value="42">Ustadz</option>
                                        <option value="43">Wiraswasta</option>
                                        <option value="44">Kepala Desa</option>
                                        <option value="45">Konstruksi</option>
                                        <option value="46">Peternak</option>
                                        <option value="47">Presiden</option>
                                        <option value="48">Wakil Presiden</option>
                                        <option value="49">Seniman</option>
                                        <option value="50">Wartawan</option>
                                        <option value="51">Residen</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">No. Rmh</label>
                                    <input type="text" name="no_rmh" value="" id="no_rmh" class="form-control"
                                        placeholder="Isikan Nomor rumah (PSTN) pasien / keluarga pasien ...">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Alamat Instansi</label>
                                    <input type="text" name="instansi_almt" value="" id="instansi_almt"
                                        class="form-control" placeholder="Isikan alamat lengkapnya ...">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="control-label">Penjamin</label>
                                    <select id="platform" name="platform" class="form-control rounded-0">
                                        <option value="">- PENJAMIN -</option>
                                        <option value="1">UMUM</option>
                                        <option value="2">ASURANSI</option>
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label">Poli</label>
                                    <select id="poli" name="poli" class="form-control ">
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
                                <div class="form-group ">
                                    <label id="dokter_label" class="control-label" style="display: none;">Dokter</label>
                                    <select id="dokter" name="dokter" class="form-control select2bs4 "
                                        style="display: none;">
                                        <option value="">- Dokter -</option>
                                        <!--
                                                                                                    <option value="" ></option>
                                                                                                    -->
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label class="control-label">Alergi Obat ?</label>
                                    <input type="text" name="alergi" value="" id="alergi" class="form-control"
                                        placeholder="Ada alergi obat ...">
                                </div>
                                <div class="form-group ">
                                    <label class="control-label">Tgl Periksa*</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="tgl_masuk" value="23-04-2025" id="tgl_masuk"
                                            class="form-control pull-right" placeholder="Silahkan isi tgl periksa ...">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div data-sitekey="6LcS_gsUAAAAAO03Uiv4111znmIc797f_fQK-N5R" data-theme="light"
                                        class="g-recaptcha">
                                        <div style="width: 304px; height: 78px;">
                                            <div><iframe title="reCAPTCHA" width="304" height="78" role="presentation"
                                                    name="a-3kye9m5tcze5" frameborder="0" scrolling="no"
                                                    sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox allow-storage-access-by-user-activation"
                                                    src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LcS_gsUAAAAAO03Uiv4111znmIc797f_fQK-N5R&amp;co=aHR0cHM6Ly9wZXJqYW5qaWFuLmVzZW5zaWEuY28uaWQ6NDQz&amp;hl=en&amp;v=ItfkQiGBlJDHuTkOhlT3zHpB&amp;theme=light&amp;size=normal&amp;cb=ejpi8oa3rndd"></iframe>
                                            </div><textarea id="g-recaptcha-response" name="g-recaptcha-response"
                                                class="g-recaptcha-response"
                                                style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea>
                                        </div><iframe style="display: none;"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-lg-6">

                            </div>
                            <div class="col-lg-6 text-right">
                                <button type="submit" name="daftar" value="daftar_aksi"
                                    class="btn btn-primary btn-flat"><i class="fa fa-user-plus"></i> Daftar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- /.content -->