<section class="content-header">
    <h1>Manajemen Link Terkait / Jejaring</h1>
</section>
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <?php echo anchor(site_url('ta_link_terkait/create'), 'Tambah Link', 'class="btn btn-primary"'); ?>
        </div>
        <div class="box-body">
            <?php echo $this->session->userdata('message'); ?>
            <table class="table table-bordered">
                <tr><th>No</th><th>Logo</th><th>Nama Instansi</th><th>URL</th><th>Aksi</th></tr>
                <?php foreach ($ta_link_data as $link) { ?>
                <tr>
                    <td><?php echo ++$start ?></td>
                    <td>
                        <?php if($link->logo): ?><img src="<?php echo base_url('uploads/links/'.$link->logo) ?>" width="60"><?php endif; ?>
                    </td>
                    <td><?php echo $link->nama_link ?></td>
                    <td><?php echo $link->url ?></td>
                    <td>
                        <?php echo anchor(site_url('ta_link_terkait/update/'.$link->id_link),'Edit', 'class="btn btn-xs btn-info"'); ?>
                        <?php echo anchor(site_url('ta_link_terkait/delete/'.$link->id_link),'Hapus','class="btn btn-xs btn-danger" onclick="return confirm(\'Yakin?\')"'); ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</section>