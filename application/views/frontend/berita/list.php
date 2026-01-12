<style>
    /* CSS Khusus Halaman Berita */
    .news-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: #fff;
        overflow: hidden;
        height: 100%;
        margin-bottom: 30px;
    }
    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .news-thumb {
        height: 200px;
        overflow: hidden;
        position: relative;
    }
    .news-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Agar gambar tidak gepeng */
        transition: transform 0.5s ease;
    }
    .news-card:hover .news-thumb img {
        transform: scale(1.1); /* Efek zoom saat hover */
    }
    .news-cat {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(0, 123, 255, 0.9);
        color: #fff;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .news-body {
        padding: 20px;
    }
    .news-date {
        font-size: 12px;
        color: #999;
        margin-bottom: 10px;
        display: block;
    }
    .news-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 10px;
        line-height: 1.4;
    }
    .news-title a {
        color: #333;
        text-decoration: none;
    }
    .news-title a:hover {
        color: #007bff;
    }
    .news-footer {
        padding: 15px 20px;
        border-top: 1px solid #f1f1f1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 12px;
        color: #666;
    }
</style>

<div class="container" style="padding-top: 50px; padding-bottom: 50px;">
    <div class="row text-center mb-5">
        <div class="col-12">
            <h2 style="font-weight: 800; color: #2c3e50;">Kabar JDIH Terkini</h2>
            <p class="text-muted">Informasi terbaru seputar hukum dan kegiatan pemerintahan</p>
            <hr style="width: 60px; border-top: 3px solid #007bff; margin: 20px auto;">
        </div>
    </div>

    <div class="row">
        <?php foreach ($berita as $row): 
            // --- LOGIKA THUMBNAIL CERDAS ---
            // Cek folder upload otomatis (TinyMCE)
            $img_src = base_url('uploads/no-image.png');
            
            if(!empty($row->file)) {
                if(file_exists(FCPATH . 'uploads/berita_konten/' . $row->file)){
                    $img_src = base_url('uploads/berita_konten/' . $row->file);
                } elseif(file_exists(FCPATH . 'uploads/berita/' . $row->file)){
                    $img_src = base_url('uploads/berita/' . $row->file);
                }
            }
        ?>
        <div class="col-md-4 col-sm-6">
            <div class="news-card">
                <div class="news-thumb">
                    <span class="news-cat"><?php echo $row->nama_kategori; ?></span>
                    <a href="<?php echo site_url('berita/detail/'.$row->id_berita); ?>">
                        <img src="<?php echo $img_src; ?>" alt="<?php echo $row->judul; ?>">
                    </a>
                </div>
                <div class="news-body">
                    <span class="news-date"><i class="fa fa-calendar"></i> <?php echo date('d M Y', strtotime($row->tgl_insert)); ?></span>
                    <h3 class="news-title">
                        <a href="<?php echo site_url('berita/detail/'.$row->id_berita); ?>">
                            <?php echo word_limiter($row->judul, 10); ?>
                        </a>
                    </h3>
                    <p style="color:#666; font-size:14px;">
                        <?php echo word_limiter(strip_tags($row->isi), 15); ?>
                    </p>
                </div>
                <div class="news-footer">
                    <span><i class="fa fa-user"></i> <?php echo $row->user; ?></span>
                    <span><i class="fa fa-eye"></i> <?php echo $row->viewer; ?>x</span>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="row mt-4">
        <div class="col-12 text-center">
            <?php echo $pagination; ?>
        </div>
    </div>
</div>