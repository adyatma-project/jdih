<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Ta_produk_hukum_katalog <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Ktlglembaran Jenis <?php echo form_error('ktlglembaran_jenis') ?></label>
            <input type="text" class="form-control" name="ktlglembaran_jenis" id="ktlglembaran_jenis" placeholder="Ktlglembaran Jenis" value="<?php echo $ktlglembaran_jenis; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ktlglembaran Tahun <?php echo form_error('ktlglembaran_tahun') ?></label>
            <input type="text" class="form-control" name="ktlglembaran_tahun" id="ktlglembaran_tahun" placeholder="Ktlglembaran Tahun" value="<?php echo $ktlglembaran_tahun; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Ktlglembaran No <?php echo form_error('ktlglembaran_no') ?></label>
            <input type="text" class="form-control" name="ktlglembaran_no" id="ktlglembaran_no" placeholder="Ktlglembaran No" value="<?php echo $ktlglembaran_no; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Ktlglembaran Jum Halaman <?php echo form_error('ktlglembaran_jum_halaman') ?></label>
            <input type="text" class="form-control" name="ktlglembaran_jum_halaman" id="ktlglembaran_jum_halaman" placeholder="Ktlglembaran Jum Halaman" value="<?php echo $ktlglembaran_jum_halaman; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ktlgtambahan Jenis <?php echo form_error('ktlgtambahan_jenis') ?></label>
            <input type="text" class="form-control" name="ktlgtambahan_jenis" id="ktlgtambahan_jenis" placeholder="Ktlgtambahan Jenis" value="<?php echo $ktlgtambahan_jenis; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Ktlgtambahan Tahun <?php echo form_error('ktlgtambahan_tahun') ?></label>
            <input type="text" class="form-control" name="ktlgtambahan_tahun" id="ktlgtambahan_tahun" placeholder="Ktlgtambahan Tahun" value="<?php echo $ktlgtambahan_tahun; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Ktlgtambahan No <?php echo form_error('ktlgtambahan_no') ?></label>
            <input type="text" class="form-control" name="ktlgtambahan_no" id="ktlgtambahan_no" placeholder="Ktlgtambahan No" value="<?php echo $ktlgtambahan_no; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Ktlgtambahan Jum Halaman <?php echo form_error('ktlgtambahan_jum_halaman') ?></label>
            <input type="text" class="form-control" name="ktlgtambahan_jum_halaman" id="ktlgtambahan_jum_halaman" placeholder="Ktlgtambahan Jum Halaman" value="<?php echo $ktlgtambahan_jum_halaman; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Pemrakarsa <?php echo form_error('pemrakarsa') ?></label>
            <input type="text" class="form-control" name="pemrakarsa" id="pemrakarsa" placeholder="Pemrakarsa" value="<?php echo $pemrakarsa; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">No Register <?php echo form_error('no_register') ?></label>
            <input type="text" class="form-control" name="no_register" id="no_register" placeholder="No Register" value="<?php echo $no_register; ?>" />
        </div>
	    <input type="hidden" name="id_produk_hukum" value="<?php echo $id_produk_hukum; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('ta_produk_hukum_katalog') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>