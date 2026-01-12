<style>
    /* --- MODERN TYPOGRAPHY --- */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap');

    :root {
        --primary: #2563eb;       
        --primary-dark: #1e40af;
        --secondary: #3b82f6;
        --accent: #0ea5e9;        
        --bg-body: #f8fafc;       
        --text-main: #0f172a;     
        --text-muted: #64748b;    
        --radius-xl: 24px;
        --radius-lg: 16px;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: var(--bg-body);
        color: var(--text-main);
        overflow-x: hidden;
    }

    h1, h2, h3, h4, h5, h6, .btn {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* --- BACKGROUND DECORATION --- */
    .bg-blob {
        position: absolute;
        filter: blur(80px);
        opacity: 0.6;
        z-index: -1;
    }
    .blob-1 {
        top: 20%; left: -10%;
        width: 500px; height: 500px;
        background: #dbeafe;
        border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
        animation: floatBlob 10s infinite alternate;
    }
    .blob-2 {
        bottom: 10%; right: -5%;
        width: 400px; height: 400px;
        background: #e0f2fe;
        border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
        animation: floatBlob 12s infinite alternate-reverse;
    }

    @keyframes floatBlob {
        0% { transform: translate(0, 0) rotate(0deg); }
        100% { transform: translate(20px, 40px) rotate(10deg); }
    }

    /* --- HERO SLIDER --- */
    .hero-wrapper {
        position: relative;
        padding: 20px;
        background: #fff;
    }

    .slider-container {
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 20px 40px -10px rgba(37, 99, 235, 0.15);
        position: relative;
    }

    .carousel-item {
        height: 550px;
        background-position: center;
        background-size: cover;
        transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
    }

    /* --- SEARCH SECTION --- */
    .search-section {
        margin-top: -60px;
        position: relative;
        z-index: 10;
        padding: 0 20px;
    }

    .search-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 30px;
        padding: 40px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        text-align: center;
    }

    /* .brand-title {
        font-weight: 800;
        font-size: 2rem;
        background: linear-gradient(135deg, var(--primary), var(--accent));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
        letter-spacing: -0.5px;
    } */

    .form-control-modern {
        background: #f1f5f9;
        border: 2px solid transparent;
        border-radius: 15px;
        padding: 15px 20px;
        font-size: 1rem;
        font-weight: 500;
        color: var(--text-main);
        transition: all 0.3s ease;
    }

    .form-control-modern:focus {
        background: #fff;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
    }

    .btn-search-modern {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        border: none;
        border-radius: 15px;
        padding: 15px 30px;
        font-weight: 700;
        width: 100%;
        transition: all 0.3s;
        box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.4);
    }

    .btn-search-modern:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 15px 25px -5px rgba(37, 99, 235, 0.5);
        color: white;
    }

    /* --- STATS SECTION (NEW) --- */
    .stats-card {
        background: #fff;
        border-radius: 20px;
        padding: 25px;
        display: flex;
        align-items: center;
        gap: 20px;
        transition: all 0.3s ease;
        border: 1px solid #f1f5f9;
        box-shadow: 0 10px 20px -5px rgba(0,0,0,0.03);
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px -10px rgba(0,0,0,0.08);
        border-color: var(--primary);
    }

    .stats-icon-box {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        flex-shrink: 0;
    }

    .bg-blue-soft { background: #eff6ff; color: #2563eb; }
    .bg-green-soft { background: #f0fdf4; color: #16a34a; }
    .bg-purple-soft { background: #faf5ff; color: #9333ea; }
    .bg-orange-soft { background: #fff7ed; color: #ea580c; }

    .stats-info h3 {
        font-size: 1.8rem;
        font-weight: 800;
        margin: 0;
        color: var(--text-main);
        line-height: 1;
        margin-bottom: 5px;
    }

    .stats-info p {
        margin: 0;
        color: var(--text-muted);
        font-size: 0.9rem;
        font-weight: 600;
    }

    /* --- CONTENT CARDS --- */
    .section-label {
        display: inline-block;
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--accent);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
        background: rgba(14, 165, 233, 0.1);
        padding: 5px 15px;
        border-radius: 20px;
    }

    .law-item {
        background: #fff;
        border-radius: var(--radius-lg);
        padding: 25px;
        margin-bottom: 20px;
        border: 1px solid #f1f5f9;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }

    .law-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.05);
        border-color: var(--primary);
    }

    .law-item::after {
        content: '';
        position: absolute;
        left: 0; top: 20%; bottom: 20%;
        width: 4px;
        background: var(--bg-body);
        border-radius: 0 4px 4px 0;
        transition: all 0.3s;
    }

    .law-item:hover::after {
        background: var(--primary);
        top: 15%; bottom: 15%;
    }

    .law-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--text-main);
        text-decoration: none;
        line-height: 1.5;
        display: block;
        margin-bottom: 10px;
    }

    .law-title:hover {
        color: var(--primary);
    }

    /* --- NEWS CARDS --- */
    .news-card-modern {
        background: #fff;
        border-radius: var(--radius-xl);
        overflow: hidden;
        border: none;
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.03);
        height: 100%;
        transition: all 0.4s ease;
    }

    .news-card-modern:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.1);
    }

    .news-img-container {
        height: 220px;
        overflow: hidden;
        position: relative;
    }

    .news-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s;
    }

    .news-card-modern:hover .news-img-container img {
        transform: scale(1.08);
    }

    .news-date-badge {
        position: absolute;
        top: 15px; left: 15px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(4px);
        padding: 6px 14px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--text-main);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    /* --- SIDEBAR WIDGETS --- */
    .widget-island {
        background: #fff;
        border-radius: var(--radius-xl);
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.03);
        text-align: center;
        border: 1px solid #f1f5f9;
        position: relative;
        overflow: hidden;
    }

    .profile-blob-container {
        width: 130px;
        height: 130px;
        margin: 0 auto 20px;
        position: relative;
    }

    .profile-blob-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 45% 55% 70% 30% / 30% 30% 70% 70%;
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.2);
        border: 4px solid #fff;
        transition: border-radius 0.5s ease;
    }
    
    .widget-island:hover .profile-blob-img {
        border-radius: 50%;
    }

    .btn-profile {
        background: transparent;
        color: var(--primary);
        border: 2px solid var(--primary);
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-profile:hover {
        background: var(--primary);
        color: #fff;
        box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.3);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .carousel-item { height: 350px; }
        .search-card { padding: 25px; border-radius: 20px; }
        .brand-title { font-size: 1.5rem; }
    }

    .related-links-section {
        background: #fff;
        padding: 50px 0;
        border-top: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
        overflow: hidden;
    }

    .section-title-center {
        text-align: center;
        margin-bottom: 40px;
    }

    .section-title-center h3 {
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 10px;
    }

    .section-title-center p {
        color: var(--text-muted);
        max-width: 600px;
        margin: 0 auto;
    }

    /* Infinite Scroll Animation */
    .marquee-container {
        display: flex;
        width: 100%;
        overflow: hidden;
        mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
        -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);
    }

    .marquee-content {
        display: flex;
        gap: 50px;
        animation: scroll 30s linear infinite;
        width: max-content;
        padding: 10px 0;
    }
    
    .marquee-content:hover {
        animation-play-state: paused; /* Berhenti saat di-hover */
    }

    @keyframes scroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); } /* Geser setengah karena konten diduplikasi */
    }

    .link-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        width: 150px;
        transition: transform 0.3s;
    }

    .link-item:hover {
        transform: translateY(-5px);
    }

    .link-logo-box {
        width: 100px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        border-radius: 50%;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        border: 1px solid #f1f5f9;
        margin-bottom: 15px;
        padding: 15px;
        transition: all 0.3s;
    }

    .link-item:hover .link-logo-box {
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.15);
        border-color: var(--primary);
    }

    .link-logo-box img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        filter: grayscale(100%); /* Hitam putih agar rapi */
        opacity: 0.7;
        transition: all 0.3s;
    }

    .link-item:hover .link-logo-box img {
        filter: grayscale(0%); /* Berwarna saat hover */
        opacity: 1;
    }

    .link-name {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--text-muted);
        text-align: center;
        line-height: 1.2;
        transition: color 0.3s;
    }

    .link-item:hover .link-name {
        color: var(--primary);
    }
</style>

<div class="bg-blob blob-1"></div>
<div class="bg-blob blob-2"></div>

<div class="hero-wrapper">
    <div class="container-fluid p-0">
        <div class="container slider-container p-0">
            <?php if(!empty($sliders)): ?>
            <div id="modernCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000">
                <div class="carousel-indicators">
                    <?php foreach($sliders as $key => $slide): ?>
                        <button type="button" data-bs-target="#modernCarousel" data-bs-slide-to="<?= $key ?>" class="<?= ($key==0) ? 'active' : '' ?>" aria-current="true"></button>
                    <?php endforeach; ?>
                </div>
                <div class="carousel-inner">
                    <?php foreach($sliders as $key => $slide): ?>
                        <div class="carousel-item <?= ($key==0) ? 'active' : '' ?>" style="background-image: url('<?= base_url('uploads/slider/'.$slide->foto) ?>');"></div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#modernCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#modernCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
            <?php else: ?>
                <div class="carousel-item active" style="background-color: var(--primary); height: 400px; display:flex; align-items:center; justify-content:center;">
                    <h3 class="text-white">JDIH Kabupaten Donggala</h3>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="container search-section">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11">
            <div class="search-card">
                <div class="mb-4">
                    <h5 class="text-uppercase text-muted fw-bold ls-1" style="letter-spacing: 2px; font-size: 0.85rem;">Selamat Datang di</h5>
                    <h1 class="brand-title">JDIH KABUPATEN DONGGALA</h1>
                    <p class="text-muted mb-0">Portal Integrasi Data Peraturan Perundang-undangan Daerah</p>
                </div>

                <form action="<?php echo site_url('frontendprodukhukum/produk_hukum_list'); ?>" method="get">
                    <div class="row g-3">
                        <div class="col-lg-5">
                            <input type="text" class="form-control form-control-modern" placeholder="Kata kunci (misal: Pajak, Retribusi)" name="tentang">
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <input type="text" class="form-control form-control-modern" placeholder="Nomor" name="no_peraturan">
                        </div>
                        <div class="col-lg-2 col-md-4">
                            <input type="text" class="form-control form-control-modern" placeholder="Tahun" name="tahun">
                        </div>
                        <div class="col-lg-3 col-md-4">
                            <button class="btn-search-modern" type="submit">
                                <i class="bi bi-search me-2"></i> Cari Dokumen
                            </button>
                        </div>
                        <input type="hidden" name="ref_status_peraturan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row g-4">
        <div class="col-lg-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon-box bg-blue-soft">
                    <i class="bi bi-file-earmark-text-fill"></i>
                </div>
                <div class="stats-info">
                    <h3><?php echo number_format($stats['peraturan']); ?></h3>
                    <p>Peraturan</p>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon-box bg-green-soft">
                    <i class="bi bi-book-half"></i>
                </div>
                <div class="stats-info">
                    <h3><?php echo number_format($stats['monografi']); ?></h3>
                    <p>Monografi</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon-box bg-purple-soft">
                    <i class="bi bi-newspaper"></i>
                </div>
                <div class="stats-info">
                    <h3><?php echo number_format($stats['artikel']); ?></h3>
                    <p>Artikel Hukum</p>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="stats-card">
                <div class="stats-icon-box bg-orange-soft">
                    <i class="bi bi-hammer"></i>
                </div>
                <div class="stats-info">
                    <h3><?php echo number_format($stats['putusan']); ?></h3>
                    <p>Putusan</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="related-links-section mt-5">
    <div class="container">
        <div class="section-title-center">
            <span class="section-label">Jejaring</span>
            <h3>JDIH Se-Sulawesi Tengah</h3>
            <p>Terintegrasi dengan jaringan dokumentasi hukum Kabupaten/Kota lainnya.</p>
        </div>

        <?php if(!empty($links)): ?>
        <div class="marquee-container">
            <div class="marquee-content">
                <?php 
                // Loop 1 (Asli)
                foreach($links as $link): ?>
                    <a href="<?php echo $link->url; ?>" target="_blank" class="link-item" title="<?php echo $link->nama_link; ?>">
                        <div class="link-logo-box">
                            <?php if(!empty($link->logo)): ?>
                                <img src="<?php echo base_url('uploads/links/'.$link->logo); ?>" alt="<?php echo $link->nama_link; ?>">
                            <?php else: ?>
                                <i class="bi bi-link-45deg fs-1 text-muted"></i>
                            <?php endif; ?>
                        </div>
                        <span class="link-name"><?php echo $link->nama_link; ?></span>
                    </a>
                <?php endforeach; ?>

                <?php 
                // Loop 2 (Duplikat untuk efek sambung menyambung)
                foreach($links as $link): ?>
                    <a href="<?php echo $link->url; ?>" target="_blank" class="link-item" title="<?php echo $link->nama_link; ?>">
                        <div class="link-logo-box">
                            <?php if(!empty($link->logo)): ?>
                                <img src="<?php echo base_url('uploads/links/'.$link->logo); ?>" alt="<?php echo $link->nama_link; ?>">
                            <?php else: ?>
                                <i class="bi bi-link-45deg fs-1 text-muted"></i>
                            <?php endif; ?>
                        </div>
                        <span class="link-name"><?php echo $link->nama_link; ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php else: ?>
            <div class="text-center text-muted py-4">
                <small>Belum ada data link terkait.</small>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="container py-5" style="margin-bottom: 50px;">
    <div class="row g-5">
        
        <div class="col-lg-8">
            
            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <span class="section-label">Update Terbaru</span>
                        <h3 class="fw-bold mb-0">Produk Hukum Daerah</h3>
                    </div>
                    <a href="<?php echo base_url('frontendprodukhukum/produk_hukum_list') ?>" class="btn btn-outline-primary rounded-pill px-4 fw-bold">Lihat Semua</a>
                </div>

                <div class="vstack gap-3">
                    <?php foreach($ta_produk_hukum_data as $value) { ?>
                        <div class="law-item">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-light text-primary fw-bold px-3 py-2 rounded-pill">
                                    <i class="bi bi-bookmark-fill me-1"></i> <?php echo $value->kategori; ?>
                                </span>
                                <small class="text-muted fw-bold">
                                    <i class="bi bi-clock me-1"></i> <?php echo tanggal($value->tgl_peraturan); ?>
                                </small>
                            </div>
                            <a href="<?php echo base_url()?>frontendprodukhukum/produk_hukum_page/<?php echo $value->id_produk_hukum ?>" class="law-title">
                                Nomor <?php echo $value->no_peraturan; ?> Tahun <?php echo $value->tahun; ?> tentang <?php echo $value->tentang; ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>

          <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <span class="section-label" style="color: var(--primary);">Informasi</span>
                        <h3 class="fw-bold mb-0" style="font-weight: 800; color:var(--text-main);">Kabar Berita</h3>
                    </div>
                    <a href="<?php echo base_url('berita') ?>" class="btn btn-outline-dark btn-sm rounded-pill px-4 fw-bold">Arsip Berita</a>
                </div>

                <div class="row">
                    <?php if(!empty($ta_berita)): foreach($ta_berita as $value) { 
                        // LOGIKA GAMBAR (Smart Auto-Check)
                        $img_src = '';
                        if(!empty($value->file)) {
                            if(file_exists(FCPATH . 'uploads/berita_konten/' . $value->file)){
                                $img_src = base_url('uploads/berita_konten/' . $value->file);
                            } elseif(file_exists(FCPATH . 'uploads/berita/' . $value->file)){
                                $img_src = base_url('uploads/berita/' . $value->file);
                            }
                        }
                    ?>
                        <div class="col-md-6 mb-4">
                            <div class="news-card-modern">
                                <div class="news-img-container">
                                    <?php if($img_src): ?>
                                        <img src="<?php echo $img_src; ?>" alt="Berita">
                                    <?php else: ?>
                                        <div class="d-flex align-items-center justify-content-center bg-light w-100 h-100 text-muted">
                                            <i class="fa fa-image fa-3x"></i>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="news-date-badge">
                                        <i class="fa fa-calendar-o"></i> 
                                        <?php echo date('d M Y', strtotime($value->tgl_insert)); ?>
                                    </div>
                                </div>
                                <div class="p-4 d-flex flex-column flex-grow-1">
                                    <h5 class="fw-bold mb-2 lh-base" style="font-size: 1.1rem;">
                                        <a href="<?php echo base_url('berita/detail/'.$value->id_berita); ?>" class="text-decoration-none text-dark stretched-link">
                                            <?php echo substr($value->judul, 0, 60) . '...'; ?>
                                        </a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    <?php } else: ?>
                        <div class="col-12"><div class="alert alert-info">Belum ada berita terbaru.</div></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            
            <div class="widget-island">
                <h6 class="text-uppercase text-muted fw-bold mb-4 ls-1">
                    <?php echo isset($kabag->jabatan) ? $kabag->jabatan : 'Kepala Bagian Hukum'; ?>
                </h6>
                
                <div class="profile-blob-container">
                    <?php if(isset($kabag->foto) && !empty($kabag->foto) && file_exists(FCPATH . 'uploads/pejabat/' . $kabag->foto)): ?>
                        <img src="<?php echo base_url('uploads/pejabat/'.$kabag->foto); ?>" alt="Foto Pejabat" class="profile-blob-img">
                    <?php else: ?>
                        <img src="<?php echo base_url(); ?>template/img/kabag.jpg" onerror="this.src='https://placehold.co/150x150/e2e8f0/1e293b?text=Foto+Kabag'" alt="Default Pejabat" class="profile-blob-img">
                    <?php endif; ?>
                </div>
                
                <h4 class="fw-bold text-dark mb-1">
                    <?php echo isset($kabag->nama) ? $kabag->nama : '-'; ?>
                </h4>
                <p class="text-muted small mb-4">
                    <?php echo isset($kabag->nip) && !empty($kabag->nip) ? 'NIP. '.$kabag->nip : 'Sekretariat Daerah Kab. Donggala'; ?>
                </p>
               
            </div>

            <div class="widget-island p-4 text-start border-0" style="background: linear-gradient(135deg, var(--primary), var(--accent)); color:white;">
                <div class="position-relative" style="z-index: 2;">
                    <i class="bi bi-globe2 fs-1 text-white-50 mb-3 d-block"></i>
                    <h4 class="fw-bold mb-2">JDIH NASIONAL</h4>
                    <p class="small opacity-75 mb-4">Terintegrasi dengan Jaringan Dokumentasi dan Informasi Hukum Nasional.</p>
                    <a href="https://jdihn.go.id" target="_blank" class="btn btn-light text-primary fw-bold rounded-pill w-100 shadow-sm border-0">
                        Kunjungi Portal <i class="bi bi-box-arrow-up-right ms-1"></i>
                    </a>
                </div>
                <div style="position: absolute; top: -30px; right: -30px; width: 150px; height: 150px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
            </div>

            <div class="widget-island p-0 border-0 shadow-sm">
                <div class="p-3 bg-white text-start border-bottom">
                    <small class="fw-bold d-block text-dark"><i class="bi bi-geo-alt-fill text-danger me-2"></i>Lokasi Kantor</small>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.5384300858527!2d119.74998847496477!3d-0.6786681993147113!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d8bb84fdde0d2cb%3A0xbc10bdf2c28577c3!2sDonggala%20Regent%20Office!5e0!3m2!1sen!2sid!4v1768146808224!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

        </div>
    </div>
</div>