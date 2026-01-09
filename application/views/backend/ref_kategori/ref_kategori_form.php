
        
	
<section class="content-header">
      <h1>
        Tambah/Ubah Data
        <small>Jenis Produk Hukum</small>
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
          <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Jenis Produk Hukum <?php echo form_error('kategori') ?></label>
            <input type="text" class="form-control" name="kategori" id="kategori" placeholder="Jenis Produk Hukum" value="<?php echo $kategori; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Status <?php echo form_error('status') ?></label>
            
			<select class="form-control" name="status" id="status" placeholder="Status">
				<option value="0">Non-Aktif</option>
				<option value="1">Aktif</option>
			</select>
        </div>
	    <input type="hidden" name="id_kategori" value="<?php echo $id_kategori; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('ref_kategori') ?>" class="btn btn-default">Batal</a>
	</form>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>

</section>