<?PHP
header("Content-Type: application/json");
$servername = "localhost";
$username = "root";
$password = "jdih@!*K0m";
$dbname = "jdih_web";
$port = "3306";
$varjson = [];
$row_array = (object)[];
$conn = new mysqli($servername.":".$port, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql="select ta_produk_hukum_det.id as det_id, ta_produk_hukum.id_produk_hukum, ta_produk_hukum.tentang AS judul, ref_kategori.kategori, ta_produk_hukum.no_peraturan, ref_pengarang.pengarang,ta_produk_hukum.tempat_terbit, ta_produk_hukum.tahun,  ref_status_peraturan.nama_status_peraturan, ta_produk_hukum.tgl_peraturan, ta_produk_hukum.file from ta_produk_hukum
LEFT JOIN ta_produk_hukum_det ON
ta_produk_hukum.id_produk_hukum=ta_produk_hukum_det.id_produk_hukum
LEFT JOIN ref_status_peraturan ON 
ta_produk_hukum_det.id_status_peraturan=ref_status_peraturan.id_status_peraturan
LEFT JOIN ref_kategori ON ta_produk_hukum.id_kategori=ref_kategori.id_kategori
LEFT JOIN ref_pengarang ON ta_produk_hukum.id_pengarang=ref_pengarang.id_pengarang

GROUP BY ta_produk_hukum_det.id_produk_hukum, det_id HAVING MAX(det_id)
ORDER BY ta_produk_hukum_det.id_produk_hukum ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		$row_array->idData=$row["id_produk_hukum"];
		$row_array->tanggalData=$row["tahun"];
		$row_array->jenis=$row["kategori"];
		$row_array->noPeraturan=$row["no_peraturan"];
		$row_array->judul=$row["judul"];
		$row_array->tempatTerbit='Masamba';
		//$row_array->tempatTerbit=$row["tempat_terbit"];
		//$row_array->idkategori=11532; 
		//$row_array->tahun=$row['tahun']; 
		//$row_array->penerbit=$row["Penerbit.."];
		$row_array->status=$row["nama_status_peraturan"];
		//$row_array->bahasa=$row["Bahasa.."];
		$row_array->badanPengguna=$row["pengarang"];
		$row_array->fileDownload=$row["file"];
		$row_array->urlDownload='https://jdih.donggala.go.id/uploads/produk_hukum/'.$row["file"];
		$row_array->urlDetailPeraturan='https://jdih.donggala.go.id/frontendprodukhukum/produk_hukum_page/'.$row["id_produk_hukum"];
		$row_array->operasi="4";
		$row_array->display="1";
		array_push($varjson,json_decode(json_encode($row_array)));
    }
echo json_encode($varjson);
} else {
    echo "0 results";
}
$conn->close();
            ?>