<section class="content-header">
    <h1>Detail Slider</h1>
</section>
<section class="content">
    <div class="box">
        <div class="box-body">
            <table class="table table-bordered">
                <tr><td width="200">Judul</td><td><?php echo $judul; ?></td></tr>
                <tr><td>Sub Judul</td><td><?php echo $sub_judul; ?></td></tr>
                <tr><td>Foto</td><td>
                    <?php if($foto): ?>
                    <img src="<?php echo base_url('uploads/slider/'.$foto); ?>" class="img-responsive" style="max-height:300px;">
                    <?php endif; ?>
                </td></tr>
                <tr><td>Urutan</td><td><?php echo $urutan; ?></td></tr>
                <tr><td>Status</td><td><?php echo ($status=='1')?'Aktif':'Non-Aktif'; ?></td></tr>
                <tr><td></td><td><a href="<?php echo site_url('ta_slider') ?>" class="btn btn-default">Kembali</a></td></tr>
            </table>
        </div>
    </div>
</section>