<?php
include_once ('_common.php');

$id = $_GET['id'];

$sql = "update `notify` set `attach_file`='', `attach_file_url`='';";
sql_query($sql);

alert_msg("삭제하였습니다.");
location_href("./notice_home.php");
?>