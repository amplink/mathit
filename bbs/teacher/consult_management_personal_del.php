<?php
include_once ('_common.php');

$seq = $_POST['seq'];
$s_id = $_GET['s_id'];
$s_name = $_GET['s_name'];
$d_uid = $_GET['d_uid'];
$c_uid = $_GET['c_uid'];

$sql = "delete from `teacher_consult` where `seq` = '$seq';";
sql_query($sql);

alert_msg("삭제가 완료되었습니다.");
location_href("./consult_management_personal.php?s_id=$s_id&s_name=$s_name&d_uid=$d_uid&c_uid=$c_uid");
?>