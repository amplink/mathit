<?php
include_once ('_common.php');
$ac = $_SESSION['client_no'];
$link = "/api/math/student_list?client_no=".$ac;
$r = api_calls_get($link);
var_dump($r);
?>