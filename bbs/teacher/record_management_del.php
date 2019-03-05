<?php
include_once ('_common.php');
$class = $_GET['class'];
$test_genre = $_GET['test_genre'];
$title = $_GET['title'];

$chk_list = $_POST['chk_list'];
//print_r($chk_list);
for($i=0; $i<count($chk_list); $i++) {
    $sql = "delete from `teacher_score` where `seq` = '$chk_list[$i]';";
    sql_query($sql);
}
alert_msg("삭제가 완료되었습니다.");
location_href("./record_management_list.php");
?>