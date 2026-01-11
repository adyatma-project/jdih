<section class="content">
    <div class="box">
        <div class="box-body">
            <table class="table">
                <tr><td>Nama</td><td><?php echo $nama; ?></td></tr>
                <tr><td>NIP</td><td><?php echo $nip; ?></td></tr>
                <tr><td>Jabatan</td><td><?php echo $jabatan; ?></td></tr>
                <tr><td>Foto</td><td><img src="<?php echo base_url('uploads/pejabat/'.$foto); ?>" width="200"></td></tr>
                <tr><td></td><td><a href="<?php echo site_url('ref_kabag') ?>" class="btn btn-default">Kembali</a></td></tr>
            </table>
        </div>
    </div>
</section>
    