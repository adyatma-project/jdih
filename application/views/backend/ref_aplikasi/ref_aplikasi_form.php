
        
	
<section class="content-header">
      <h1>
        Pengaturan
        <small>Aplikasi</small>
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
          <h3 class="box-title">Pengaturan</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        <div class="box-body">
        <div class="box-body">
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Web <?php echo form_error('nama_web') ?></label>
            <input type="text" class="form-control" name="nama_web" id="nama_web" placeholder="Nama Web" value="<?php echo $nama_web; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nama Instansi <?php echo form_error('nama_instansi') ?></label>
            <input type="text" class="form-control" name="nama_instansi" id="nama_instansi" placeholder="Nama Instansi" value="<?php echo $nama_instansi; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Alamat <?php echo form_error('alamat') ?></label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Email <?php echo form_error('email') ?></label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Fax <?php echo form_error('fax') ?></label>
            <input type="text" class="form-control" name="fax" id="fax" placeholder="Fax" value="<?php echo $fax; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">No Telpn <?php echo form_error('no_telpn') ?></label>
            <input type="text" class="form-control" name="no_telpn" id="no_telpn" placeholder="No Telpn" value="<?php echo $no_telpn; ?>" />
        </div>
	    <input type="hidden" name="" value="<?php echo $id; ?>" /> 
      <div class="row">
    <div class="col-md-12">
        <h4 class="text-primary"><i class="fa fa-share-alt"></i> Akun Media Sosial</h4>
        <hr>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label for="varchar">Facebook URL</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-facebook"></i></div>
                <input type="text" class="form-control" name="fb" id="fb" placeholder="Contoh: https://facebook.com/jdihdonggala" value="<?php echo $fb; ?>" />
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="varchar">Instagram URL</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-instagram"></i></div>
                <input type="text" class="form-control" name="ig" id="ig" placeholder="Contoh: https://instagram.com/jdih_donggala" value="<?php echo $ig; ?>" />
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="varchar">Twitter / X URL</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-twitter"></i></div>
                <input type="text" class="form-control" name="twitter" id="twitter" placeholder="Link Twitter" value="<?php echo $twitter; ?>" />
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="varchar">Youtube Channel URL</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-youtube-play"></i></div>
                <input type="text" class="form-control" name="yt" id="yt" placeholder="Link Youtube" value="<?php echo $yt; ?>" />
            </div>
        </div>
    </div>
</div>
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    
	</form>
   </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>

</section>