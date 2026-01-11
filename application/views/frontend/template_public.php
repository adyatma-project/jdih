<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="description" content="JDIH Kabupaten Donggala - Jaringan Dokumentasi dan Informasi Hukum" />
    <meta name="author" content="Bagian Hukum Donggala" />
    
    <title>JDIH - Kabupaten DONGGALA</title>

    <link rel="shortcut icon" href="<?php echo base_url(); ?>template/ico/favicon.png" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-color: #0d6efd;
            --primary-dark: #0043a8;
            --secondary-color: #fca311; /* Aksen Kuning Emas */
            --dark-bg: #0f172a;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        h1, h2, h3, h4, h5, h6, .navbar-brand {
            font-family: 'Poppins', sans-serif;
        }

        /* --- TOP BAR --- */
        .top-bar {
            background-color: var(--primary-dark);
            color: rgba(255,255,255,0.8);
            font-size: 0.85rem;
            padding: 8px 0;
        }
        .top-bar a { color: rgba(255,255,255,0.8); text-decoration: none; transition: 0.3s; }
        .top-bar a:hover { color: #fff; }

        /* --- NAVBAR --- */
        .navbar-custom {
            background: linear-gradient(90deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 15px 0;
        }
        .navbar-brand img {
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }
        .brand-text {
            line-height: 1.2;
            color: white;
        }
        .brand-title { font-weight: 700; font-size: 1.2rem; display: block; }
        .brand-subtitle { font-weight: 400; font-size: 0.8rem; letter-spacing: 1px; opacity: 0.9; }
        
        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            padding: 0 15px !important;
            position: relative;
            transition: all 0.3s;
        }
        .nav-link:hover, .nav-link.active {
            color: #fff !important;
            transform: translateY(-2px);
        }
        /* Efek garis bawah saat hover */
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 50%;
            background-color: var(--secondary-color);
            transition: all 0.3s ease-in-out;
            transform: translateX(-50%);
        }
        .nav-link:hover::after { width: 80%; }
        
        .dropdown-menu {
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            margin-top: 15px;
        }
        .dropdown-item { padding: 10px 20px; transition: 0.2s; }
        .dropdown-item:hover { background-color: var(--primary-color); color: white; }

        /* --- MAIN CONTENT --- */
        main { flex: 1; }

        /* --- FOOTER MODERN --- */
        .footer-modern {
            background-color: var(--dark-bg);
            color: #b0b8c4;
            padding-top: 60px;
            position: relative;
            overflow: hidden;
        }
        /* Garis aksen di atas footer */
        .footer-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--secondary-color), var(--primary-color));
        }
        .footer-title {
            color: #fff;
            font-weight: 700;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 15px;
        }
        .footer-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background-color: var(--secondary-color);
        }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a {
            color: #b0b8c4;
            text-decoration: none;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
        }
        .footer-links a:hover {
            color: var(--secondary-color);
            transform: translateX(5px);
        }
        .footer-links i { margin-right: 10px; font-size: 0.8rem; }
        
        .contact-info li {
            display: flex;
            margin-bottom: 15px;
            align-items: flex-start;
        }
        .contact-icon {
            background: rgba(255,255,255,0.1);
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-right: 15px;
            color: var(--secondary-color);
            flex-shrink: 0;
        }
        
        .copyright-section {
            background-color: #0b1120;
            padding: 20px 0;
            margin-top: 50px;
            border-top: 1px solid rgba(255,255,255,0.05);
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <div class="top-bar d-none d-lg-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex gap-4">
                <span><i class="bi bi-envelope me-2"></i> bagianhukum@donggala.go.id</span>
                <span><i class="bi bi-telephone me-2"></i> (0457) 712345</span>
            </div>
            <div class="d-flex gap-3">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-youtube"></i></a>
                <span class="border-start mx-2 border-secondary"></span>
                <span><?php echo date('l, d F Y'); ?></span>
            </div>
        </div>
    </div>

    <header>
        <nav class="navbar navbar-expand-lg navbar-custom navbar-dark sticky-top">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-3" href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url(); ?>template/img/logo-jdih.png" alt="Logo" width="55" height="auto">
                    <div class="brand-text text-start">
                        <span class="brand-title">JDIH KABUPATEN DONGGALA</span>
                        <span class="brand-subtitle">Jaringan Dokumentasi dan Informasi Hukum Kabupaten Donggala    </span>
                    </div>
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url(); ?>">Beranda</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                Profil
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo base_url() ?>frontend/visimisi">Visi dan Misi</a></li>
                                <li><a class="dropdown-item" href="#">Struktur Organisasi</a></li>
                                <li><a class="dropdown-item" href="#">Tupoksi</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarProd" role="button" data-bs-toggle="dropdown">
                                Produk Hukum
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo base_url() ?>frontendprodukhukum/produk_hukum_list">Pencarian Lengkap</a></li>
                                <li><a class="dropdown-item" href="#">Peraturan Daerah</a></li>
                                <li><a class="dropdown-item" href="#">Peraturan Bupati</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url() ?>frontendberita/berita_list">Berita</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light rounded-pill px-4 ms-2" href="#" style="border:1px solid rgba(255,255,255,0.5);">Kontak</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <?php echo $contents; ?>
    </main>

    <footer class="footer-modern mt-auto">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <img src="<?php echo base_url(); ?>template/img/logo-jdih.png" alt="Logo" width="40" style="filter: brightness(0) invert(1);">
                        <h5 class="text-white m-0 fw-bold">JDIH DONGGALA</h5>
                    </div>
                    <p class="small" style="line-height: 1.6;">
                        Jaringan Dokumentasi dan Informasi Hukum Kabupaten Donggala adalah wadah pendayagunaan bersama atas dokumen hukum secara tertib, terpadu, dan berkesinambungan.
                    </p>
                    <div class="mt-4">
                        <a href="#" class="text-white me-3 fs-5"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white me-3 fs-5"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white me-3 fs-5"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white fs-5"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h5 class="footer-title">Hubungi Kami</h5>
                    <?php 
                        // Mengambil data aplikasi jika database allow, kalau error pakai dummy dulu
                        $info = $this->db->query('SELECT * FROM ref_aplikasi LIMIT 1')->row(); 
                        $alamat = $info ? $info->alamat : 'Jalan Jati No. 1, Banawa';
                        $telp = $info ? $info->no_telpn : '(0457) 71xxx';
                        $email = $info ? $info->email : 'hukum@donggala.go.id';
                    ?>
                    <ul class="list-unstyled contact-info">
                        <li>
                            <div class="contact-icon"><i class="bi bi-geo-alt"></i></div>
                            <div>
                                <span class="d-block text-white fw-bold">Alamat</span>
                                <small><?php echo $alamat; ?></small>
                            </div>
                        </li>
                        <li>
                            <div class="contact-icon"><i class="bi bi-telephone"></i></div>
                            <div>
                                <span class="d-block text-white fw-bold">Telepon</span>
                                <small><?php echo $telp; ?></small>
                            </div>
                        </li>
                        <li>
                            <div class="contact-icon"><i class="bi bi-envelope"></i></div>
                            <div>
                                <span class="d-block text-white fw-bold">Email</span>
                                <small><?php echo $email; ?></small>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5 class="footer-title">Tautan Cepat</h5>
                            <ul class="list-unstyled footer-links">
                                <li><a href="https://jdih.donggala.go.id/frontendprodukhukum/produk_hukum_list"><i class="bi bi-chevron-right"></i> Produk Hukum</a></li>
                                <li><a href="https://jdih.donggala.go.id/frontendberita/berita_list"><i class="bi bi-chevron-right"></i> Berita Terkini</a></li>
                                <li><a href="https://jdih.donggala.go.id/frontend/visimisi"><i class="bi bi-chevron-right"></i> Visi Misi</a></li>
                                <li><a href="https://jdihn.go.id" target="_blank"><i class="bi bi-box-arrow-up-right"></i> Portal JDIHN</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <h5 class="footer-title">Pengunjung</h5>
                            <div class="bg-dark p-3 rounded border border-secondary">
                                <div id="histats_counter"></div>
                                <script type="text/javascript">
                                    var _Hasync= _Hasync|| [];
                                    _Hasync.push(['Histats.start', '1,5001853,4,330,112,62,00011111']);
                                    _Hasync.push(['Histats.fasi', '1']);
                                    _Hasync.push(['Histats.track_hits', '']);
                                    (function() {
                                    var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
                                    hs.src = ('//s10.histats.com/js15_as.js');
                                    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
                                    })();
                                </script>
                                <noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?5001853&101" alt="web stats" border="0"></a></noscript>
                                <small class="text-muted d-block mt-2" style="font-size: 0.7rem;">Live Traffic Monitoring</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyright-section text-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-md-start mb-2 mb-md-0">
                        &copy; <?php echo date('Y'); ?> <strong>Bagian Hukum Setda Kab. Donggala</strong>.
                    </div>
                    <div class="col-md-6 text-md-end">
                        <small class="text-muted">Developed with <i class="bi bi-heart-fill text-danger"></i> for Donggala</small>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.querySelector('.navbar-custom').classList.add('shadow-lg');
            } else {
                document.querySelector('.navbar-custom').classList.remove('shadow-lg');
            }
        });
    </script>
</body>
</html>