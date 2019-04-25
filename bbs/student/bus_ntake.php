<?php
include_once ('_common.php');
include_once ('api.class.php');

$s_uid = $_SESSION['s_uid'];
$api = new gabiaSmsApi('psemathit','e7e280b259a8b08dd95e605e89637bc1');
$ac = $_SESSION['client_id'];
$link = "/api/math/bus?client_no=".$ac;
$r = api_calls_get($link);

$sql = "select * from `student_table` where `uid`='$s_uid';";
$result = sql_query($sql);
$res = mysqli_fetch_array($result);

$t = 0;
for($i=0; $i<count($r['list']); $i++) {
    $bus_uid[$i] = $r['list'][$i][0];
    if($bus_uid[$i]==$res['station_uid']) $driver = $r['list'][$i][3];
}
$driver = "01053967566";
if ($api->sms_send($driver, "02-2282-0331", $_SESSION['s_name']."학생(PM ".$res['time']." ".$res['station']."정류장 탑승 예정)\n\n금일 셔틀버스 이용하지 않습니다.", "MATH IT" ,0) == gabiaSmsApi::$RESULT_OK) {
    echo "success";
}
else {
    echo("error : " . $p . " - " . $api->getResultCode() . " - " . $api->getResultMessage() . "<br>");
}
?>