<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card my-4">
                <div class="card-body">
                    <h3 class="card-title text-center">Visi dan Misi</h3>
                    <hr>
                    <?php foreach ($visimisi as $value) { ?>
                        <div class="p-4">
                            <?php echo $value->visimisi; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card my-4">
                <div class="card-header">
                    Informasi Kontak
                </div>
                <div class="card-body">
                    <?php $info = $this->db->query('SELECT * FROM ref_aplikasi')->row(); ?>
                    <ul class="list-unstyled">
                        <li><strong>Alamat:</strong><br><?php echo $info->alamat ?></li>
                        <li><strong>Telepon:</strong><br><?php echo $info->no_telpn ?></li>
                        <li><strong>Fax:</strong><br><?php echo $info->fax ?></li>
                        <li><strong>Email:</strong><br><?php echo $info->email ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>