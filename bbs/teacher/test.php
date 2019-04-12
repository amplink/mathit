<?php
include_once ('_common.php');
$class = "초등 5학년(파이)";

$link = "/api/math/class?client_no=".$_SESSION['client_no'];
$r = api_calls_get($link);

for($i=0; $i<count($r); $i++) {
    if($r[$i][4] == $class) {
        $d_uid = $r[$i][0];
        $c_uid = $r[$i][1];
    }
}

$link = "/api/math/class_stu?client_no=".$_SESSION['client_no']."&d_uid=".$d_uid."&c_uid=".$c_uid;
$r = api_calls_get($link);

?>