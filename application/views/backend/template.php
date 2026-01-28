<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>JDIH Anggota | Kabupaten Donggala</title>

    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <base href="<?php echo base_url(); ?>">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet"
        href="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/dist/css/skins/skin-blue.min.css">

    <link rel="stylesheet"
        href="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/bower_components/select2/dist/css/select2.min.css">

    <style>
    /* Global Font */
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    .main-header .logo {
        font-family: 'Poppins', sans-serif !important;
    }

    /* Header Modern: Glassmorphism */
    .main-header {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .main-header .navbar {
        background: linear-gradient(to right, #1e3c72, #2a5298) !important;
        /* Biru Dongker Elegan */
        border: none;
    }

    .main-header .logo {
        background-color: #162e58 !important;
        font-weight: 600;
        letter-spacing: 1px;
    }

    /* Sidebar Modern & SCROLL FIX */
    .main-sidebar {
        background-color: #ffffff;
        /* Sidebar Putih Bersih */
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
        border-right: 1px solid #f0f0f0;

        /* --- PERBAIKAN SCROLL --- */
        position: fixed;
        height: 100vh;
        overflow-y: auto;
        /* Aktifkan scroll vertikal */
        z-index: 810;
        /* Pastikan di atas konten tapi di bawah header jika perlu */
        padding-bottom: 50px;
        /* Ruang agar menu paling bawah tidak terpotong */
    }

    /* Sembunyikan Scrollbar default agar rapi (Opsional) */
    .main-sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .main-sidebar::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 3px;
    }

    .skin-blue .wrapper,
    .skin-blue .main-sidebar,
    .skin-blue .left-side {
        background-color: #fff;
    }

    .skin-blue .sidebar-menu>li>a {
        color: #555;
        font-weight: 500;
        border-radius: 0 25px 25px 0;
        /* Rounded tab effect */
        margin-right: 10px;
        transition: all 0.3s;
    }

    .skin-blue .sidebar-menu>li:hover>a,
    .skin-blue .sidebar-menu>li.active>a {
        color: #1e3c72;
        background: #f0f4ff;
        border-left: 4px solid #1e3c72;
    }

    .skin-blue .sidebar-menu>li>.treeview-menu {
        background: #fff;
        padding-left: 20px;
    }

    .user-panel>.info>p {
        color: #333;
        font-weight: 600;
    }

    .user-panel>.info>a {
        color: #28a745;
        /* Online Green */
    }

    /* Content Area */
    .content-wrapper {
        background-color: #f4f6f9;
        /* Abu-abu sangat muda */
    }

    /* Box / Card Modern */
    .box {
        border-radius: 10px;
        border-top: none;
        /* Hilangkan garis biru default adminlte */
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
        transition: transform 0.3s ease;
    }

    .box:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.06);
    }

    .box-header.with-border {
        border-bottom: 1px solid #f0f0f0;
        background-color: #fff;
        border-radius: 10px 10px 0 0;
        padding: 15px 20px;
    }

    .box-title {
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
    }

    /* Tombol Keren */
    .btn {
        border-radius: 50px;
        /* Tombol Bulat */
        padding: 6px 20px;
        font-size: 13px;
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
        border: none;
        transition: all 0.3s;
    }

    .btn-primary {
        background: linear-gradient(45deg, #1e3c72, #2a5298);
    }

    .btn-success {
        background: linear-gradient(45deg, #11998e, #38ef7d);
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 14px rgba(50, 50, 93, .1), 0 3px 6px rgba(0, 0, 0, .08);
    }

    /* Footer Modern */
    .glass-footer {
        background: #fff;
        border-top: 1px solid #f0f0f0;
        color: #666;
        padding: 15px 20px;
    }

    .neon-link {
        color: #1e3c72;
        font-weight: 700;
        text-decoration: none;
    }

    .version-box {
        background: #f0f4ff;
        color: #1e3c72;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 11px;
        font-weight: 600;
    }

    /* PDF Viewer */
    .pdfitem {
        position: relative;
        padding-bottom: 100%;
        height: 0;
        margin: 20px 0;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .pdfitem object {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    </style>

    <link rel="shortcut icon" href="<?php echo base_url(); ?>template/ico/favicon.png">

    <script src="<?php echo base_url(); ?>assets/highcharts/highcharts.js"></script>
    <script src="<?php echo base_url(); ?>assets/highcharts/exporting.js"></script>
    <script src="<?php echo base_url(); ?>assets/highcharts/export-data.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini fixed">
    <div class="wrapper">

        <header class="main-header">
            <a href="<?php echo base_url() ?>backend" class="logo">
                <span class="logo-mini"><b>JD</b></span>
                <span class="logo-lg"><b>JDIH</b> Donggala</span>
            </a>

            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/dist/img/logo.png"
                                    class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $this->session->userdata('nama'); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/dist/img/logo.png"
                                        class="img-circle" alt="User Image">
                                    <p>
                                        <?php echo $this->session->userdata('nama'); ?>
                                        <small>Administrator System</small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo base_url('ubah_password') ?>"
                                            class="btn btn-default btn-flat">Ubah Password</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo base_url() ?>backend/logout"
                                            class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel" style="background:transparent; margin-bottom: 20px;">
                    <div class="pull-left image">
                        <img src="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/dist/img/logo.png" class="img-circle"
                            alt="User Image" style="border: 2px solid #ddd;">
                    </div>
                    <div class="pull-left info">
                        <p style="color:#333;"><?php echo $this->session->userdata('nama'); ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>

                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header" style="background:transparent; color:#999; font-size:11px;">MAIN MENU</li>

                    <li><a href="<?php echo base_url() ?>backend"><i class="fa fa-dashboard text-blue"></i>
                            <span>Dashboard</span></a></li>

                    <li class="treeview">
                        <a href="#"><i class="fa fa-bank text-purple"></i> <span>Pemerintahan</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url() ?>ref_visimisi/update/1">Visi dan Misi</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#"><i class="fa fa-balance-scale text-red"></i> <span>Produk Hukum</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url() ?>ref_kategori">Kategori Dokumen</a></li>
                            <li><a href="<?php echo base_url() ?>ta_produk_hukum">Data Peraturan</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#"><i class="fa fa-sticky-note-o text-orange"></i> <span>Info Hukum</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url() ?>ref_kategori_info">Kategori Info</a></li>
                            <li><a href="<?php echo base_url() ?>ta_info_hukum">Data Info Hukum</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="<?php echo base_url() ?>ref_kabag"><i class="fa fa-user-secret text-black"></i>
                            <span>Data Pejabat</span></a>
                    </li>

                    <li class="<?php echo $this->uri->segment(1) == 'ta_link_eksternal' ? 'active' : '' ?>">
                        <a href="<?php echo site_url('ta_link_eksternal'); ?>">
                            <i class="fa fa-link"></i> <span>Link Terkait</span>
                        </a>
                    </li>

                    <li class="treeview">
                        <a href="#"><i class="fa fa-image text-aqua"></i> <span>Slider</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url() ?>ta_slider">Kelola Slider</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#"><i class="fa fa-newspaper-o text-green"></i> <span>Berita</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url() ?>ref_kategori_berita">Kategori Berita</a></li>
                            <li><a href="<?php echo base_url() ?>ta_berita">Data Berita</a></li>
                        </ul>
                    </li>

                    <li><a href="<?php echo base_url() ?>Ta_link_terkait"><i class="fa fa-link text-maroon"></i>
                            <span>Jejaring / Link</span></a></li>

                    <li class="header" style="background:transparent; color:#999; font-size:11px;">SYSTEM</li>

                    <li class="treeview">
                        <a href="#"><i class="fa fa-comments-o text-teal"></i> <span>Interaksi Publik</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url() ?>atur_interaksi"><i class="fa fa-circle-o"></i> Atur
                                    Link Form</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#"><i class="fa fa-university text-yellow"></i> <span>Profil & Halaman</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url('atur_halaman/edit/dasar_hukum') ?>"><i
                                        class="fa fa-circle-o"></i> Edit Dasar Hukum</a></li>
                            <li><a href="<?php echo base_url('atur_halaman/edit/sop') ?>"><i class="fa fa-circle-o"></i>
                                    Edit SOP</a></li>
                            <li><a href="<?php echo base_url('atur_halaman/edit/struktur') ?>"><i
                                        class="fa fa-circle-o"></i> Edit Struktur Org</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#"><i class="fa fa-cogs text-gray"></i> <span>Pengaturan</span>
                            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="<?php echo base_url() ?>ref_aplikasi">Identitas Aplikasi</a></li>
                            <li><a href="<?php echo base_url() ?>manage_user">Manajemen Pengguna</a></li>
                        </ul>
                    </li>

                    <li><a href="<?php echo base_url() ?>backend/logout"><i class="fa fa-power-off text-red"></i>
                            <span>Log Out</span></a></li>
                </ul>
            </section>
        </aside>

        <div class="content-wrapper">
            <?php echo $contents; ?>
        </div>

        <footer class="main-footer glass-footer">
            <div class="row">
                <div class="col-md-6">
                    <strong>&copy; <?= date('Y'); ?> <a href="#" class="neon-link">JDIH Kab. Donggala</a>.</strong>
                    <small class="text-muted">Semua Hak Dilindungi.</small>
                </div>
                <div class="col-md-6 text-right">
                    <span class="version-box"><i class="fa fa-code-fork"></i> v2.0 Modern UI</span>
                </div>
            </div>
        </footer>

    </div>
    <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/bower_components/bootstrap/dist/js/bootstrap.min.js">
    </script>
    <script
        src="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js">
    </script>
    <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/dist/js/adminlte.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/AdminLTE-2.4.3/bower_components/select2/dist/js/select2.full.min.js">
    </script>

    <script>
    $(function() {
        // Inisialisasi Select2
        $('.select2').select2();

        // Datepicker Custom
        $('#tgl_peraturan').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            orientation: "bottom auto"
        });
    })
    </script>

    <script>
    $(document).ready(function() {
        var elem = document.getElementById("myP");
        if (elem) elem.style.display = "none";
    });

    $("#id_status_peraturan").change(function() {
        var status = $(this).val();
        if (status == '0' || status == '7') {
            if (document.getElementById("myP")) {
                document.getElementById("myP").style.display = "none";
                $("#isi-subject").empty();
                $("#subject_produk").val('');
                $("#subject_status").val('');
            }
        } else {
            if (document.getElementById("myP")) document.getElementById("myP").style.display = "";
        }
    });
    </script>
</body>

</html>