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
        <h2 style="margin-top:0px">Ref_status_peraturan Read</h2>
        <table class="table">
	    <tr><td>Nama Status Peraturan</td><td><?php echo $nama_status_peraturan; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('ref_status_peraturan') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>