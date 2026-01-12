<section class="content-header">
    <h1>Form Link Eksternal</h1>
</section>
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <form action="<?php echo $action; ?>" method="post">
                <div class="form-group">
                    <label>Nama Link / Instansi</label>
                    <input type="text" class="form-control" name="nama_link" value="<?php echo $nama_link; ?>" placeholder="Contoh: Website Pemda Donggala" required />
                </div>
                <div class="form-group">
                    <label>URL (Wajib pakai http:// atau https://)</label>
                    <input type="url" class="form-control" name="url" value="<?php echo $url; ?>" placeholder="Contoh: https://donggalakab.go.id" required />
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1" <?php echo $status=='1'?'selected':''; ?>>Aktif</option>
                                <option value="0" <?php echo $status=='0'?'selected':''; ?>>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Urutan Tampil</label>
                            <input type="number" class="form-control" name="urutan" value="<?php echo $urutan; ?>" />
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id_link" value="<?php echo $id_link; ?>" /> 
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                <a href="<?php echo site_url('ta_link_eksternal') ?>" class="btn btn-default">Batal</a>
            </form>
        </div>
    </div>
</section>