<?php

include_once ('_common.php');

$book_type = $_POST['book_type'];
$grade = $_POST['grade'];
$unit = $_POST['unit'];
$semester = $_POST['semester'];
$level = $_POST['level'];

$section_1[0] = $_POST['a_item_number'];
$section_1[1] = $_POST['a_answer_image'];
$section_1[2] = $_POST['a_explain_image'];

$section_2[0] = $_POST['b_item_number'];
$section_2[1] = $_POST['b_answer_image'];
$section_2[2] = $_POST['b_explain_image'];

$section_3[0] = $_POST['c_item_number'];
$section_3[1] = $_POST['c_answer_image'];
$section_3[2] = $_POST['c_explain_image'];

$section_4[0] = $_POST['d_item_number'];
$section_4[1] = $_POST['d_answer_image'];
$section_4[2] = $_POST['d_explain_image'];

$section_size[0] = count($section_1[0]);
$section_size[1] = count($section_2[0]);
$section_size[2] = count($section_3[0]);
$section_size[3] = count($section_4[0]);

if($section_1[0][0]) {
    $c_name = "개념마스터";
    for($i=0; $i<$section_size[0]; $i++) {
        $answer_id = rand(1, 22222).":".date("mds");
        $sql = "INSERT INTO `answer_master`
                (`answer_id`, `book_type`, `grade`, `semester`, `unit`, `level`, `c_name`, `item_number`, `answer_image`, `explain_image`, `event_time`)
                VALUES ('$answer_id', '$book_type', '$grade', '$semester', '$unit', '$level', '$c_name', '".$section_1[0][$i]."', '".$section_1[1][$i]."', '".$section_1[2][$i]."', CURRENT_TIMESTAMP);";
        mysqli_query($connect_db, $sql);
    }
}

if($section_2[0][0]) {
    $c_name = "개념확인";
    for($i=0; $i<$section_size[1]; $i++) {
        $answer_id = rand(22222, 44444).":".date("mds");
        $sql = "INSERT INTO `answer_master`
                (`answer_id`, `book_type`, `grade`, `semester`, `unit`, `level`, `c_name`, `item_number`, `answer_image`, `explain_image`, `event_time`)
                VALUES ('$answer_id', '$book_type', '$grade', '$semester', '$unit', '$level', '$c_name', '".$section_2[0][$i]."', '".$section_2[1][$i]."', '".$section_2[2][$i]."', CURRENT_TIMESTAMP);";
        mysqli_query($connect_db, $sql);
    }
}

if($section_3[0][0]) {
    $c_name = "서술과코칭";
    for($i=0; $i<$section_size[2]; $i++) {
        $answer_id = rand(44444, 66666).":".date("mds");
        $sql = "INSERT INTO `answer_master`
                (`answer_id`, `book_type`, `grade`, `semester`, `unit`, `level`, `c_name`, `item_number`, `answer_image`, `explain_image`, `event_time`)
                VALUES ('$answer_id', '$book_type', '$grade', '$semester', '$unit', '$level', '$c_name', '".$section_3[0][$i]."', '".$section_3[1][$i]."', '".$section_3[2][$i]."', CURRENT_TIMESTAMP);";
        mysqli_query($connect_db, $sql);
    }
}

if($section_4[0][0]) {
    $c_name = "이야기수학";
    for($i=0; $i<$section_size[3]; $i++) {
        $answer_id = rand(66666, 99999).":".date("mds");
        $sql = "INSERT INTO `answer_master`
                (`answer_id`, `book_type`, `grade`, `semester`, `unit`, `level`, `c_name`, `item_number`, `answer_image`, `explain_image`, `event_time`)
                VALUES ('$answer_id', '$book_type', '$grade', '$semester', '$unit', '$level', '$c_name', '".$section_4[0][$i]."', '".$section_4[1][$i]."', '".$section_4[2][$i]."', CURRENT_TIMESTAMP);";
        mysqli_query($connect_db, $sql);
    }
}

echo "<script>alert('등록이 완료되었습니다.');</script>";
echo "<script>location.href='./answer_manegement.php';</script>";

?>