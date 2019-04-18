<?php
include_once ('_common.php');

$seq = $_POST['seq'];
$content = $_POST['content'];

$s_id = $_GET['s_id'];
$s_name = $_GET['s_name'];
$d_uid = $_GET['d_uid'];
$c_uid = $_GET['c_uid'];


$sql = "update `teacher_consult` set `content` = '$content' where `seq` = '$seq';";
sql_query($sql);

alert_msg("수정이 완료되었습니다.");
location_href("./consult_management_personal.php?s_id=$s_id&s_name=$s_name&d_uid=$d_uid&c_uid=$c_uid");
?>