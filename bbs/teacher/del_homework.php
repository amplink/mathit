<?php
include_once ('_common.php');

$no = $_GET['no'];
$sql = "delete from `homework` where `seq`='$no' and client_id = $_SESSION[client_no]";
sql_query($sql);
sql_query("delete from homework_assign_list where h_id = '$no'");
//echo $sql;
alert_msg("삭제가 완료되었습니다.");
//location_href("homework_management_list.php");
?>