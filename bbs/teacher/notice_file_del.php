<?php
include_once ('_common.php');
$seq = $_GET['seq'];

$sql = "select * from `teacher_notice` where `seq`='$seq';";
$result = sql_query($sql);
$res = mysqli_fetch_array($result);

unlink($res['file_url'].$res['file_name']);
rmdir(substr($res['file_url'],0, -1));

$sql = "update `teacher_notice` set `file_url`='', `file_name` = '' where `seq`='$seq';";
sql_query($sql);

alert_msg("첨부파일 삭제가 완료되었습니다.");
location_href("notice_list.php");

?>