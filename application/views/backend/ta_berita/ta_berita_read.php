
        <h2 style="margin-top:0px">Ta_berita Read</h2>
        <table class="table">
	    <tr><td>Judul</td><td><?php echo $judul; ?></td></tr>
	    <tr><td>Isi</td><td><?php echo $isi; ?></td></tr>
	    <tr><td>Jenis Berita</td><td><?php echo $jenis_berita; ?></td></tr>
	    <tr><td>Tgl Insert</td><td><?php echo $tgl_insert; ?></td></tr>
	    <tr><td>Tgl Update</td><td><?php echo $tgl_update; ?></td></tr>
	    <tr><td>User</td><td><?php echo $user; ?></td></tr>
	    <tr><td>Viewer</td><td><?php echo $viewer; ?></td></tr>
	    <tr><td>File</td><td><?php echo $file; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('ta_berita') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>