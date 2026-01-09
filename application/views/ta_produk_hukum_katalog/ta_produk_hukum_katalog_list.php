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
        <h2 style="margin-top:0px">Ta_produk_hukum_katalog List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('ta_produk_hukum_katalog/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('ta_produk_hukum_katalog/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('ta_produk_hukum_katalog'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Ktlglembaran Jenis</th>
		<th>Ktlglembaran Tahun</th>
		<th>Ktlglembaran No</th>
		<th>Ktlglembaran Jum Halaman</th>
		<th>Ktlgtambahan Jenis</th>
		<th>Ktlgtambahan Tahun</th>
		<th>Ktlgtambahan No</th>
		<th>Ktlgtambahan Jum Halaman</th>
		<th>Pemrakarsa</th>
		<th>No Register</th>
		<th>Action</th>
            </tr><?php
            foreach ($ta_produk_hukum_katalog_data as $ta_produk_hukum_katalog)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $ta_produk_hukum_katalog->ktlglembaran_jenis ?></td>
			<td><?php echo $ta_produk_hukum_katalog->ktlglembaran_tahun ?></td>
			<td><?php echo $ta_produk_hukum_katalog->ktlglembaran_no ?></td>
			<td><?php echo $ta_produk_hukum_katalog->ktlglembaran_jum_halaman ?></td>
			<td><?php echo $ta_produk_hukum_katalog->ktlgtambahan_jenis ?></td>
			<td><?php echo $ta_produk_hukum_katalog->ktlgtambahan_tahun ?></td>
			<td><?php echo $ta_produk_hukum_katalog->ktlgtambahan_no ?></td>
			<td><?php echo $ta_produk_hukum_katalog->ktlgtambahan_jum_halaman ?></td>
			<td><?php echo $ta_produk_hukum_katalog->pemrakarsa ?></td>
			<td><?php echo $ta_produk_hukum_katalog->no_register ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('ta_produk_hukum_katalog/read/'.$ta_produk_hukum_katalog->id_produk_hukum),'Read'); 
				echo ' | '; 
				echo anchor(site_url('ta_produk_hukum_katalog/update/'.$ta_produk_hukum_katalog->id_produk_hukum),'Update'); 
				echo ' | '; 
				echo anchor(site_url('ta_produk_hukum_katalog/delete/'.$ta_produk_hukum_katalog->id_produk_hukum),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>