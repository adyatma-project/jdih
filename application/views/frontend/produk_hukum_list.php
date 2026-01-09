<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mt-4 mb-4">Pencarian Produk Hukum</h3>
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo site_url('frontendprodukhukum/produk_hukum_list'); ?>" method="get">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <input type="text" class="form-control" name="no_peraturan" placeholder="No. Peraturan" value="<?php echo $no_peraturan ?>">
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="text" class="form-control" name="tentang" placeholder="Tentang" value="<?php echo $tentang ?>">
                            </div>
                            <div class="col-md-2 mb-3">
                                <input type="text" class="form-control" name="tahun" placeholder="Tahun" value="<?php echo $tahun ?>">
                            </div>
                            <div class="col-md-2 mb-3">
                                <select class="form-select" name="ref_kategori">
                                    <option value="">- Kategori -</option>
                                    <?php foreach ($ref_kategori as $value) { ?>
                                        <option value="<?php echo $value->id_kategori ?>" <?php echo ($kategori == $value->id_kategori) ? 'selected' : '' ?>><?php echo $value->kategori ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <select class="form-select" name="ref_status_peraturan">
                                    <option value="">- Status -</option>
                                    <?php foreach ($ref_status_peraturan as $value) { ?>
                                        <option value="<?php echo $value->id_status_peraturan ?>" <?php echo ($status_peraturan == $value->id_status_peraturan) ? 'selected' : '' ?>><?php echo $value->nama_status_peraturan ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Produk Hukum</th>
                                <th>Tentang</th>
                                <th>Tanggal</th>
                                <th>No. Register</th>
                                <th>Pemrakarsa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ta_produk_hukum_data as $ta_produk_hukum) { ?>
                                <tr>
                                    <td><?php echo ++$start ?></td>
                                    <td>
                                        <a href="<?php echo base_url() . "frontendprodukhukum/produk_hukum_page/" . $ta_produk_hukum->id_produk_hukum; ?>">
                                            <?php echo $ta_produk_hukum->kategori; ?> Nomor <?php echo $ta_produk_hukum->no_peraturan; ?> Tahun <?php echo $ta_produk_hukum->tahun ?>
                                        </a>
                                    </td>
                                    <td><?php echo $ta_produk_hukum->tentang ?></td>
                                    <td><?php echo tanggal($ta_produk_hukum->tgl_peraturan) ?></td>
                                    <td><?php echo $ta_produk_hukum->no_register ?></td>
                                    <td><?php echo $ta_produk_hukum->pemrakarsa ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            Total Data : <?php echo $total_rows ?>
                        </div>
                        <div class="col-md-6">
                            <div class="pagination">
                                <?php echo $pagination ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
