
        
	
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

       

  <div class="col-md-12">
    <div class="col-md-6">
       <?php echo form_open_multipart($action); ?>
      <div class="form-group">
            <label for="varchar">Nomor Surat <?php echo form_error('no') ?></label>
            <input type="text" class="form-control" name="no" id="no" placeholder="No" value="<?php echo $no; ?>" />
        </div>
      <div class="form-group">
            <label for="varchar">Judul <?php echo form_error('judul') ?></label>
            <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" value="<?php echo $judul; ?>" />
        </div>
      <div class="form-group">
            <label for="int">Kategori<?php echo form_error('id_kategori_info') ?></label>
            <select class="form-control" name="id_kategori_info" id="id_kategori_info">
              <option value="">-Pilih Kategori-</option>
              <?php
              foreach ($kategori as $value) {
                $select="";
                if ($value->id_kategori==$id_kategori_info) {
                  $select="selected";
                }
                ?>
                 <option value="<?= $value->id_kategori?>" <?=$select ?>> <?= $value->kategori?> </option>
                <?php
              }

              ?>
            </select>
      </div>
        

    </div>
    <div class="col-md-6">
      <div class="form-group">
          <label for="date">Tangggal<?php echo form_error('tgl') ?></label>
          <div class="input-group date">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <input type="text" class="form-control pull-right" name="tgl" id="tgl_peraturan" placeholder="Tanggal" value="<?php echo $tgl; ?>" />
          </div>
      </div>
      <div class="form-group">
            <label for="int">Tahun <?php echo form_error('tahun') ?></label>
            <input type="text" class="form-control" name="tahun" id="tahun" placeholder="Tahun" value="<?php echo $tahun; ?>" />
        </div>

        <div class="form-group">
            <div class="col-xs-12">


              <label for="varchar">File Abstrak (.pdf) : <?php echo $file; ?><?php echo form_error('file') ?></label>
            <input type="file" name="file">
            <input class="file-path validate" type="hidden" name="file">

            </div>
          </div>
      
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="varchar">Deskripsi <?php echo form_error('deskripsi') ?></label>
            <textarea type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="deskripsi"><?php echo $deskripsi; ?></textarea>
        </div>
    </div>
  </div>
    </div>
        
        <!-- /.box-body -->
        <div class="box-footer">
        <div class="col-md-12">
          <div class="form-group pull-right">
            <input type="hidden" name="id_info_hukum" value="<?php echo $id_info_hukum; ?>" /> 
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
            <a href="<?php echo site_url('ta_info_hukum') ?>" class="btn btn-default">Cancel</a>
          </div>
        </div>
        </div>
      <?php echo form_close(); ?>
        <!-- /.box-footer-->
      </div>

</section>