<?php
include_once ('_common.php');

$seq = $_POST['seq'];
$content = $_POST['content'];

$sql = "update `teacher_consult` set `content` = '$content' where `seq` = '$seq';";
sql_query($sql);

alert_msg("수정이 완료되었습니다.");
location_href("./consult_management_personal.php");
?>