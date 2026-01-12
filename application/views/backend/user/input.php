<section class="content-header">
    <h1>
        Manajemen User
        <small><?php echo ($st == 'edit') ? 'Ubah Data' : 'Tambah Data'; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">User</a></li>
        <li class="active">Input</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo ($st == 'edit') ? 'Form Edit User' : 'Form Tambah User'; ?></h3>
            <div class="box-tools pull-right">
                <a href="<?php echo site_url('manage_user') ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div>

        <?php echo form_open('manage_user/simpan', 'class="form-horizontal"'); ?>
        <div class="box-body">
            
            <?php if(validation_errors()) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Peringatan!</h4>
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>

            <?php echo $this->session->flashdata('pass'); ?>

            <div class="form-group">
                <label for="nama_lengkap" class="col-sm-2 control-label">Nama Operator</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="<?php echo $nama_lengkap; ?>" placeholder="Masukkan Nama Lengkap" required>
                </div>
            </div>

            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="username" id="username" value="<?php echo $username; ?>" <?php if($st=="edit"){ echo 'readonly'; } ?> placeholder="Masukkan Username" required>
                    <?php if($st=="edit"): ?>
                        <p class="help-block"><i class="fa fa-info-circle"></i> Username tidak dapat diubah.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                    <hr style="border-top: 1px dashed #ccc;">
                    <span class="text-muted"><i>Pengaturan Password</i></span>
                </div>
            </div>

            <div class="form-group <?php echo (form_error('password')) ? 'has-error' : ''; ?>">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password Baru">
                    <?php if($st=="edit"): ?>
                        <p class="help-block text-yellow"><i class="fa fa-warning"></i> Biarkan kosong jika tidak ingin mengubah password.</p>
                    <?php else: ?>
                        <p class="help-block text-red">* Wajib diisi untuk user baru.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group <?php echo (form_error('re_password')) ? 'has-error' : ''; ?>">
                <label for="re_password" class="col-sm-2 control-label">Ulangi Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="re_password" id="re_password" placeholder="Ketik Ulang Password">
                </div>
            </div>

            <input type="hidden" name="id_param" value="<?php echo $id_param; ?>">
            <input type="hidden" name="st" value="<?php echo $st; ?>">

        </div>
        <div class="box-footer">
            <div class="col-sm-offset-2 col-sm-8">
                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan Data</button>
                <a href="<?php echo site_url('manage_user') ?>" class="btn btn-default btn-flat">Batal</a>
            </div>
        </div>
        <?php echo form_close(); ?> 
    </div>
</section>