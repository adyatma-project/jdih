<section class="content-header">
    <h1><?php echo $button ?> Pejabat</h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-body">
            <?php echo form_open_multipart($action); ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Nama Lengkap (beserta Gelar)</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>" required placeholder="Contoh: Budi Santoso, S.H., M.H." />
                    </div>
                    <div class="form-group">
                        <label>NIP (Opsional)</label>
                        <input type="text" class="form-control" name="nip" value="<?php echo $nip; ?>" placeholder="Nomor Induk Pegawai" />
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <input type="text" class="form-control" name="jabatan" value="<?php echo $jabatan; ?>" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Foto (.jpg|.png)</label>
                        <input type="file" class="form-control" name="foto">
                        <p class="help-block text-red">* Format Kotak (1:1) disarankan.</p>
                        <?php if($foto): ?>
                            <br><img src="<?php echo base_url('uploads/pejabat/'.$foto) ?>" width="100">
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1" <?php echo ($status=='1')?'selected':''; ?>>Aktif (Tampil di Depan)</option>
                            <option value="0" <?php echo ($status=='0')?'selected':''; ?>>Non-Aktif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Urutan</label>
                        <input type="number" class="form-control" name="urutan" value="<?php echo $urutan; ?>">
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <input type="hidden" name="id_kabag" value="<?php echo $id_kabag; ?>" /> 
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                <a href="<?php echo site_url('ref_kabag') ?>" class="btn btn-default">Batal</a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    // Cek apakah ada flashdata dari controller
    var swalIcon = "<?php echo $this->session->flashdata('swal_icon'); ?>";
    var swalTitle = "<?php echo $this->session->flashdata('swal_title'); ?>";
    var swalText = "<?php echo $this->session->flashdata('swal_text'); ?>";

    if(swalIcon){
        Swal.fire({
            icon: swalIcon,
            title: swalTitle,
            text: swalText,
            showConfirmButton: true,
            timer: (swalIcon == 'success') ? 2000 : null // Auto close jika sukses
        });
    }

    // Konfirmasi Hapus
    $('.btn-hapus').on('click', function(e){
        e.preventDefault();
        const href = $(this).attr('href');

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href;
            }
        })
    });
</script>