
        
	
<section class="content-header">
      <h1>
        Tambah/Ubah Data
        <small>Kategori Produk Hukum</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
</section>

    <!-- Main content -->
<section class="content container-fluid">

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah/Ubah</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
	<?php echo $this->session->flashdata('pass'); ?>
	<?php if(validation_errors()) { ?>
	<div class="callout callout-danger lead">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  	<h4>Terjadi Kesalahan!</h4>
		<?php echo validation_errors(); ?>
	</div>
	<?php } ?>
		<?php echo form_open('manage_user/simpan','class="form-horizontal"'); ?>
		  <div class="control-group">
		  	<legend align="center">Manajemen User</legend>
			<label class="control-label col-lg-2" for="nama_unit_kerja">Nama Operator</label>
			<div class="col-lg-10">
			  <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="<?php echo $nama_lengkap; ?>" placeholder="Nama Pengguna">
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="control-label col-lg-2" for="eselon">Username</label>
			<div class="col-lg-10">
			  <input type="text" class="form-control" name="username" id="username" value="<?php echo $username; ?>" <?php if($st=="edit"){ echo 'readonly="true"'; } ?> placeholder="Username">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label col-lg-2" for="parent_unit">Password</label>
			<div class="col-lg-10">
			  <input type="password" class="form-control" name="password" id="password"  placeholder="Password">
			</div>
		  </div>

		  <input type="hidden" name="id_param" value="<?php echo $id_param; ?>">
		  <input type="hidden" name="default_username" value="<?php echo $username; ?>">
		  <input type="hidden" name="st" value="<?php echo $st; ?>">
		  <div class="control-group">
			<div class="col-lg-10">
			<div><br></div>
			  <button type="submit" class="btn btn-primary">Simpan</button>
			  <a href="<?php echo site_url('manage_user') ?>" class="btn btn-default">Batal</a>
			</div>
		  </div>
		<?php echo form_close(); ?> 
			 </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>

</section>