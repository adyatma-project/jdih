<section class="content-header">
    <h1>
        Produk Hukum
        <small>JDIH Kabupaten Donggala Versi 1.0</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Produk Hukum</a></li>
        <li class="active">List</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary"> <div class="box-header with-border">
            <h3 class="box-title">Daftar Produk Hukum</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
        
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>

            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-4">
                    <?php echo anchor(site_url('ta_produk_hukum/create'),'<i class="fa fa-plus"></i> Tambah Data', 'class="btn btn-primary"'); ?>
                    <?php echo anchor(site_url('ta_produk_hukum/excel'), '<i class="fa fa-file-excel-o"></i> Excel', 'class="btn btn-success"'); ?>
                </div>
                
                <div class="col-md-4 text-center">
                    <div style="margin-top: 8px" id="message"></div>
                </div>
                
                <div class="col-md-4 text-right">
                    <form action="<?php echo site_url('ta_produk_hukum/index'); ?>" class="form-inline" method="get">
                        <div class="input-group" style="width: 100%;">
                            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>" placeholder="Cari Nomor, Tahun, atau Tentang...">
                            <span class="input-group-btn">
                                <?php if ($q <> '') { ?>
                                    <a href="<?php echo site_url('ta_produk_hukum'); ?>" class="btn btn-default" title="Reset Pencarian"><i class="fa fa-refresh"></i></a>
                                <?php } ?>
                                <button class="btn btn-info" type="submit"><i class="fa fa-search"></i> Cari</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" style="margin-bottom: 10px">
                    <thead class="bg-gray">
                        <tr>
                            <th width="30px" class="text-center">No</th>
                            <th><i class="fa fa-balance-scale"></i> Produk Hukum</th>
                            <th>Tentang</th>
                            <th width="120px"><i class="fa fa-calendar"></i> Tanggal</th>
                            <th>Status</th>
                            <th width="50px" class="text-center"><i class="fa fa-eye"></i></th>
                            <th width="50px" class="text-center"><i class="fa fa-download"></i></th>
                            <th width="100px" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ta_produk_hukum_data as $ta_produk_hukum) { ?>
                        <tr>
                            <td class="text-center"><?php echo ++$start ?></td>
                            <td>
                                <strong><?php echo $ta_produk_hukum->kategori; ?></strong><br>
                                Nomor <?php echo $ta_produk_hukum->no_peraturan; ?> Tahun <?php echo $ta_produk_hukum->tahun ?>
                            </td>
                            <td><?php echo $ta_produk_hukum->tentang ?></td>
                            <td><?php echo date('d M Y', strtotime($ta_produk_hukum->tgl_peraturan)); ?></td>
                            
                            <td style="font-size: 12px;">
                                <?php
                                // Logika Status (Tidak diubah dari kode asli Anda)
                                $get_status = $this->db->query('SELECT ref_status_peraturan.nama_status_peraturan, ta_produk_hukum_det.id_status_peraturan, ta_produk_hukum_det.id_sumber_perubahan FROM ta_produk_hukum_det 
                                    LEFT JOIN ref_status_peraturan ON
                                    ta_produk_hukum_det.id_status_peraturan=ref_status_peraturan.id_status_peraturan
                                    WHERE ta_produk_hukum_det.id_produk_hukum='.$ta_produk_hukum->id_produk_hukum.'')->result();

                                if(empty($get_status)){
                                    echo "<span class='label label-success'>Berlaku</span>";
                                }

                                foreach ($get_status as $value) {
                                    if($value->id_status_peraturan=="0"||$value->id_status_peraturan==NULL ) {
                                        echo "<span class='label label-success'>Berlaku</span>";
                                    } else {
                                        echo "<b>".$value->nama_status_peraturan.": </b>";
                                        if (!$value->id_sumber_perubahan==0) {
                                            $sumber = $this->db->query('SELECT ta_produk_hukum.tahun, ta_produk_hukum.id_produk_hukum, ta_produk_hukum.no_peraturan, ref_kategori.kategori FROM ta_produk_hukum
                                            left join ref_kategori
                                            on ta_produk_hukum.id_kategori=ref_kategori.id_kategori
                                            WHERE ta_produk_hukum.id_produk_hukum='.$value->id_sumber_perubahan.'
                                            ')->row();
                                            if ($sumber) {
                                                echo "<br><a href=".base_url()."ta_produk_hukum/read/".$sumber->id_produk_hukum.">";
                                                echo $sumber->kategori; echo " No. ";  echo $sumber->no_peraturan; echo " Thn "; echo $sumber->tahun;
                                                echo "</a>";
                                            } else {
                                                echo "<i>Sumber Tidak Diketahui</i>";
                                            }
                                        }
                                    }
                                }

                                // Status diubah oleh
                                $get_status_ubah = $this->db->query('SELECT ref_status_peraturan.nama_status_peraturan, ta_produk_hukum_det.id_status_peraturan, ta_produk_hukum_det.id_sumber_perubahan, ta_produk_hukum_det.id_produk_hukum FROM ta_produk_hukum_det 
                                    LEFT JOIN ref_status_peraturan ON
                                    ta_produk_hukum_det.id_status_peraturan=ref_status_peraturan.id_status_peraturan
                                    WHERE ta_produk_hukum_det.id_sumber_perubahan='.$ta_produk_hukum->id_produk_hukum.'')->result();

                                foreach ($get_status_ubah as $value) {
                                    if ($value->id_status_peraturan=='2'|| $value->id_status_peraturan=='4'||$value->id_status_peraturan=='6') {
                                        echo "<br><b>".getpengubahstatus($value->id_status_peraturan).": </b>";
                                        $sumber = $this->db->query('SELECT ta_produk_hukum.tahun, ta_produk_hukum.id_produk_hukum, ta_produk_hukum.no_peraturan, ref_kategori.kategori FROM ta_produk_hukum
                                        left join ref_kategori
                                        on ta_produk_hukum.id_kategori=ref_kategori.id_kategori
                                        WHERE ta_produk_hukum.id_produk_hukum='.$value->id_produk_hukum.'
                                        ')->row();
                                        if ($sumber) {
                                            echo "<br><a href=".base_url()."ta_produk_hukum/read/".$sumber->id_produk_hukum.">";
                                            echo $sumber->kategori; echo " No. ";  echo $sumber->no_peraturan; echo " Thn "; echo $sumber->tahun;
                                            echo "</a>";
                                        } else {
                                            echo "<i>Sumber Tidak Diketahui</i>";
                                        }
                                    }
                                }
                                ?>
                            </td>
                            
                            <td class="text-center"><span class="badge bg-aqua"><?php echo $ta_produk_hukum->dilihat ?></span></td>
                            <td class="text-center"><span class="badge bg-green"><?php echo $ta_produk_hukum->didownload ?></span></td>
                            <td class="text-center">
                                <?php 
                                echo anchor(site_url('ta_produk_hukum/update/'.$ta_produk_hukum->id_produk_hukum),'<i class="fa fa-pencil-square-o"></i>', 'class="btn btn-sm btn-warning" title="Edit"'); 
                                echo " ";
                                echo anchor(site_url('ta_produk_hukum/delete/'.$ta_produk_hukum->id_produk_hukum),'<i class="fa fa-trash-o"></i>','class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm(\'Yakin Ingin Hapus ?\')"');
                                ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <span class="label label-info">Total Data : <?php echo $total_rows ?></span>
                </div>
                <div class="col-md-6 text-right">
                    <?php echo $pagination ?>
                </div>
            </div>
        </div>
        </div>
</section>