<?php
include_once ('_common.php');
// 시간표
$s_year = date("Y");
$a_quarter = date("md");
$mon = date("m");

if($mon >= 1 && $mon <= 2) $s_quarter = 1;
else if($mon >= 3 && $mon <= 5) $s_quarter = 2;
else if($mon >= 6 && $mon <= 8) $s_quarter = 3;
else $s_quarter = 4;

$ac = $_SESSION['client_no'];
$date = $s_year.$a_quarter;

$link = "/api/math/teacher_class?client_no=".$ac."&t_uid=".$_SESSION['t_uid']."&date=".$date;
$r = api_calls_get($link);

$d_uid = array();
$c_uid = array();
$s_uid = array();
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
        $s_uid[$cnt] = $r[$i][2];
        $d_name[$cnt] = $r[$i][4];
        $d_yoie[$cnt] = $r[$i][5];
        $cnt++;
    }
}

$time = array();
$cnt = 0;

for($i=0; $i<count($d_uid); $i++) {

    $link = "/api/math/timetable?client_no=".$ac."&d_uid=".$d_uid[$i];
    $r = api_calls_get($link);
    $kk = 0;

    var_dump($r);
    echo "<br><br>";

    if(count($r)) {
        for($j=0; $j<count($r); $j++) {

            $cnt = 0;

            if($r[$j][2] == $_SESSION['t_uid']) { //해당 선생(강사)님

//                    $time[$i] = $r[$j][0];
//                    $time1[$i][$kk] = $r[$j][0];
//                    $kk++;
                for($k=1; $k<count($r[$j]); $k++) {

                    if($k%3 == 0) {

                        if($r[$j][$k]) :
                            $day[$i][$cnt] = $r[$j][$k];
                            $time1[$i][$cnt][$kk] = $r[$j][0];
                            $kk++;
                        endif;

                        $cnt++;
                    }
                }
            }

        }

    }
}

?>