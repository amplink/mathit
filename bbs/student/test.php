<?php
include_once ('_common.php');
$ac = $_SESSION['client_id'];
$link = "/api/math/bus?client_no=".$ac;
$r = api_calls_get($link);
?>