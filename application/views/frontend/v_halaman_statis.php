<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <div class="text-center mb-5">
                <h2 class="fw-bold text-primary text-uppercase" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                    <?php echo $judul; ?>
                </h2>
                <div class="d-flex justify-content-center mt-3">
                    <span class="bg-secondary opacity-25" style="height: 1px; width: 100px; display: block;"></span>
                </div>
                <small class="text-muted mt-2 d-block">
                    Terakhir diperbarui: <?php echo date('d F Y', strtotime($updated)); ?>
                </small>
            </div>

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                    <div class="content-body" style="line-height: 1.8; color: #334155;">
                        <?php echo $konten; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .content-body img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }
    .content-body table {
        width: 100% !important;
        border-collapse: collapse;
        margin-bottom: 1rem;
    }
    .content-body table, .content-body th, .content-body td {
        border: 1px solid #e2e8f0;
        padding: 8px;
    }
</style>