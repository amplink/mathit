<?php
include_once ('_common.php');

$cnt = $_GET['cnt'];
$ac = $_SESSION['client_id'];
$link = "/api/math/bus?client_no=".$ac;
$r = api_calls_get($link);

$t = 0;
for($i=0; $i<count($r['list']); $i++) {
    $bus_uid[$i] = $r['list'][$i][0];
    $bus_name[$i] = $r['list'][$i][1]."(".$r['list'][$i][2].")";
    // ."(".$r['list'][$i][2].")"

    $uid = $r['list'][$i][0];
    for($j=1; $j<=count($r['route'][$uid]); $j++) {
        if($t==$cnt-1) {
            $line = $bus_name[$i];
            $station_uid = $uid;
            $station_name = $r['route'][$uid][$j][1];
            $station_time = $r['route'][$uid][$j][2];
            $station_seq = $r['route'][$uid][$j][3];
        }
        $t++;
    }
}
$s_uid = $_SESSION['s_uid'];
if($cnt) {
    $sql = "update `student_table` set `station_uid`='$station_uid', `line`='$line', `station`='$station_name', `time`='$station_time', `bus_seq`='$cnt' where `uid`='$s_uid';";
    sql_query($sql);
}else {
    $sql = "update `student_table` set `station_uid`='', `line`='', `station`='', `time`='', `bus_seq`='' where `uid`='$s_uid';";
    sql_query($sql);
}
echo "success";
?>