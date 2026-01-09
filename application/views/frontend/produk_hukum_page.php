<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card my-4">
                <div class="card-header">
                    <a href="<?php echo base_url() ?>frontendprodukhukum/produk_hukum_list" class="btn btn-sm btn-light"> << Kembali ke Pencarian</a>
                </div>
                <div class="card-body">
                    <h4 class="card-title text-center"><?php echo ucwords(strtolower($kategori)); ?> Nomor <?php echo $no_peraturan; ?> Tahun <?php echo $tahun ?></h4>
                    <hr>
                    <table class="table table-sm table-borderless">
                        <tbody>
                            <tr>
                                <td style="width: 150px;"><strong>Tentang</strong></td>
                                <td>: <?php echo ucwords(strtolower($tentang)); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>: 
                                <?php
                                $get_status = $this->db->query('SELECT ref_status_peraturan.nama_status_peraturan, ta_produk_hukum_det.id_status_peraturan, ta_produk_hukum_det.id_sumber_perubahan FROM ta_produk_hukum_det LEFT JOIN ref_status_peraturan ON ta_produk_hukum_det.id_status_peraturan=ref_status_peraturan.id_status_peraturan WHERE ta_produk_hukum_det.id_produk_hukum=' . $id_produk_hukum . '')->result();
                                $berlaku = '';
                                foreach ($get_status as $value) {
                                    if ($value->id_status_peraturan == "0" || $value->id_status_peraturan == NULL) {
                                        if ($keterangan_lainnya == '' or $keterangan_lainnya == NULL) {
                                            echo "<b>Berlaku</b>";
                                            $berlaku = 'Berlaku';
                                        } else {
                                            echo '<b>' . $keterangan_lainnya . '</b>';
                                        }
                                    } else {
                                        echo "<b>" . $value->nama_status_peraturan . ": </b>";
                                        if (!$value->id_sumber_perubahan == 0) {
                                            $sumber = $this->db->query('SELECT ta_produk_hukum.tahun, ta_produk_hukum.id_produk_hukum, ta_produk_hukum.no_peraturan, ref_kategori.kategori FROM ta_produk_hukum left join ref_kategori on ta_produk_hukum.id_kategori=ref_kategori.id_kategori WHERE ta_produk_hukum.id_produk_hukum=' . $value->id_sumber_perubahan . '')->row();
                                            if ($sumber) {
                                                echo "<a href='" . base_url() . "frontendprodukhukum/produk_hukum_page/" . $sumber->id_produk_hukum . "'>";
                                                echo $sumber->kategori . " Nomor " . $sumber->no_peraturan . " Tahun " . $sumber->tahun;
                                                echo "</a>";
                                            }
                                        }
                                    }
                                }
                                ?>
                                </td>
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
                                <td><strong>File Peraturan</strong></td>
                                <td>: <a href="<?php echo base_url() ?>frontendprodukhukum/download/<?php echo $id_produk_hukum ?>" target="_blank" class="btn btn-primary btn-sm">Unduh</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card my-4">
                <div class="card-header">
                    Abstrak
                </div>
                <div class="card-body">
                    <?php echo strip_tags($abstrak) ?>
                </div>
            </div>
            <div class="card my-4">
                <div class="card-header">
                    Dokumen
                </div>
                <div class="card-body">
                    <iframe src="<?php echo base_url() ?>assets/pdf.js/web/viewer.html?file=<?php echo base_url() ?>uploads/produk_hukum/<?php echo $file ?>" width="100%" height="800px"></iframe>
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
