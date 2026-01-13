<section class="content-header">
    <h1>Kelola Interaksi Publik <small>Pengaduan & Survei</small></h1>
</section>

<section class="content">
    <div class="box box-primary" style="border-top: 3px solid #3c8dbc;">
        <div class="box-header with-border">
            <h3 class="box-title">Konfigurasi Link Google Form</h3>
        </div>
        
        <form action="<?php echo base_url('atur_interaksi/update'); ?>" method="post">
        <div class="box-body">
            
            <?php echo $this->session->flashdata('message'); ?>

            <div class="callout callout-info" style="margin-bottom: 20px;">
                <h4><i class="fa fa-info-circle"></i> Petunjuk</h4>
                <p>Masukkan Link Google Form (Embed HTML) agar formulir muncul di dalam website tanpa berpindah halaman.</p>
            </div>

            <div class="form-group bg-gray p-3" style="padding: 15px; border-radius: 5px; border-left: 5px solid #dd4b39; margin-bottom: 20px;">
                <label style="font-size: 16px;"><i class="fa fa-bullhorn"></i> 1. Link Pengaduan Hukum</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-link"></i></span>
                    <input type="text" name="link_pengaduan" class="form-control input-lg" value="<?php echo $link_pengaduan; ?>" required>
                </div>
            </div>

            <div class="form-group bg-gray p-3" style="padding: 15px; border-radius: 5px; border-left: 5px solid #00a65a; margin-bottom: 20px;">
                <label style="font-size: 16px;"><i class="fa fa-check-square-o"></i> 2. Link Survei Kepuasan</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-link"></i></span>
                    <input type="text" name="link_survei" class="form-control input-lg" value="<?php echo $link_survei; ?>" required>
                </div>
            </div>

            <div class="box-footer text-center">
                <button type="submit" class="btn btn-primary btn-lg btn-flat"><i class="fa fa-save"></i> SIMPAN PERUBAHAN</button> 
            </div>

        </div>
        </form>
    </div>
</section>