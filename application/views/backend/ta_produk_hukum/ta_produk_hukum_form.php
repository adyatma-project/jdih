<section class="content-header">
	<h1>
		Tambah/Ubah Data
		<small>Produk Hukum</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
		<li class="active">Here</li>
	</ol>
</section>

<!-- Main content -->
<section class="content container-fluid">

	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">Produk Hukum</h3>
		</div>
		<div class="box-body">
			<div class="col-md-6">
				<?php echo form_open_multipart($action); ?>

				<div class="form-group">
					<label for="varchar">Judul Peraturan <?php echo form_error('judul_peraturan') ?></label>
					<input type="text" class="form-control" name="judul_peraturan" id="judul_peraturan" placeholder="Judul Peraturan" value="<?php echo $judul_peraturan; ?>" />
				</div>

				<div class="form-group row">
					<div class="col-xs-8">
						<label for="int">Jenis <?php echo form_error('id_kategori') ?></label>
						<select class="form-control" name="id_kategori" id="id_kategori">
							<option value="">- Pilih Jenis -</option>
							<?php
							foreach ($kategori as $value) {
								if ($id_kategori == $value->id_kategori) {
									$selected = "selected";
								} else {
									$selected = "";
								}
							?>
								<option value="<?php echo $value->id_kategori ?>" <?php echo $selected ?>><?php echo $value->kategori ?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-xs-6">
						<label for="varchar">No. Peraturan <?php echo form_error('no_peraturan') ?></label>
						<input type="text" class="form-control" name="no_peraturan" id="no_peraturan" placeholder="No Peraturan" value="<?php echo $no_peraturan; ?>" />
					</div>
				</div>

				<div class="form-group row">
					<div class="col-xs-3">
						<label for="int">Tahun <?php echo form_error('tahun') ?></label>
						<input type="text" class="form-control" name="tahun" id="tahun" placeholder="Tahun" value="<?php echo $tahun; ?>" />
					</div>
				</div>

				<div class="form-group">
					<label for="varchar">Tentang <?php echo form_error('tentang') ?></label>
					<input type="text" class="form-control" name="tentang" id="tentang" placeholder="Tentang" value="<?php echo $tentang; ?>" />
				</div>

				<div class="form-group">
					<label for="abstrak">Abstrak <?php echo form_error('abstrak') ?></label>
					<textarea class="form-control" rows="3" name="abstrak" id="abstrak" placeholder="Abstrak"><?php echo $abstrak; ?></textarea>
				</div>




			</div>
			<div class="col-md-6">
				<div class="form-group row">
					<div class="col-xs-4">
						<label for="int">Status Peraturan <?php echo form_error('id_status_peraturan') ?></label>
						<select class="form-control" name="id_status_peraturan" id="id_status_peraturan" <?php echo $disabled ?>>

							<option value="0">Baru</option>
							<?php
							foreach ($status_peraturan as $value) {
								if ($id_status_peraturan == $value->id_status_peraturan) {
									$selected = "selected";
								} else {
									$selected = "";
								}
							?>
								<option value="<?php echo $value->id_status_peraturan ?>" <?php echo $selected ?>><?php echo $value->nama_status_peraturan ?></option>
							<?php
							}
							?>
						</select>
					</div>

				</div>
				<?php if ($id_status_peraturan == "0" || $id_status_peraturan == "2" || $id_status_peraturan == "4" || $id_status_peraturan == "6" || $id_status_peraturan == NULL) {
				?>

				<?php
				} else {
				?>

					<span id="myP">
						<div class="form-group">
							<label for="int">Subject/Keterangan Status <?php echo form_error('id_sumber_perubahan') ?></label> *)
							<em>Pilih Sumber Subject/Keterangan Status</em> <br>
							<div class="col-xs-11">

								<select class="form-control select2" name="id_sumber_perubahan" id="id_sumber_perubahan">
									<option value="">- Pilih Produk Hukum</option>
									<?php foreach ($list_produk_hukum as $value) {
										if ($id_sumber_perubahan == $value->id_produk_hukum) {
											$selected = "selected";
										} else {
											$selected = "";
										}
									?>
										<option value="<?php echo $value->id_produk_hukum ?>" <?php echo $selected ?>><?php echo "Nomor " . $value->no_peraturan . " Tahun " . $value->tahun . " Tentang " . $value->tentang; ?></option>
									<?php
									}
									?>
								</select>

							</div>
							<div class="col-xs-1">
								<span class="btn btn-success" id="tambah_status">+</span>
							</div>
							<br>
							<br>
							<table class="table table-responsive table-bordered">
								<thead>
									<tr>
										<th></th>
										<th>Peraturan</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody id="isi-subject"></tbody>
							</table>
							<span id="isi-subject1"></span>
							<input type="hidden" name="subject_produk" id="subject_produk"></input>
							<input type="hidden" name="subject_status" id="subject_status"></input>
						</div>
					</span>
				<?php
				}
				?>


				<div class="form-group">
					<label for="int">Keterangan Lainnya <?php echo form_error('keterangan_lainnya') ?></label>
					<input type="text" class="form-control" name="keterangan_lainnya" id="keterangan_lainnya" placeholder="keterangan Lainnya" value="<?php echo $keterangan_lainnya; ?>" />
				</div>

				<div class="form-group row">
					<div class="col-xs-6">
						<label for="date">Tangggal Peraturan <?php echo form_error('tgl_peraturan') ?></label>
						<div class="input-group date">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control pull-right" name="tgl_peraturan" id="tgl_peraturan" placeholder="Tgl Peraturan" value="<?php echo $tgl_peraturan; ?>" />
						</div>
					</div>
				</div>

				<div class="form-group row">
					<div class="col-xs-8">
						<label for="int">Pengarang <?php echo form_error('id_pengarang') ?></label>
						<select class="form-control" name="id_pengarang" id="id_pengarang">
							<option value="">- Pilih Jenis -</option>
							<?php
							foreach ($pengarang as $value) {
								if ($id_pengarang == $value->id_pengarang) {
									$selected = "selected";
								} else {
									$selected = "";
								}
							?>
								<option value="<?php echo $value->id_pengarang ?>" <?php echo $selected ?>><?php echo $value->pengarang ?></option>
							<?php
							}
							?>
						</select>
					</div>
				</div>

				<!-- <div class="form-group">
				<label for="int">Uji Material <?php echo form_error('pengarang') ?></label>
				<input type="text" class="form-control" name="pengarang" id="pengarang" placeholder="Uji Material" value="<?php echo $pengarang; ?>" />
			</div> -->
				<div class="form-group">
					<label for="int">Tempat Terbit <?php echo form_error('tempat_terbit') ?></label>
					<input type="text" class="form-control" name="tempat_terbit" id="tempat_terbit" placeholder="Tempat Terbit" value="<?php echo $tempat_terbit; ?>" />
				</div>

				<div class="form-group">
					<label for="int">Pemrakarsa <?php echo form_error('pemrakarsa') ?></label>
					<input type="text" class="form-control" name="pemrakarsa" id="pemrakarsa" placeholder="Pemrakarsa" value="<?php echo $pemrakarsa; ?>" />
				</div>
				<div class="form-group">
					<label for="int">Nomor Register<?php echo form_error('no_register') ?></label>
					<input type="text" class="form-control" name="no_register" id="no_register" placeholder="Nomor Register" value="<?php echo $no_register; ?>" />
				</div>



				<div class="form-group row">
					<div class="col-xs-12">
						<label for="varchar">File Peraturan (.pdf) : <?php echo $file; ?><?php echo form_error('imgName') ?></label>
						<input type="file" name="imgName">
						<input class="file-path validate" type="hidden" name="imgName">
					</div>
				</div>

				<div class="form-group row">
					<div class="col-xs-12">
						<label for="varchar">File Lampiran (.pdf) : <?php echo $file_lampiran; ?><?php echo form_error('file_lampiran') ?></label>
						<input type="file" name="file_lampiran">
						<input class="file-path validate" type="hidden" name="file_lampiran">
					</div>
				</div>

				<!-- <div class="form-group row">
					<div class="col-xs-12">
						<label for="varchar">File Abstrak (.pdf) : <?php echo $file_abstrak; ?><?php echo form_error('file_abstrak') ?></label>
						<input type="file" name="file_abstrak">
						<input class="file-path validate" type="hidden" name="file_abstrak">
					</div>
				</div> -->
			</div>
			<?php
			$jenis_lembaran = array('LD', 'BD');
			$jenis_tambahan = array('TLD', 'LL');
			?>


			<div class="col-md-12">
				<br>
				<div class="box box-solid box-success" data-widget="box-widget">
					<div class="box-header">
						<div style="text-align:center"><b>DESKRIPSI KATALOG</b></div>
					</div>
					<div class="box-body">
						<div class="col-md-12">
							<div class="col-md-6">
								<h4 class="text-center">Catatan Lembaran</h4>
								<hr>
								<div class="form-group">
									<label for="int">Jenis Lembaran <?php echo form_error('ktlglembaran_jenis') ?></label>
									<select class="form-control" name="ktlglembaran_jenis" id="ktlglembaran_jenis">
										<option value="-">-Pilih Jenis Lembaran-</option>
										<?php
										$selected = "";
										foreach ($jenis_lembaran as $v_jenis_lembaran) {
											if ($v_jenis_lembaran == $ktlglembaran_jenis) {
												$selected = "selected";
											} else {
												$selected = "";
											}
										?>
											<option value="<?= $v_jenis_lembaran ?>" <?= $selected ?>><?= $v_jenis_lembaran ?></option>
										<?php
										}
										?>

									</select>
									<!-- <input type="text" class="form-control" name="ktlglembaran_jenis" id="ktlglembaran_jenis" placeholder="Jenis Lembaran" value="<?php echo $ktlglembaran_jenis; ?>" /> -->
								</div>
								<div class="form-group">
									<label for="int">Tahun <?php echo form_error('ktlglembaran_tahun') ?></label>
									<input type="text" class="form-control" name="ktlglembaran_tahun" id="ktlglembaran_tahun" placeholder="Tahun" value="<?php echo $ktlglembaran_tahun; ?>" />
								</div>
								<div class="form-group">
									<label for="int">Nomor <?php echo form_error('ktlglembaran_no') ?></label>
									<input type="text" class="form-control" name="ktlglembaran_no" id="ktlglembaran_no" placeholder="Nomor" value="<?php echo $ktlglembaran_no; ?>" />
								</div>
								<div class="form-group">
									<label for="int">Jumlah Halaman <?php echo form_error('ktlglembaran_jum_halaman') ?></label>
									<input type="text" class="form-control" name="ktlglembaran_jum_halaman" id="ktlglembaran_jum_halaman" placeholder="Jumlah Halaman" value="<?php echo $ktlglembaran_jum_halaman; ?>" />
								</div>
							</div>

							<div class="col-md-6">
								<h4 class="text-center">Catatan Tambahan</h4>
								<hr>
								<div class="form-group">
									<label for="int">Jenis Lembaran <?php echo form_error('ktlgtambahan_jenis') ?></label>
									<select class="form-control" name="ktlgtambahan_jenis" id="ktlgtambahan_jenis">
										<option value="-">-Pilih Jenis Lembaran-</option>
										<?php
										$selected = "";
										foreach ($jenis_tambahan as $v_jenis_tambahan) {
											if ($v_jenis_tambahan == $ktlgtambahan_jenis) {
												$selected = "selected";
											} else {
												$selected = "";
											}
										?>
											<option value="<?= $v_jenis_tambahan ?>" <?= $selected ?>><?= $v_jenis_tambahan ?></option>
										<?php
										}
										?>

									</select>
									<!-- <input type="text" class="form-control" name="ktlgtambahan_jenis" id="ktlgtambahan_jenis" placeholder="Jenis Lembaran" value="<?php echo $ktlgtambahan_jenis; ?>" /> -->
								</div>

								<div class="form-group">
									<label for="int">Tahun <?php echo form_error('ktlgtambahan_tahun') ?></label>
									<input type="text" class="form-control" name="ktlgtambahan_tahun" id="ktlgtambahan_tahun" placeholder="Tahun" value="<?php echo $ktlgtambahan_tahun; ?>" />
								</div>

								<div class="form-group">
									<label for="int">Nomor <?php echo form_error('ktlgtambahan_no') ?></label>
									<input type="text" class="form-control" name="ktlgtambahan_no" id="ktlgtambahan_no" placeholder="Nomor" value="<?php echo $ktlgtambahan_no; ?>" />
								</div>

								<div class="form-group">
									<label for="int">Jumlah Halaman <?php echo form_error('ktlgtambahan_jum_halaman') ?></label>
									<input type="text" class="form-control" name="ktlgtambahan_jum_halaman" id="ktlgtambahan_jum_halaman" placeholder="Jumlah Halaman" value="<?php echo $ktlgtambahan_jum_halaman; ?>" />
								</div>

							</div>

						</div>
					</div>
				</div>
			</div>



			<!-- /.box-body -->

			<div class="box-footer">
				<div class="col-md-12">
					<div class="form-group pull-right">
						<input type="hidden" name="id_produk_hukum" value="<?php echo $id_produk_hukum; ?>" />
						<button type="submit" class="btn btn-primary"><?php echo $button ?></button>
						<a href="<?php echo site_url('ta_produk_hukum') ?>" class="btn btn-default">Batal</a>
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
			<!-- /.box-footer-->
		</div>

</section>