<section class="content-header">
    <h1>
        Manajemen Slider
        <small>JDIH Kabupaten Donggala</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Slider</li>
    </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Daftar Slider</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="col-md-12">
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
            <div class="row" style="margin-bottom: 10px">
                <div class="col-md-8"></div>
                <div class="col-md-4 text-right">
                    <?php echo anchor(site_url('ta_slider/create'), '<i class="fa fa-plus"></i> Tambah Slider', 'class="btn btn-primary"'); ?>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" style="margin-bottom: 10px">
                    <tr>
                        <th width="30">No</th>
                        <th>Foto</th>
                        <th>Judul Utama</th>
                        <th>Sub Judul</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                    <?php
                    foreach ($ta_slider_data as $slider) {
                    ?>
                        <tr>
                            <td><?php echo ++$start ?></td>
                            <td>
                                <?php if($slider->foto != ""): ?>
                                    <img src="<?php echo base_url()."uploads/slider/".$slider->foto ?>" width="120px" style="border-radius:5px;">
                                <?php else: ?>
                                    <span class="label label-warning">No Image</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $slider->judul ?></td>
                            <td><?php echo $slider->sub_judul ?></td>
                            <td><?php echo $slider->urutan ?></td>
                            <td>
                                <?php if($slider->status == '1'): ?>
                                    <span class="label label-success">Aktif</span>
                                <?php else: ?>
                                    <span class="label label-danger">Non-Aktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php 
                                echo anchor(site_url('ta_slider/read/'.$slider->id_slider),'<i class="fa fa-eye"></i>', 'class="btn btn-sm btn-success"'); 
                                echo ' ';
                                echo anchor(site_url('ta_slider/update/'.$slider->id_slider),'<i class="fa fa-pencil-square-o"></i>', 'class="btn btn-sm btn-info"'); 
                                echo ' ';
                                echo anchor(site_url('ta_slider/delete/'.$slider->id_slider),'<i class="fa fa-trash-o"></i>','class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin Ingin Hapus ?\')"');
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Total Data : <?php echo $total_rows ?>
                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>
            </div>
        </div>
    </div>
</section>