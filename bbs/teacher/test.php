<?php
include_once ('_common.php');

$ac = $_SESSION['client_no'];
$link = "/api/math/class?client_no=".$ac."&date=20180901";
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

$link = "/api/math/teacher_class?client_no=".$ac."&t_uid=".$_SESSION['t_uid']."&date=20190101";
$r = api_calls_get($link);

$d_uid = array();
$c_uid = array();
$chk = 0;
$cnt = 0;
for($i=1; $i<count($r); $i++) {
    $chk = 0;
    for($j=0; $j<count($d_uid); $j++) {
        if($d_uid[$j] == $r[$i][0]) $chk = 1;
    }
    if(!$chk) {
        $d_uid[$cnt] = $r[$i][0];
        $c_uid[$cnt] = $r[$i][1];
        $d_name[$cnt] = $r[$i][4];
        $cnt++;
    }
}

print_r($d_name);

$time = array();
$cnt = 0;
for($i=0; $i<count($d_uid); $i++) {
    $link = "/api/math/timetable?client_no=".$ac."&d_uid=".$d_uid[$i];
    $r = api_calls_get($link);

    if(count($r)) {
        for($j=0; $j<count($r); $j++) {
            $cnt = 0;
            if($r[$j][2] == $_SESSION['t_uid']) {
                $time[$i] = $r[$j][0];
                for($k=1; $k<count($r[$j]); $k++) {
                    if($k%3==0) {
                        if($r[$j][$k]) $day[$i][$cnt] = $r[$j][$k];
                        $cnt++;
                    }
                }
            }
        }
    }
}

?>