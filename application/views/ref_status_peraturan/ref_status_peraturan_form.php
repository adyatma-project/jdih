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
        <h2 style="margin-top:0px">Ref_status_peraturan <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="nama_status_peraturan">Nama Status Peraturan <?php echo form_error('nama_status_peraturan') ?></label>
            <textarea class="form-control" rows="3" name="nama_status_peraturan" id="nama_status_peraturan" placeholder="Nama Status Peraturan"><?php echo $nama_status_peraturan; ?></textarea>
        </div>
	    <input type="hidden" name="id_status_peraturan" value="<?php echo $id_status_peraturan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('ref_status_peraturan') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>