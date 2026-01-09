<section class="content-header">
      <h1>
        Katalog
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
          <h3 class="box-title">Katalog Produk Hukum</h3>

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
                <form action="<?php echo site_url('ta_katalog/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('ta_katalog'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Cari</button>
						  <?php echo anchor(site_url('ta_katalog/create'),'Tambah', 'class="btn btn-info"'); ?>
                        </span>
                    </div>
                </form>
            </div>
        </div>
		<div class="table-responsive">
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Katalog</th>
		<th>Tahun</th>
		<th>File</th>
		<th width="5%">Aksi</th>
            </tr><?php
            foreach ($ta_katalog_data as $ta_katalog)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $ta_katalog->nama_katalog ?></td>
			<td><?php echo $ta_katalog->tahun ?></td>
			<td><?php echo $ta_katalog->file ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('ta_katalog/read/'.$ta_katalog->id_katalog),'<i class="fa fa-file-pdf-o"></i>', 'class="btn btn-sm btn-warning"');
				
				echo anchor(site_url('ta_katalog/update/'.$ta_katalog->id_katalog),'<i class="fa fa-pencil-square-o"></i>', 'class="btn btn-sm btn-info"'); 
				
				echo anchor(site_url('ta_katalog/delete/'.$ta_katalog->id_katalog),'<i class="fa fa-trash-o"></i>','class="btn btn-sm btn-danger" onclick="javasciprt: return confirm(\'Yakin Ingin Hapus ?\')"');
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
                
			</div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Total Record : <?php echo $total_rows ?>
        </div>
        <!-- /.box-footer-->
      </div>

       

</section>