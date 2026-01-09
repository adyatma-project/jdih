
        
	
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
		<?php echo form_open_multipart($action); ?>

	    <div class="form-group">
            <label for="nama_katalog">Nama Katalog <?php echo form_error('nama_katalog') ?></label>
            <input type="text" class="form-control" rows="3" name="nama_katalog" id="nama_katalog" placeholder="Nama Katalog" value="<?php echo $nama_katalog; ?>"/>
        </div>
	    <div class="form-group">
            <label for="int">Tahun <?php echo form_error('tahun') ?></label>
            <input type="text" class="form-control" name="tahun" id="tahun" placeholder="Tahun" value="<?php echo $tahun; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">File : <?php echo $file; ?> <?php echo form_error('file') ?></label>
            
			<input type="file" name="imgName">
			<input class="file-path validate" type="hidden" name="imgName">
			
        </div>
	    <input type="hidden" name="id_katalog" value="<?php echo $id_katalog; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('ta_katalog') ?>" class="btn btn-default">Batal</a>
	<?php echo form_close(); ?>
</form>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>

</section>