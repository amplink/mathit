<?php
include_once ('_common.php');

$ac = $_SESSION['client_no'];
$link = "/api/math/class?client_no=".$ac;
$r = api_calls_get($link);

// 학기
$t_year = array();
$chk = 0;
$cnt = 0;

for($i=1; $i<count($r); $i++) {
    $chk = 0;
    for($j=0; $j<count($t_year); $j++) {
        if($t_year[$j] == $r[$i][3]) $chk = 1;
    }
    if(!$chk) {
        $t_year[$cnt] = $r[$i][3];
        $cnt++;
    }
}
$year = array();
$quarter = array();

for($i=0; $i<count($t_year); $i++) {
    $t = explode(" ", $t_year[$i]);
    $year[$i] = $t[0];
    $quarter[$i] = $t[1];
}
?>