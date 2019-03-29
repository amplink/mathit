<?php
include_once ('_common.php');
$seq = $_GET['seq'];

$sql = "update `teacher_schedule` set `file_url`='', `file_name` = '' where `seq`='$seq';";
sql_query($sql);
?>