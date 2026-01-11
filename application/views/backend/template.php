<!--
====================================================
AYO NGINTIP CODING YACH!

By		: Ilham Saleh
Email	: salehilham@gmail.com
WA		: 082154545489
====================================================
-->

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>JDIH Anggota | Kabupaten Donggala</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/dist/css/skins/skin-blue.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/bower_components/select2/dist/css/select2.min.css">

  <!-- Untuk Local Host -->
  <script src="<?php echo base_url() ?>assets/tinymce/tiny_mce.js"></script>
  <script src="<?php echo base_url(); ?>assets/highcharts/highcharts.js"></script>
  <script src="<?php echo base_url(); ?>assets/highcharts/exporting.js"></script>
  <script src="<?php echo base_url(); ?>assets/highcharts/export-data.js"></script>

  <script type="text/javascript">
    tinyMCE.init({
      // General options
      mode: "textareas",
      theme: "advanced",
    });
  </script>

  <style type="text/css">
    .pdfitem {
      position: relative;
      padding-bottom: 150%;
      height: 0;
      margin: 20px 0;
    }

    .pdfitem object {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }
  </style>


  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="shortcut icon" href="<?php echo base_url(); ?>template/ico/favicon.png">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--
BODY TAG OPTIONS:
=================

|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>JDIH</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>JDIH</b>Donggala</span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/dist/img/logo.png" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs"><?php echo $this->session->userdata('nama'); ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/dist/img/logo.png" class="img-circle" alt="User Image">

                  <p>
                    <?php echo $this->session->userdata('nama'); ?>
                    <small>Tgl Lahir Admin Disini</small>
                  </p>
                </li>
                <!-- Menu Body -->
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Ubah Password</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url() ?>backend/logout" class="btn btn-default btn-flat">Log Out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/dist/img/logo.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?php echo $this->session->userdata('nama'); ?></p>
            <!-- Status -->
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header"></li>
          <!-- Optionally, you can add icons to the links -->
          <li><a href="<?php echo base_url() ?>backend"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
          <!--<li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li> -->

          <li class="treeview">
            <a href="#"><i class="fa fa-bank"></i> <span>Pemerintahan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url() ?>ref_visimisi/update/1">Visi dan Misi</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#"><i class="fa fa-balance-scale"></i> <span>Produk Hukum</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url() ?>ref_kategori">Jenis</a></li>
              <!-- <li><a href="<?php echo base_url() ?>ta_katalog">Katalog PHD</a></li> -->
              <li><a href="<?php echo base_url() ?>ta_produk_hukum">Peraturan</a></li>
            </ul>
          </li>

          <li class="treeview">
            <a href="#"><i class="fa fa-sticky-note-o"></i> <span>Info Hukum</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url() ?>ref_kategori_info">Kategori</a></li>
              <li><a href="<?php echo base_url() ?>ta_info_hukum">Info Hukum</a></li>
            </ul>
          </li>
          <li>
    <a href="<?php echo base_url() ?>ref_kabag"><i class="fa fa-user-secret"></i> <span>Data Kabag Hukum</span></a>
</li>
<li class="treeview">
  <a href="#"><i class="fa fa-image"></i> <span>Slider</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="<?php echo base_url() ?>ta_slider">Kelola Slider</a></li>
  </ul>
</li>
          <li class="treeview">
            <a href="#"><i class="fa fa-newspaper-o"></i> <span>Berita</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url() ?>ref_kategori_berita">Kategori</a></li>
              <li><a href="<?php echo base_url() ?>ta_berita">Berita</a></li>
            </ul>
          </li>
          <li class="treeview">
            <a href="#"><i class="fa fa-picture-o"></i> <span>Galeri</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#">Album</a></li>
              <li><a href="#">Foto</a></li>
            </ul>
          </li>

          <li><a href="<?php echo base_url() ?>Ta_link_terkait"><i class="fa fa-dashboard"></i> <span>Link Terkait</span></a></li>

          <li class="treeview">
            <a href="#"><i class="fa fa-wrench"></i> <span>Pengaturan</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url() ?>ref_aplikasi">Aplikasi</a></li>
              <li><a href="<?php echo base_url() ?>manage_user">Manajemen Pengguna</a></li>
            </ul>
          </li>
          <li><a href="<?php echo base_url() ?>backend/logout"><i class="fa fa-power-off"></i> <span>Log Out</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php echo $contents; ?>
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="pull-right hidden-xs">
        <b>Versi 1.2.2 </b>
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2019 <a href="#">Bagian Hukum dan Perundang-undangan Donggala</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->

    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->



  <!-- jQuery 3 -->
  <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/dist/js/adminlte.min.js"></script>

  <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/bower_components/select2/dist/js/select2.full.min.js"></script>


  <script>
    $(function() {

      $('.select2').select2()

      //Date picker
      $('#tgl_peraturan').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      })
    })
  </script>
</body>

</html>

<script>
  $(document).ready(function() {
    document.getElementById("myP").style.display = "none";
  });

  $("#id_status_peraturan").change(function() {
    var status = $(this).val();
    if (status == '0' || status == '7') {
      document.getElementById("myP").style.display = "none";

      $("#isi-subject").empty();
      $("#subject_produk").val('');
      $("#subject_status").val('');

    } else {
      document.getElementById("myP").style.display = "";
    }
  });

  $("#id_katalog").change(function() {
    var id_katalog = $(this).val();
    if (id_katalog != "") {
      $.ajax({
        type: "GET",
        url: "<?php echo base_url('ta_produk_hukum/getKatalog'); ?>/" + id_katalog,
        success: function(isi) {
          $("#isi-katalog").html(isi);
        },
        error: function() {
          alert("Data Tidak Ditemukan. Mohon mencari dengan kata kunci yang sesuaiaaa!");
        }
      });
    } else {
      $("#isi-katalog").html("");
    }
  });

  $("#tambah_status").click(function() {
    var id_sumber_perubahan = $('#id_sumber_perubahan').val();
    var id_status_peraturan = $('#id_status_peraturan').val();
    var status = 0;

    var subject_produk = $('#subject_produk').val();
    var split_subject_produk = subject_produk.split('=>');
    var subject_status = $('#subject_status').val();

    for (var i = 0; i < split_subject_produk.length; i++) {
      if (split_subject_produk[i] == id_sumber_perubahan) {
        status = 1;

      }
    }
    console.log(status);
    if (status == 1) {
      alert("List Subject/Keterangan Status Sudah Ada!");
    } else {


      if (subject_produk == "") {
        var a_subject_produk = (id_sumber_perubahan);
        var a_subject_status = (id_status_peraturan);

      } else {
        var a_subject_produk = (id_sumber_perubahan) + "=>" + (subject_produk);
        var a_subject_status = (id_status_peraturan) + "=>" + (subject_status);
      }

      if (id_sumber_perubahan != "") {
        $.ajax({
          type: "POST",
          url: "<?php echo base_url('ta_produk_hukum/getSubjectProdukHukum'); ?>",
          data: {
            id_sumber_perubahan: id_sumber_perubahan,
            id_status_peraturan: id_status_peraturan
          },
          success: function(isi) {
            $("#isi-subject").append(isi);
            $("#subject_produk").val(a_subject_produk);
            $("#subject_status").val(a_subject_status);
          },
          error: function() {
            alert("Data Tidak Ditemukan. Mohon mencari dengan kata kunci yang sesuaiaaa!");
          }
        });
      } else {
        alert("Mohon Memilih Subject/Keterangan Status!");
      }
    }
  });
</script>