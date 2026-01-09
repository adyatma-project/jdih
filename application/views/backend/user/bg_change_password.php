<body class="hold-transition skin-blue fixed sidebar-collapse">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>dashboard_admin" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>S</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SIMPEG</b> <?php echo $credit; ?></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
    <div class="collapse navbar-collapse" id="navbar-collapse">
            <?php require("inc/menu/mnatas.php"); ?>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url(); ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Nama Adminnya</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
		
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
	  
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Data Pegawai
            <small>Detail Pegawai</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Pegawai</h3>
                </div><!-- /.box-header -->
				
                <div class="box-body">

<section id="data-keluarga">
  <div>
  	<?php echo $this->session->flashdata('pass'); ?>
    <?php if(validation_errors()) { ?>
	<div class="callout callout-danger lead">
	  <button type="button" class="close" data-dismiss="alert">×</button>
	  	<h4>Terjadi Kesalahan!</h4>
		<?php echo validation_errors(); ?>
	</div>
	<?php } ?>
	<div class="nav nav-tabs">
	<?php
		if($this->session->userdata("tab_a")=="" && $this->session->userdata("tab_b")=="")
		{
			$set['tab_a'] = "active";
			$this->session->set_userdata($set);
		}
		$a = $this->session->userdata("tab_a");
		$b = $this->session->userdata("tab_b");
	?>
	  <ul class="nav nav-tabs">
		<li class="<?php echo $a; ?>"><a href="#lA" data-toggle="tab">Pengaturan Password</a></li>
		<li class="<?php echo $b; ?>"><a href="#lB" data-toggle="tab">Pengaturan Nama Pengguna</a></li>
	  </ul>
	  <div class="tab-content">
		<div class="tab-pane <?php echo $a; ?>" id="lA">
		  <h4>Pengaturan Password</h4>
			<?php echo form_open('app/save_pass'); ?>
				<div class="control-group">
					<label class="control-label col-lg-2 col-lg-2" for="pass_lama">Username</label>
					<div class="col-lg-10">
					  <input type="text" value="<?php echo $this->session->userdata('username'); ?>" 
					  class="form-control" name="username" id="username" placeholder="Username" readonly="true">
					</div>
					<label class="control-label col-lg-2" for="pass_lama">Password Lama</label>
					<div class="col-lg-10">
					  <input type="password" class="form-control" name="pass_lama" id="pass_lama" placeholder="Password Lama">
					</div>
					<label class="control-label col-lg-2" for="pass_lama">Password Baru</label>
					<div class="col-lg-10">
					  <input type="password" class="form-control" name="pass_baru" id="pass_baru" placeholder="Password Baru">
					</div>
					<label class="control-label col-lg-2" for="pass_lama">Ulangi Password Baru</label>
					<div class="col-lg-10">
					  <input type="password" class="form-control" name="ulangi_pass_baru" id="ulangi_pass_baru" placeholder="Ulangi Password Baru">
					</div>
			  	</div>
				<div class="control-group">
			<div class="col-lg-10">
			<div>
			<br>
			</div>
			  <button type="submit" class="btn btn-primary">Simpan Data</button>
			  <button type="reset" class="btn">Bersihkan Data</button>
			</div>
		  </div>
			<?php echo form_close(); ?>
		</div>
		<div class="tab-pane <?php echo $b; ?>" id="lB">
		  <h4>Pengaturan Nama Pengguna</h4>
			  <?php echo form_open('app/save_name'); ?>
					<div class="control-group">
						<label class="control-label col-lg-2" for="pass_lama">Nama Pengguna</label>
						<div class="col-lg-10">
						  <input type="text" value="<?php echo $this->session->userdata('nama'); ?>" 
						  class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Pengguna">
						</div>
					</div>
					<div class="control-group">
				<div class="col-lg-10">
							<div>
			<br>
			</div>
				  <button type="submit" class="btn btn-primary">Simpan Data</button>
				  <button type="reset" class="btn">Bersihkan Data</button>
				</div>
			  </div>
			<?php echo form_close(); ?>
		</div>
	  </div>
	</div> <!-- /tabbable -->
  </div>
</section>
    </div> <!-- /container -->

</div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
	  
	  
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Versi</b> 1.0
        </div>
        <strong>Copyright &copy; <?php echo $credit; ?></a>.</strong>
      </footer>

      <!-- Control Sidebar -->
      <!-- /.control-sidebar -->
	  
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->


  </body>
</html>




