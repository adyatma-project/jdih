<section class="content-header">
    <h1>
        Detail Produk Hukum
        <small>JDIH Kabupaten Donggala</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Detail</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Metadata Dokumen</h3>
            <div class="box-tools pull-right">
                <a href="<?php echo site_url('ta_produk_hukum') ?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr><td width="200">Jenis Dokumen</td><td><strong><?php echo isset($kategori) ? $kategori : $id_kategori; ?></strong></td></tr>
                        <tr><td>Nomor Peraturan</td><td><?php echo $no_peraturan; ?></td></tr>
                        <tr><td>Tahun</td><td><?php echo $tahun; ?></td></tr>
                        <tr><td>Judul / Tentang</td><td><?php echo $tentang; ?></td></tr>
                        <tr><td>Status Peraturan</td><td><?php echo $id_status_peraturan; ?></td></tr>
                        <tr><td>Tanggal Diupload</td><td><?php echo tanggal($tgl_peraturan); ?></td></tr>
                        
                        <?php if(!empty($tempat_penetapan)) { ?>
                            <tr><td>Tempat Penetapan</td><td><?php echo $tempat_penetapan; ?></td></tr>
                        <?php } ?>
                        <?php if(!empty($tgl_penetapan)) { ?>
                            <tr><td>Tgl Penetapan</td><td><?php echo tanggal($tgl_penetapan); ?></td></tr>
                        <?php } ?>
                        <?php if(!empty($tgl_pengundangan)) { ?>
                            <tr><td>Tgl Pengundangan</td><td><?php echo tanggal($tgl_pengundangan); ?></td></tr>
                        <?php } ?>
                        <?php if(!empty($sumber_ln)) { ?>
                            <tr><td>Sumber (LN/TLN/BN)</td><td><?php echo "$sumber_ln / $sumber_tln / $sumber_bn"; ?></td></tr>
                        <?php } ?>
                    </table>
                </div>

                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <?php if(!empty($nomor_putusan)) { ?>
                            <tr><td width="150">Nomor Putusan</td><td><?php echo $nomor_putusan; ?></td></tr>
                            <tr><td>Jenis Peradilan</td><td><?php echo $jenis_peradilan; ?></td></tr>
                            <tr><td>Lembaga</td><td><?php echo $lembaga_peradilan; ?></td></tr>
                            <tr><td>Amar Putusan</td><td><?php echo $amar_putusan; ?></td></tr>
                        <?php } ?>

                        <?php if(!empty($isbn)) { ?>
                            <tr><td width="150">ISBN</td><td><?php echo $isbn; ?></td></tr>
                        <?php } ?>
                        <?php if(!empty($penulis)) { ?>
                            <tr><td width="150">Penulis</td><td><?php echo $penulis; ?></td></tr>
                        <?php } ?>
                        <?php if(!empty($penerbit)) { ?>
                            <tr><td>Penerbit</td><td><?php echo $penerbit; ?></td></tr>
                        <?php } ?>
                        <?php if(!empty($nama_jurnal)) { ?>
                            <tr><td>Jurnal</td><td><?php echo "$nama_jurnal (Vol: $volume, Hal: $halaman)"; ?></td></tr>
                        <?php } ?>

                        <tr><td>Abstrak</td><td><?php echo $abstrak; ?></td></tr>
                        <tr><td>Statistik</td><td><i class="fa fa-eye"></i> <?php echo $dilihat; ?> x Dilihat | <i class="fa fa-download"></i> <?php echo $didownload; ?> x Unduh</td></tr>
                    </table>
                </div>
            </div>

            <hr>
            
            <h4><i class="fa fa-file-pdf-o"></i> File Dokumen</h4>
            <?php if(!empty($file) && file_exists('./uploads/produk_hukum/'.$file)): ?>
                <div class="pdfitem" style="height: 800px; border: 1px solid #ddd;">
                    <object data="<?php echo base_url('uploads/produk_hukum/'.$file) ?>" type="application/pdf" width="100%" height="100%">
                        <p class="text-center" style="padding: 20px;">
                            Browser Anda tidak mendukung preview PDF.<br>
                            <a href="<?php echo base_url('uploads/produk_hukum/'.$file) ?>" class="btn btn-primary"><i class="fa fa-download"></i> Download File</a>
                        </p>
                    </object>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">File PDF tidak ditemukan atau belum diupload.</div>
            <?php endif; ?>

        </div>
    </div>
</section>