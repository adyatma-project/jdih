<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mt-4 mb-4">Pencarian Info Hukum</h3>
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo site_url('Frontendinfohukum/info_hukum_list'); ?>" method="get">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <input type="text" class="form-control" name="nomor" placeholder="Nomor"
                                    value="<?php echo $nomor ?>">
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="text" class="form-control" name="tentang" placeholder="Tentang"
                                    value="<?php echo $tentang ?>">
                            </div>
                            <div class="col-md-2 mb-3">
                                <input type="text" class="form-control" name="tahun" placeholder="Tahun"
                                    value="<?php echo $tahun ?>">
                            </div>
                            <div class="col-md-2 mb-3">
                                <select class="form-select" name="id_kategori_info">
                                    <option value="">- Kategori -</option>
                                    <?php foreach($ref_kategori as $value) { ?>
                                    <option value="<?php echo $value->id_kategori ?>"
                                        <?php echo ($id_kategori_info == $value->id_kategori) ? 'selected' : '' ?>>
                                        <?php echo $value->kategori ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </div>
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
                                <th>Info Hukum</th>
                                <th>Tentang</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ta_info_hukum_data as $ta_info_hukum) { ?>
                            <tr>
                                <td><?php echo ++$start ?></td>
                                <td>
                                    <a
                                        href="<?php echo base_url()."frontendinfohukum/info_hukum_page/".$ta_info_hukum->id_info_hukum; ?>">
                                        <?php echo $ta_info_hukum->kategori; ?> Nomor <?php echo $ta_info_hukum->no; ?>
                                        Tahun <?php echo $ta_info_hukum->tahun ?>
                                    </a>
                                </td>
                                <td><?php echo $ta_info_hukum->judul ?></td>
                                <td><?php echo $ta_info_hukum->tgl ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            Total Record : <?php echo $total_rows ?>
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