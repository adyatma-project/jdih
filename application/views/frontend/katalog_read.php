    <!-- Main content -->
<section class="content">
<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Detail Katalog Produk Hukum</h3>


        </div>
        <div class="box-body">
		
        <table class="table">
	    <tr><td>Nama Katalog</td><td><?php echo $nama_katalog; ?></td></tr>
	    <tr><td>Tahun</td><td><?php echo $tahun; ?></td></tr>
	    <tr><td>File</td><td><?php echo $file; ?></td></tr>
		<tr><td></td><td><a href="<?php echo base_url() ?>frontendprodukhukum/produk_hukum_page/<?php echo $id_produk_hukum ?>" class="btn btn-default">Kembali</a></td></tr>
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
