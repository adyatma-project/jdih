<section class="content-header">
    <h1>Form Berita <small>Editor Otomatis</small></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Berita</a></li>
        <li class="active">Form</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?php echo $button ?> Berita</h3>
        </div>
        
        <?php echo form_open($action); ?>
        <div class="box-body">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" class="form-control input-lg" name="judul" value="<?php echo $judul; ?>" placeholder="Masukkan Judul Berita" required />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label>Konten Berita</label>
                        <textarea name="konten" id="editor_konten"><?php echo $konten; ?></textarea>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label>Kategori Berita <span class="text-danger">*</span></label>
                        <select name="id_kategori" class="form-control select2" style="width: 100%;" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php 
                            if(!empty($ref_kategori_berita)) {
                                foreach ($ref_kategori_berita as $kat) { 
                                    $selected = ($kat->id_kategori == $id_kategori) ? 'selected' : '';
                                    echo "<option value='".$kat->id_kategori."' $selected>".$kat->kategori."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <input type="hidden" name="status" value="1">
                    
                    </div>
            </div>

            <input type="hidden" name="id_berita" value="<?php echo $id_berita; ?>" /> 
        </div>

        <div class="box-footer">
            <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Simpan & Publish</button> 
            <a href="<?php echo site_url('ta_berita') ?>" class="btn btn-default btn-lg">Batal</a>
        </div>
        <?php echo form_close(); ?>
    </div>
</section>

<script src="https://cdn.tiny.cloud/1/zfu2tijwpy11k5iwqissn730yqwg8zyiuwr4cml6udnjcquj/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  tinymce.init({
    selector: '#editor_konten',
    height: 600,
    plugins: 'image link media lists table code wordcount fullscreen preview searchreplace autolink',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image media | fullscreen code preview',
    images_upload_url: '<?php echo base_url("ta_berita/upload_image"); ?>',
    automatic_uploads: true,
    paste_data_images: true, 
    file_picker_types: 'image',
    branding: false
  });
</script>