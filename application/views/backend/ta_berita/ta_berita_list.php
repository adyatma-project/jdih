<section class="content-header">
      <h1>
        List Berita
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
          <h3 class="box-title">List Berita</h3>

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
                <form action="<?php echo site_url('ta_berita/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('ta_berita'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Cari</button>
						  <?php echo anchor(site_url('ta_berita/create'),'Tambah', 'class="btn btn-info"'); ?>
                        </span>
                    </div>
                </form>
            </div>
        </div>
		<div class="table-responsive">
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
                <th>Foto</th>
		<th><i class="fa fa-info"></i> Judul</th>
		<th width="30%"><i class="fa fa-newspaper-o"></i> Isi</th>
		<th ><i class="fa fa-archive"></i> Kategori</th>
		<th width="10%"><i class="fa fa-calendar"></i> Input</th> 
		<th width="10%"><i class="fa fa-calendar"></i> Update</th> 
		<th width="3%"><i class="fa fa-user"></i></th>
		<th width="3%"><i class="fa fa-eye"></i></th>
		<th width="5%">Aksi</th>
            </tr><?php
            foreach ($ta_berita_data as $ta_berita)
            {
                ?>
                <tr>
			<td width="30"><?php echo ++$start ?></td>
            <td><img src="<?php echo base_url()."uploads/berita/thumb/".$ta_berita->file ?>"></img></td>
			<td><a href="<?php echo base_url()?>ta_berita/read/<?php echo $ta_berita->id_berita ?>"> <?php echo $ta_berita->judul ?></a></td>
			<td><?php echo $ta_berita->isi ?></td>
			<td><?php echo $ta_berita->kategori ?></td>
			<td><?php echo $ta_berita->tgl_insert ?></td>
			<td><?php echo $ta_berita->tgl_update ?></td>
			<td><?php echo $ta_berita->user ?></td>
			<td><?php echo $ta_berita->viewer ?></td>
			
			<td style="text-align:center">
				<?php 
				
				echo anchor(site_url('ta_berita/read/'.$ta_berita->id_berita),'<i class="fa fa-sticky-note-o"></i>', 'class="btn btn-sm btn-success"'); 
				echo anchor(site_url('ta_berita/update/'.$ta_berita->id_berita),'<i class="fa fa-pencil-square-o"></i>', 'class="btn btn-sm btn-info"'); 
				echo anchor(site_url('ta_berita/delete/'.$ta_berita->id_berita),'<i class="fa fa-trash-o"></i>','class="btn btn-sm btn-danger" onclick="javasciprt: return confirm(\'Yakin Ingin Hapus ?\')"');
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