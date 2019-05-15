<?php
//include_once ('_common.php');
$path = $_GET['path'];
$file = $_GET['file'];


$filename = $file;
$reail_filename = urldecode($file); 
$file_path = "../teacher/".$path.$reail_filename;


/*header('Content-Type: application/x-octetstream');
header('Content-Length: '.filesize($file_path));
//header('Content-Disposition: attachment; filename='.iconv('UTF-8','CP949',$reail_filename));
header("Content-Disposition: attachment; filename*=UTF-8''".rawurlencode($filename));
header('Content-Transfer-Encoding: binary');
*/

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($filename));
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . @filesize($file_path));


ob_clean();
flush();
@readfile($file_path);


?>

