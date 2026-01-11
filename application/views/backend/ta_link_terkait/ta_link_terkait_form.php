<section class="content">
    <div class="box">
        <div class="box-header with-border"><h3 class="box-title">Form Link</h3></div>
        <div class="box-body">
            <?php echo form_open_multipart($action); ?>
            <div class="form-group">
                <label>Nama Instansi / Link</label>
                <input type="text" class="form-control" name="nama_link" value="<?php echo $nama_link; ?>" required />
            </div>
            <div class="form-group">
                <label>URL (Gunakan http:// atau https://)</label>
                <input type="text" class="form-control" name="url" value="<?php echo $url; ?>" required />
            </div>
            <div class="form-group">
                <label>Logo</label>
                <input type="file" class="form-control" name="logo">
                <?php if($logo): ?><br><img src="<?php echo base_url('uploads/links/'.$logo) ?>" width="100"><?php endif; ?>
            </div>
            <div class="form-group">
                <label>Urutan</label>
                <input type="number" class="form-control" name="urutan" value="<?php echo $urutan; ?>">
            </div>
            <input type="hidden" name="id_link" value="<?php echo $id_link; ?>" />
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
            <a href="<?php echo site_url('ta_link_terkait') ?>" class="btn btn-default">Batal</a>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>