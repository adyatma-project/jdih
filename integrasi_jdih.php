<?PHP
header("Content-Type: application/json");
$servername = "localhost";
$username = "jdih";
$password = "ITd0nggala@9102";
$dbname = "jdih_donggala";
$port = "3306";
$varjson = [];
$row_array = (object)[];
$conn = new mysqli($servername . ":" . $port, $username, $password, $dbname);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$sql = "select ta_produk_hukum_det.id as det_id, ta_produk_hukum.id_produk_hukum, ta_produk_hukum.tentang AS judul, ref_kategori.kategori,
ref_kategori.singkatan AS singkatan_bentuk, ta_produk_hukum.no_peraturan, ref_pengarang.pengarang,
ta_produk_hukum.tempat_terbit, ta_produk_hukum.tahun,  ref_status_peraturan.nama_status_peraturan, 
ta_produk_hukum.tgl_peraturan, ta_produk_hukum.file, ta_produk_hukum_katalog.pemrakarsa , ta_produk_hukum_katalog.no_register, ta_produk_hukum_katalog.ktlglembaran_jenis, ta_produk_hukum_katalog.ktlglembaran_tahun, ta_produk_hukum_katalog.ktlglembaran_no, ta_produk_hukum_katalog.ktlglembaran_jum_halaman
from ta_produk_hukum
LEFT JOIN ta_produk_hukum_det ON
ta_produk_hukum.id_produk_hukum=ta_produk_hukum_det.id_produk_hukum
LEFT JOIN ref_status_peraturan ON 
ta_produk_hukum_det.id_status_peraturan=ref_status_peraturan.id_status_peraturan
LEFT JOIN ref_kategori ON ta_produk_hukum.id_kategori=ref_kategori.id_kategori
LEFT JOIN ref_pengarang ON ta_produk_hukum.id_pengarang=ref_pengarang.id_pengarang
LEFT JOIN ta_produk_hukum_katalog ON ta_produk_hukum.id_produk_hukum=ta_produk_hukum_katalog.id_produk_hukum

GROUP BY ta_produk_hukum_det.id_produk_hukum, det_id HAVING MAX(det_id)
ORDER BY ta_produk_hukum_det.id_produk_hukum ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$row_array->idData = $row["id_produk_hukum"]; //berisi id dokumen
		$row_array->tahun_pengundangan = $row["tahun"]; //berisi tahun penetapan atau tahun terbit ex. 2019
		$row_array->tanggal_pengundangan = $row["tgl_peraturan"]; //berisi tahun bulan tanggal (YYYY-MM-DD) ex. 2019-04-22
		$row_array->jenis = $row["kategori"]; //berisi jenis peraturan ex. Peraturan Daerah
		$row_array->noPeraturan = $row["no_peraturan"]; //berisi no peraturan ex. 24
		$row_array->judul = $row["kategori"] . ' Donggala Nomor ' . sprintf('%02d', $row["no_peraturan"]) . ' Tahun ' . $row["tahun"] . ' tentang ' . ucwords(strtolower($row["judul"]));
		$row_array->noPanggil = '-'; //khusus untuk monografi/buku
		$row_array->singkatanJenis = $row["singkatan_bentuk"]; //berisi singkatan dari jenis ex. Perda
		$row_array->tempatTerbit = $row["tempat_terbit"]; //berisi tempat terbit
		$row_array->penerbit = 'Pemerintah Kab. Donggala'; //untuk dokumen bertipe monografi
		$row_array->deskripsiFisik = '-'; //khusus untuk monografi/buku
		$row_array->sumber = $row["ktlglembaran_jenis"] . ' Tahun ' . $row["ktlglembaran_tahun"] . ' (' . $row["ktlglembaran_no"] . '); ' . $row["ktlglembaran_jum_halaman"] . ' hlm'; //Lembar daerah atau menyesuaikan
		$row_array->subjek = '-'; //Kata kunci dari dokumen hukum
		$row_array->isbn = '-'; //khusus untuk monografi/buku
		$row_array->status = $row["nama_status_peraturan"]; //berisi status perundang undangan
		$row_array->bahasa = 'Indonesia'; //indonesia atau inggris
		$row_array->bidangHukum = '-'; //pembidangan dokumen hukum
		$row_array->teuBadan = 'Sulawesi Tengah.Kabupaten Donggala'; //nama instansi terkait
		$row_array->nomorIndukBuku = $row["no_register"]; //khusus untuk monografi/buku
		$row_array->fileDownload =  $row["file"]; //berisi nama file ex. peraturan.pdf, peraturan.docx
		//$row_array->urlDownload=$row["url"]; //sesuaikan pointing ke lokasi direktori storage file download
		$row_array->urlDownload = 'http://jdih.donggala.go.id/frontendprodukhukum/download/' . $row['id_produk_hukum']; //berisi url dan nama file ex. domain.com/peraturan.pdf
		//$row_array->urlDownload='http://jdih.instansi.go.id/ildis/www/storage/document/'.$file; //
		$row_array->urlDetailPeraturan = 'http://jdih.donggala.go.id/frontendprodukhukum/produk_hukum_page/' . $row["id_produk_hukum"]; //berisi link peraturan
		$row_array->operasi = "4";
		$row_array->display = "1";
		array_push($varjson, json_decode(json_encode($row_array)));
	}
	echo json_encode($varjson);
} else {
	echo "0 results";
}
$conn->close();