<section class="content-header">
    <h1>Form Metadata Produk Hukum (Standar JDIHN)</h1>
    <small>Sesuai Permenkumham No. 8 Tahun 2019</small>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Input Data Dokumen</h3>
        </div>

        <?php echo form_open_multipart($action); ?>
        <div class="box-body">

            <div class="form-group bg-gray p-3"
                style="padding: 15px; border-radius: 5px; border-left: 5px solid #3c8dbc; margin-bottom: 20px;">
                <label style="font-size: 16px;">Tipe Dokumen <span class="text-danger">*</span></label>
                <select name="id_kategori" id="id_kategori" class="form-control input-lg" required>
                    <option value="">-- Pilih Jenis Dokumen --</option>
                    <?php foreach ($ref_kategori as $kat) { ?>
                    <option value="<?php echo $kat->id_kategori ?>"
                        <?php echo ($id_kategori == $kat->id_kategori) ? 'selected' : ''; ?>>
                        <?php echo $kat->kategori ?>
                    </option>
                    <?php } ?>
                </select>
                <small class="text-muted">Pilih kategori terlebih dahulu untuk menampilkan form input.</small>
            </div>

            <div id="form_container" style="display:none;">

                <div class="form-group">
                    <label>Judul <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="tentang" rows="3" required
                        placeholder="Tuliskan judul lengkap dokumen..."><?php echo $tentang; ?></textarea>
                </div>

                <div id="meta_peraturan" class="meta-group" style="display:none;">
                    <div class="callout callout-info" style="margin-bottom: 15px;">
                        <h4><i class="fa fa-gavel"></i> Metadata Peraturan</h4>
                    </div>

                    <div class="form-group">
                        <label>T.E.U. Badan / Pengarang <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="teu_badan" value="<?php echo $teu_badan; ?>"
                            placeholder="Contoh: Indonesia. Presiden / Bupati Donggala">
                    </div>



                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor Peraturan</label>
                                <input type="text" class="form-control" name="no_peraturan"
                                    value="<?php echo $no_peraturan; ?>">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Jenis / Bentuk Peraturan</label>
                        <input type="text" class="form-control" name="jenis_peraturan"
                            value="<?php echo $jenis_peraturan; ?>"
                            placeholder="Contoh: Peraturan Daerah, Peraturan Bupati, Keputusan Kepala Dinas">
                    </div>

                    <div class="form-group">
                        <label>Singkatan Jenis / Bentuk Peraturan</label>
                        <input type="text" class="form-control" name="singkatan_jenis"
                            value="<?php echo $singkatan_jenis; ?>" placeholder="Contoh: PERDA / PERBUP">
                    </div>

                    <div class="form-group">
                        <label>Tempat Penetapan</label>
                        <input type="text" class="form-control" name="tempat_penetapan"
                            value="<?php echo $tempat_penetapan; ?>" placeholder="Contoh: Donggala">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal-Bulan-Tahun Penetapan/Pengundangan</label>
                                <input type="date" class="form-control" name="tgl_penetapan"
                                    value="<?php echo $tgl_penetapan; ?>">
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label>9. Tanggal-Bulan-Tahun Pengundangan</label>
                                <input type="date" class="form-control" name="tgl_pengundangan" value="<?php echo $tgl_pengundangan; ?>">
                            </div>
                        </div> -->
                    </div>

                    <div class="form-group">
                        <label>Sumber</label>
                        <input type="text" class="form-control" name="sumber" value="<?php echo $sumber; ?>"
                            placeholder="Contoh: LD Kabupaten Donggala Tahun 2024 Nomor 1">
                    </div>

                    <div class="form-group" style="background-color: #f9f9f9; padding: 10px; border: 1px dashed #ccc;">
                        <label>Status Peraturan</label>
                        <input type="text" class="form-control" name="status_peraturan"
                            value="<?php echo $status_peraturan; ?>"
                            placeholder="Ketik status disini. Contoh: Berlaku, Dicabut, atau Mengubah...">
                        <small class="text-muted">Isi secara manual status keberlakuan peraturan ini.</small>
                    </div>
                </div>
                <div id="meta_monografi" class="meta-group" style="display:none;">
                    <div class="callout callout-warning" style="margin-bottom: 15px;">
                        <h4><i class="fa fa-book"></i> Metadata Monografi / Buku</h4>
                    </div>
                    <div class="form-group">
                        <label>T.E.U. Orang / Badan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="penulis" value="<?php echo $penulis; ?>"
                            placeholder="Nama Pengarang">
                    </div>
                    <div class="form-group">
                        <label>Nomor Panggil</label>
                        <input type="text" class="form-control" name="nomor_panggil"
                            value="<?php echo $nomor_panggil; ?>">
                    </div>
                    <div class="form-group">
                        <label>Cetakan / Edisi</label>
                        <input type="text" class="form-control" name="cetakan_edisi"
                            value="<?php echo $cetakan_edisi; ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tempat Terbit</label>
                                <input type="text" class="form-control" name="tempat_terbit"
                                    value="<?php echo $tempat_terbit; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Penerbit</label>
                                <input type="text" class="form-control" name="penerbit"
                                    value="<?php echo $penerbit; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tahun Terbit</label>
                        <input type="number" class="form-control" name="tahun_terbit" value="<?php echo $tahun; ?>">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Fisik</label>
                        <input type="text" class="form-control" name="deskripsi_fisik"
                            value="<?php echo $deskripsi_fisik; ?>" placeholder="Contoh: 400 hlm; 23cm">
                    </div>
                    <div class="form-group">
                        <label>ISBN / ISSN</label>
                        <input type="text" class="form-control" name="isbn" value="<?php echo $isbn; ?>">
                    </div>
                    <div class="form-group">
                        <label>Nomor Induk Buku</label>
                        <input type="text" class="form-control" name="nomor_induk_buku"
                            value="<?php echo $nomor_induk_buku; ?>">
                    </div>
                </div>

                <div id="meta_artikel" class="meta-group" style="display:none;">
                    <div class="callout callout-success" style="margin-bottom: 15px;">
                        <h4><i class="fa fa-newspaper-o"></i> Metadata Artikel Hukum</h4>
                    </div>
                    <div class="form-group">
                        <label>T.E.U. Orang / Badan</label>
                        <input type="text" class="form-control" name="penulis_artikel" value="<?php echo $penulis; ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tempat Terbit</label>
                                <input type="text" class="form-control" name="tempat_terbit_art"
                                    value="<?php echo $tempat_terbit; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tahun Terbit</label>
                                <input type="number" class="form-control" name="tahun_terbit_art"
                                    value="<?php echo $tahun; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Sumber</label>
                        <input type="text" class="form-control" name="nama_jurnal" value="<?php echo $sumber; ?>"
                            placeholder="Contoh: Jurnal Hukum Nasional">
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"><label>Volume / Nomor</label><input type="text" class="form-control" name="volume" value="<?php echo $volume; ?>"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><label>Halaman</label><input type="text" class="form-control" name="halaman" value="<?php echo $halaman; ?>"></div>
                        </div>
                    </div> -->
                </div>

                <div id="meta_putusan" class="meta-group" style="display:none;">
                    <div class="callout callout-danger" style="margin-bottom: 15px;">
                        <h4><i class="fa fa-balance-scale"></i> Metadata Putusan Pengadilan</h4>
                    </div>
                    <div class="form-group">
                        <label>T.E.U Badan</label>
                        <input type="text" class="form-control" name="lembaga_peradilan"
                            value="<?php echo $lembaga_peradilan; ?>" placeholder="Contoh: Mahkamah Agung">
                    </div>
                    <div class="form-group">
                        <label>Nomor Putusan</label>
                        <input type="text" class="form-control" name="nomor_putusan"
                            value="<?php echo $nomor_putusan; ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Peradilan</label>
                                <select name="jenis_peradilan" class="form-control">
                                    <option value="">- Pilih -</option>
                                    <option value="Peradilan Umum"
                                        <?php echo ($jenis_peradilan=='Peradilan Umum')?'selected':''; ?>>Peradilan Umum
                                    </option>
                                    <option value="Peradilan Agama"
                                        <?php echo ($jenis_peradilan=='Peradilan Agama')?'selected':''; ?>>Peradilan
                                        Agama</option>
                                    <option value="Peradilan TUN"
                                        <?php echo ($jenis_peradilan=='Peradilan TUN')?'selected':''; ?>>Peradilan TUN
                                    </option>
                                    <option value="Peradilan Militer"
                                        <?php echo ($jenis_peradilan=='Peradilan Militer')?'selected':''; ?>>Peradilan
                                        Militer</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Singkatan Jenis Peradilan</label>
                                <input type="text" class="form-control" name="singkatan_peradilan"
                                    value="<?php echo $singkatan_peradilan; ?>" placeholder="Contoh: PN / PA / MA">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tempat Peradilan</label>
                        <input type="text" class="form-control" name="tempat_peradilan"
                            value="<?php echo $tempat_peradilan; ?>" placeholder="Contoh: Donggala">
                    </div>
                    <div class="form-group">
                        <label>Tanggal-Bulan-Tahun Dibacakan</label>
                        <input type="date" class="form-control" name="tanggal_dibacakan"
                            value="<?php echo $tanggal_dibacakan; ?>">
                    </div>
                    <div class="form-group">
                        <label>Status Putusan</label>
                        <select name="status_putusan" class="form-control">
                            <option value="Tetap" <?php echo $status_putusan=='Tetap'?'selected':''; ?>>Berkekuatan
                                Hukum Tetap</option>
                            <option value="Tidak Tetap" <?php echo $status_putusan=='Tidak Tetap'?'selected':''; ?>>
                                Belum Berkekuatan Hukum Tetap</option>
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <label>Amar Putusan</label>
                        <textarea class="form-control" name="amar_putusan" rows="3"><?php echo $amar_putusan; ?></textarea>
                    </div> -->
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Subjek<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="subjek" value="<?php echo $subjek; ?>"
                                required placeholder="Contoh: HUKUM PIDANA; RETRIBUSI">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Bidang Hukum</label>
                            <input type="text" class="form-control" name="bidang_hukum"
                                value="<?php echo $bidang_hukum; ?>" placeholder="Contoh: Hukum Administrasi Negara">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Bahasa</label>
                            <input type="text" class="form-control" name="bahasa" value="<?php echo $bahasa; ?>"
                                placeholder="Indonesia">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Lokasi</label>
                            <input type="text" class="form-control" name="lokasi" value="<?php echo $lokasi; ?>"
                                placeholder="Contoh: Lemari A Rak 2">
                        </div>
                    </div>
                </div>

                <hr>

                

                <div class="form-group well">
                    <label>Lampiran File Dokumen (PDF/DOC) <span class="text-danger">*</span></label>
                    <input type="file" name="file" class="form-control">
                    <?php if($file){ ?>
                    <p class="help-block text-success"><i class="fa fa-check"></i> File saat ini: <a
                            href="<?php echo base_url('uploads/produk_hukum/'.$file) ?>"
                            target="_blank"><?php echo $file; ?></a></p>
                    <?php } ?>
                    <p class="help-block text-muted">Pastikan file yang diunggah dapat dibaca dengan jelas (Full Text).
                    </p>
                </div>

                <div class="form-group well" style="background-color: #fdfdfd; border: 1px dashed #ddd;">
                    <label>Dokumen Abstrak <small class="text-muted">(Opsional)</small></label>
                    <input type="file" name="file_abstrak" class="form-control">
                    <?php if(isset($file_abstrak) && $file_abstrak){ ?>
                    <p class="help-block text-success"><i class="fa fa-check"></i> File Abstrak saat ini: <a
                            href="<?php echo base_url('uploads/produk_hukum/'.$file_abstrak) ?>"
                            target="_blank"><?php echo $file_abstrak; ?></a></p>
                    <?php } ?>
                    <p class="help-block text-muted">Upload file abstrak jika tersedia (PDF/DOC).</p>
                </div>

                <div class="form-group">
                    <label>Status Publikasi Website</label>
                    <select name="status" class="form-control">
                        <option value="1" <?php echo ($status=='1') ? 'selected' : ''; ?>>Publish (Tampilkan)</option>
                        <option value="0" <?php echo ($status=='0') ? 'selected' : ''; ?>>Draft (Sembunyikan)</option>
                    </select>
                </div>

                <input type="hidden" name="id_produk_hukum" value="<?php echo $id_produk_hukum; ?>" />

                <div class="box-footer text-center" style="background: transparent; border-top: 1px solid #f4f4f4;">
                    <a href="<?php echo site_url('ta_produk_hukum') ?>" class="btn btn-default btn-lg"><i
                            class="fa fa-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> SIMPAN DATA</button>
                </div>

            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {

    function checkKategori() {
        var selectedVal = $("#id_kategori").val();
        var selectedText = $("#id_kategori option:selected").text().toLowerCase();

        // 1. SEMBUNYIKAN SEMUANYA TERLEBIH DAHULU
        $(".meta-group").hide();
        $("#form_container").hide();

        // 2. JIKA BELUM PILIH, STOP. (TETAP SEMBUNYI)
        if (selectedVal === "") {
            return;
        }

        // 3. JIKA SUDAH PILIH, TAMPILKAN WRAPPER UTAMA
        $("#form_container").fadeIn();

        // 4. LOGIKA METADATA KHUSUS
        if (selectedText.includes("pengadilan") || selectedText.includes("mahkamah") || selectedText.includes(
                "yurisprudensi")) {
            $("#meta_putusan").show();
        } else if (selectedText.includes("monografi") || selectedText.includes("buku") || selectedText.includes(
                "naskah")) {
            $("#meta_monografi").show();
        } else if (selectedText.includes("artikel") || selectedText.includes("jurnal") || selectedText.includes(
                "majalah")) {
            $("#meta_artikel").show();
        }
        // Default: Peraturan (Perda, Perbup, Keputusan, dll)
        else {
            $("#meta_peraturan").show();
        }
    }

    // Jalankan saat load (penting untuk mode Edit)
    checkKategori();

    // Jalankan saat user mengganti pilihan
    $("#id_kategori").change(function() {
        checkKategori();
    });
});
</script>