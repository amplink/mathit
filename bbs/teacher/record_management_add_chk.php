<?php
include_once ('_common.php');

$class = $_POST['class'];
$test_genre = $_POST['test_genre'];
$date = $_POST['date'];
$title = $_POST['title'];
$standard = $_POST['standard_score'];
$sub_score1 = $_POST['sub_score1'];
$sub_score2 = $_POST['sub_score2'];
$score_add1 = $_POST['score_add1'];
$score_add2 = $_POST['score_add2'];
$teacher = $_SESSION['t_name'];
$student = $_POST['student_name'];
$student_id = $_POST['student_id'];

$sql = "delete * from `teacher_score` where `title` = '$title' and `test_genre` = '$test_genre' and `class` = '$class';";
sql_query($sql);

for($i=0; $i<count($student); $i++) {
    $sql = "INSERT INTO `teacher_score` (`seq`, `class`, `test_genre`, `title`, `date`, `standard`, `sub_score1`, `sub_score2`, `score1`, `score2`, `teacher`, `student_id`, `student`, `event_time`) 
VALUES (NULL, '$class', '$test_genre', '$title', '$date', '$standard', '$sub_score1', '$sub_score2', '$score_add1[$i]', '$score_add2[$i]', '$teacher', '$student_id[$i]', '$student[$i]', CURRENT_TIMESTAMP);";
    sql_query($sql);
}

alert_msg("등록이 완료되었습니다.");
location_href("./record_management_list.php");
?>