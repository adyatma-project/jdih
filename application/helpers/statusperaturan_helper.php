<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	function getubahstatus($id_status_perubahan){
		$status="0";
		if ($id_status_perubahan=="1"){
			$status="2";
		}
		elseif ($id_status_perubahan=="3") {
			$status="4";
		}
		elseif ($id_status_perubahan=="5") {
			$status="6";
		}
	return $status;
	}

	function getpengubahstatus($id_status_perubahan){
		$status="0";
		if ($id_status_perubahan=="2"){
			$status="Mencabut";
		}
		elseif ($id_status_perubahan=="4") {
			$status="Mengubah";
		}
		elseif ($id_status_perubahan=="6") {
			$status="Membatalkan";
		}
	return $status;
	}

	function getstatusperubahan($id_status_perubahan){
		$status="0";
		if ($id_status_perubahan=="1"){
			$status="Dicabut";
			$id_status="2";
		}
		elseif ($id_status_perubahan=="3") {
			$status="Diubah";
			$id_status="4";
		}
		elseif ($id_status_perubahan=="5") {
			$status="Tidak Berlaku Setelah";
			$id_status="6";
		}
	$hasil = array(
		'status' =>$status,
		'id_status' => $id_status,
		);
	return $id_status.'.'.$status;
	}
?>