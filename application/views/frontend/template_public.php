<?php 
    // --- BAGIAN INI SANGAT PENTING (JANGAN DIHAPUS) ---
    // Logika untuk mengambil data profil aplikasi & medsos dari database
    $app = $this->db->query("SELECT * FROM ref_aplikasi LIMIT 1")->row();
    
    // Cek apakah kolom medsos ada datanya, jika tidak ada, isi dengan '#'
    // Menggunakan isset() untuk mencegah error jika kolom belum dibuat di database
    $link_fb  = (isset($app->fb) && !empty($app->fb)) ? $app->fb : '#';
    $link_ig  = (isset($app->ig) && !empty($app->ig)) ? $app->ig : '#';
    $link_tw  = (isset($app->twitter) && !empty($app->twitter)) ? $app->twitter : '#';
    $link_yt  = (isset($app->yt) && !empty($app->yt)) ? $app->yt : '#';
    
    // Data kontak default
    $alamat_app = isset($app->alamat) ? $app->alamat : 'Jalan Jati No. 1, Banawa';
    $telp_app   = isset($app->no_telpn) ? $app->no_telpn : '(0457) 712345';
    $email_app  = isset($app->email) ? $app->email : 'hukum@donggala.go.id';
?>
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        :root {
            --primary-color: #1e3a8a; /* Biru Tua Modern */
            --primary-light: #3b82f6; /* Biru Terang */
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
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* --- TOP BAR --- */
        .top-bar {
            background-color: var(--dark-bg);
            color: rgba(255,255,255,0.8);
            font-size: 0.85rem;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .top-bar a { color: rgba(255,255,255,0.8); text-decoration: none; transition: 0.3s; }
        .top-bar a:hover { color: #fff; }

        /* --- NAVBAR STYLING --- */
        .navbar-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-light) 100%);
            padding: 15px 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .brand-text { line-height: 1.2; }
        .brand-title {
            font-weight: 800;
            font-size: 1.2rem;
            display: block;
            letter-spacing: 0.5px;
            color: #fff;
        }
        .brand-subtitle {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 400;
            display: block;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: rgba(255,255,255,0.9);
            font-weight: 500;
            padding: 10px 15px;
            transition: all 0.3s;
            position: relative;
        }
        
        .navbar-dark .navbar-nav .nav-link:hover,
        .navbar-dark .navbar-nav .nav-link.active {
            color: #fff;
            transform: translateY(-2px);
        }

        .navbar-nav .nav-item .nav-link::after {
            content: ''; position: absolute; width: 0; height: 2px;
            bottom: 5px; left: 50%; background-color: #fff;
            transition: all 0.3s ease; transform: translateX(-50%);
        }
        .navbar-nav .nav-item .nav-link:hover::after { width: 80%; }

        /* --- DROPDOWN --- */
        .dropdown-menu {
            border: none; border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            padding: 10px; margin-top: 15px !important;
            background: #fff; min-width: 240px;
            opacity: 0; transform: translateY(10px);
            transition: all 0.3s ease; display: block; visibility: hidden;
        }
        .nav-item.dropdown:hover .dropdown-menu,
        .nav-item.dropdown .dropdown-menu.show {
            opacity: 1; transform: translateY(0); visibility: visible;
        }
        .dropdown-item {
            padding: 12px 15px; border-radius: 10px;
            font-weight: 500; color: #444;
            transition: all 0.2s ease; display: flex; align-items: center; gap: 12px;
        }
        .dropdown-item i {
            color: var(--primary-light); font-size: 1.1em;
            width: 20px; text-align: center; transition: transform 0.2s;
        }
        .dropdown-item:hover {
            background-color: #eff6ff; color: var(--primary-color);
            transform: translateX(5px);
        }
        .dropdown-item:hover i { transform: scale(1.2); }
        .dropdown-toggle::after { transition: transform 0.3s; }
        .nav-item.dropdown:hover .dropdown-toggle::after { transform: rotate(180deg); }

        .btn-contact-nav {
            background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.4);
            color: #fff !important; border-radius: 50px;
            padding: 8px 25px !important; transition: all 0.3s;
        }
        .btn-contact-nav:hover {
            background: #fff; color: var(--primary-color) !important;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2); transform: translateY(-2px);
        }
        .btn-contact-nav::after { display: none; }

        main { flex: 1; }

        /* --- FOOTER --- */
        .footer-modern {
            background-color: var(--dark-bg); color: #b0b8c4;
            padding-top: 60px; position: relative; overflow: hidden;
        }
        .footer-modern::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0;
            height: 4px; background: linear-gradient(90deg, var(--secondary-color), var(--primary-light));
        }
        .footer-title {
            color: #fff; font-weight: 700; margin-bottom: 25px;
            position: relative; padding-bottom: 15px; font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .footer-title::after {
            content: ''; position: absolute; bottom: 0; left: 0;
            width: 40px; height: 3px; background-color: var(--secondary-color);
        }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a {
            color: #b0b8c4; text-decoration: none; transition: 0.3s;
            display: inline-flex; align-items: center;
        }
        .footer-links a:hover {
            color: var(--secondary-color); transform: translateX(5px);
        }
        .footer-links i { margin-right: 10px; font-size: 0.8rem; }
        
        .contact-info li {
            display: flex; margin-bottom: 15px; align-items: flex-start;
        }
        .contact-icon {
            background: rgba(255,255,255,0.1); width: 35px; height: 35px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%; margin-right: 15px;
            color: var(--secondary-color); flex-shrink: 0;
        }
        
        .copyright-section {
            background-color: #0b1120; padding: 20px 0;
            margin-top: 50px; border-top: 1px solid rgba(255,255,255,0.05);
            font-size: 0.9rem;
        }

        @media (max-width: 991px) {
            .dropdown-menu {
                border: 1px solid #eee; box-shadow: none; margin-top: 0 !important;
                opacity: 1; visibility: visible; display: none; 
            }
            .dropdown-menu.show { display: block; }
            .navbar-collapse {
                background: var(--primary-color); padding: 20px;
                border-radius: 15px; margin-top: 15px;
            }
            .brand-subtitle { display: none; }
        }
    </style>
</head>
<body>

    <div class="top-bar d-none d-lg-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex gap-4">
                <span><i class="bi bi-envelope me-2"></i> <?php echo $email_app; ?></span>
                <span><i class="bi bi-telephone me-2"></i> <?php echo $telp_app; ?></span>
            </div>
            <div class="d-flex gap-3">
                <?php if($link_fb != '#'): ?> <a href="<?php echo $link_fb; ?>" target="_blank" title="Facebook"><i class="bi bi-facebook"></i></a> <?php endif; ?>
                <?php if($link_ig != '#'): ?> <a href="<?php echo $link_ig; ?>" target="_blank" title="Instagram"><i class="bi bi-instagram"></i></a> <?php endif; ?>
                <?php if($link_tw != '#'): ?> <a href="<?php echo $link_tw; ?>" target="_blank" title="Twitter"><i class="bi bi-twitter"></i></a> <?php endif; ?>
                <?php if($link_yt != '#'): ?> <a href="<?php echo $link_yt; ?>" target="_blank" title="Youtube"><i class="bi bi-youtube"></i></a> <?php endif; ?>
                
                <span class="border-start mx-2 border-secondary"></span>
                <span><?php echo date('l, d F Y'); ?></span>
            </div>
        </div>
    </div>

    <header>
        <nav class="navbar navbar-expand-lg navbar-custom navbar-dark sticky-top">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-3" href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url(); ?>template/img/logo-jdih.png" alt="Logo" width="50" height="auto" class="d-inline-block align-text-top">
                    <div class="brand-text text-start">
                        <span class="brand-title">JDIH DONGGALA</span>
                        <span class="brand-subtitle">Jaringan Dokumentasi & Informasi Hukum</span>
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
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Profil
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="<?php echo base_url() ?>frontend/visimisi">
                                        <i class="fa fa-bullseye"></i> Visi dan Misi
                                    </a>
                                </li>
                                
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarProd" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Produk Hukum
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarProd">
                                <li>
                                    <a class="dropdown-item" href="<?php echo base_url() ?>frontendprodukhukum/produk_hukum_list">
                                        <i class="fa fa-search"></i> Pencarian Lengkap
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo base_url() ?>frontendprodukhukum/produk_hukum_list?kategori=Peraturan+Daerah">
                                        <i class="fa fa-book"></i> Peraturan Daerah
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?php echo base_url() ?>frontendprodukhukum/produk_hukum_list?kategori=Peraturan+Bupati">
                                        <i class="fa fa-gavel"></i> Peraturan Bupati
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('berita'); ?>">Berita</a>
                        </li>

                        <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                            <a class="nav-link btn-contact-nav" href="<?php echo base_url('kontak'); ?>">
                                Kontak Kami
                            </a>
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
                        <a href="<?php echo $link_fb; ?>" target="_blank" class="text-white me-3 fs-5"><i class="bi bi-facebook"></i></a>
                        <a href="<?php echo $link_tw; ?>" target="_blank" class="text-white me-3 fs-5"><i class="bi bi-twitter"></i></a>
                        <a href="<?php echo $link_ig; ?>" target="_blank" class="text-white me-3 fs-5"><i class="bi bi-instagram"></i></a>
                        <a href="<?php echo $link_yt; ?>" target="_blank" class="text-white fs-5"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h5 class="footer-title">Hubungi Kami</h5>
                    <ul class="list-unstyled contact-info">
                        <li>
                            <div class="contact-icon"><i class="bi bi-geo-alt"></i></div>
                            <div>
                                <span class="d-block text-white fw-bold">Alamat</span>
                                <small><?php echo $alamat_app; ?></small>
                            </div>
                        </li>
                        <li>
                            <div class="contact-icon"><i class="bi bi-telephone"></i></div>
                            <div>
                                <span class="d-block text-white fw-bold">Telepon</span>
                                <small><?php echo $telp_app; ?></small>
                            </div>
                        </li>
                        <li>
                            <div class="contact-icon"><i class="bi bi-envelope"></i></div>
                            <div>
                                <span class="d-block text-white fw-bold">Email</span>
                                <small><?php echo $email_app; ?></small>
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
                                <li><a href="<?php echo base_url('berita'); ?>"><i class="bi bi-chevron-right"></i> Berita Terkini</a></li>
                                <li><a href="https://jdih.donggala.go.id/frontend/visimisi"><i class="bi bi-chevron-right"></i> Visi Misi</a></li>
                                <li><a href="https://jdihn.go.id" target="_blank"><i class="bi bi-box-arrow-up-right"></i> Portal JDIHN</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <h5 class="footer-title">Pengunjung</h5>
                            <div class="bg-dark p-3 rounded border border-secondary">
                                <div id="histats_counter"></div>
                                <script type="text/javascript">var _Hasync= _Hasync|| [];
                                _Hasync.push(['Histats.start', '1,5001853,4,330,112,62,00011111']);
                                _Hasync.push(['Histats.fasi', '1']);
                                _Hasync.push(['Histats.track_hits', '']);
                                (function() {
                                var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
                                hs.src = ('//s10.histats.com/js15_as.js');
                                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
                                })();</script>
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
        // Efek Navbar Shadow saat Scroll
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