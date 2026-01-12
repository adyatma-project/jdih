<section class="content-header">
    <h1>
        Ubah Password
        <small>Keamanan Akun</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ubah Password</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Form Ganti Password</h3>
                </div>
                
                <div style="padding: 10px 20px;">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>

                <?php echo form_open($action); ?>
                <div class="box-body">
                    
                    <div class="form-group <?php echo form_error('password_lama') ? 'has-error' : '' ?>">
                        <label for="password_lama">Password Lama</label>
                        <input type="password" class="form-control" name="password_lama" id="password_lama" placeholder="Masukkan Password Lama Anda" value="<?php echo $password_lama; ?>">
                        <span class="help-block"><?php echo form_error('password_lama') ?></span>
                    </div>

                    <div class="form-group <?php echo form_error('password_baru') ? 'has-error' : '' ?>">
                        <label for="password_baru">Password Baru</label>
                        <input type="password" class="form-control" name="password_baru" id="password_baru" placeholder="Minimal 5 Karakter" value="<?php echo $password_baru; ?>">
                        <span class="help-block"><?php echo form_error('password_baru') ?></span>
                    </div>

                    <div class="form-group <?php echo form_error('konfirmasi_password') ? 'has-error' : '' ?>">
                        <label for="konfirmasi_password">Ulangi Password Baru</label>
                        <input type="password" class="form-control" name="konfirmasi_password" id="konfirmasi_password" placeholder="Ketik ulang password baru" value="<?php echo $konfirmasi_password; ?>">
                        <span class="help-block"><?php echo form_error('konfirmasi_password') ?></span>
                    </div>

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Password Baru</button>
                    <a href="<?php echo base_url('backend') ?>" class="btn btn-default">Batal</a>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="callout callout-info">
                <h4><i class="fa fa-info-circle"></i> Tips Keamanan</h4>
                <p>Gunakan kombinasi huruf besar, huruf kecil, dan angka untuk membuat password yang kuat. Jangan gunakan tanggal lahir atau nama yang mudah ditebak.</p>
            </div>
        </div>
    </div>
</section>