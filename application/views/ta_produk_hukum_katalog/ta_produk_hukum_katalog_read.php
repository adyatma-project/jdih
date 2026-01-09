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
        <h2 style="margin-top:0px">Ta_produk_hukum_katalog Read</h2>
        <table class="table">
	    <tr><td>Ktlglembaran Jenis</td><td><?php echo $ktlglembaran_jenis; ?></td></tr>
	    <tr><td>Ktlglembaran Tahun</td><td><?php echo $ktlglembaran_tahun; ?></td></tr>
	    <tr><td>Ktlglembaran No</td><td><?php echo $ktlglembaran_no; ?></td></tr>
	    <tr><td>Ktlglembaran Jum Halaman</td><td><?php echo $ktlglembaran_jum_halaman; ?></td></tr>
	    <tr><td>Ktlgtambahan Jenis</td><td><?php echo $ktlgtambahan_jenis; ?></td></tr>
	    <tr><td>Ktlgtambahan Tahun</td><td><?php echo $ktlgtambahan_tahun; ?></td></tr>
	    <tr><td>Ktlgtambahan No</td><td><?php echo $ktlgtambahan_no; ?></td></tr>
	    <tr><td>Ktlgtambahan Jum Halaman</td><td><?php echo $ktlgtambahan_jum_halaman; ?></td></tr>
	    <tr><td>Pemrakarsa</td><td><?php echo $pemrakarsa; ?></td></tr>
	    <tr><td>No Register</td><td><?php echo $no_register; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('ta_produk_hukum_katalog') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>