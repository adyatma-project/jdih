<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Detail Slider</h3>
        </div>
        <div class="box-body">
            <table class="table">
                <tr><td>Judul</td><td><?php echo $judul; ?></td></tr>
                <tr><td>Sub Judul</td><td><?php echo $sub_judul; ?></td></tr>
                <tr><td>Foto</td><td><img src="<?php echo base_url('uploads/slider/'.$foto); ?>" width="50%"></td></tr>
                <tr><td>Urutan</td><td><?php echo $urutan; ?></td></tr>
                <tr><td>Status</td><td><?php echo ($status=='1')?'Aktif':'Non-Aktif'; ?></td></tr>
                <tr><td>Tgl Input</td><td><?php echo $tgl_input; ?></td></tr>
                <tr><td></td><td><a href="<?php echo site_url('ta_slider') ?>" class="btn btn-default">Kembali</a></td></tr>
            </table>
        </div>
    </div>
</section>