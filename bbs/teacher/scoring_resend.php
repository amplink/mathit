<?php
include_once ('_common.php');
$s_id = $_GET['s_id'];

$sql = "insert into `alarm` set `content`='정답지를 다시촬영하여 전송해주세요.', `table_name`='score', `target`='학생', `uid`='$s_id';";
sql_query($sql);
?>