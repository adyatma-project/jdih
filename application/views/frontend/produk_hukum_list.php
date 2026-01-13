<style>
    /* --- MODERN LISTING STYLE (SAMA SEPERTI YANG ANDA KIRIM) --- */
    body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }
    .listing-header { background: #fff; padding: 40px 0; border-bottom: 1px solid #e2e8f0; margin-bottom: 40px; }
    .page-title { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; color: #0f172a; font-size: 2rem; }
    .filter-card { background: #fff; border-radius: 16px; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px -5px rgba(0,0,0,0.05); padding: 25px; position: sticky; top: 100px; } /* Top saya ubah jadi 100px agar tidak tertutup navbar sticky */
    .filter-title { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 1.1rem; color: #1e293b; margin-bottom: 20px; border-bottom: 2px solid #f1f5f9; padding-bottom: 15px; display: flex; align-items: center; gap: 10px; }
    .form-label-modern { font-size: 0.85rem; font-weight: 600; color: #64748b; margin-bottom: 8px; }
    .form-control-modern, .form-select-modern { border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px 15px; font-size: 0.95rem; color: #334155; background-color: #f8fafc; transition: all 0.3s; }
    .form-control-modern:focus, .form-select-modern:focus { background-color: #fff; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); outline: none; }
    
    .search-wrapper { position: relative; margin-bottom: 30px; }
    .search-input-lg { height: 60px; border-radius: 16px; border: 2px solid #e2e8f0; padding-left: 55px; font-size: 1.1rem; width: 100%; transition: all 0.3s; box-shadow: 0 5px 15px rgba(0,0,0,0.03); }
    .search-input-lg:focus { border-color: #3b82f6; box-shadow: 0 10px 25px rgba(59, 130, 246, 0.15); outline: none; }
    .search-icon-lg { position: absolute; left: 20px; top: 50%; transform: translateY(-50%); font-size: 1.4rem; color: #94a3b8; }
    
    .doc-card { background: #fff; border-radius: 16px; border: 1px solid #f1f5f9; padding: 25px; margin-bottom: 20px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden; }
    .doc-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px -10px rgba(0,0,0,0.08); border-color: #bfdbfe; }
    .doc-card::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: transparent; transition: 0.3s; }
    .doc-card:hover::before { background: #3b82f6; }
    
    .doc-category { font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: #3b82f6; background: #eff6ff; padding: 5px 12px; border-radius: 30px; letter-spacing: 0.5px; }
    .doc-title-link { display: block; font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.25rem; font-weight: 700; color: #1e293b; text-decoration: none; line-height: 1.4; margin: 12px 0; transition: color 0.2s; }
    .doc-title-link:hover { color: #2563eb; }
    
    .meta-badge { display: inline-flex; align-items: center; gap: 5px; font-size: 0.85rem; color: #64748b; background: #f8fafc; padding: 6px 12px; border-radius: 8px; margin-right: 8px; margin-bottom: 8px; }
    .status-badge-active { background: #dcfce7; color: #166534; font-weight: 600; padding: 5px 10px; border-radius: 6px; font-size: 0.75rem; }
    .status-badge-inactive { background: #fee2e2; color: #991b1b; font-weight: 600; padding: 5px 10px; border-radius: 6px; font-size: 0.75rem; }
    
    .btn-action { padding: 10px 20px; border-radius: 10px; font-weight: 600; text-decoration: none; font-size: 0.9rem; transition: 0.2s; display: inline-flex; align-items: center; gap: 8px; border: none; }
    .btn-primary-soft { background: #eff6ff; color: #2563eb; }
    .btn-primary-soft:hover { background: #2563eb; color: #fff; }
    .btn-download-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; background: #f1f5f9; color: #475569; transition: 0.2s; text-decoration: none; }
    .btn-download-icon:hover { background: #334155; color: #fff; }
    
    .pagination { justify-content: center; gap: 5px; margin-top: 40px; }
    .pagination li a { border: none; background: #fff; color: #64748b; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; border-radius: 10px; font-weight: 600; box-shadow: 0 2px 5px rgba(0,0,0,0.05); text-decoration: none; }
    .pagination li.active a { background: #2563eb; color: #fff; box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3); }
    
    @media (max-width: 991px) { .filter-card { position: relative; top: 0; margin-bottom: 30px; } }
</style>

<div class="listing-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title m-0">Produk Hukum</h1>
                <p class="text-muted m-0 mt-2">Arsip digital peraturan dan dokumentasi hukum daerah.</p>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row">
        
        <div class="col-lg-3">
             <div class="card mt-4 border-0 shadow-sm rounded-4 bg-primary text-white p-4 text-center overflow-hidden position-relative">
                <i class="bi bi-archive position-absolute" style="font-size: 8rem; right: -20px; bottom: -20px; opacity: 0.2;"></i>
                <h3 class="fw-bold display-6"><?php echo number_format($total_rows); ?></h3>
                <p class="small opacity-75 mb-0">Total Dokumen Ditemukan</p>
            </div>

            <div class="filter-card">
                <div class="filter-title">
                    <i class="bi bi-sliders2"></i> Filter Pencarian
                </div>
                
                <form action="<?php echo site_url('frontendprodukhukum/produk_hukum_list'); ?>" method="get">
                    
                    <input type="hidden" name="q" value="<?php echo $q; ?>">

                    <div class="mb-3">
                        <label class="form-label-modern">Nomor Peraturan</label>
                        <input type="text" class="form-control form-control-modern" name="no_peraturan" value="<?php echo $no_peraturan; ?>" placeholder="Contoh: 15">
                    </div>

                    <div class="mb-3">
                        <label class="form-label-modern">Tahun</label>
                        <input type="number" class="form-control form-control-modern" name="tahun" value="<?php echo $tahun; ?>" placeholder="Contoh: 2024">
                    </div>

                    <div class="mb-3">
                        <label class="form-label-modern">Jenis / Kategori</label>
                        <select class="form-select form-select-modern" name="ref_kategori">
                            <option value="">Semua Kategori</option>
                            <?php foreach ($ref_kategori as $kat): ?>
                                <option value="<?php echo $kat->id_kategori; ?>" <?php echo ($kategori_selected == $kat->id_kategori) ? 'selected' : ''; ?>>
                                    <?php echo $kat->kategori; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                   

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary fw-bold py-2" style="border-radius: 10px;">
                            <i class="bi bi-search me-2"></i> Terapkan Filter
                        </button>
                        <a href="<?php echo site_url('frontendprodukhukum/produk_hukum_list'); ?>" class="btn btn-light fw-bold py-2 text-muted" style="border-radius: 10px;">
                            Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-9">
            
            <form action="<?php echo site_url('frontendprodukhukum/produk_hukum_list'); ?>" method="get">
                <div class="search-wrapper">
                    <i class="bi bi-search search-icon-lg"></i>
                    <input type="text" class="search-input-lg" name="tentang" value="<?php echo $tentang; ?>" placeholder="Ketik kata kunci judul, tentang, atau topik...">
                    
                    <input type="hidden" name="no_peraturan" value="<?php echo $no_peraturan; ?>">
                    <input type="hidden" name="tahun" value="<?php echo $tahun; ?>">
                    <input type="hidden" name="ref_kategori" value="<?php echo $kategori_selected; ?>"> <input type="hidden" name="ref_status_peraturan" value="<?php echo $status_peraturan; ?>">
                </div>
            </form>

            <?php if(!empty($q) || !empty($tentang) || !empty($no_peraturan) || !empty($kategori_selected)): ?>
                <p class="text-muted mb-4">
                    <i class="bi bi-funnel-fill me-1"></i> Memfilter data berdasarkan: 
                    <?php if(!empty($tentang)) echo '<span class="badge bg-light text-dark border me-1">"'.$tentang.'"</span>'; ?>
                    <?php if(!empty($kategori_selected)) {
                        // Cari nama kategori untuk ditampilkan
                        foreach($ref_kategori as $rk) {
                            if($rk->id_kategori == $kategori_selected) {
                                echo '<span class="badge bg-primary me-1">'.$rk->kategori.'</span>';
                                break;
                            }
                        }
                    } ?>
                    <?php if(!empty($tahun)) echo '<span class="badge bg-light text-dark border me-1">Tahun '.$tahun.'</span>'; ?>
                </p>
            <?php endif; ?>

            <div class="result-list">
                <?php if(!empty($ta_produk_hukum_data)): ?>
                    <?php foreach ($ta_produk_hukum_data as $row): 
                        // Status Badge
                        $status_badge = '<span class="status-badge-active"><i class="bi bi-check-circle me-1"></i> Berlaku</span>';
                        if (isset($row->status_peraturan) && ($row->status_peraturan == 'Dicabut' || $row->status_peraturan == 'Tidak Berlaku')) { 
                             $status_badge = '<span class="status-badge-inactive"><i class="bi bi-x-circle me-1"></i> '.$row->status_peraturan.'</span>'; 
                        }
                    ?>
                        <div class="doc-card">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="doc-category"><?php echo $row->kategori ?></span>
                                <?php echo $status_badge; ?>
                            </div>
                            
                            <a href="<?php echo base_url('frontendprodukhukum/produk_hukum_page/'.$row->id_produk_hukum) ?>" class="doc-title-link">
                                <?php echo !empty($row->tentang) ? $row->tentang : $row->judul; ?>
                            </a>

                            <div class="d-flex flex-wrap align-items-center mt-3 mb-4">
                                <span class="meta-badge"><i class="bi bi-hash"></i> No. <?php echo $row->no_peraturan ?></span>
                                <span class="meta-badge"><i class="bi bi-calendar-event"></i> Tahun <?php echo $row->tahun ?></span>
                                <?php if(!empty($row->tanggal_penetapan) && $row->tanggal_penetapan != '0000-00-00'): ?>
                                    <span class="meta-badge"><i class="bi bi-pen"></i> <?php echo date('d M Y', strtotime($row->tanggal_penetapan)); ?></span>
                                <?php endif; ?>
                                <span class="meta-badge text-primary bg-blue-soft"><i class="bi bi-eye"></i> <?php echo $row->dilihat ?>x</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-2">
                                <a href="<?php echo base_url('frontendprodukhukum/produk_hukum_page/'.$row->id_produk_hukum) ?>" class="btn-action btn-primary-soft">
                                    Lihat Detail <i class="bi bi-arrow-right"></i>
                                </a>
                                
                                <?php if (!empty($row->file) && file_exists('./uploads/produk_hukum/' . $row->file)): ?>
                                    <a href="<?php echo base_url('frontendprodukhukum/download/'.$row->id_produk_hukum) ?>" target="_blank" class="btn-download-icon" title="Download PDF">
                                        <i class="bi bi-download"></i>
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted small fst-italic"><i class="bi bi-x-circle"></i> File N/A</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-5">
                        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486754.png" width="120" style="opacity: 0.5; margin-bottom: 20px;">
                        <h4 class="text-muted fw-bold">Tidak ada dokumen ditemukan</h4>
                        <p class="text-muted">Coba ubah kata kunci pencarian atau reset filter Anda.</p>
                        <a href="<?php echo site_url('frontendprodukhukum/produk_hukum_list'); ?>" class="btn btn-outline-primary rounded-pill px-4 mt-2">Reset Pencarian</a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-12">
                    <?php echo $pagination; ?>
                </div>
            </div>

        </div>
    </div>
</div>