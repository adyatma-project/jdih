    <section class="content-header">
        <h1>
            <?php echo $button ?> Data Slider
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Slider</li>
        </ol>
    </section>

    <section class="content container-fluid">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Form Slider</h3>
            </div>
            <div class="box-body">
                <?php echo form_open_multipart($action); ?>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="varchar">Judul Utama <?php echo form_error('judul') ?></label>
                            <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Besar" value="<?php echo $judul; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="varchar">Sub Judul (Opsional)</label>
                            <input type="text" class="form-control" name="sub_judul" id="sub_judul" placeholder="Keterangan singkat" value="<?php echo $sub_judul; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="varchar">Foto Slider (.jpg|.png) : <?php echo $foto; ?></label>
                            <input type="file" name="foto" class="form-control">
                            <p class="help-block">Disarankan ukuran gambar horizontal (misal: 1200x500 px)</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="int">Urutan Tampil</label>
                            <input type="number" class="form-control" name="urutan" id="urutan" value="<?php echo $urutan; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="enum">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" <?php echo ($status=='1')?'selected':''; ?>>Aktif</option>
                                <option value="0" <?php echo ($status=='0')?'selected':''; ?>>Non-Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <input type="hidden" name="id_slider" value="<?php echo $id_slider; ?>" /> 
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                <a href="<?php echo site_url('ta_slider') ?>" class="btn btn-default">Batal</a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </section>  