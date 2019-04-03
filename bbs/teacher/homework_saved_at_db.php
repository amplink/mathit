<?php
include_once('./_common.php');

$name = $_POST['name'];
$from = $_POST['from'];
$to = $_POST['to'];
$textbook = $_POST['textbook'];
$grade = $_POST['grade'];
$semester = $_POST['semester'];
$level = $_POST['level'];
$unit = $_POST['unit'];
$corner1 = $_POST['corner1'];
$Q_number1 = $_POST['Q_number1'];
$corner2 = $_POST['corner2'];
$Q_number2 = $_POST['Q_number2'];
$corner3 = $_POST['corner3'];
$Q_number3 = $_POST['Q_number3'];
$corner4 = $_POST['corner4'];
$Q_number4 = $_POST['Q_number4'];
$student_list = $_POST['student_list'];
$class_name = $_POST['class_name'];

for($i=0; $i<count($Q_number1); $i++) {
    if($i==count($Q_number1)-1) $q_number1 .= $Q_number1[$i];
    else $q_number1 .= $Q_number1[$i].",";
}
for($i=0; $i<count($Q_number2); $i++) {
    if($i==count($Q_number2)-1) $q_number2 .= $Q_number2[$i];
    else $q_number2 .= $Q_number2[$i].",";
}
for($i=0; $i<count($Q_number3); $i++) {
    if($i==count($Q_number3)-1) $q_number3 .= $Q_number3[$i];
    else $q_number3 .= $Q_number3[$i].",";
}
for($i=0; $i<count($Q_number4); $i++) {
    if($i==count($Q_number4)-1) $q_number4 .= $Q_number4[$i];
    else $q_number4 .= $Q_number4[$i].",";
}

for($i=0; $i<count($student_list); $i++) {
    if($i==count($student_list)-1) $st .= $student_list[$i];
    else $st .= $student_list[$i].",";
}

$query = "INSERT INTO homework SET
                         `seq` = NULL,
						 `client_id`='$_SESSION[t_id]',
                         `name`='$name',
                         `class_name` = '$class_name',
                         `student` = '$st',
                         `_from`='$from',
                         `_to`='$to',
                         `textbook`='$textbook',
                         `grade`='$grade',
                         `semester`='$semester',
                         `level`='$level',
                         `unit`='$unit',
                         `corner1`='$corner1',
                         `Q_number1`='$q_number1',
                         `corner2`='$corner2',
                         `Q_number2`='$q_number2',
                         `corner3`='$corner3',
                         `Q_number3`='$q_number3',
                         `corner4`='$corner4',
                         `Q_number4`='$q_number4',
                         `checked` = '0'
                                ";

sql_query($query);

alert_msg("등록이 완료되었습니다.");
location_href("homework_management_list.php");
?>

