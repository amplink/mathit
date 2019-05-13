<?php
include_once ('_common.php');
$path = $_GET['path'];
$file = $_GET['file'];


$filename = $file;
$reail_filename = urldecode($file);
$file_dir = "../teacher/".$path.$reail_filename;


header('Content-Type: application/x-octetstream');
header('Content-Length: '.filesize($file_dir));
//header('Content-Disposition: attachment; filename='.iconv('UTF-8','CP949',$reail_filename));
header("Content-Disposition: attachment; filename*=UTF-8''".rawurlencode($filename));
header('Content-Transfer-Encoding: binary');

ob_clean();
flush();
readfile($file_dir);


