
        
	
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
            <label for="varchar">Judul <?php echo form_error('judul') ?></label>
            <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" value="<?php echo $judul; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Jenis Berita <?php echo form_error('jenis_berita') ?></label>
            <select class="form-control" name="jenis_berita" id="jenis_berita">
              <option value="">-Pilih-</option>
            <?php
              foreach ($kategori as $value) {
                $select="";
                if ($value->id_kategori==$jenis_berita)
                {
                  $select="selected"; 
                }
                ?>
                <option value="<?=$value->id_kategori?>" <?= $select ?> > <?= $value->kategori?> </option>
            <?php
            }
            ?>
            </select>
        </div>

	    <div class="form-group">
            <label for="isi">Isi <?php echo form_error('isi') ?></label>
            <textarea class="form-control" rows="10" name="isi" id="isi" placeholder="Isi"><?php echo $isi; ?></textarea>
        </div>
	    
	    <div class="form-group">
            <div class="col-xs-12">
              <label for="varchar">Foto (.jpg||.bmp||.png) : <?php echo $file; ?><?php echo form_error('file') ?></label>
            <input type="file" name="file">
            <input class="file-path validate" type="hidden" name="file">
            </div>
        </div>


    </div>
        <!-- /.box-body -->
        <div class="box-footer">
        <div class="col-md-12">
          <div class="form-group pull-right">
                  <input type="hidden" name="id_berita" value="<?php echo $id_berita; ?>" /> 
      <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
      <a href="<?php echo site_url('ta_berita') ?>" class="btn btn-default">Batal</a>
          </div>
        </div>
        </div>
      <?php echo form_close(); ?>
        <!-- /.box-footer-->
      </div>

</section>