<?php
include_once ('_common.php');

$push = $_GET['push'];
$sound = $_GET['sound'];
$uid = $_SESSION['s_uid'];

$sql = "update `student_table` set `push_alarm`='$push', `sound`='$sound' where `uid`='$uid';";
sql_query($sql);
?>