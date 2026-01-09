<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h3 class="mt-4 mb-4">Berita</h3>
            <?php foreach ($ta_berita_data as $value) { ?>
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?php echo base_url(); ?>/uploads/berita/medium/<?= $value->file ?>" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $value->judul ?></h5>
                                <p class="card-text"><?= substr($value->isi, 0, 200) . '... ' ?></p>
                                <p class="card-text"><small class="text-muted"><?= $value->tgl_insert . " || " . $value->user . " || " . $value->viewer . " Dilihat" ?></small></p>
                                <a href="#" class="btn btn-primary">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="pagination">
                <?php echo $pagination ?>
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
        </div>
    </div>
</div>
