<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card my-4">
                <div class="card-header">
                    <a href="<?php echo base_url() ?>frontendinfohukum/info_hukum_list" class="btn btn-sm btn-light"> << Kembali ke Pencarian</a>
                </div>
                <div class="card-body">
                    <h4 class="card-title text-center"><?php echo $kategori; ?> Nomor <?php echo $no; ?></h4>
                    <hr>
                    <table class="table table-sm table-borderless">
                        <tbody>
                            <tr>
                                <td style="width: 150px;"><strong>Tentang</strong></td>
                                <td>: <?php echo $judul; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Deskripsi</strong></td>
                                <td>: <?php echo $deskripsi; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal</strong></td>
                                <td>: <?php echo $tgl; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tahun</strong></td>
                                <td>: <?php echo $tahun; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Kategori</strong></td>
                                <td>: <?php echo $kategori; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Dilihat</strong></td>
                                <td>: <?php echo $dilihat; ?> kali</td>
                            </tr>
                            <tr>
                                <td><strong>Diunduh</strong></td>
                                <td>: <?php echo $didownload; ?> kali</td>
                            </tr>
                            <tr>
                                <td><strong>File</strong></td>
                                <td>: <a href="<?php echo base_url() ?>frontendinfohukum/download/<?php echo $id_info_hukum ?>" target="_blank" class="btn btn-primary btn-sm">Unduh</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card my-4">
                <div class="card-header">
                    Dokumen
                </div>
                <div class="card-body">
                    <iframe src="<?php echo base_url() ?>assets/pdf.js/web/viewer.html?file=<?php echo base_url() ?>uploads/info_hukum/<?php echo $file ?>" width="100%" height="800px"></iframe>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card my-4">
                <div class="card-header">
                    Produk Hukum Populer
                </div>
                <ul class="list-group list-group-flush">
                    <?php foreach($ta_produk_hukum_populer as $value) { ?>
                        <li class="list-group-item">
                            <a href="<?php echo base_url()."frontendprodukhukum/produk_hukum_page/".$value->id_produk_hukum; ?>">
                                <?php echo $value->kategori; ?> Nomor <?php echo $value->no_peraturan; ?> Tahun <?php echo $value->tahun; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="card my-4">
                <div class="card-header">
                    Berita Terkini
                </div>
                <ul class="list-group list-group-flush">
                    <?php foreach($ta_berita as $value) { ?>
                        <li class="list-group-item">
                            <a href="#"><?php echo $value->judul; ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>