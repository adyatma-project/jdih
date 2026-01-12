<style>
    .detail-header {
        margin-bottom: 20px;
        border-bottom: 1px solid #eee;
        padding-bottom: 20px;
    }
    .detail-title {
        font-size: 32px;
        font-weight: 800;
        color: #2c3e50;
        line-height: 1.3;
        margin-bottom: 15px;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .detail-meta {
        font-size: 14px;
        color: #777;
    }
    .detail-meta span {
        margin-right: 20px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    
    .detail-content {
        font-size: 17px;
        line-height: 1.8;
        color: #2c3e50;
        font-family: 'Georgia', serif; 
        margin-top: 30px;
    }

    /* PERBAIKAN TAMPILAN GAMBAR DALAM KONTEN */
    .detail-content img {
        max-width: 100% !important;
        height: auto !important;
        display: block;
        margin: 20px auto; /* Tengah otomatis */
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    
    /* Sidebar Styling */
    .sidebar-card {
        background: #fff;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        border: 1px solid #f1f5f9;
        margin-bottom: 30px;
    }
    .sidebar-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 20px;
        border-bottom: 2px solid #f1f5f9;
        padding-bottom: 15px;
        color: #333;
    }
    .list-berita-sidebar li {
        margin-bottom: 15px;
        border-bottom: 1px dashed #eee;
        padding-bottom: 15px;
    }
    .list-berita-sidebar a {
        font-weight: 600;
        color: #444;
        text-decoration: none;
        display: block;
        line-height: 1.4;
    }
    .list-berita-sidebar a:hover {
        color: #007bff;
    }
</style>

<div class="container" style="padding-top: 60px; padding-bottom: 60px;">
    <div class="row">
        <div class="col-md-8">
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url('berita'); ?>">Berita</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Baca</li>
                </ol>
            </nav>

            <div class="detail-header">
                <span class="badge badge-primary px-3 py-2 rounded-pill mb-3" style="background-color: var(--primary);">
                    <?php echo isset($berita->nama_kategori) ? $berita->nama_kategori : 'Berita Umum'; ?>
                </span>
                <h1 class="detail-title"><?php echo $berita->judul; ?></h1>
                
                <div class="detail-meta">
                    <span><i class="fa fa-calendar text-primary"></i> <?php echo date('d F Y', strtotime($berita->tgl_insert)); ?></span>
                    <span><i class="fa fa-user text-primary"></i> <?php echo $berita->user; ?></span>
                    <span><i class="fa fa-eye text-primary"></i> <?php echo $berita->viewer; ?>x Dibaca</span>
                </div>
            </div>

            <div class="detail-content">
                <?php 
                // --- PERBAIKAN PATH GAMBAR ---
                // Mengambil isi berita
                $isi_konten = $berita->isi;

                // TinyMCE sering menyimpan gambar sebagai "uploads/..." (path relatif)
                // Saat dibuka di "jdih.donggala.go.id/berita/detail", browser mengira folder uploads ada di dalam folder berita
                // Kita harus paksa path-nya menjadi absolut (full URL)
                
                // Ganti src="uploads/" menjadi src="https://domain.com/uploads/"
                $isi_konten = str_replace('src="uploads/', 'src="'.base_url('uploads/'), $isi_konten);
                
                // Jaga-jaga jika tersimpan sebagai "../uploads/"
                $isi_konten = str_replace('src="../uploads/', 'src="'.base_url('uploads/'), $isi_konten);

                echo $isi_konten; 
                ?>
            </div>

            <div class="mt-5 p-4 bg-light rounded text-center border">
                <p class="mb-2 fw-bold text-muted small text-uppercase">Bagikan informasi ini</p>
                <div class="d-flex justify-content-center gap-2">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo current_url(); ?>" target="_blank" class="btn btn-primary btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;"><i class="fa fa-facebook"></i></a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo current_url(); ?>&text=<?php echo urlencode($berita->judul); ?>" target="_blank" class="btn btn-info text-white btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;"><i class="fa fa-twitter"></i></a>
                    <a href="https://wa.me/?text=<?php echo urlencode($berita->judul . ' ' . current_url()); ?>" target="_blank" class="btn btn-success btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;"><i class="fa fa-whatsapp"></i></a>
                </div>
            </div>

            <hr style="margin: 40px 0;">
            <a href="<?php echo site_url('berita'); ?>" class="btn btn-outline-secondary rounded-pill px-4"><i class="fa fa-arrow-left me-2"></i> Kembali ke Daftar Berita</a>
        </div>

        <div class="col-md-4">
            <div class="sidebar-card">
                <h4 class="sidebar-title">Berita Terbaru</h4>
                <ul class="list-unstyled list-berita-sidebar">
                    <?php foreach ($berita_terbaru as $brt): ?>
                    <li>
                        <small class="text-muted d-block mb-1"><i class="fa fa-clock-o me-1"></i> <?php echo date('d M Y', strtotime($brt->tgl_insert)); ?></small>
                        <a href="<?php echo site_url('berita/detail/'.$brt->id_berita); ?>">
                            <?php echo $brt->judul; ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>