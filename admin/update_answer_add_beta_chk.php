<?php

include_once ('_common.php');

$book_type = $_POST['book_type'];
$grade = $_POST['grade'];
$unit = $_POST['unit'];
$semester = $_POST['semester'];
$level = $_POST['level'];

$event_time = $_POST['event'];

$section_1[0] = $_POST['a_item_number'];
$section_1[1] = $_POST['a_answer_image'];
$section_1[2] = $_POST['a_explain_image'];

$section_2[0] = $_POST['b_item_number'];
$section_2[1] = $_POST['b_answer_image'];
$section_2[2] = $_POST['b_explain_image'];

$section_3[0] = $_POST['c_item_number'];
$section_3[1] = $_POST['c_answer_image'];
$section_3[2] = $_POST['c_explain_image'];

$section_size[0] = count($section_1[0]);
$section_size[1] = count($section_2[0]);
$section_size[2] = count($section_3[0]);


$sql = "delete from `answer_master` where `book_type`='$book_type' and `grade` = '$grade' and `unit` = '$unit' and `semester` = '$semester' and `level` = '$level';";
sql_query($sql);

if($section_1[0][0]) {
    $c_name = "개념다지기";
    for($i=0; $i<$section_size[0]; $i++) {
        $answer_id = rand(1, 22222).":".date("mds");
        $sql = "INSERT INTO `answer_master`
                (`seq`, `answer_id`, `book_type`, `grade`, `semester`, `unit`, `level`, `c_name`, `item_number`, `answer_image`, `explain_image`, `event_time`)
                VALUES ('$i', '$answer_id', '$book_type', '$grade', '$semester', '$unit', '$level', '$c_name', '".$section_1[0][$i]."', '".$section_1[1][$i]."', '".$section_1[2][$i]."', CURRENT_TIMESTAMP);";
        if($section_1[0][$i]) mysqli_query($connect_db, $sql);
    }
}

if($section_2[0][0]) {
    $c_name = "단원마무리";
    for($i=0; $i<$section_size[1]; $i++) {
        $answer_id = rand(22222, 44444).":".date("mds");
        $sql = "INSERT INTO `answer_master`
                (`seq`, `answer_id`, `book_type`, `grade`, `semester`, `unit`, `level`, `c_name`, `item_number`, `answer_image`, `explain_image`, `event_time`)
                VALUES ('$i', '$answer_id', '$book_type', '$grade', '$semester', '$unit', '$level', '$c_name', '".$section_2[0][$i]."', '".$section_2[1][$i]."', '".$section_2[2][$i]."', CURRENT_TIMESTAMP);";
        if($section_2[0][$i]) mysqli_query($connect_db, $sql);
    }
}

if($section_3[0][0]) {
    $c_name = "도전문제";
    for($i=0; $i<$section_size[2]; $i++) {
        $answer_id = rand(44444, 66666).":".date("mds");
        $sql = "INSERT INTO `answer_master`
                (`seq`, `answer_id`, `book_type`, `grade`, `semester`, `unit`, `level`, `c_name`, `item_number`, `answer_image`, `explain_image`, `event_time`)
                VALUES ('$i', '$answer_id', '$book_type', '$grade', '$semester', '$unit', '$level', '$c_name', '".$section_3[0][$i]."', '".$section_3[1][$i]."', '".$section_3[2][$i]."', CURRENT_TIMESTAMP);";
        if($section_3[0][$i]) mysqli_query($connect_db, $sql);
    }
}

echo "<script>alert('수정이 완료되었습니다.');</script>";
echo "<script>location.href='./answer_manegement.php';</script>";

?>