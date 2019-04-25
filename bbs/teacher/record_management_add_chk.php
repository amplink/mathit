<?php
include_once ('_common.php');

$class = $_POST['class'];
$grade = $_POST['grade'];
$test_genre = $_POST['test_genre'];
$date = $_POST['date'];
$title = $_POST['title'];
$standard = $_POST['standard_score'];
$sub_score1 = $_POST['sub_score1'];
$sub_score2 = $_POST['sub_score2'];
$sub_score3 = $_POST['sub_score3'];
$score_add1 = $_POST['score_add1'];
$score_add2 = $_POST['score_add2'];
$score_add3 = $_POST['score_add3'];
$teacher = $_SESSION['t_name'];
$student = $_POST['student_name'];
$student_id = $_POST['student_id'];
$d_yoie = $_POST['d_yoie'];
$year = $_POST['year_select'];
$quarter = $_POST['quarter_select'];
$d_id = $_POST['d_id'];
$c_id = $_POST['c_id'];
$s_id = $_POST['s_id'];

//$sql = "delete * from `teacher_score` where `title` = '$title' and `test_genre` = '$test_genre' and `class` = '$class';";
//sql_query($sql);

$j = 0;
for($i=0; $i<count($student); $i++) {
    $sql = "INSERT INTO `teacher_score` (`client_id`, `d_uid`, `c_uid`, `s_uid`, `class`, `grade`, `year`, `quarter`, `d_order`, `test_genre`, `title`, `date`, `standard`, `sub_score1`, `sub_score2`, `sub_score3`, `score1`, `score2`, `score3`, `teacher`, `student_id`, `student`, `event_time`) 
VALUES ('$_SESSION[client_no]', '$d_id', '$c_id', '$s_id', '$class', '$grade', '$year', '$quarter', '$d_yoie', '$test_genre', '$title', '$date', '$standard', '$sub_score1', '$sub_score2', '$sub_score3', '$score_add1[$i]', '$score_add2[$i]', '$score_add3[$i]', '$teacher', '$student_id[$i]', '$student[$i]', CURRENT_TIMESTAMP);";
    $result = sql_query($sql);
    if($result == 1) $j++;
}

$ac = $_SESSION['client_no'];
$link = "/api/math/class_stu?client_no=".$ac."&d_uid=".$d_id."&c_uid=".$c_id;
$r = api_calls_get($link);

for($i=1; $i<count($r); $i++) {
    $sql = "insert into `alarm` set `seq`='', `content`='새로운 성적표가 등록되었습니다.', `table_name`='score', `target`='학생', `uid`='".$r[$i][1]."', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
    sql_query($sql);
}

$sql = "insert into `alarm` set `seq`='', `content`='새로운 성적표가 등록되었습니다.', `table_name`='score', `target`='관리자', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
sql_query($sql);

if(count($student) != $j){
    alert_msg("이미 등록되어진 성적표가 있습니다.");
}else{
    alert_msg("등록이 완료되었습니다.");
}
location_href("./record_management_list.php");
?>