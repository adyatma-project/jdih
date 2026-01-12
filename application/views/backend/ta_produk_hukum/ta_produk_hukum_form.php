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
                        <option value="<?php echo $kat->id_kategori ?>" data-nama="<?php echo strtolower($kat->kategori); ?>" <?php echo ($id_kategori == $kat->id_kategori) ? 'selected' : ''; ?>>
                            <?php echo $kat->kategori ?>
                        </option>
                    <?php } ?>
                </select>
                <small class="text-muted">Metadata di bawah akan berubah sesuai kategori yang dipilih.</small>
            </div>

            <div id="meta_peraturan" class="meta-group" style="display:none;">
                <h4 class="text-primary"><i class="fa fa-gavel"></i> Metadata Peraturan</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Peraturan</label>
                            <input type="text" class="form-control" disabled value="Sesuai Kategori Diatas">
                        </div>
                        <div class="form-group">
                            <label>Nomor Peraturan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="no_peraturan" value="<?php echo $no_peraturan; ?>" placeholder="Contoh: 15">
                        </div>
                        <div class="form-group">
                            <label>Tahun <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="tahun" value="<?php echo $tahun; ?>" placeholder="Contoh: 2024">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Judul Peraturan (Tentang) <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="tentang" rows="3" placeholder="Nama lengkap peraturan..."><?php echo $tentang; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tempat Penetapan</label>
                            <input type="text" class="form-control" name="tempat_penetapan" value="<?php echo $tempat_penetapan; ?>" placeholder="Contoh: Donggala">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Penetapan</label>
                            <input type="date" class="form-control" name="tgl_penetapan" value="<?php echo $tgl_penetapan; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Pengundangan</label>
                            <input type="date" class="form-control" name="tgl_pengundangan" value="<?php echo $tgl_pengundangan; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                         <div class="form-group">
                            <label>Tanggal Diupload</label>
                            <input type="date" class="form-control" name="tgl_peraturan" value="<?php echo $tgl_peraturan; ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sumber (LN)</label>
                            <input type="text" class="form-control" name="sumber_ln" value="<?php echo $sumber_ln; ?>" placeholder="Lembaran Negara">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sumber (TLN)</label>
                            <input type="text" class="form-control" name="sumber_tln" value="<?php echo $sumber_tln; ?>" placeholder="Tambahan LN">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sumber (BN)</label>
                            <input type="text" class="form-control" name="sumber_bn" value="<?php echo $sumber_bn; ?>" placeholder="Berita Negara">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Subjek / Kata Kunci</label>
                    <input type="text" class="form-control" name="subjek" value="<?php echo $subjek; ?>" placeholder="Contoh: Pajak, Retribusi, Pendidikan">
                </div>
            </div>

            <div id="meta_putusan" class="meta-group" style="display:none;">
                <h4 class="text-primary"><i class="fa fa-balance-scale"></i> Metadata Putusan Pengadilan</h4>
                <div class="row">
                    <div class="col-md-6">
                         <div class="form-group">
                            <label>Nomor Putusan</label>
                            <input type="text" class="form-control" name="nomor_putusan" value="<?php echo $nomor_putusan; ?>">
                        </div>
                        <div class="form-group">
                            <label>Jenis Peradilan</label>
                            <select name="jenis_peradilan" class="form-control">
                                <option value="">- Pilih -</option>
                                <option value="Peradilan Umum" <?php echo ($jenis_peradilan=='Peradilan Umum')?'selected':''; ?>>Peradilan Umum</option>
                                <option value="Peradilan Agama" <?php echo ($jenis_peradilan=='Peradilan Agama')?'selected':''; ?>>Peradilan Agama</option>
                                <option value="Peradilan TUN" <?php echo ($jenis_peradilan=='Peradilan TUN')?'selected':''; ?>>Peradilan TUN</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Lembaga Peradilan</label>
                            <input type="text" class="form-control" name="lembaga_peradilan" value="<?php echo $lembaga_peradilan; ?>" placeholder="Contoh: Pengadilan Negeri Donggala">
                        </div>
                         <div class="form-group">
                            <label>Tanggal Putusan</label>
                            <input type="date" class="form-control" name="tgl_putusan" value="<?php echo $tgl_putusan; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Amar Putusan</label>
                    <textarea class="form-control" name="amar_putusan" rows="3" placeholder="Ringkasan Putusan..."><?php echo $amar_putusan; ?></textarea>
                </div>
            </div>

            <div id="meta_monografi" class="meta-group" style="display:none;">
                <h4 class="text-primary"><i class="fa fa-book"></i> Metadata Monografi/Buku</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Judul Buku</label>
                            <input type="text" class="form-control" name="judul_buku" value="<?php echo $tentang; ?>" placeholder="Diisi di field 'Tentang' sebagai Judul">
                        </div>
                        <div class="form-group">
                            <label>Penulis / Pengarang</label>
                            <input type="text" class="form-control" name="penulis" value="<?php echo $penulis; ?>">
                        </div>
                         <div class="form-group">
                            <label>Penerbit</label>
                            <input type="text" class="form-control" name="penerbit" value="<?php echo $penerbit; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>ISBN</label>
                            <input type="text" class="form-control" name="isbn" value="<?php echo $isbn; ?>">
                        </div>
                        <div class="form-group">
                            <label>Tahun Terbit</label>
                            <input type="number" class="form-control" name="tahun_terbit" value="<?php echo $tahun; ?>" placeholder="Diisi di field Tahun">
                        </div>
                         <div class="form-group">
                            <label>Klasifikasi</label>
                            <input type="text" class="form-control" name="klasifikasi" value="<?php echo $klasifikasi; ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div id="meta_artikel" class="meta-group" style="display:none;">
                <h4 class="text-primary"><i class="fa fa-newspaper-o"></i> Metadata Artikel Hukum</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Judul Artikel</label>
                            <input type="text" class="form-control" name="judul_artikel" value="<?php echo $tentang; ?>" placeholder="Diisi di field 'Tentang'">
                        </div>
                         <div class="form-group">
                            <label>Penulis</label>
                            <input type="text" class="form-control" name="penulis_artikel" value="<?php echo $penulis; ?>" placeholder="Nama Penulis">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Jurnal / Majalah</label>
                            <input type="text" class="form-control" name="nama_jurnal" value="<?php echo $nama_jurnal; ?>">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Volume / Nomor</label>
                                    <input type="text" class="form-control" name="volume" value="<?php echo $volume; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Halaman</label>
                                    <input type="text" class="form-control" name="halaman" value="<?php echo $halaman; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="form-group">
                <label>Upload File Dokumen (PDF) <span class="text-danger">*</span></label>
                <input type="file" name="file" class="form-control">
                <?php if($file){ ?>
                    <p class="help-block">File saat ini: <a href="<?php echo base_url('uploads/produk_hukum/'.$file) ?>" target="_blank"><?php echo $file; ?></a></p>
                <?php } ?>
            </div>

             <div class="form-group">
                <label>Status Publikasi</label>
                <select name="status" class="form-control">
                    <option value="1" <?php echo ($status=='1') ? 'selected' : ''; ?>>Publish (Tampil)</option>
                    <option value="0" <?php echo ($status=='0') ? 'selected' : ''; ?>>Draft (Sembunyikan)</option>
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
            // Ambil text dari option yang dipilih (karena ID kategori mungkin beda-beda di DB)
            // Kita deteksi berdasarkan kata kuncinya
            var selectedText = $("#id_kategori option:selected").text().toLowerCase();
            
            // Sembunyikan semua dulu
            $(".meta-group").hide();

            // Logika Tampil
            if (selectedText.includes("putusan") || selectedText.includes("pengadilan")) {
                $("#meta_putusan").show();
            } 
            else if (selectedText.includes("monografi") || selectedText.includes("buku")) {
                $("#meta_monografi").show();
            }
            else if (selectedText.includes("artikel") || selectedText.includes("jurnal")) {
                $("#meta_artikel").show();
            }
            else {
                // Default ke Peraturan jika kosong atau kategori lain (Perda, Perbup, dll)
                $("#meta_peraturan").show();
            }
        }

        // Jalankan saat load (untuk mode edit)
        checkKategori();

        // Jalankan saat diganti
        $("#id_kategori").change(function() {
            checkKategori();
        });
    });
</script>