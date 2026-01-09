<section class="content-header">
      <h1>
        Manajemen User
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
          <h3 class="box-title">List User</h3>

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

            </div>
        </div>
	<table id="example1" class="table table-bordered table-striped">
 <thead>
      <tr>
        <th width="5">No.</th>
        <th>Username</th>
        <th>Nama Operator</th>
        <th>Hak Akses</th>
		<th>Status</th>

        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
	<?php
		$no=$tot+1;
		foreach($status_pegawai->result_array() as $dp)
		{
	?>
      <tr>
        <td><?php echo $no; ?></td>
        <td>
		<?php
			if($dp['online']=="1")
			{
			?>
				<i class="fa fa-circle text-success"></i>
				<a href="<?php echo base_url(); ?>manage_user/edit/<?php echo $dp['id_user_login']; ?>"> <?php echo $dp['username']; ?></a>
        <?php
			}
			else
			{
			?>
        <i class="fa fa-circle text-danger"></i>
		<a href="<?php echo base_url(); ?>manage_user/edit/<?php echo $dp['id_user_login']; ?>"> <?php echo $dp['username']; ?></a>
        <?php
			}
			?>
		</td>
        <td><?php echo $dp['nama_lengkap']; ?>
		
		</td>
        <td><?php echo $dp['stts']; ?></td>
		
		<td>
		<?php
			if($dp['online']=="1")
			{
			?>
				<strong>Online</strong>
        <?php
			}
			else
			{
			?>
				<em>Offline</em>
        <?php
			}
			?>
		</td>
		<td>
				<a href="<?php echo base_url(); ?>manage_user/edit/<?php echo $dp['id_user_login']; ?>" class="btn btn-primary btn-flat"> <i class="fa fa-pencil"></i></a>
				<a href="<?php echo base_url(); ?>manage_user/hapus/<?php echo $dp['id_user_login']; ?>" class="btn btn-danger hapus btn-flat" onClick="return confirm('Anda yakin..???');"><i class="fa fa-trash"></i></a>
	        </div><!-- /btn-group -->
		</td>
      </tr>
	 <?php
	 		$no++;
	 	}
	 ?>
    </tbody>
  </table>
        <div class="col-lg-10"  >
	<div> <br> </div>
	 <?php echo anchor(site_url('manage_user/tambah'),'Tambah', 'class="btn btn-info"'); ?>
    </div>
<div class="row">
            <div class="col-md-6">
                
			</div>
            <div class="col-md-6 text-right">
                
            </div>
        </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Total Record : 
        </div>
        <!-- /.box-footer-->
      </div>

       

</section>
             