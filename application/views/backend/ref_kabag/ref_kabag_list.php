<section class="content-header">
    <h1>Data Pejabat / Kabag Hukum</h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Daftar Pejabat</h3>
            <div class="box-tools pull-right">
                <?php echo anchor(site_url('ref_kabag/create'), '<i class="fa fa-plus"></i> Tambah', 'class="btn btn-primary btn-sm"'); ?>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th width="30">No</th>
                        <th>Foto</th>
                        <th>Nama & NIP</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th width="150">Aksi</th>
                    </tr>
                    <?php foreach ($ref_kabag_data as $row) { ?>
                    <tr>
                        <td><?php echo ++$start ?></td>
                        <td>
                            <?php if($row->foto): ?>
                                <img src="<?php echo base_url('uploads/pejabat/'.$row->foto) ?>" width="80" style="border-radius:10px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                            <?php else: ?>
                                <span class="label label-warning">No Foto</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <strong><?php echo $row->nama ?></strong><br>
                            <small class="text-muted">NIP: <?php echo $row->nip ?></small>
                        </td>
                        <td><?php echo $row->jabatan ?></td>
                        <td>
                            <?php echo ($row->status=='1') ? '<span class="label label-success">Aktif</span>' : '<span class="label label-default">Non-Aktif</span>'; ?>
                        </td>
                        <td>
                            <?php 
                            echo anchor(site_url('ref_kabag/update/'.$row->id_kabag),'<i class="fa fa-pencil"></i>', 'class="btn btn-sm btn-info"'); 
                            echo ' ';
                            // Tombol Hapus dengan ID khusus untuk trigger SweetAlert (opsional, saat ini pakai link biasa)
                            echo anchor(site_url('ref_kabag/delete/'.$row->id_kabag),'<i class="fa fa-trash"></i>','class="btn btn-sm btn-danger btn-hapus"'); 
                            ?>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            
            <div class="row">
                <div class="col-md-6">Total Data: <?php echo $total_rows ?></div>
                <div class="col-md-6 text-right"><?php echo $pagination ?></div>
            </div>
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