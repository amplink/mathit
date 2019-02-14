<?php
include_once ('_common.php');

session_start();

$link = "/api/math/teacher_class?client_no=126&t_uid=".$_SESSION['t_uid'];
$r = api_calls_get($link);

$ac = $_SESSION['client_no'];

$d_uid = array();
$chk = 0;
$cnt = 0;

for($i=1; $i<count($r); $i++) {
    $chk = 0;
    for($j=0; $j<count($d_uid); $j++) {
        if($d_uid[$j] == $r[$i][0]) $chk = 1;
    }
    if(!$chk) {
        $d_uid[$cnt] = $r[$i][0];
        $d_name[$cnt] = $r[$i][4];
        $cnt++;
    }
}

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
print_r($day);

?>