<!--
====================================================
AYO NGINTIP CODING YACH!

By		: Ilham Saleh
Email	: salehilham@gmail.com
WA		: 082154545489
====================================================
-->
<html><head>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>template/ico/favicon.png"></link>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <title>Login | JDIH Anggota Kabupaten Donggala</title>
	<link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/shamcey/css/style.default.css" type="text/css">
      <link rel="stylesheet" href="<?php echo base_url(); ?>assets/shamcey/css/style.shinyblue.css" type="text/css">
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/shamcey/js/jquery-1.9.1.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/shamcey/js/jquery-migrate-1.1.1.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/shamcey/js/jquery-ui-1.9.2.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/shamcey/js/modernizr.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/shamcey/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/shamcey/js/jquery.cookie.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/shamcey/js/custom.js"></script>
      <script type="text/javascript">
        jQuery(document).ready(function(){
                        jQuery('#login').submit(function(){
                            var u = jQuery('#username').val();
                            var p = jQuery('#password').val();
                            if(u == '' && p == '') {
                                jQuery('.login-alert').fadeIn();
                                return false;
                            }
                        });
                    });
      </script>
  </head><body class="loginpage">
  <div><br> </div>
  <div> <br></div>
   <div> <br></div>
   <div><br> </div>
  <div> <br></div>
   <div> <br></div>
   <div> <br></div>
   <div> <br></div>
  
  
<div class="loginpanel" style="
    top: 190px;
    margin-left: 0px;
    margin-right: 0px;">
<div class="loginpanelinner">

	  <table align="center" width="600">
					<tr>
					<td align="center"><img src="<?php echo base_url() ?>template/img/logo.png" alt="..."></td>
					</tr>
					<tr>
					    <td>
						<br>
						<b><h4 align="center">LOGIN ANGGOTA</h4><b><br>
						<h4 align="center"><strong>JARINGAN DOKUMENTASI DAN INFORMASI HUKUM</strong></h4>
						<h4 align="center"><strong>KABUPATEN DONGGALA</strong></h4>
            <div class="aligncenter"></div>
						<hr>
            <?php echo $this->session->userdata('result_login') <> '' ? $this->session->userdata('result_login') : ''; ?>
						</td>
					</tr>
					</table>
		</div>
		</div>

    <div class="loginpanel" align="center">
        <div><br> </div>
  <div> <br><br></div>
   <div> <br></div>
      <div> <br></div>
         <div> <br></div>
		 <div> <br></div>

      <div class="loginpanelinner"><?php echo form_open('backend/index','class="navbar-form pull-right"'); ?>
		
        <div class="inputwrapper login-alert">
          <?php if(validation_errors()) { ?>
          <div class="callout callout-danger lead">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h4>Terjadi Kesalahan!</h4>
            <?php echo validation_errors(); ?>
          </div>
		<?php } ?>
		<?php if($this->session->flashdata('result_login')) { ?>
          <div class="callout callout-danger lead">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h4>Terjadi Kesalahan!</h4>
            <?php echo $this->session->flashdata('result_login'); ?></div>
          <?php } ?>
          <div class="alert alert-error">username atau password salah!</div>
        </div>
        <div class="inputwrapper animate1 bounceIn">
          <input type="text" name="username" id="username" placeholder="Masukkan username">
        </div>
        <div class="inputwrapper animate2 bounceIn">
          <input type="password" name="password" id="password" placeholder="Masukkan password">
        </div>
        <div class="inputwrapper animate3 bounceIn" width="10">
          <button name="submit">Login</button>
        </div>
        <div class="inputwrapper animate4 bounceIn">
          <label  style="color:blue"><a href="<?php echo base_url()?>"><b>Kembali Halaman Utama</a></b></label>
        </div>
      </div>
      <loginpanelinner>
	  
    </div>
    <loginpanel>
    <div class="loginfooter">
      <div class="pull-right hidden-xs">
          <b style="color:#3d5c5c">Versi 1.2.2</b> &bnsp;
        </div>
        <strong style="color:#3d5c5c">&copy; Bagian Hukum dan Perundang-undangan Donggala , All rights reserved 2020</a>.</strong>
    </div>
  

</body></html>