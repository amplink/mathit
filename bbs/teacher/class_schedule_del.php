<?php
include_once ('_common.php');
$seq = $_GET['seq'];

$sql = "delete from `teacher_schedule` where `seq` = '$seq';";
sql_query($sql);

alert_msg("삭제가 완료되었습니다.");
location_href("class_schedule_list.php");
?>