<?php
include_once ('_common.php');

$alarm = $_POST['push_alarm'];
$melody = $_POST['sound'];
$uid = $_SESSION['t_uid'];

$sql = "delete from `app_setting` where `t_id` = '$uid';";
mysqli_query($connect_db, $sql);

$sql = "INSERT INTO `app_setting` (`t_id`, `alarm`, `melody`, `event_time`) VALUES ('".$_SESSION['t_uid']."', '$alarm', '$melody', CURRENT_TIMESTAMP);";
mysqli_query($connect_db, $sql);

alert_msg("등록이 완료되었습니다.");
location_href('./setting.php');
?>