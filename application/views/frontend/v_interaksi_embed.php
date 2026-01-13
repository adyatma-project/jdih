<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <div class="text-center mb-5">
                <h2 class="fw-bold text-primary" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                    <?php echo $judul; ?>
                </h2>
                <p class="text-muted">Silahkan isi formulir digital di bawah ini.</p>
                <div class="d-flex justify-content-center">
                    <span class="bg-warning" style="height: 3px; width: 60px; display: block;"></span>
                </div>
            </div>

            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-body p-0">
                    <div class="ratio ratio-16x9" style="min-height: 800px;">
                        <iframe 
                            src="<?php echo $url_gform; ?>" 
                            allowfullscreen>
                            Memuat Formulir...
                        </iframe>
                    </div>
                </div>
                <div class="card-footer bg-light text-center py-3">
                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i> 
                        Formulir tidak muncul? 
                        <a href="<?php echo $url_gform; ?>" target="_blank" class="fw-bold text-decoration-none">Buka di Tab Baru</a>
                    </small>
                </div>
            </div>

        </div>
    </div>
</div>