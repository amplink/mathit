<?php
include_once ('_common.php');
$seq = $_GET['seq'];

$sql = "update `teacher_notice` set `file_url`='', `file_name` = '' where `seq`='$seq';";
sql_query($sql);

alert_msg("첨부파일 삭제가 완료되었습니다.");
location_href("notice_list.php");

?>