<section class="content-header">
    <h1>
        Edit Halaman
        <small><?php echo $page->judul; ?></small>
    </h1>
</section>

<section class="content">
    <div class="box box-primary" style="border-top: 3px solid #3c8dbc;">
        <div class="box-header with-border">
            <h3 class="box-title">Form Editor Konten</h3>
        </div>
        
        <form action="<?php echo base_url('atur_halaman/update'); ?>" method="post">
            <input type="hidden" name="slug" value="<?php echo $page->slug; ?>">
            
            <div class="box-body">
                <?php echo $this->session->flashdata('message'); ?>

                <div class="form-group">
                    <label style="font-size: 16px;">Judul Halaman</label>
                    <input type="text" class="form-control" value="<?php echo $page->judul; ?>" readonly disabled style="background-color: #eee;">
                    <p class="help-block text-muted">Judul halaman default sistem.</p>
                </div>

                <div class="form-group">
                    <label style="font-size: 16px;">Isi Konten <span class="text-danger">*</span></label>
                    <textarea name="isi_konten" id="editor_konten" style="height: 500px; width: 100%;">
                        <?php echo $page->isi_konten; ?>
                    </textarea>
                </div>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> SIMPAN PERUBAHAN</button>
            </div>
        </form>
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