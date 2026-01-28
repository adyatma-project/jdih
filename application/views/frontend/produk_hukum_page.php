<style>
/* --- MODERN DETAIL STYLE --- */
body {
    background-color: #f8fafc;
    font-family: 'Inter', sans-serif;
}

/* Header Area */
.detail-header {
    background: #fff;
    padding: 30px 0;
    border-bottom: 1px solid #e2e8f0;
    margin-bottom: 30px;
}

.badge-modern {
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-block;
    margin-bottom: 10px;
}

.bg-soft-blue {
    background: #eff6ff;
    color: #2563eb;
}

.bg-soft-green {
    background: #dcfce7;
    color: #166534;
}

.bg-soft-red {
    background: #fee2e2;
    color: #991b1b;
}

.bg-soft-orange {
    background: #ffedd5;
    color: #c2410c;
}

.doc-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 800;
    color: #0f172a;
    font-size: 1.75rem;
    line-height: 1.4;
    margin-bottom: 10px;
}

/* Cards */
.detail-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #f1f5f9;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
    overflow: hidden;
    margin-bottom: 25px;
}

.card-head {
    padding: 15px 20px;
    border-bottom: 1px solid #f1f5f9;
    background: #fafbfc;
    font-weight: 700;
    color: #334155;
    font-family: 'Plus Jakarta Sans', sans-serif;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Metadata List */
.meta-list {
    padding: 10px 20px;
}

.meta-row {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px dashed #e2e8f0;
    font-size: 0.95rem;
}

.meta-row:last-child {
    border-bottom: none;
}

.meta-label {
    color: #64748b;
    font-weight: 500;
    width: 40%;
    font-size: 0.85rem;
}

.meta-value {
    color: #0f172a;
    font-weight: 600;
    width: 60%;
    text-align: right;
    word-break: break-word;
}

/* Download Box */
.download-section {
    background: linear-gradient(145deg, #2563eb, #1e40af);
    color: white;
    padding: 30px 20px;
    text-align: center;
}

.btn-download {
    background: #fff;
    color: #2563eb;
    font-weight: 700;
    padding: 12px 20px;
    border-radius: 10px;
    border: none;
    width: 100%;
    display: block;
    margin-top: 15px;
    text-decoration: none;
    transition: 0.2s;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.btn-download:hover {
    transform: translateY(-2px);
    color: #1e3a8a;
    background: #f8fafc;
}

.btn-download-abstrak {
    background: transparent;
    border: 1px solid rgba(255, 255, 255, 0.5);
    color: #fff;
    font-weight: 600;
    font-size: 0.9rem;
    padding: 10px 20px;
    border-radius: 10px;
    width: 100%;
    display: block;
    margin-top: 10px;
    text-decoration: none;
    transition: 0.2s;
}

.btn-download-abstrak:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: #fff;
    color: #fff;
}

/* PDF Viewer */
.pdf-wrapper {
    height: 900px;
    background: #525659;
}

.pdf-frame {
    width: 100%;
    height: 100%;
    border: none;
}

@media (max-width: 991px) {
    .meta-row {
        flex-direction: column;
        gap: 5px;
    }

    .meta-label,
    .meta-value {
        width: 100%;
        text-align: left;
    }

    .pdf-wrapper {
        height: 500px;
    }

    .doc-title {
        font-size: 1.4rem;
    }
}
</style>

<?php
// --- SETUP VARIABLE ---
$judul_dokumen = isset($tentang) && !empty($tentang) ? $tentang : (isset($judul) ? $judul : 'Tanpa Judul');
$nm_kategori   = isset($kategori) ? $kategori : 'Produk Hukum';
$file_uri      = isset($file) ? base_url('uploads/produk_hukum/' . $file) : '#';
$has_file      = (isset($file) && !empty($file) && file_exists('./uploads/produk_hukum/' . $file));

$abstrak_uri   = isset($file_abstrak) ? base_url('uploads/produk_hukum/' . $file_abstrak) : '#';
$has_abstrak   = (isset($file_abstrak) && !empty($file_abstrak) && file_exists('./uploads/produk_hukum/' . $file_abstrak));

// Deteksi Jenis Dokumen untuk Logika Tampilan Metadata
$is_putusan   = (stripos($nm_kategori, 'Penadilan') !== false || stripos($nm_kategori, 'pengadilan') !== false);
$is_monografi = (stripos($nm_kategori, 'monografi') !== false || stripos($nm_kategori, 'buku') !== false);
$is_artikel   = (stripos($nm_kategori, 'artikel') !== false || stripos($nm_kategori, 'jurnal') !== false || stripos($nm_kategori, 'majalah') !== false);
// Default sisanya dianggap Peraturan

// Format Tanggal Helper
function format_tgl($tgl) {
    if (empty($tgl) || $tgl == '0000-00-00') return '-';
    return date('d M Y', strtotime($tgl));
}
?>

<div class="detail-header">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="mb-3">
                    <a href="<?= base_url('frontendprodukhukum/produk_hukum_list') ?>"
                        class="text-muted text-decoration-none small fw-bold">
                        <i class="bi bi-arrow-left"></i> KEMBALI KE PENCARIAN
                    </a>
                </div>

                <span class="badge-modern bg-soft-blue">
                    <i class="bi bi-bookmark-fill me-1"></i> <?= strtoupper($nm_kategori) ?>
                </span>

                <?php if(!empty($status_peraturan)): ?>
                <?php 
                            // Cek apakah mengandung kata "berlaku" (tidak case sensitive)
                            $is_berlaku = (stripos($status_peraturan, 'Berlaku') !== false);
                            
                            // Tentukan Warna & Icon
                            $warna_status = $is_berlaku ? 'bg-soft-green' : 'bg-soft-orange';
                            $icon_status  = $is_berlaku ? 'bi-check-circle' : 'bi-exclamation-circle';
                        ?>
                <span class="badge-modern <?= $warna_status ?> me-1">
                    <i class="bi <?= $icon_status ?> me-1"></i> <?= strtoupper($status_peraturan) ?>
                </span>
                <?php endif; ?>

                <?php if(!empty($status_putusan)): ?>
                <span class="badge-modern bg-soft-blue me-1">
                    <i class="bi bi-gavel me-1"></i> <?= strtoupper($status_putusan) ?>
                </span>
                <?php endif; ?>


                <h1 class="doc-title"><?= $judul_dokumen ?></h1>

                <div class="d-flex flex-wrap gap-3 text-muted small mt-2">
                    <?php if(!empty($tahun)): ?>
                    <span><i class="bi bi-calendar-event me-1"></i> Tahun <?= $tahun ?></span>
                    <?php endif; ?>
                    <span><i class="bi bi-eye me-1"></i> <?= isset($dilihat) ? $dilihat : '0' ?>x Dilihat</span>
                    <span><i class="bi bi-download me-1"></i> <?= isset($didownload) ? $didownload : '0' ?>x
                        Diunduh</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row justify-content-center">

        <div class="col-lg-4">



            <div class="detail-card">
                <div class="card-head"><i class="bi bi-list-ul text-primary"></i> Metadata Dokumen</div>
                <div class="meta-list">

                    <?php if($is_putusan): ?>
                    <?php if(!empty($jenis_peraturan)): ?>
                    <div class="meta-row"><span class="meta-label">Tipe Dokumen</span><span
                            class="meta-value"><?= $jenis_peraturan ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($tentang)): ?>
                    <div class="meta-row"><span class="meta-label">Judul</span><span
                            class="meta-value"><?= $tentang ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($teu_badan)): ?>
                    <div class="meta-row"><span class="meta-label">T.E.U. Badan</span><span
                            class="meta-value"><?= $teu_badan ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($no_peraturan)): ?>
                    <div class="meta-row"><span class="meta-label">Nomor Putusan</span><span
                            class="meta-value"><?= $no_peraturan ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($jenis_peradilan)): ?>
                    <div class="meta-row"><span class="meta-label">Jenis Peradilan</span><span
                            class="meta-value"><?= $jenis_peradilan ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($singkatan_peradilan)): ?>
                    <div class="meta-row"><span class="meta-label">Singkatan Jenis Peradilan</span><span
                            class="meta-value"><?= $singkatan_peradilan ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($tempat_peradilan)): ?>
                    <div class="meta-row"><span class="meta-label">Tempat Peradilan</span><span
                            class="meta-value"><?= $tempat_peradilan ?></span></div>
                    <?php endif; ?>
                    <div class="meta-row"><span class="meta-label">Tanggal-Bulan-Tahun dibacakan</span><span
                            class="meta-value"><?= format_tgl($tgl_putusan) ?></span></div>
                    <?php if(!empty($sumber)): ?>
                    <div class="meta-row"><span class="meta-label">Sumber</span><span
                            class="meta-value"><?= $sumber ?></span></div>
                    <?php endif; ?>
                    <?php if(isset($status_putusan)): ?>
                    <div class="meta-row"><span class="meta-label">Status Putusan</span><span
                            class="meta-value"><?= $status_putusan ?></span></div>
                    <?php endif; ?>
                    <?php if(isset($bahasa)): ?>
                    <div class="meta-row"><span class="meta-label">Bahasa</span><span
                            class="meta-value"><?= $bahasa ?></span></div>
                    <?php endif; ?>
                    <?php if(isset($bidang_hukum)): ?>
                    <div class="meta-row"><span class="meta-label">Bidang Hukum / Jenis Perkara</span><span
                            class="meta-value"><?= $bidang_hukum ?></span></div>
                    <?php endif; ?>

                    <?php if(isset($lokasi)): ?>
                    <div class="meta-row"><span class="meta-label">Lokasi</span><span
                            class="meta-value"><?= $lokasi ?></span></div>
                    <?php endif; ?>



                    <?php elseif($is_monografi): ?>
                    <?php if(!empty($tipe_dokumen)): ?>
                    <div class="meta-row"><span class="meta-label">Tipe Dokumen</span><span
                            class="meta-value"><?= $tipe_dokumen ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($tentang)): ?>
                    <div class="meta-row"><span class="meta-label">Judul</span><span
                            class="meta-value"><?= $tentang ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($teu_badan)): ?>
                    <div class="meta-row"><span class="meta-label">T.E.U. Orang/Badan</span><span
                            class="meta-value"><?= $teu_badan ?></span></div>
                    <?php endif; ?>

                    <?php if(!empty($nomor_panggil)): ?>
                    <div class="meta-row"><span class="meta-label">Nomor Panggil</span><span
                            class="meta-value"><?= $nomor_panggil ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($cetakan_edisi)): ?>
                    <div class="meta-row"><span class="meta-label">Cetakan/Edisi</span><span
                            class="meta-value"><?= $cetakan_edisi ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($tempat_terbit)): ?>
                    <div class="meta-row"><span class="meta-label">Tempat Terbit</span><span
                            class="meta-value"><?= $tempat_terbit ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($penerbit)): ?>
                    <div class="meta-row"><span class="meta-label">Penerbit</span><span
                            class="meta-value"><?= $penerbit ?></span></div>
                    <?php endif; ?>
                    <div class="meta-row"><span class="meta-label">Tahun Terbit</span><span
                            class="meta-value"><?= $tahun ?></span></div>
                    <?php if(!empty($deskripsi_fisik)): ?>
                    <div class="meta-row"><span class="meta-label">Deskripsi Fisik</span><span
                            class="meta-value"><?= $deskripsi_fisik ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($isbn)): ?>
                    <div class="meta-row"><span class="meta-label">ISBN/ISSN</span><span
                            class="meta-value"><?= $isbn ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($bahasa)): // Backup jika teu_badan kosong ?>
                    <div class="meta-row"><span class="meta-label">Bahasa</span><span
                            class="meta-value"><?= $bahasa ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($bidang_hukum)): // Backup jika teu_badan kosong ?>
                    <div class="meta-row"><span class="meta-label">Bidang Hukum</span><span
                            class="meta-value"><?= $bidang_hukum ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($nomor_induk_buku)): ?>
                    <div class="meta-row"><span class="meta-label">No. Induk Buku</span><span
                            class="meta-value"><?= $nomor_induk_buku ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($lokasi)): // Backup jika teu_badan kosong ?>
                    <div class="meta-row"><span class="meta-label">Lokasi</span><span
                            class="meta-value"><?= $lokasi ?></span></div>
                    <?php endif; ?>

                    <?php elseif($is_artikel): ?>
                    <?php if(!empty($tipe_dokumen)): ?>
                    <div class="meta-row"><span class="meta-label">Tipe Dokumen</span><span
                            class="meta-value"><?= $tipe_dokumen ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($tentang)): ?>
                    <div class="meta-row"><span class="meta-label">Judul</span><span
                            class="meta-value"><?= $tentang ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($teu_badan)): ?>
                    <div class="meta-row"><span class="meta-label">T.E.U. Orang/Badan</span><span
                            class="meta-value"><?= $teu_badan ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($tempat_terbit)): ?>
                    <div class="meta-row"><span class="meta-label">Tempat Terbit</span><span
                            class="meta-value"><?= $tempat_terbit ?></span></div>
                    <?php endif; ?>
                    <!-- cek kembali kesesuaiannya -->
                    <?php if(!empty($sumber) || !empty($nama_jurnal)): ?>
                    <div class="meta-row"><span class="meta-label">Sumber</span><span
                            class="meta-value"><?= !empty($nama_jurnal) ? $nama_jurnal : $sumber ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($subjek)): ?>
                    <div class="meta-row"><span class="meta-label">Subjek</span><span
                            class="meta-value"><?= $subjek ?></span></div>
                    <?php endif; ?>

                    <?php if(!empty($bahasa)): ?>
                    <div class="meta-row"><span class="meta-label">Bahasa</span><span
                            class="meta-value"><?= $bahasa ?></span></div>
                    <?php endif; ?>

                    <?php if(!empty($bidang_hukum)): ?>
                    <div class="meta-row"><span class="meta-label">Bidang Hukum</span><span
                            class="meta-value"><?= $bidang_hukum ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($lokasi)): ?>
                    <div class="meta-row"><span class="meta-label">Lokasi</span><span
                            class="meta-value"><?= $lokasi ?></span></div>
                    <?php endif; ?>

                    <?php else: ?>
                    <?php if(!empty($jenis_peraturan)): ?>
                    <div class="meta-row"><span class="meta-label">Tipe Dokumen</span><span
                            class="meta-value"><?= $jenis_peraturan ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($tentang)): ?>
                    <div class="meta-row"><span class="meta-label">Judul</span><span
                            class="meta-value"><?= $tentang ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($teu_badan)): ?>
                    <div class="meta-row"><span class="meta-label">T.E.U. Badan/ Pengarang</span><span
                            class="meta-value"><?= $teu_badan ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($no_peraturan)): ?>
                    <div class="meta-row"><span class="meta-label">Nomor Peraturan</span><span
                            class="meta-value"><?= $no_peraturan ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($jenis_peraturan)): ?>
                    <div class="meta-row"><span class="meta-label">Jenis / Bentuk Peraturan</span><span
                            class="meta-value"><?= $jenis_peraturan ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($singkatan_jenis)): ?>
                    <div class="meta-row"><span class="meta-label">Singkatan Jenis / Bentuk Peraturan</span><span
                            class="meta-value"><?= $singkatan_jenis ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($tempat_penetapan)): ?>
                    <div class="meta-row"><span class="meta-label">Tempat Penetapan</span><span
                            class="meta-value"><?= $tempat_penetapan ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($tgl_penetapan)): ?>
                    <div class="meta-row"><span class="meta-label">Tanggal-Bulan-Tahun
                            Penetapan/Pengundangan</span><span class="meta-value"><?= $tgl_penetapan ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($sumber)): ?>
                    <div class="meta-row"><span class="meta-label">Sumber</span><span
                            class="meta-value"><?= $sumber ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($subjek)): ?>
                    <div class="meta-row"><span class="meta-label">Subjek</span><span
                            class="meta-value"><?= $subjek ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($status_peraturan)): ?>
                    <div class="meta-row"><span class="meta-label">Status Peraturan</span><span
                            class="meta-value"><?= $status_peraturan ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($bahasa)): ?>
                    <div class="meta-row"><span class="meta-label">Bahasa</span><span
                            class="meta-value"><?= $bahasa ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($lokasi)): ?>
                    <div class="meta-row"><span class="meta-label">Lokasi</span><span
                            class="meta-value"><?= $lokasi ?></span></div>
                    <?php endif; ?>
                    <?php if(!empty($bidang_hukum)): ?>
                    <div class="meta-row"><span class="meta-label">Bidang Hukum</span><span
                            class="meta-value"><?= $bidang_hukum ?></span></div>
                    <?php endif; ?>



                    <?php endif; ?>



                </div>
            </div>

            <!-- Abstrak / Ringkasan -->
            <div class="detail-card overflow-hidden">
                <div class="download-section">
                    <i class="bi bi-file-earmark-pdf-fill" style="font-size: 3rem; opacity: 0.8;"></i>
                    <h5 class="fw-bold mt-3 mb-1">File Dokumen</h5>
                    <p class="small opacity-75">Unduh dokumen lengkap dalam format PDF.</p>

                    <?php if($has_file): ?>
                    <a href="<?= base_url('frontendprodukhukum/download/'.(isset($id_produk_hukum)?$id_produk_hukum:'')) ?>"
                        target="_blank" class="btn-download">
                        <i class="bi bi-download me-2"></i> DOWNLOAD PDF
                    </a>
                    <?php else: ?>
                    <button class="btn-download text-muted" disabled style="background:#e2e8f0; cursor:not-allowed;">
                        File Tidak Tersedia
                    </button>
                    <?php endif; ?>
                    <?php if($has_abstrak): ?>
                        <div class="mt-3 pt-3 border-top border-light border-opacity-25">
                            <span class="small text-white opacity-75 fw-bold d-block mb-1">DOKUMEN PENDUKUNG</span>
                            <a href="<?= $abstrak_uri ?>" target="_blank" class="btn-download-abstrak">
                                <i class="bi bi-file-text me-2"></i> Download Abstrak
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
         
        </div>

        <div class="col-lg-8">
            <div class="detail-card p-0">
                <div class="card-head border-0 bg-white p-3">
                    <i class="bi bi-eye text-primary"></i> Pratinjau Dokumen
                    <?php if($has_file): ?>
                    <a href="<?= $file_uri ?>" target="_blank"
                        class="btn btn-sm btn-outline-primary ms-auto rounded-pill px-3">
                        <i class="bi bi-arrows-fullscreen"></i> Fullscreen
                    </a>
                    <?php endif; ?>
                </div>

                <div class="pdf-wrapper">
                    <?php if($has_file): ?>
                    <iframe src="<?= base_url() ?>assets/pdf.js/web/viewer.html?file=<?= $file_uri ?>"
                        class="pdf-frame"></iframe>
                    <?php else: ?>
                    <div
                        class="d-flex flex-column align-items-center justify-content-center h-100 text-center p-5 text-white">
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