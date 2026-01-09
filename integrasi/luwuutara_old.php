<?PHP
//if (!isset($_SERVER['PHP_AUTH_USER'])) { 
//header('WWW-Authenticate: Basic realm="JDIH"'); 
//header('HTTP/1.0 401 Unauthorized'); 
// echo 'Fail To Authenticating'; 
//exit; 
//} else {
//if ($_SERVER['PHP_AUTH_USER'] == 'bagianhukumsetda@donggala.go.id' && md5($_SERVER['PHP_AUTH_PW']) == '09ff9706e7656aa4ebaf5909d6e75879') { 
if (1==1){
$DBHOST= "localhost" ;
$DBUSER= "root" ;
$DBPASSWORD= "jdih@!*K0m" ;
$DBNAME= "jdih_web";
$con=mysqli_connect($DBHOST,$DBUSER,$DBPASSWORD,$DBNAME);
$query='SELECT ta_produk_hukum.id_produk_hukum, ta_produk_hukum.no_peraturan, ta_produk_hukum.tentang, ta_produk_hukum.tahun, ta_produk_hukum.file, ta_produk_hukum.tgl_peraturan, ref_kategori.kategori, ref_status_peraturan.nama_status_peraturan from ta_produk_hukum LEFT JOIN ref_kategori on ref_kategori.id_kategori = ta_produk_hukum.id_kategori left join ref_status_peraturan ON ref_status_peraturan.id_status_peraturan = ta_produk_hukum.id_status_peraturan WHERE ta_produk_hukum.id_kategori = 2 OR ta_produk_hukum.id_kategori = 3 OR ta_produk_hukum.id_kategori = 5 ';
$res=mysqli_query($con,$query);
$response=array();
//$date = new DateTime();
while($result=mysqli_fetch_array($res)){
$row_array['tanggalData']=$result['tgl_peraturan'];
$row_array['idData']=$result['id_produk_hukum'];
$row_array['jenis']=$result['kategori'];
$row_array['urlDownload']='http://jdih.donggala.go.id/uploads/produk_hukum';
$row_array['urlDetailPeraturan']='';
//$row_array['tanggal']=$date->format('Y-m-d'); 
$row_array['tahun']=$result['tahun']; 
$row_array['operasi']=4; 
$row_array['noPeraturan']=(int)$result['no_peraturan']; 
$row_array['judul']=$result['tentang']; 
$row_array['fileDownload']=$result['file'];
$row_array['hasilUjiMateriMk']=$result['0']; 
$row_array['abstrak']=$result['0'];
$row_array['katalog']=$result['0'];
$row_array['status']=$result['nama_status_peraturan'];
$row_array['idkategori']=11532; 
$row_array['display']=1; 
array_push($response,$row_array);} 
header('Content-Type: application/json');
echo json_encode($response);}else{ 
header('WWW-Authenticate: Basic realm="JDIH"'); 
header('HTTP/1.0 401 Unauthorized'); 
 echo 'Fail To Authenticating'; 
exit; 
}
?>