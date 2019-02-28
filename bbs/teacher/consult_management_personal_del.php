<?php
include_once ('_common.php');

$seq = $_POST['seq'];

$sql = "delete from `teacher_consult` where `seq` = '$seq';";
sql_query($sql);

alert_msg("삭제가 완료되었습니다.");
location_href("./consult_management_personal.php");
?>