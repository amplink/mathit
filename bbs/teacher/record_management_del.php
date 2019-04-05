<?php
include_once ('_common.php');
$class = $_GET['class'];
$test_genre = $_GET['test_genre'];
$title = $_GET['title'];
$score1 = $_POST['score1'];
$score2 = $_POST['score2'];
$student = $_POST['student'];

for($i=0; $i<count($student); $i++) {
    $sql = "update `teacher_score` set `score1` = '$score1[$i]', `score2`='$score2[$i]' where `student`='$student[$i]';";
    sql_query($sql);
}

$chk_list = $_POST['chk_list'];
//print_r($chk_list);
for($i=0; $i<count($chk_list); $i++) {
    $sql = "delete from `teacher_score` where `seq` = '$chk_list[$i]';";
    sql_query($sql);
}
alert_msg("완료되었습니다.");
location_href("./record_management_list.php");
?>