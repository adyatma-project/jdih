<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function tanggal($tanggal)
{
	$bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	
	if ($tanggal=="0000-00-00" || $tanggal==NULL)
	{
		

	
	return "-";

	}
	else
	{
		$split = explode('-', $tanggal);
		return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];

	}
	
}
?>