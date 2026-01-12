<section class="content-header">
    <h1>Form Metadata Produk Hukum (Standar JDIHN)</h1>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Input Data Dokumen</h3>
        </div>
        
        <?php echo form_open_multipart($action); ?>
        <div class="box-body">
            
            <div class="form-group bg-gray p-3" style="padding: 15px; border-radius: 5px;">
                <label style="font-size: 16px;">Jenis Dokumen / Kategori <span class="text-danger">*</span></label>
                <select name="id_kategori" id="id_kategori" class="form-control input-lg" required>
                    <option value="">-- Pilih Jenis Dokumen --</option>
                    <?php foreach ($ref_kategori as $kat) { ?>
                        <option value="<?php echo $kat->id_kategori ?>" <?php echo ($id_kategori == $kat->id_kategori) ? 'selected' : ''; ?>>
                            <?php echo $kat->kategori ?>
                        </option>
                    <?php } ?>
                </select>
                <small class="text-muted">Form input di bawah akan menyesuaikan otomatis.</small>
            </div>

            <div id="meta_peraturan" class="meta-group" style="display:none;">
                <h4 class="text-primary"><i class="fa fa-gavel"></i> Metadata Peraturan</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>T.E.U Badan / Pengarang</label>
                            <input type="text" class="form-control" name="teu_badan" value="<?php echo $teu_badan; ?>" placeholder="Contoh: Indonesia. Presiden">
                        </div>
                        <div class="form-group">
                            <label>Nomor Peraturan</label>
                            <input type="text" class="form-control" name="no_peraturan" value="<?php echo $no_peraturan; ?>" placeholder="15">
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="number" class="form-control" name="tahun" value="<?php echo $tahun; ?>" placeholder="2024">
                        </div>
                        <div class="form-group">
                            <label>Singkatan Jenis</label>
                            <input type="text" class="form-control" name="singkatan_jenis" value="<?php echo $singkatan_jenis; ?>" placeholder="Contoh: PERBUP">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Judul Peraturan (Tentang)</label>
                            <textarea class="form-control" name="tentang" rows="4" placeholder="Judul lengkap..."><?php echo $tentang; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tempat Penetapan</label>
                            <input type="text" class="form-control" name="tempat_penetapan" value="<?php echo $tempat_penetapan; ?>" placeholder="Contoh: Donggala">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group"><label>Tgl Penetapan</label><input type="date" class="form-control" name="tgl_penetapan" value="<?php echo $tgl_penetapan; ?>"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"><label>Tgl Pengundangan</label><input type="date" class="form-control" name="tgl_pengundangan" value="<?php echo $tgl_pengundangan; ?>"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"><label>Sumber (LN/BN/LD)</label><input type="text" class="form-control" name="sumber" value="<?php echo $sumber; ?>" placeholder="Contoh: BD 2024 (1)"></div>
                    </div>
                </div>
            </div>

            <div id="meta_putusan" class="meta-group" style="display:none;">
                <h4 class="text-danger"><i class="fa fa-balance-scale"></i> Metadata Putusan Pengadilan</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nomor Putusan</label>
                            <input type="text" class="form-control" name="nomor_putusan" value="<?php echo $nomor_putusan; ?>">
                        </div>
                        <div class="form-group">
                            <label>Lembaga Peradilan (T.E.U Badan)</label>
                            <input type="text" class="form-control" name="lembaga_peradilan" value="<?php echo $lembaga_peradilan; ?>" placeholder="Contoh: Mahkamah Agung">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Peradilan</label>
                            <select name="jenis_peradilan" class="form-control">
                                <option value="">- Pilih -</option>
                                <option value="Peradilan Umum" <?php echo ($jenis_peradilan=='Peradilan Umum')?'selected':''; ?>>Peradilan Umum</option>
                                <option value="Peradilan Agama" <?php echo ($jenis_peradilan=='Peradilan Agama')?'selected':''; ?>>Peradilan Agama</option>
                                <option value="Peradilan TUN" <?php echo ($jenis_peradilan=='Peradilan TUN')?'selected':''; ?>>Peradilan TUN</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Singkatan Peradilan</label>
                            <input type="text" class="form-control" name="singkatan_peradilan" value="<?php echo $singkatan_peradilan; ?>" placeholder="Contoh: MA / PN">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group"><label>Tempat Peradilan</label><input type="text" class="form-control" name="tempat_peradilan" value="<?php echo $tempat_peradilan; ?>"></div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group"><label>Tanggal Dibacakan</label><input type="date" class="form-control" name="tanggal_dibacakan" value="<?php echo $tanggal_dibacakan; ?>"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Amar Putusan</label>
                    <textarea class="form-control" name="amar_putusan" rows="3"><?php echo $amar_putusan; ?></textarea>
                </div>
                <div class="form-group">
                    <label>Status Putusan</label>
                    <select name="status_putusan" class="form-control">
                        <option value="Tetap" <?php echo $status_putusan=='Tetap'?'selected':''; ?>>Berkekuatan Hukum Tetap</option>
                        <option value="Tidak Tetap" <?php echo $status_putusan=='Tidak Tetap'?'selected':''; ?>>Tidak Berkekuatan Hukum Tetap</option>
                    </select>
                </div>
            </div>

            <div id="meta_monografi" class="meta-group" style="display:none;">
                <h4 class="text-warning"><i class="fa fa-book"></i> Metadata Monografi / Buku</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Judul Buku</label>
                            <input type="text" class="form-control" name="judul_buku" value="<?php echo $tentang; ?>">
                        </div>
                        <div class="form-group">
                            <label>Pengarang / Penulis (T.E.U Orang)</label>
                            <input type="text" class="form-control" name="penulis" value="<?php echo $penulis; ?>">
                        </div>
                        <div class="form-group">
                            <label>Nomor Panggil</label>
                            <input type="text" class="form-control" name="nomor_panggil" value="<?php echo $nomor_panggil; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Penerbit</label>
                            <input type="text" class="form-control" name="penerbit" value="<?php echo $penerbit; ?>">
                        </div>
                        <div class="form-group">
                            <label>Tempat Terbit</label>
                            <input type="text" class="form-control" name="tempat_terbit" value="<?php echo $tempat_terbit; ?>">
                        </div>
                        <div class="form-group">
                            <label>Tahun Terbit</label>
                            <input type="number" class="form-control" name="tahun_terbit" value="<?php echo $tahun; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group"><label>Cetakan/Edisi</label><input type="text" class="form-control" name="cetakan_edisi" value="<?php echo $cetakan_edisi; ?>"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"><label>Deskripsi Fisik</label><input type="text" class="form-control" name="deskripsi_fisik" value="<?php echo $deskripsi_fisik; ?>"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group"><label>ISBN</label><input type="text" class="form-control" name="isbn" value="<?php echo $isbn; ?>"></div>
                    </div>
                </div>
                <div class="form-group"><label>Nomor Induk Buku</label><input type="text" class="form-control" name="nomor_induk_buku" value="<?php echo $nomor_induk_buku; ?>"></div>
            </div>

            <div id="meta_artikel" class="meta-group" style="display:none;">
                <h4 class="text-success"><i class="fa fa-newspaper-o"></i> Metadata Artikel Hukum</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Judul Artikel</label>
                            <input type="text" class="form-control" name="judul_artikel" value="<?php echo $tentang; ?>">
                        </div>
                        <div class="form-group">
                            <label>Penulis Artikel</label>
                            <input type="text" class="form-control" name="penulis_artikel" value="<?php echo $penulis; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Jurnal / Sumber</label>
                            <input type="text" class="form-control" name="nama_jurnal" value="<?php echo $sumber; ?>">
                        </div>
                        <div class="form-group">
                            <label>Tempat Terbit</label>
                            <input type="text" class="form-control" name="tempat_terbit_art" value="<?php echo $tempat_terbit; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4"><div class="form-group"><label>Volume</label><input type="text" class="form-control" name="volume" value="<?php echo $volume; ?>"></div></div>
                    <div class="col-md-4"><div class="form-group"><label>Halaman</label><input type="text" class="form-control" name="halaman" value="<?php echo $halaman; ?>"></div></div>
                    <div class="col-md-4"><div class="form-group"><label>Tahun</label><input type="number" class="form-control" name="tahun_terbit_art" value="<?php echo $tahun; ?>"></div></div>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Subjek <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="subjek" value="<?php echo $subjek; ?>" required placeholder="Contoh: RETRIBUSI">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Bidang Hukum</label>
                        <input type="text" class="form-control" name="bidang_hukum" value="<?php echo $bidang_hukum; ?>" placeholder="Contoh: Hukum Administrasi Negara">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Bahasa</label>
                        <input type="text" class="form-control" name="bahasa" value="<?php echo $bahasa; ?>" placeholder="Indonesia">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label>Lokasi Fisik</label>
                <input type="text" class="form-control" name="lokasi" value="<?php echo $lokasi; ?>" placeholder="Contoh: Lemari A">
            </div>

            <hr>
            <div class="form-group">
                <label>Upload File (PDF) <span class="text-danger">*</span></label>
                <input type="file" name="file" class="form-control">
                <?php if($file){ ?>
                    <p class="help-block">File saat ini: <a href="<?php echo base_url('uploads/produk_hukum/'.$file) ?>" target="_blank"><?php echo $file; ?></a></p>
                <?php } ?>
            </div>

             <div class="form-group">
                <label>Status Publikasi</label>
                <select name="status" class="form-control">
                    <option value="1" <?php echo ($status=='1') ? 'selected' : ''; ?>>Publish</option>
                    <option value="0" <?php echo ($status=='0') ? 'selected' : ''; ?>>Draft</option>
                </select>
            </div>

            <input type="hidden" name="id_produk_hukum" value="<?php echo $id_produk_hukum; ?>" /> 
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-save"></i> Simpan Data</button> 
            <a href="<?php echo site_url('ta_produk_hukum') ?>" class="btn btn-default btn-lg">Batal</a>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        
        function checkKategori() {
            var selectedText = $("#id_kategori option:selected").text().toLowerCase();
            
            $(".meta-group").hide();

            // 1. PUTUSAN PENGADILAN (Wajib ada kata 'pengadilan' atau 'mahkamah')
            if (selectedText.includes("pengadilan") || selectedText.includes("mahkamah")) {
                $("#meta_putusan").show();
            } 
            // 2. MONOGRAFI / BUKU
            else if (selectedText.includes("monografi") || selectedText.includes("buku") || selectedText.includes("naskah")) {
                $("#meta_monografi").show();
            }
            // 3. ARTIKEL / JURNAL
            else if (selectedText.includes("artikel") || selectedText.includes("jurnal") || selectedText.includes("majalah")) {
                $("#meta_artikel").show();
            }
            // 4. BELUM PILIH
            else if (selectedText.includes("pilih jenis")) {
                $(".meta-group").hide();
            }
            // 5. DEFAULT: PERATURAN (Termasuk Keputusan Bupati, Perda, dll)
            else {
                $("#meta_peraturan").show();
            }
        }

        checkKategori();

        $("#id_kategori").change(function() {
            checkKategori();
        });
    });
</script>