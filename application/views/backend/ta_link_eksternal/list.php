<section class="content-header">
    <h1>Manajemen Link Eksternal</h1>
</section>
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <?php echo anchor(site_url('ta_link_eksternal/create'), 'Tambah Data', 'class="btn btn-primary"'); ?>
        </div>
        <div class="box-body">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            <table class="table table-bordered table-striped" id="mytable">
                <thead>
                    <tr>
                        <th width="50px">No</th>
                        <th>Nama Link</th>
                        <th>URL Tujuan</th>
                        <th>Status</th>
                        <th>Urutan</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $start = 0; foreach ($data_link as $link) { ?>
                    <tr>
                        <td><?php echo ++$start ?></td>
                        <td><?php echo $link->nama_link ?></td>
                        <td><a href="<?php echo $link->url ?>" target="_blank"><?php echo $link->url ?></a></td>
                        <td><?php echo ($link->status == '1') ? '<span class="label label-success">Aktif</span>' : '<span class="label label-danger">Tidak Aktif</span>'; ?></td>
                        <td><?php echo $link->urutan ?></td>
                        <td style="text-align:center">
                            <?php 
                            echo anchor(site_url('ta_link_eksternal/update/'.$link->id_link),'<i class="fa fa-pencil"></i>', 'class="btn btn-warning btn-xs"'); 
                            echo ' '; 
                            echo anchor(site_url('ta_link_eksternal/delete/'.$link->id_link),'<i class="fa fa-trash"></i>','class="btn btn-danger btn-xs" onclick="return confirm(\'Yakin Hapus?\')"'); 
                            ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>