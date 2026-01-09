<section class="content-header">
      <h1>
        Detail Produk Hukum
        <small>JDIH Kabupaten Donggala Versi 1.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
</section>

    <!-- Main content -->
<section class="content">
<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Produk Hukum</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        <table class="table">
	    <tr><td>No Peraturan</td><td><?php echo $no_peraturan; ?></td></tr>
	    <tr><td>Tentang</td><td><?php echo $tentang; ?></td></tr>
	    <tr><td>Tahun</td><td><?php echo $tahun; ?></td></tr>
	    <tr><td>Jenis</td><td><?php echo $id_kategori; ?></td></tr>
	    <tr><td>Status Peraturan</td><td><?php echo $id_status_peraturan; ?></td></tr>
	    <tr><td>Abstrak</td><td><?php echo $abstrak; ?></td></tr>
	    <tr><td>Pengarang</td><td><?php echo $id_pengarang; ?></td></tr>
	    <tr><td>Tanggal Peraturan</td><td><?php echo tanggal($tgl_peraturan); ?></td></tr>
	    <tr><td>Dilihat</td><td><?php echo $dilihat; ?></td></tr>
	    <tr><td>Didownload</td><td><?php echo $didownload; ?> <?php echo $file ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('ta_produk_hukum') ?>" class="btn btn-default">Kembali</a></td></tr>
		<tr><td colspan="2">
		<div class="pdfitem">
		
			<object data="<?php echo base_url()?>uploads/produk_hukum/<?php echo $file ?>" type="application/pdf">
				<p>Browser ini tidak mendukung file PDF. Silakan unduh untuk melihat.
				</p>
			</object>
		</div>
		</td>
		</tr>
	</table>
</div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>

       

</section>

