<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function selengkapnya($konten){
  $i = strpos($konten, '<batas>');
  if ($i !== false) {
   $i += strlen('<batas>');
    return substr($konten, 0, $i);
  }
 else return $konten;
}
?>