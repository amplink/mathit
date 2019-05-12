<?php
include_once ('_common.php');
$thisTime=date("m/d/Y");
$time = "05/14/2019";
$someTime=strtotime($thisTime)-strtotime("$time GMT");
$cha = ceil($someTime/(60*60*24));
echo $cha;
?>