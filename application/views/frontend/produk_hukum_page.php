<style>
    /* --- MODERN DETAIL STYLE --- */
    body { background-color: #f8fafc; font-family: 'Inter', sans-serif; }

    /* Header Area */
    .detail-header {
        background: #fff;
        padding: 30px 0;
        border-bottom: 1px solid #e2e8f0;
        margin-bottom: 30px;
    }
    .badge-modern {
        padding: 6px 12px; border-radius: 8px; 
        font-size: 0.75rem; font-weight: 700; 
        text-transform: uppercase; letter-spacing: 0.5px;
        display: inline-block; margin-bottom: 10px;
    }
    .bg-soft-blue { background: #eff6ff; color: #2563eb; }
    .bg-soft-green { background: #dcfce7; color: #166534; }
    .bg-soft-red { background: #fee2e2; color: #991b1b; }
    .bg-soft-orange { background: #ffedd5; color: #c2410c; }

    .doc-title {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 800; color: #0f172a;
        font-size: 1.75rem; line-height: 1.4;
        margin-bottom: 10px;
    }

    /* Cards */
    .detail-card {
        background: #fff; border-radius: 16px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
        overflow: hidden; margin-bottom: 25px;
    }
    .card-head {
        padding: 15px 20px; border-bottom: 1px solid #f1f5f9;
        background: #fafbfc; font-weight: 700; color: #334155;
        font-family: 'Plus Jakarta Sans', sans-serif;
        display: flex; align-items: center; gap: 8px;
    }

    /* Metadata List */
    .meta-list { padding: 10px 20px; }
    .meta-row {
        display: flex; justify-content: space-between;
        padding: 12px 0; border-bottom: 1px dashed #e2e8f0;
        font-size: 0.95rem;
    }
    .meta-row:last-child { border-bottom: none; }
    .meta-label { color: #64748b; font-weight: 500; width: 40%; font-size: 0.85rem; }
    .meta-value { color: #0f172a; font-weight: 600; width: 60%; text-align: right; }

    /* Download Box */
    .download-section {
        background: linear-gradient(145deg, #2563eb, #1e40af);
        color: white; padding: 30px 20px; text-align: center;
    }
    .btn-download {
        background: #fff; color: #2563eb; font-weight: 700;
        padding: 12px 20px; border-radius: 10px; border: none;
        width: 100%; display: block; margin-top: 15px;
        text-decoration: none; transition: 0.2s; box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .btn-download:hover { transform: translateY(-2px); color: #1e3a8a; background: #f8fafc; }

    /* PDF Viewer */
    .pdf-wrapper { height: 900px; background: #525659; }
    .pdf-frame { width: 100%; height: 100%; border: none; }

    @media (max-width: 991px) {
        .meta-row { flex-direction: column; gap: 5px; }
        .meta-label, .meta-value { width: 100%; text-align: left; }
        .pdf-wrapper { height: 500px; }
        .doc-title { font-size: 1.4rem; }
    }
</style>

<?php
// --- PREPARE VARIABLES (Agar tidak error undefined) ---
// Kita gunakan isset() ternary operator untuk semua variabel yang mungkin kosong
$judul_dokumen = isset($tentang) && !empty($tentang) ? $tentang : (isset($judul) ? $judul : 'Tanpa Judul');
$nm_kategori   = isset($kategori) ? $kategori : 'Produk Hukum';
$file_uri      = isset($file) ? base_url('uploads/produk_hukum/' . $file) : '#';
$has_file      = (isset($file) && !empty($file) && file_exists('./uploads/produk_hukum/' . $file));

// Format Tanggal Helper
function format_tgl($tgl) {
    if (empty($tgl) || $tgl == '0000-00-00') return null;
    return date('d M Y', strtotime($tgl));
}
?>

<div class="detail-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="mb-3">
                    <a href="<?= base_url('frontendprodukhukum/produk_hukum_list') ?>" class="text-muted text-decoration-none small fw-bold">
                        <i class="bi bi-arrow-left"></i> KEMBALI KE PENCARIAN
                    </a>
                </div>

                <span class="badge-modern bg-soft-blue">
                    <i class="bi bi-bookmark-fill me-1"></i> <?= strtoupper($nm_kategori) ?>
                </span>

                <?php
                if(isset($id_produk_hukum)) {
                    $get_status = $this->db->query('SELECT ref_status_peraturan.nama_status_peraturan, ta_produk_hukum_det.id_status_peraturan, ta_produk_hukum_det.id_sumber_perubahan FROM ta_produk_hukum_det LEFT JOIN ref_status_peraturan ON ta_produk_hukum_det.id_status_peraturan=ref_status_peraturan.id_status_peraturan WHERE ta_produk_hukum_det.id_produk_hukum=' . $id_produk_hukum)->result();
                    
                    if (!empty($get_status)) {
                        foreach ($get_status as $val) {
                            if ($val->id_status_peraturan == "0" || $val->id_status_peraturan == NULL) {
                                echo '<span class="badge-modern bg-soft-green"><i class="bi bi-check-circle me-1"></i> BERLAKU</span>';
                            } else {
                                echo '<span class="badge-modern bg-soft-red"><i class="bi bi-exclamation-circle me-1"></i> ' . strtoupper($val->nama_status_peraturan) . '</span>';
                            }
                        }
                    } else {
                        // Default jika tidak ada di tabel det
                        echo '<span class="badge-modern bg-soft-green"><i class="bi bi-check-circle me-1"></i> BERLAKU</span>';
                    }
                }
                ?>

                <h1 class="doc-title"><?= ucwords(strtolower($judul_dokumen)) ?></h1>

                <div class="d-flex flex-wrap gap-3 text-muted small mt-2">
                    <?php if(!empty($tahun)): ?>
                        <span><i class="bi bi-calendar-event me-1"></i> Tahun <?= $tahun ?></span>
                    <?php endif; ?>
                    <span><i class="bi bi-eye me-1"></i> <?= isset($dilihat) ? $dilihat : '0' ?>x Dilihat</span>
                    <span><i class="bi bi-download me-1"></i> <?= isset($didownload) ? $didownload : '0' ?>x Diunduh</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row justify-content-center">
        
        <div class="col-lg-4">
            
            <div class="detail-card overflow-hidden">
                <div class="download-section">
                    <i class="bi bi-file-earmark-pdf-fill" style="font-size: 3rem; opacity: 0.8;"></i>
                    <h5 class="fw-bold mt-3 mb-1">File Dokumen</h5>
                    <p class="small opacity-75">Unduh dokumen lengkap dalam format PDF.</p>
                    
                    <?php if($has_file): ?>
                        <a href="<?= base_url('frontendprodukhukum/download/'.(isset($id_produk_hukum)?$id_produk_hukum:'')) ?>" target="_blank" class="btn-download">
                            <i class="bi bi-download me-2"></i> DOWNLOAD PDF
                        </a>
                    <?php else: ?>
                        <button class="btn-download text-muted" disabled style="background:#e2e8f0; cursor:not-allowed;">
                            File Tidak Tersedia
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <div class="detail-card">
                <div class="card-head"><i class="bi bi-list-ul text-primary"></i> Rincian Dokumen</div>
                <div class="meta-list">
                    
                    <?php if(!empty($no_peraturan)): ?>
                        <div class="meta-row">
                            <span class="meta-label">Nomor Peraturan</span>
                            <span class="meta-value"><?= $no_peraturan ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($tahun)): ?>
                        <div class="meta-row">
                            <span class="meta-label">Tahun</span>
                            <span class="meta-value"><?= $tahun ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($singkatan_jenis)): ?>
                        <div class="meta-row">
                            <span class="meta-label">Singkatan Jenis</span>
                            <span class="meta-value"><?= $singkatan_jenis ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($teu_badan)): ?>
                        <div class="meta-row">
                            <span class="meta-label">T.E.U Badan/Pengarang</span>
                            <span class="meta-value"><?= $teu_badan ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($tempat_penetapan)): ?>
                        <div class="meta-row">
                            <span class="meta-label">Tempat Penetapan</span>
                            <span class="meta-value"><?= $tempat_penetapan ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if(format_tgl($tgl_penetapan)): ?>
                        <div class="meta-row">
                            <span class="meta-label">Tanggal Penetapan</span>
                            <span class="meta-value"><?= format_tgl($tgl_penetapan) ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if(format_tgl($tgl_pengundangan)): ?>
                        <div class="meta-row">
                            <span class="meta-label">Tanggal Pengundangan</span>
                            <span class="meta-value"><?= format_tgl($tgl_pengundangan) ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($sumber) || !empty($sumber_ln) || !empty($sumber_bn)): ?>
                        <div class="meta-row">
                            <span class="meta-label">Sumber</span>
                            <span class="meta-value">
                                <?= !empty($sumber) ? $sumber : '' ?>
                                <?= !empty($sumber_ln) ? $sumber_ln : '' ?>
                                <?= !empty($sumber_bn) ? $sumber_bn : '' ?>
                            </span>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($judul_buku)): ?>
                        <div class="meta-row"><span class="meta-label">Judul Buku</span><span class="meta-value"><?= $judul_buku ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($penulis)): ?>
                        <div class="meta-row"><span class="meta-label">Penulis</span><span class="meta-value"><?= $penulis ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($penerbit)): ?>
                        <div class="meta-row"><span class="meta-label">Penerbit</span><span class="meta-value"><?= $penerbit ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($isbn)): ?>
                        <div class="meta-row"><span class="meta-label">ISBN</span><span class="meta-value"><?= $isbn ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($deskripsi_fisik)): ?>
                        <div class="meta-row"><span class="meta-label">Deskripsi Fisik</span><span class="meta-value"><?= $deskripsi_fisik ?></span></div>
                    <?php endif; ?>

                    <?php if(!empty($nama_jurnal)): ?>
                        <div class="meta-row"><span class="meta-label">Jurnal/Sumber</span><span class="meta-value"><?= $nama_jurnal ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($volume)): ?>
                        <div class="meta-row"><span class="meta-label">Volume</span><span class="meta-value"><?= $volume ?></span></div>
                    <?php endif; ?>

                    <?php if(!empty($nomor_putusan)): ?>
                        <div class="meta-row"><span class="meta-label">Nomor Putusan</span><span class="meta-value"><?= $nomor_putusan ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($lembaga_peradilan)): ?>
                        <div class="meta-row"><span class="meta-label">Lembaga Peradilan</span><span class="meta-value"><?= $lembaga_peradilan ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($jenis_peradilan)): ?>
                        <div class="meta-row"><span class="meta-label">Jenis Peradilan</span><span class="meta-value"><?= $jenis_peradilan ?></span></div>
                    <?php endif; ?>
                    <?php if(format_tgl($tgl_putusan)): ?>
                        <div class="meta-row"><span class="meta-label">Tanggal Dibacakan</span><span class="meta-value"><?= format_tgl($tgl_putusan) ?></span></div>
                    <?php endif; ?>

                    <?php if(!empty($subjek)): ?>
                        <div class="meta-row">
                            <span class="meta-label">Subjek</span>
                            <span class="meta-value text-primary"><?= $subjek ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($bidang_hukum)): ?>
                        <div class="meta-row">
                            <span class="meta-label">Bidang Hukum</span>
                            <span class="meta-value"><?= $bidang_hukum ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($bahasa)): ?>
                        <div class="meta-row">
                            <span class="meta-label">Bahasa</span>
                            <span class="meta-value"><?= $bahasa ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if(!empty($lokasi)): ?>
                        <div class="meta-row">
                            <span class="meta-label">Lokasi Fisik</span>
                            <span class="meta-value"><?= $lokasi ?></span>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

            <?php if((!empty($abstrak) && strip_tags($abstrak) != '-') || !empty($amar_putusan)): ?>
            <div class="detail-card">
                <div class="card-head"><i class="bi bi-file-text text-warning"></i> Abstrak / Ringkasan</div>
                <div class="p-3 text-muted small" style="line-height: 1.6; text-align: justify;">
                    <?= !empty($amar_putusan) ? $amar_putusan : $abstrak ?>
                </div>
            </div>
            <?php endif; ?>

        </div>

        <div class="col-lg-8">
            <div class="detail-card p-0">
                <div class="card-head border-0 bg-white p-3">
                    <i class="bi bi-eye text-primary"></i> Pratinjau Dokumen
                    <?php if($has_file): ?>
                    <a href="<?= $file_uri ?>" target="_blank" class="btn btn-sm btn-outline-primary ms-auto rounded-pill px-3">
                        <i class="bi bi-arrows-fullscreen"></i> Fullscreen
                    </a>
                    <?php endif; ?>
                </div>
                
                <div class="pdf-wrapper">
                    <?php if($has_file): ?>
                        <iframe src="<?= base_url() ?>assets/pdf.js/web/viewer.html?file=<?= $file_uri ?>" class="pdf-frame"></iframe>
                    <?php else: ?>
                        <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center p-5 text-white">
                            <i class="bi bi-file-earmark-x" style="font-size: 4rem; opacity: 0.5;"></i>
                            <h4 class="mt-3">Pratinjau Tidak Tersedia</h4>
                            <p class="opacity-75">File dokumen fisik belum diunggah ke server.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>