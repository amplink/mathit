<?php
include_once ('_common.php');
$class = $_GET['class'];
$test_genre = $_GET['test_genre'];
$title = $_GET['title'];
$score1 = $_POST['score1'];
$score2 = $_POST['score2'];
$student = $_POST['student'];
$chk_list = $_POST['chk_list'];

if(count($chk_list) > 0) {
    for($i=0; $i<count($chk_list); $i++) {
        $sql = "delete from `teacher_score` where `seq` = '$chk_list[$i]';";
        sql_query($sql);
    }
} else {
    for($i=0; $i<count($student); $i++) {
        $sql = "update `teacher_score` set `score1` = '$score1[$i]', `score2`='$score2[$i]' where `student`='$student[$i]';";
        sql_query($sql);
    }
    echo "1";
}
exit;
?>