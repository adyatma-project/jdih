<?php 
    // --- LOGIKA DATA DINAMIS ---
    // Mengambil data profil aplikasi & medsos dari database
    $app = $this->db->query("SELECT * FROM ref_aplikasi LIMIT 1")->row();
    
    // Fallback data jika null
    $link_fb  = (isset($app->fb) && !empty($app->fb)) ? $app->fb : '#';
    $link_ig  = (isset($app->ig) && !empty($app->ig)) ? $app->ig : '#';
    $link_tw  = (isset($app->twitter) && !empty($app->twitter)) ? $app->twitter : '#';
    $link_yt  = (isset($app->yt) && !empty($app->yt)) ? $app->yt : '#';
    
    $alamat_app = isset($app->alamat) ? $app->alamat : 'Jalan Jati No. 1, Banawa';
    $telp_app   = isset($app->no_telpn) ? $app->no_telpn : '(0457) 712345';
    $email_app  = isset($app->email) ? $app->email : 'hukum@donggala.go.id';

    $ci =& get_instance();
$ci->load->model('Ta_link_eksternal_model');
$menu_links = $ci->Ta_link_eksternal_model->get_active_links1();
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        :root {
            /* Palette Modern */
            --primary-color: #da25ebff; /* Biru Royal Gelap */
            --primary-light: #b60f9aff; /* Biru Cerah */
            --secondary-color: #f59e0b; /* Kuning Emas Elegan */
            --dark-bg: #091433ff;       /* Hitam Kebiruan (Slate) */
            --body-bg: #f8fafc;       /* Abu-abu sangat muda */
            --text-main: #1e293b;     /* Warna Teks Utama */
            --text-muted: #64748b;    /* Warna Teks Muted */
        }

        body {
            font-family: 'Inter', sans-serif; /* Font Utama */
            background-color: var(--body-bg);
            color: var(--text-main);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Terapkan Plus Jakarta Sans untuk semua Judul */
        h1, h2, h3, h4, h5, h6, .navbar-brand, .btn, .nav-link {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* --- TOP BAR --- */
        .top-bar {
            background-color: var(--dark-bg);
            color: rgba(255,255,255,0.7);
            font-size: 0.85rem;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            font-weight: 500;
        }
        .top-bar a { color: rgba(255,255,255,0.8); text-decoration: none; transition: 0.3s; }
        .top-bar a:hover { color: #fff; }

        /* --- NAVBAR STYLING --- */
        .navbar-custom {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            padding: 15px 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08); /* Shadow lebih halus */
            transition: all 0.3s ease;
        }

        .brand-text { line-height: 1.2; }
        .brand-title {
            font-weight: 800;
            font-size: 1.25rem;
            display: block;
            letter-spacing: -0.5px; /* Sedikit rapat agar modern */
            color: #fff;
        }
        .brand-subtitle {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            font-family: 'Inter', sans-serif; /* Subtitle pakai Inter agar terbaca jelas */
            display: block;
        }

        /* Navigation Links */
        .navbar-dark .navbar-nav .nav-link {
            color: rgba(255,255,255,0.9);
            font-weight: 600;
            font-size: 0.95rem;
            padding: 10px 18px;
            transition: all 0.3s;
            border-radius: 8px;
        }
        
        .navbar-dark .navbar-nav .nav-link:hover,
        .navbar-dark .navbar-nav .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,0.1); /* Efek tombol halus saat hover */
        }

        /* --- DROPDOWN MODERN --- */
        .dropdown-menu {
            border: 1px solid rgba(0,0,0,0.05);
            border-radius: 16px; /* Lebih bulat */
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            padding: 10px; 
            margin-top: 20px !important;
            background: #fff; 
            min-width: 250px;
            opacity: 0; 
            transform: translateY(15px);
            transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1); /* Easing animation */
            display: block; 
            visibility: hidden;
        }

        .nav-item.dropdown:hover .dropdown-menu,
        .nav-item.dropdown .dropdown-menu.show {
            opacity: 1; transform: translateY(0); visibility: visible;
        }

        .dropdown-item {
            padding: 12px 15px; 
            border-radius: 10px;
            font-weight: 600; 
            color: var(--text-main);
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s ease; 
            display: flex; 
            align-items: center; 
            gap: 12px;
        }

        .dropdown-item i {
            color: var(--primary-light); 
            font-size: 1.1em;
            width: 24px; text-align: center; 
            transition: transform 0.2s;
        }

        .dropdown-item:hover {
            background-color: #eff6ff; 
            color: var(--primary-color);
            transform: translateX(5px);
        }
        .dropdown-item:hover i { transform: scale(1.2); }
        
        .dropdown-toggle::after { transition: transform 0.3s; font-size: 0.8em; margin-left: 8px;}
        .nav-item.dropdown:hover .dropdown-toggle::after { transform: rotate(180deg); }

        /* Kontak Button di Nav */
        .btn-contact-nav {
            background: rgba(255,255,255,0.1); 
            border: 1px solid rgba(255,255,255,0.3);
            color: #fff !important; 
            border-radius: 50px;
            padding: 8px 25px !important; 
            transition: all 0.3s;
        }
        .btn-contact-nav:hover {
            background: #fff; 
            color: var(--primary-color) !important;
            box-shadow: 0 10px 20px rgba(0,0,0,0.15); 
            transform: translateY(-2px);
        }

        main { flex: 1; }

        /* --- FOOTER --- */
        .footer-modern {
            background-color: var(--dark-bg); 
            color: #94a3b8; /* Slate 400 */
            padding-top: 70px; 
            position: relative; 
            font-family: 'Inter', sans-serif;
        }
        .footer-title {
            color: #fff; 
            font-weight: 700; 
            font-size: 1.1rem;
            margin-bottom: 25px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            letter-spacing: -0.5px;
        }
        .footer-links li { margin-bottom: 14px; }
        .footer-links a {
            color: #cbd5e1; /* Slate 300 */
            text-decoration: none; 
            transition: 0.3s;
            display: inline-flex; align-items: center;
            font-size: 0.95rem;
        }
        .footer-links a:hover {
            color: var(--secondary-color); 
            transform: translateX(8px);
        }
        .footer-links i { margin-right: 10px; font-size: 0.8rem; color: rgba(255,255,255,0.3); }
        
        .contact-info li {
            display: flex; margin-bottom: 20px; align-items: flex-start;
        }
        .contact-icon {
            background: rgba(255,255,255,0.05); 
            width: 40px; height: 40px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 12px; margin-right: 15px;
            color: var(--secondary-color); flex-shrink: 0;
            font-size: 1.1rem;
        }
        
        .copyright-section {
            background-color: #020617; /* Very dark slate */
            padding: 25px 0;
            margin-top: 60px; 
            border-top: 1px solid rgba(255,255,255,0.05);
            font-size: 0.9rem;
        }

        @media (max-width: 991px) {
            .dropdown-menu {
                border: 1px solid #eee; box-shadow: none; margin-top: 0 !important;
                opacity: 1; visibility: visible; display: none; 
            }
            .dropdown-menu.show { display: block; }
            .navbar-collapse {
                background: #1e3a8a; padding: 20px;
                border-radius: 15px; margin-top: 15px;
            }
            .brand-subtitle { display: none; }
        }

        /* Styling Dropdown Menu Link Terkait */
    .bg-blue-soft {leng
        background-color: #eff6ff !important;
        color: #2563eb !important;
    }
    
    .dropdown-item {
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
    }
    
    .dropdown-item:hover {
        background-color: #f8fafc;
        border-left-color: #2563eb; /* Garis biru di kiri saat hover */
        color: #1e40af;
    }
    
    /* Agar dropdown tidak tertutup navbar di tampilan mobile */
    @media (max-width: 991px) {
        .dropdown-menu {
            border: 1px solid #f1f5f9 !important;
            box-shadow: none !important;
            margin-top: 10px;
        }
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
                
                <span class="border-start mx-3 border-secondary opacity-25"></span>
                <span style="font-family: 'Plus Jakarta Sans', sans-serif;"><?php echo date('l, d F Y'); ?></span>
            </div>
        </div>
    </div>

    <header>
        <nav class="navbar navbar-expand-lg navbar-custom navbar-dark sticky-top">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-3" href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url(); ?>template/img/logo-jdih.png" alt="Logo" width="50" height="auto" class="d-inline-block align-text-top" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));">
                    <div class="brand-text text-start">
                        <span class="brand-title">JDIH KABUPATEN DONGGALA</span>
                        <span class="brand-subtitle">Jaringan Dokumentasi & Informasi Hukum Kabupaten Donggala</span>
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
    <a class="nav-link dropdown-toggle" href="#" id="navbarDasarHukum" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Profil
    </a>
    <ul class="dropdown-menu shadow-lg border-0 rounded-4 p-2" aria-labelledby="navbarDasarHukum">
        
     <li>
            <a class="dropdown-item rounded-3 py-2" href="<?php echo base_url('frontend/dasar_hukum/dasar_hukum'); ?>">
                <i class="bi bi-diagram-3 text-success me-2"></i> Dasar Hukum
            </a>
        </li>
    <li>
            <a class="dropdown-item rounded-3 py-2" href="<?php echo base_url('frontend/dasar_hukum/sop'); ?>">
                <i class="bi bi-file-earmark-text text-primary me-2"></i> SOP
            </a>
        </li>
        <li>
            <a class="dropdown-item rounded-3 py-2" href="<?php echo base_url('frontend/dasar_hukum/struktur'); ?>">
                <i class="bi bi-diagram-3 text-success me-2"></i> Struktur Organisasi
            </a>
        </li>

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

 <a class="dropdown-item" href="https://jdih.donggala.go.id/frontendprodukhukum/produk_hukum_list?q=&no_peraturan=&tahun=&ref_kategori=2&ref_status_peraturan=">
                                        <i class="fa fa-search"></i> Peraturan Daerah
                                    </a>
                                    <a class="dropdown-item" href="https://jdih.donggala.go.id/frontendprodukhukum/produk_hukum_list?q=&no_peraturan=&tahun=&ref_kategori=3&ref_status_peraturan=">
                                        <i class="fa fa-search"></i> Peraturan Bupati
                                    </a>
                                    <a class="dropdown-item" href="https://jdih.donggala.go.id/frontendprodukhukum/produk_hukum_list?q=&no_peraturan=&tahun=&ref_kategori=5&ref_status_peraturan=">
                                        <i class="fa fa-search"></i> Keputusan Bupati
                                    </a>
                                    <a class="dropdown-item" href="https://jdih.donggala.go.id/frontendprodukhukum/produk_hukum_list?q=&no_peraturan=&tahun=&ref_kategori=12&ref_status_peraturan=">
                                        <i class="fa fa-search"></i> Monografi Hukum
                                    </a>
                                    <a class="dropdown-item" href="https://jdih.donggala.go.id/frontendprodukhukum/produk_hukum_list?q=&no_peraturan=&tahun=&ref_kategori=13&ref_status_peraturan=">
                                        <i class="fa fa-search"></i> Artikel Hukum
                                    </a>
                                    <a class="dropdown-item" href="https://jdih.donggala.go.id/frontendprodukhukum/produk_hukum_list?q=&no_peraturan=&tahun=&ref_kategori=14&ref_status_peraturan=">
                                        <i class="fa fa-search"></i> Putusan Pengadilan / Yurisprudensi
                                    </a>
                                


                                    <a class="dropdown-item" href="<?php echo base_url() ?>frontendprodukhukum/produk_hukum_list">
                                        <i class="fa fa-search"></i> Pencarian Lengkap
                                    </a>
                                </li>
                                
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('berita'); ?>">Berita</a>
                        </li>

                        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarInteraksi" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Interaksi
    </a>
    <ul class="dropdown-menu shadow-lg border-0 rounded-4 p-2" aria-labelledby="navbarInteraksi">
        <li>
            <a class="dropdown-item rounded-3 py-2" href="<?php echo base_url('frontend/interaksi/pengaduan'); ?>">
                <i class="bi bi-chat-text-fill text-danger me-2"></i> Pengaduan Hukum
            </a>
        </li>
        <li>
            <a class="dropdown-item rounded-3 py-2" href="<?php echo base_url('frontend/interaksi/survei'); ?>">
                <i class="bi bi-clipboard-data-fill text-success me-2"></i> Survei Kepuasan
            </a>
        </li>
    </ul>
</li>


                        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle fw-bold" href="#" id="navbarDropdownLinks" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Link Terkait
    </a>
    <ul class="dropdown-menu border-0 shadow-lg rounded-4 overflow-hidden p-0" aria-labelledby="navbarDropdownLinks">
        
        <?php if(!empty($menu_links)): ?>
            <?php foreach($menu_links as $link): ?>
                <li>
                    <a class="dropdown-item py-2 px-3 d-flex align-items-center" href="<?php echo $link->url; ?>" target="_blank">
                        <div class="bg-blue-soft text-primary rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 24px; height: 24px; font-size: 12px;">
                            <i class="bi bi-link-45deg"></i>
                        </div>
                        <span style="font-size: 0.9rem;"><?php echo $link->nama_link; ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li><span class="dropdown-item text-muted small">Belum ada link.</span></li>
        <?php endif; ?>
    </ul>
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
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-4">
                        <img src="<?php echo base_url(); ?>template/img/logo-jdih.png" alt="Logo" width="45" style="filter: brightness(0) invert(1);">
                        <h5 class="text-white m-0 fw-bold" style="font-family: 'Plus Jakarta Sans', sans-serif;">JDIH DONGGALA</h5>
                    </div>
                    <p class="small" style="line-height: 1.8; color: #94a3b8;">
                        Jaringan Dokumentasi dan Informasi Hukum Kabupaten Donggala adalah wadah pendayagunaan bersama atas dokumen hukum secara tertib, terpadu, dan berkesinambungan.
                    </p>
                    <div class="mt-4 d-flex gap-3">
                        <a href="<?php echo $link_fb; ?>" target="_blank" class="text-white fs-5 opacity-75 hover-100"><i class="bi bi-facebook"></i></a>
                        <a href="<?php echo $link_tw; ?>" target="_blank" class="text-white fs-5 opacity-75 hover-100"><i class="bi bi-twitter"></i></a>
                        <a href="<?php echo $link_ig; ?>" target="_blank" class="text-white fs-5 opacity-75 hover-100"><i class="bi bi-instagram"></i></a>
                        <a href="<?php echo $link_yt; ?>" target="_blank" class="text-white fs-5 opacity-75 hover-100"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h5 class="footer-title">Hubungi Kami</h5>
                    <ul class="list-unstyled contact-info">
                        <li>
                            <div class="contact-icon"><i class="bi bi-geo-alt"></i></div>
                            <div>
                                <span class="d-block text-white fw-bold" style="font-family: 'Plus Jakarta Sans'; font-size:0.9rem;">Alamat</span>
                                <small><?php echo $alamat_app; ?></small>
                            </div>
                        </li>
                        <li>
                            <div class="contact-icon"><i class="bi bi-telephone"></i></div>
                            <div>
                                <span class="d-block text-white fw-bold" style="font-family: 'Plus Jakarta Sans'; font-size:0.9rem;">Telepon</span>
                                <small><?php echo $telp_app; ?></small>
                            </div>
                        </li>
                        <li>
                            <div class="contact-icon"><i class="bi bi-envelope"></i></div>
                            <div>
                                <span class="d-block text-white fw-bold" style="font-family: 'Plus Jakarta Sans'; font-size:0.9rem;">Email</span>
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
                            <h5 class="footer-title">Statistik</h5>
                            <div class="bg-dark p-3 rounded-3 border border-secondary border-opacity-25 text-center">
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
                                <small class="text-muted d-block mt-2" style="font-size: 0.7rem; font-family: 'Plus Jakarta Sans';">Live Traffic</small>
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
                        &copy; <?php echo date('Y'); ?> <strong>Bagian Hukum Sekretariat Daerah Kabupaten Donggala</strong>.
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