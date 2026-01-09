<style>
    /* Styling untuk Carousel Modern */
    .carousel-item {
        height: 500px; /* Tinggi slider */
        min-height: 350px;
        background: no-repeat center center scroll;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        position: relative;
    }
    
    /* Overlay Gelap agar teks terbaca */
    .carousel-item::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.7) 100%);
    }

    .carousel-caption {
        bottom: 20%;
        text-align: left;
        padding-left: 5%;
        padding-right: 5%;
    }

    .carousel-caption h2 {
        font-weight: 800;
        font-size: 2.5rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.6);
        animation: fadeInUp 1s ease-in-out;
    }

    .carousel-caption p {
        font-size: 1.2rem;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.6);
        animation: fadeInUp 1s ease-in-out 0.3s; /* Delay sedikit */
        animation-fill-mode: both;
    }

    /* Search Box Floating (Melayang di atas slider/konten) */
    .search-card-wrapper {
        margin-top: -80px; /* Menarik ke atas agar menumpuk slider */
        position: relative;
        z-index: 10;
        padding: 0 15px;
    }

    .search-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: none;
        border-radius: 15px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        padding: 30px;
    }

    /* Animasi Teks */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translate3d(0, 40px, 0); }
        to { opacity: 1; transform: translate3d(0, 0, 0); }
    }

    /* Styling elemen lain */
    .hukum-item {
        transition: all 0.3s;
        border-left: 5px solid #0d6efd;
        background-color: #fff;
    }
    .hukum-item:hover {
        transform: translateX(5px);
        background-color: #f8f9fa;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .widget-header {
        border-bottom: 3px solid #0d6efd;
        padding-bottom: 10px;
        margin-bottom: 20px;
        font-weight: bold;
        color: #333;
    }
    .profile-img-box {
        width: 120px;
        height: 120px;
        margin: 0 auto 15px;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid #0d6efd;
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.2);
    }
</style>

<?php if(!empty($sliders)): ?>
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php foreach($sliders as $key => $slide): ?>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?= $key ?>" class="<?= ($key==0) ? 'active' : '' ?>" aria-current="true" aria-label="Slide <?= $key+1 ?>"></button>
        <?php endforeach; ?>
    </div>
    <div class="carousel-inner">
        <?php foreach($sliders as $key => $slide): ?>
            <div class="carousel-item <?= ($key==0) ? 'active' : '' ?>" style="background-image: url('<?= base_url('uploads/slider/'.$slide->foto) ?>')">
                <div class="carousel-caption d-none d-md-block">
                    <h2><?= $slide->judul ?></h2>
                    <p><?= $slide->sub_judul ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<?php else: ?>
<div class="carousel slide">
    <div class="carousel-inner">
        <div class="carousel-item active" style="background-color: #0043a8;">
            <div class="carousel-caption d-block">
                <h2>Jaringan Dokumentasi dan Informasi Hukum</h2>
                <p>Kabupaten Donggala</p>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="container search-card-wrapper mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card search-card">
                <form action="<?php echo site_url('frontendprodukhukum/produk_hukum_list'); ?>" method="get">
                    <div class="row g-3">
                        <div class="col-md-12 mb-1">
                            <label class="form-label fw-bold text-primary"><i class="bi bi-search"></i> Cari Produk Hukum</label>
                            <input type="text" class="form-control form-control-lg bg-light border-0" placeholder="Ketik kata kunci (misal: Pajak, Retribusi)..." name="tentang">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Nomor Peraturan" name="no_peraturan">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Tahun" name="tahun">
                        </div>
                        <div class="col-md-4">
                            <select class="form-select" name="ref_kategori">
                                <option value="">- Semua Kategori -</option>
                                <?php foreach($ref_kategori as $value) { ?>
                                    <option value="<?php echo $value->id_kategori ?>"><?php echo $value->kategori ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-2 d-grid">
                            <button class="btn btn-primary fw-bold" type="submit">Cari</button>
                        </div>
                        <input type="hidden" name="ref_status_peraturan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        <div class="col-lg-8">
            
            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <h4 class="mb-0 text-primary fw-bold"><i class="bi bi-file-earmark-text me-2"></i> Produk Hukum Terbaru</h4>
                    <a href="<?php echo base_url('frontendprodukhukum/produk_hukum_list') ?>" class="btn btn-sm btn-outline-primary rounded-pill">Lihat Semua <i class="bi bi-arrow-right"></i></a>
                </div>

                <div class="list-group shadow-sm rounded-3 overflow-hidden border-0">
                    <?php foreach($ta_produk_hukum_data as $value) { ?>
                        <a href="<?php echo base_url()?>frontendprodukhukum/produk_hukum_page/<?php echo $value->id_produk_hukum ?>" class="list-group-item list-group-item-action p-3 hukum-item d-flex align-items-start gap-3 border-bottom">
                            <div class="fs-2 text-danger bg-light rounded p-2">
                                <i class="bi bi-file-earmark-pdf-fill"></i>
                            </div>
                            <div class="w-100">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="mb-0 fw-bold text-dark">
                                        <?php echo $value->kategori; ?> Nomor <?php echo $value->no_peraturan; ?>
                                    </h6>
                                    <span class="badge bg-primary rounded-pill"><?php echo $value->tahun; ?></span>
                                </div>
                                <p class="mb-1 text-muted small" style="line-height: 1.5;">
                                    <?php echo substr($value->tentang, 0, 180) . (strlen($value->tentang) > 180 ? '...' : ''); ?>
                                </p>
                                <small class="text-secondary"><i class="bi bi-calendar3"></i> <?php echo tanggal($value->tgl_peraturan); ?></small>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>

            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
                    <h4 class="mb-0 text-primary fw-bold"><i class="bi bi-newspaper me-2"></i> Berita Terkini</h4>
                    <a href="<?php echo base_url('frontendberita/berita_list') ?>" class="btn btn-sm btn-outline-primary rounded-pill">Arsip Berita</a>
                </div>

                <div class="row g-3">
                    <?php foreach($ta_berita as $value) { ?>
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm hover-shadow overflow-hidden">
                                <?php if(!empty($value->file)): ?>
                                    <div style="height: 200px; overflow: hidden;">
                                        <img src="<?php echo base_url('uploads/berita/medium/'.$value->file) ?>" class="card-img-top" alt="Berita" style="object-fit: cover; height: 100%; width: 100%;">
                                    </div>
                                <?php else: ?>
                                    <div class="bg-light text-center py-5 text-muted">
                                        <i class="bi bi-image fs-1"></i>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="card-body">
                                    <div class="d-flex gap-2 mb-2">
                                        <span class="badge bg-light text-dark border"><i class="bi bi-calendar"></i> <?php echo date('d M Y', strtotime($value->tgl_insert)); ?></span>
                                    </div>
                                    <h6 class="card-title lh-base">
                                        <a href="#" class="text-decoration-none text-dark fw-bold stretched-link">
                                            <?php echo $value->judul; ?>
                                        </a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            
            <div class="card shadow-sm border-0 mb-4 rounded-3">
                <div class="card-body p-4 text-center">
                    <h5 class="widget-header border-0 mb-4">Kepala Bagian Hukum</h5>
                    <div class="profile-img-box">
                        <img src="https://via.placeholder.com/150" alt="Foto Kabag" class="img-fluid" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <h5 class="fw-bold mb-1">Nama Pejabat, S.H., M.H.</h5>
                    <p class="text-muted small mb-3">Kepala Bagian Hukum Setda Kab. Donggala</p>
                    <a href="#" class="btn btn-outline-primary btn-sm rounded-pill w-100">Lihat Profil Lengkap</a>
                </div>
            </div>

            <div class="card bg-gradient-primary text-white mb-4 shadow rounded-3 border-0" style="background: linear-gradient(45deg, #0d6efd, #0a58ca);">
                <div class="card-body text-center p-4">
                    <img src="<?php echo base_url(); ?>template/img/logo-jdih.png" width="60" class="mb-3" style="filter: brightness(0) invert(1);">
                    <h3 class="fw-bold">JDIH NASIONAL</h3>
                    <p class="mb-4 opacity-75">Terintegrasi dengan Jaringan Dokumentasi dan Informasi Hukum Nasional</p>
                    <a href="https://jdihn.go.id" target="_blank" class="btn btn-light text-primary fw-bold rounded-pill w-100 shadow-sm">Kunjungi Portal JDIHN</a>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                <div class="card-header bg-white fw-bold py-3 border-bottom">
                    <i class="bi bi-geo-alt-fill text-danger me-2"></i> Lokasi Kantor
                </div>
                <div class="card-body p-0">
                    <div class="ratio ratio-4x3">
                       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.366403567794!2d119.7369!3d-0.6548!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMMKwMzknMTcuMyJTIDExOcKwNDQnMTIuOCJF!5e0!3m2!1sid!2sid!4v1625642000000!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <div class="p-3 bg-light border-top">
                        <small class="text-muted d-block">Bagian Hukum Sekretariat Daerah Kabupaten Donggala</small>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>