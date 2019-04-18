<?php
include_once ('_common.php');

$date = $_POST['date'];
$consult_genre = $_POST['consult_genre'];
$consult_topic = $_POST['consult_topic'];
$object = $_POST['object'];
$consult_way = $_POST['consult_way'];
$web_open = $_POST['web_open'];
$content = $_POST['content'];
$s_name = $_POST['s_name'];
$t_name = $_SESSION['t_name'];

$sql = "INSERT INTO `teacher_consult` (`seq`, `t_name`, `s_name`, `consult_genre`, `consult_topic`, `object`, `consult_way`, `web_open`, `date`, `content`, `event_time`)
 VALUES (NULL, '$t_name', '$s_name', '$consult_genre', '$consult_topic', '$object', '$consult_way', '$web_open', '$date', '$content', CURRENT_TIMESTAMP);";
sql_query($sql);

$t_name = $_SESSION['t_name'];

$t_uid = $_SESSION['t_uid'];
$sql = "insert into `alarm` set `seq`='', `content`='새로운 상담이 등록되었습니다.', `table_name`='consult', `target`='$t_name', `uid`='$t_uid',`chk`='0', `datetime`=CURRENT_TIMESTAMP";
sql_query($sql);
$sql = "insert into `alarm` set `seq`='', `content`='새로운 상담이 등록되었습니다.', `table_name`='consult', `target`='관리자', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
sql_query($sql);

alert_msg("등록이 완료되었습니다.");
location_href("./consult_management_personal.php?s_id=".$_GET['s_id']."&s_name=".$s_name."&d_uid=".$_GET['d_uid']."&c_uid=".$_GET['c_uid']);

?>