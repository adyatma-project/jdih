<style>
    /* Styling Spesifik Halaman Home */
    /* --- WIDGET LINK EKSTERNAL (SCROLL) --- */
    .link-scroll-wrapper {
        max-height: 400px;
        overflow-y: auto;
        padding-right: 5px;
    }
    
    /* Scrollbar Tipis */
    .link-scroll-wrapper::-webkit-scrollbar { width: 5px; }
    .link-scroll-wrapper::-webkit-scrollbar-track { background: #f1f5f9; }
    .link-scroll-wrapper::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

    .link-list-item {
        display: flex;
        align-items: center;
        padding: 15px;
        background: #fff;
        border: 1px solid #f1f5f9;
        border-radius: 12px;
        margin-bottom: 10px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .link-list-item:hover {
        transform: translateX(5px);
        border-color: #3b82f6;
        box-shadow: 0 5px 15px rgba(59, 130, 246, 0.1);
    }

    .link-icon-box {
        width: 40px;
        height: 40px;
        background: #eff6ff; /* Biru muda */
        color: #2563eb;       /* Biru tua */
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .link-list-info h6 {
        font-size: 0.95rem;
        font-weight: 700;
        margin: 0;
        color: #1e293b;
        line-height: 1.2;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .link-list-info small {
        font-size: 0.75rem;
        color: #64748b;
        display: flex;
        align-items: center;
        margin-top: 2px;
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
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 40px -10px rgba(30, 64, 175, 0.15);
        position: relative;
    }

    /* Carousel Items */
    .carousel-item {
        height: 550px;
        background-position: center top;
        background-size: cover; 
        background-repeat: no-repeat;
        transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
        width: 100%;
    }

    /* --- SEARCH SECTION --- */
    .search-section {
        margin-top: -60px;
        position: relative;
        z-index: 10;
        padding: 0 20px;
    }

    .search-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 30px;
        padding: 45px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        text-align: center;
    }

    .brand-heading {
        font-weight: 800;
        font-size: 2.5rem;
        background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
        letter-spacing: -1px;
    }

    .form-control-modern {
        background: #f8fafc;
        border: 2px solid transparent;
        border-radius: 12px;
        padding: 15px 20px;
        font-size: 1rem;
        font-weight: 500;
        color: #1e293b;
        transition: all 0.3s ease;
    }

    .form-control-modern:focus {
        background: #fff;
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        outline: none;
    }

    .btn-search-modern {
        background: linear-gradient(135deg, #1e40af, #3b82f6);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 15px 30px;
        font-weight: 700;
        width: 100%;
        transition: all 0.3s;
        box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.4);
    }

    .btn-search-modern:hover {
        transform: translateY(-3px) scale(1.01);
        box-shadow: 0 15px 25px -5px rgba(37, 99, 235, 0.5);
        color: white;
    }

    /* --- STATS SECTION --- */
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
        border-color: #3b82f6;
    }

    .stats-icon-box {
        width: 60px;
        height: 60px;
        border-radius: 16px;
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
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 1.8rem;
        font-weight: 800;
        margin: 0;
        color: #0f172a;
        line-height: 1;
        margin-bottom: 5px;
    }

    .stats-info p {
        margin: 0;
        color: #64748b;
        font-size: 0.9rem;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
    }

    /* --- CHART SECTION (BARU) --- */
    .chart-card {
        background: #fff;
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 15px 35px -10px rgba(0,0,0,0.05);
        border: 1px solid #f1f5f9;
        position: relative;
    }
    .chart-container {
        position: relative;
        height: 350px;
        width: 100%;
    }

    /* --- CONTENT CARDS --- */
    .section-label {
        display: inline-block;
        font-size: 0.75rem;
        font-weight: 800;
        color: #0ea5e9;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
        background: rgba(14, 165, 233, 0.1);
        padding: 5px 15px;
        border-radius: 20px;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .law-item {
        background: #fff;
        border-radius: 16px;
        padding: 20px 25px;
        margin-bottom: 15px;
        border: 1px solid #f1f5f9;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
        display: block; 
        text-decoration: none;
    }

    .law-item:hover {
        transform: translateX(5px);
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
        border-color: #3b82f6;
    }

    .law-item::after {
        content: '';
        position: absolute;
        left: 0; top: 20%; bottom: 20%;
        width: 4px;
        background: #f1f5f9;
        border-radius: 0 4px 4px 0;
        transition: all 0.3s;
    }

    .law-item:hover::after {
        background: #3b82f6;
        top: 10%; bottom: 10%;
    }

    .law-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.5;
        display: block;
        margin-top: 5px;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .law-item:hover .law-title { color: #1d4ed8; }

    /* --- NEWS CARDS --- */
    .news-card-modern {
        background: #fff;
        border-radius: 24px;
        overflow: hidden;
        border: none;
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.03);
        height: 100%;
        transition: all 0.4s ease;
        display: flex;
        flex-direction: column;
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
        color: #0f172a;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        gap: 5px;
        font-family: 'Inter', sans-serif;
    }

    /* --- SIDEBAR WIDGETS --- */
    .widget-island {
        background: #fff;
        border-radius: 24px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px -10px rgba(0,0,0,0.03);
        text-align: center;
        border: 1px solid #f1f5f9;
        position: relative;
        overflow: hidden;
    }

    .profile-blob-container {
        width: 150px;
        height: 150px;
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
    
    .widget-island:hover .profile-blob-img { border-radius: 50%; }

    .btn-profile {
        background: transparent;
        color: #2563eb;
        border: 2px solid #2563eb;
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-profile:hover {
        background: #2563eb;
        color: #fff;
        box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.3);
    }

    /* JEJARING SECTION */
    .related-links-section {
        background: #fff;
        padding: 60px 0;
        border-top: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
        overflow: hidden;
    }

    .section-title-center {
        text-align: center;
        margin-bottom: 40px;
    }

    .section-title-center h3 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800;
        color: #0f172a;
    }

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
        animation: scroll 40s linear infinite; 
        width: max-content;
        padding: 10px 0;
    }
    
    .marquee-content:hover { animation-play-state: paused; }

    @keyframes scroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    .link-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        width: 160px;
        transition: transform 0.3s;
    }

    .link-item:hover { transform: translateY(-5px); }

    .link-logo-box {
        width: 100px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        border-radius: 28px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        border: 1px solid #f1f5f9;
        margin-bottom: 15px;
        padding: 20px;
        transition: all 0.3s;
    }

    .link-item:hover .link-logo-box {
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.15);
        border-color: #3b82f6;
    }

    .link-logo-box img {
        width: 100%; height: 100%; object-fit: contain;
        filter: grayscale(100%); opacity: 0.6;
        transition: all 0.3s;
    }

    .link-item:hover .link-logo-box img { filter: grayscale(0%); opacity: 1; }

    .link-name {
        font-size: 0.85rem;
        font-weight: 700;
        color: #64748b;
        text-align: center;
        line-height: 1.3;
        transition: color 0.3s;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .link-item:hover .link-name { color: #2563eb; }

    /* --- RESPONSIVE MEDIA QUERIES --- */
    @media (max-width: 991px) { 
        .carousel-item { 
            height: 400px; 
            background-size: 100% 100% !important; 
        }
        .search-card { padding: 30px 20px; border-radius: 24px; }
        .brand-heading { font-size: 1.8rem; }
    }

    @media (max-width: 768px) { 
        .carousel-item { 
            height: 300px; 
            background-size: 100% 100% !important;
        }
    }

    @media (max-width: 576px) { 
        .carousel-item { 
            height: 220px; 
            background-size: 100% 100% !important; 
        } 
        .search-section { margin-top: -40px; }
        .chart-container { height: 250px; } /* Tinggi grafik di HP */
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
                        <div class="carousel-item <?= ($key==0) ? 'active' : '' ?>">
                            <img src="<?= base_url('uploads/slider/'.$slide->foto) ?>" class="d-block w-100 slider-image" alt="Slider Image">
                        </div>
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
                <div class="carousel-item active">
                    <div style="background-color: #1e40af; height: 400px; display:flex; align-items:center; justify-content:center;">
                        <h3 class="text-white">JDIH Kabupaten Donggala</h3>
                    </div>
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
                    <h6 class="text-uppercase text-muted fw-bold ls-1 mb-2" style="font-size: 0.8rem; letter-spacing: 2px;">Selamat Datang di</h6>
                    <h1 class="brand-heading">JDIH KABUPATEN DONGGALA</h1>
                    <p class="text-muted mb-0" style="font-size: 1.1rem;">Portal Integrasi Data Peraturan Perundang-undangan Daerah</p>
                </div>

                <form action="<?php echo site_url('frontendprodukhukum/produk_hukum_list'); ?>" method="get">
                    <div class="row g-3">
                        <div class="col-lg-5 mb-2">
                            <input type="text" class="form-control form-control-modern" placeholder="Kata kunci (misal: Pajak, Retribusi)" name="tentang">
                        </div>
                        <div class="col-lg-2 col-md-4 mb-2">
                            <input type="text" class="form-control form-control-modern" placeholder="Nomor" name="no_peraturan">
                        </div>
                        <div class="col-lg-2 col-md-4 mb-2">
                            <input type="text" class="form-control form-control-modern" placeholder="Tahun" name="tahun">
                        </div>
                        <div class="col-lg-3 col-md-4 mb-2">
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
                    <p>Putusan Pengadilan</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="chart-card">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h4 class="fw-bold mb-1" style="font-family: 'Plus Jakarta Sans', sans-serif;">Statistik Produk Hukum</h4>
                <p class="text-muted small mb-0">Tren jumlah produk hukum yang diterbitkan per tahun</p>
            </div>
            <div class="p-2 bg-light rounded-circle text-primary">
                <i class="bi bi-graph-up-arrow fs-4"></i>
            </div>
        </div>
        
        <div class="chart-container">
            <canvas id="produkHukumChart"></canvas>
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
                <?php foreach($links as $link): ?>
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
                <?php foreach($links as $link): ?>
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
                        <h3 class="fw-bold mb-0" style="font-weight: 800; color:#0f172a; font-family: 'Plus Jakarta Sans';">Produk Hukum Daerah</h3>
                    </div>
                    <a href="<?php echo base_url('frontendprodukhukum/produk_hukum_list') ?>" class="btn btn-outline-primary rounded-pill px-4 fw-bold text-decoration-none">Lihat Semua</a>
                </div>

                <div class="vstack gap-3">
                    <?php if(!empty($ta_produk_hukum_data)): foreach($ta_produk_hukum_data as $value) { ?>
                        <a href="<?php echo base_url()?>frontendprodukhukum/produk_hukum_page/<?php echo $value->id_produk_hukum ?>" class="law-item">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-light text-primary fw-bold px-3 py-2 rounded-pill">
                                    <i class="bi bi-bookmark-fill me-1"></i> <?php echo $value->kategori; ?>
                                </span>
                                <small class="text-muted fw-bold">
                                    <i class="bi bi-clock me-1"></i> <?php echo isset($value->tgl_peraturan) ? date('d M Y', strtotime($value->tgl_peraturan)) : '-'; ?>
                                </small>
                            </div>
                            <span class="law-title">
                                Nomor <?php echo $value->no_peraturan; ?> Tahun <?php echo $value->tahun; ?> tentang <?php echo $value->tentang; ?>
                            </span>
                        </a>
                    <?php } else: ?>
                        <div class="alert alert-info">Belum ada data produk hukum.</div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <span class="section-label" style="color: #1e40af;">Informasi</span>
                        <h3 class="fw-bold mb-0" style="font-weight: 800; color:#0f172a; font-family: 'Plus Jakarta Sans';">Kabar Berita</h3>
                    </div>
                    <a href="<?php echo base_url('berita') ?>" class="btn btn-outline-dark rounded-pill px-4 fw-bold text-decoration-none">Arsip Berita</a>
                </div>

                <div class="row g-4">
                    <?php if(!empty($ta_berita)): foreach($ta_berita as $value) { 
                        $img_src = '';
                        if(!empty($value->file)) {
                            if(file_exists(FCPATH . 'uploads/berita_konten/' . $value->file)){
                                $img_src = base_url('uploads/berita_konten/' . $value->file);
                            } elseif(file_exists(FCPATH . 'uploads/berita/' . $value->file)){
                                $img_src = base_url('uploads/berita/' . $value->file);
                            }
                        }
                    ?>
                        <div class="col-md-6">
                            <div class="news-card-modern">
                                <div class="news-img-container">
                                    <?php if($img_src): ?>
                                        <img src="<?php echo $img_src; ?>" alt="Berita">
                                    <?php else: ?>
                                        <div class="d-flex align-items-center justify-content-center bg-light w-100 h-100 text-muted">
                                            <i class="bi bi-image fs-1"></i>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="news-date-badge">
                                        <i class="bi bi-calendar-event"></i> 
                                        <?php echo date('d M Y', strtotime($value->tgl_insert)); ?>
                                    </div>
                                </div>
                                <div class="p-4 d-flex flex-column flex-grow-1">
                                    <h5 class="fw-bold mb-2 lh-base" style="font-size: 1.1rem; font-family: 'Plus Jakarta Sans';">
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
                <h5 class="text-uppercase text-muted fw-bold mb-4 ls-1" >
                    <?php echo isset($kabag->jabatan) ? $kabag->jabatan : 'Kepala Bagian Hukum'; ?>
                </h5>
                
                <div class="profile-blob-container">
                    <?php if(isset($kabag->foto) && !empty($kabag->foto) && file_exists(FCPATH . 'uploads/pejabat/' . $kabag->foto)): ?>
                        <img src="<?php echo base_url('uploads/pejabat/'.$kabag->foto); ?>" alt="Foto Pejabat" class="profile-blob-img">
                    <?php else: ?>
                        <img src="<?php echo base_url(); ?>template/img/kabag.jpg" onerror="this.src='https://placehold.co/150x150/e2e8f0/1e293b?text=Foto+Kabag'" alt="Default Pejabat" class="profile-blob-img">
                    <?php endif; ?>
                </div>
                
                <h4 class="fw-bold text-dark mb-1" style="font-family: 'Plus Jakarta Sans';">
                    <?php echo isset($kabag->nama) ? $kabag->nama : 'Nama Pejabat'; ?>
                </h4>
                <p class="text-muted small mb-4">
                    <?php echo isset($kabag->nip) && !empty($kabag->nip) ? 'NIP. '.$kabag->nip : 'Sekretariat Daerah Kab. Donggala'; ?>
                </p>
                
            </div>

            <div class="widget-island text-start">
        <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
            <h5 class="fw-bold mb-0" style="font-family: 'Plus Jakarta Sans'; color:#0f172a;">
                <i class="bi bi-link-45deg text-primary me-2"></i> Link Terkait
            </h5>
            <span class="badge bg-light text-primary rounded-pill"><?php echo count($links1); ?></span>
        </div>

        <div class="link-scroll-wrapper">
            <?php if(!empty($links1)): foreach($links1 as $link): ?>
                <a href="<?php echo $link->url; ?>" target="_blank" class="link-list-item">
                    
                    <div class="link-icon-box">
                        <i class="bi bi-globe"></i>
                    </div>

                    <div class="link-list-info">
                        <h6><?php echo $link->nama_link; ?></h6>
                        <small>
                            Kunjungi Tautan <i class="bi bi-box-arrow-up-right ms-1" style="font-size: 10px;"></i>
                        </small>
                    </div>
                </a>
            <?php endforeach; else: ?>
                <div class="text-center text-muted py-4">
                    <small>Belum ada link eksternal.</small>
                </div>
            <?php endif; ?>
        </div>
    </div>
            <div class="widget-island p-4 text-start border-0" style="background: linear-gradient(135deg, #1e40af, #0ea5e9); color:white;">
                <div class="position-relative" style="z-index: 2;">
                    <i class="bi bi-globe2 fs-1 text-white-50 mb-3 d-block"></i>
                    <h4 class="fw-bold mb-2" style="font-family: 'Plus Jakarta Sans';">JDIH NASIONAL</h4>
                    <p class="small opacity-75 mb-4">Terintegrasi dengan Jaringan Dokumentasi dan Informasi Hukum Nasional.</p>
                    <a href="https://jdihn.go.id" target="_blank" class="btn btn-light text-primary fw-bold rounded-pill w-100 shadow-sm border-0">
                        Kunjungi Portal <i class="bi bi-box-arrow-up-right ms-1"></i>
                    </a>
                </div>
                <div style="position: absolute; top: -30px; right: -30px; width: 150px; height: 150px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
            </div>

            <div class="widget-island p-0 border-0 shadow-sm">
                <div class="p-3 bg-white text-start border-bottom">
                    <small class="fw-bold d-block text-dark"><i class="bi bi-geo-alt-fill text-danger me-2"></i> Lokasi Kantor</small>
                </div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.5384300858527!2d119.74998847496477!3d-0.6786681993147113!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d8bb84fdde0d2cb%3A0xbc10bdf2c28577c3!2sDonggala%20Regent%20Office!5e0!3m2!1sen!2sid!4v1768146808224!5m2!1sen!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>

        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. Ambil Data dari Controller
        const labels = <?php echo isset($grafik_tahun) ? $grafik_tahun : '[]'; ?>;
        
        const dataPeraturan = <?php echo isset($grafik_peraturan) ? $grafik_peraturan : '[]'; ?>;
        const dataMonografi = <?php echo isset($grafik_monografi) ? $grafik_monografi : '[]'; ?>;
        const dataArtikel   = <?php echo isset($grafik_artikel) ? $grafik_artikel : '[]'; ?>;
        const dataPutusan   = <?php echo isset($grafik_putusan) ? $grafik_putusan : '[]'; ?>;

        const ctx = document.getElementById('produkHukumChart').getContext('2d');
        
        // Konfigurasi Chart
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Peraturan',
                        data: dataPeraturan,
                        borderColor: '#2563eb', // Biru (Sesuai Kartu 1)
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        borderWidth: 3,
                        pointBackgroundColor: '#2563eb',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        tension: 0.4, // Garis melengkung
                        fill: true
                    },
                    {
                        label: 'Monografi',
                        data: dataMonografi,
                        borderColor: '#16a34a', // Hijau (Sesuai Kartu 2)
                        backgroundColor: 'rgba(22, 163, 74, 0.1)',
                        borderWidth: 3,
                        pointBackgroundColor: '#16a34a',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Artikel Hukum',
                        data: dataArtikel,
                        borderColor: '#9333ea', // Ungu (Sesuai Kartu 3)
                        backgroundColor: 'rgba(147, 51, 234, 0.1)',
                        borderWidth: 3,
                        pointBackgroundColor: '#9333ea',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Putusan Pengadilan',
                        data: dataPutusan,
                        borderColor: '#ea580c', // Orange (Sesuai Kartu 4)
                        backgroundColor: 'rgba(234, 88, 12, 0.1)',
                        borderWidth: 3,
                        pointBackgroundColor: '#ea580c',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index', // Saat hover tahun, semua kategori muncul tooltip-nya
                    intersect: false,
                },
                plugins: {
                    legend: {
                        display: true, // Tampilkan legenda agar user tahu warna garis
                        position: 'top',
                        labels: {
                            font: { family: 'Plus Jakarta Sans', size: 12 },
                            usePointStyle: true,
                            boxWidth: 8
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.9)',
                        titleFont: { family: 'Plus Jakarta Sans', size: 13 },
                        bodyFont: { family: 'Inter', size: 13 },
                        padding: 12,
                        cornerRadius: 8,
                        displayColors: true,
                        usePointStyle: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            borderDash: [5, 5],
                            color: '#f1f5f9'
                        },
                        ticks: {
                            font: { family: 'Inter', size: 11 },
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Inter', size: 11 } }
                    }
                }
            }
        });
    });
</script>