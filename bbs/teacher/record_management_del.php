<?php
include_once ('_common.php');
$class = $_GET['class'];
$test_genre = $_GET['test_genre'];
$title = $_GET['title'];
$score1 = $_POST['score1'];
$score2 = $_POST['score2'];
$score3 = $_POST['score3'];
$student = $_POST['student'];
$chk_list = $_POST['chk_list'];
$d_uid = $_POST['d_uid'];
$c_uid = $_POST['c_uid'];
$s_uid = $_POST['s_uid'];

if(count($chk_list) > 0) {
    for($i=0; $i<count($chk_list); $i++) {
        $sql = "delete from `teacher_score` where `seq` = '$chk_list[$i]';";
        sql_query($sql);
    }
} else {
    for($i=0; $i<count($student); $i++) {
        $sql = "update `teacher_score` set `score1` = '$score1[$i]', `score2`='$score2[$i]', `score3`='$score3[$i]' where `student_id`='$student[$i]' and test_genre = '$test_genre' and d_uid= '$d_uid' and c_uid= '$c_uid' and s_uid= '$s_uid'";
        sql_query($sql);
    }
    echo "1";
}
exit;
?>