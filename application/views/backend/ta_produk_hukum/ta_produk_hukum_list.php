<section class="content-header">
      <h1>
        Produk Hukum
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
          <h3 class="box-title">Produk Hukum</h3>

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
			<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                
        </div>
        <div class="row" style="margin-bottom: 10px">
		
            
			<div class="col-md-4">
			
            </div>
			
            <div class="col-md-4 text-center">
			
                <div style="margin-top: 8px" id="message">
                    
					
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('ta_produk_hukum/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('ta_produk_hukum'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Cari</button>
						  <?php echo anchor(site_url('ta_produk_hukum/create'),'Tambah', 'class="btn btn-info"'); ?>
                        </span>
                    </div>
                </form>
            </div>
        </div>
		<div class="table-responsive">
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th width="30px">No</th>
		<th> <i class="fa fa-balance-scale"></i> Produk Hukum</th>
		<th>Tentang</th>
		<th width="9%"><i class="fa fa-calendar"></i> Tanggal</th>
		
		<th>Status</th>
		
		
		
		
		
		<th width="3%"><i class="fa fa-eye"></i></th>
		<th width="3%"><i class="fa fa-download"></i></th>
		<th width="5%">Aksi</th>
            </tr><?php
            foreach ($ta_produk_hukum_data as $ta_produk_hukum)
            {
                ?>
                <tr>
			<td><?php echo ++$start ?></td>
			<td><?php echo $ta_produk_hukum->kategori; echo " Nomor ";  echo $ta_produk_hukum->no_peraturan; echo " Tahun "; echo $ta_produk_hukum->tahun ?></td>
			<td><?php echo $ta_produk_hukum->tentang ?></td>
			<td><?php echo tanggal($ta_produk_hukum->tgl_peraturan) ?></td>
			
			<td>
			<?php
			//menampilkan data sumber peubah
			$get_status = $this->db->query('SELECT ref_status_peraturan.nama_status_peraturan, ta_produk_hukum_det.id_status_peraturan, ta_produk_hukum_det.id_sumber_perubahan FROM ta_produk_hukum_det 
				LEFT JOIN ref_status_peraturan ON
				ta_produk_hukum_det.id_status_peraturan=ref_status_peraturan.id_status_peraturan
				
				WHERE ta_produk_hukum_det.id_produk_hukum='.$ta_produk_hukum->id_produk_hukum.'')->result();

			foreach ($get_status as $value) {
				if($value->id_status_peraturan=="0"||$value->id_status_peraturan==NULL )
				{
					echo "<b>Berlaku</b>";
				}
				else
				{
					echo "<b>".$value->nama_status_peraturan.": </b>";
					if (!$value->id_sumber_perubahan==0)
					{
						$sumber = $this->db->query('SELECT ta_produk_hukum.tahun, ta_produk_hukum.id_produk_hukum, ta_produk_hukum.no_peraturan, ref_kategori.kategori FROM ta_produk_hukum
						left join ref_kategori
						on ta_produk_hukum.id_kategori=ref_kategori.id_kategori
						WHERE ta_produk_hukum.id_produk_hukum='.$value->id_sumber_perubahan.'
						')->row();
						if ($sumber)
						{
								echo "<br><p>";
								echo "<a href=".base_url()."ta_produk_hukum/read/".$sumber->id_produk_hukum.">";
								echo $sumber->kategori; echo " Nomor ";  echo $sumber->no_peraturan; echo " Tahun "; echo $sumber->tahun;
								echo "</p></a>";
						}
						else
						{
							echo "<i>Sumber Tidak Diketahui</i>";
						}
					}

				}
				
			}

			// Batas menampilkan data sumber peubah

			//menampilkan data yang di ubah

			$get_status = $this->db->query('SELECT ref_status_peraturan.nama_status_peraturan, ta_produk_hukum_det.id_status_peraturan, ta_produk_hukum_det.id_sumber_perubahan, ta_produk_hukum_det.id_produk_hukum FROM ta_produk_hukum_det 
				LEFT JOIN ref_status_peraturan ON
				ta_produk_hukum_det.id_status_peraturan=ref_status_peraturan.id_status_peraturan
				
				WHERE ta_produk_hukum_det.id_sumber_perubahan='.$ta_produk_hukum->id_produk_hukum.'')->result();

			foreach ($get_status as $value) {
					if ($value->id_status_peraturan=='2'|| $value->id_status_peraturan=='4'||$value->id_status_peraturan=='6')
					{
						echo "<br><b>".getpengubahstatus($value->id_status_peraturan).": </b>";
						$sumber = $this->db->query('SELECT ta_produk_hukum.tahun, ta_produk_hukum.id_produk_hukum, ta_produk_hukum.no_peraturan, ref_kategori.kategori FROM ta_produk_hukum
						left join ref_kategori
						on ta_produk_hukum.id_kategori=ref_kategori.id_kategori
						WHERE ta_produk_hukum.id_produk_hukum='.$value->id_produk_hukum.'
						')->row();
						if ($sumber)
						{
								echo "<br><p>";
								echo "<a href=".base_url()."ta_produk_hukum/read/".$sumber->id_produk_hukum.">";
								echo $sumber->kategori; echo " Nomor ";  echo $sumber->no_peraturan; echo " Tahun "; echo $sumber->tahun;
								echo "</p></a>";
						}
						else
						{
							echo "<i>Sumber Tidak Diketahui</i>";
						}
					}
				
			}


			
					
					
			?>
			</td>
			
			
			<td><?php echo $ta_produk_hukum->dilihat ?></td>
			<td><?php echo $ta_produk_hukum->didownload ?></td>
			<td style="text-align:center">
				<?php 
				// echo anchor(site_url('ta_produk_hukum/read/'.$ta_produk_hukum->id_produk_hukum),'<i class="fa fa-file-pdf-o"></i>', 'class="btn btn-sm btn-warning"');
				
				echo anchor(site_url('ta_produk_hukum/update/'.$ta_produk_hukum->id_produk_hukum),'<i class="fa fa-pencil-square-o"></i>', 'class="btn btn-sm btn-info"'); 
				
				echo anchor(site_url('ta_produk_hukum/delete/'.$ta_produk_hukum->id_produk_hukum),'<i class="fa fa-trash-o"></i>','class="btn btn-sm btn-danger" onclick="javasciprt: return confirm(\'Yakin Ingin Hapus ?\')"');
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
		</div>
        <div class="row">
            <div class="col-md-6">
                
		<?php echo anchor(site_url('ta_produk_hukum/excel'), '<i class="fa fa-file-excel-o"></i> Download', 'class="btn btn-success"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
		<!-- /.box-body -->
        <div class="box-footer">
          Total Data : <?php echo $total_rows ?>
        </div>
        <!-- /.box-footer-->
      </div>

</section>