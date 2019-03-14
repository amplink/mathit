<?php
include_once ('_common.php');

$name = $_GET['name'];
$sql = "delete from `homework` where `name`='$name';";
sql_query($sql);
//echo $sql;
alert_msg("삭제가 완료되었습니다.");
location_href("homework_management_list.php");
?>