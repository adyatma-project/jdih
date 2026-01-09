<section class="content-header">
      <h1>
        Detail Katalog
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
          <h3 class="box-title">Detail Katalog Produk Hukum</h3>

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
	    <tr><td>Nama Katalog</td><td><?php echo $nama_katalog; ?></td></tr>
	    <tr><td>Tahun</td><td><?php echo $tahun; ?></td></tr>
	    <tr><td>File</td><td><?php echo $file; ?></td></tr>
		<tr><td></td><td><a href="<?php echo site_url('ta_katalog') ?>" class="btn btn-default">Kembali</a></td></tr>
		<tr><td colspan="2">
		<div class="pdfitem">
			<object data="<?php echo base_url()?>uploads/katalog/<?php echo $file ?>" type="application/pdf">
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
