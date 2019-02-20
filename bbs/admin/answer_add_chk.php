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

$cnt = 0;
for($i=0; $i<$section_size[0]; $i++) {
    if($section_1[0][$i]) $cnt++;
}
for($i=0; $i<$section_size[1]; $i++) {
    if($section_2[0][$i]) $cnt++;
}
for($i=0; $i<$section_size[2]; $i++) {
    if($section_3[0][$i]) $cnt++;
}
for($i=0; $i<$section_size[3]; $i++) {
    if($section_4[0][$i]) $cnt++;
}

if($book_type == "베타") {
    if($unit == "총정리(1)") $unit = "중간평가";
    else if($unit == "총정리(2)") $unit = "기말평가";
}

if($cnt == 0) {
    echo "<script>alert('입력값이 없어 등록이 되지 않았습니다.');</script>";
    echo "<script>location.href='./answer_manegement.php';</script>";
    exit;
}

$sql = "select * from `answer_master` where `book_type`='$book_type' and `grade` = '$grade' and `unit` = '$unit' and `semester` = '$semester' and `level` = '$level';";
$result = mysqli_query($connect_db, $sql);
$res = mysqli_fetch_array($result);

if($res['chk']) {
    echo "<script>alert('중복된 교재정보입니다.');</script>";
    echo "<script>history.back(-1);</script>";
    exit;
}

$sql = "delete from `answer_master` where `book_type`='$book_type' and `grade` = '$grade' and `unit` = '$unit' and `semester` = '$semester' and `level` = '$level';";
sql_query($sql);

if($section_1[0][0]) {
    if($book_type == "알파") {
        if($level == "시그마") $c_name = "유형마스터";
        else $c_name = "개념마스터";
    }else {
        if($level == "시그마") $c_name = "실력확인";
        else {
            if($unit == "중간평가") $c_name = "중간평가 1회";
            else if($unit == "기말평가") $c_name = "기말평가 1회";
            else $c_name = "개념다지기";
        }
    }

    for($i=0; $i<$section_size[0]; $i++) {
        $answer_id = rand(1, 22222).":".date("mds");
        $sql = "INSERT INTO `answer_master`
                (`seq`, `answer_id`, `book_type`, `grade`, `semester`, `unit`, `level`, `c_name`, `item_number`, `answer_image`, `explain_image`, `chk`, `event_time`)
                VALUES ('$i', '$answer_id', '$book_type', '$grade', '$semester', '$unit', '$level', '$c_name', '".$section_1[0][$i]."', '".$section_1[1][$i]."', '".$section_1[2][$i]."', 1, CURRENT_TIMESTAMP);";
        if($section_1[0][$i]) mysqli_query($connect_db, $sql);
    }
}

if($section_2[0][0]) {
    if($book_type == "알파") {
        if($level == "시그마") $c_name = "유형확인";
        else $c_name = "개념확인";
    }else {
        if($unit == "중간평가") $c_name = "중간평가 2회";
        else if($unit == "기말평가") $c_name = "기말평가 2회";
        else $c_name = "단원마무리";
    }
    for($i=0; $i<$section_size[1]; $i++) {
        $answer_id = rand(22222, 44444).":".date("mds");
        $sql = "INSERT INTO `answer_master`
                (`seq`, `answer_id`, `book_type`, `grade`, `semester`, `unit`, `level`, `c_name`, `item_number`, `answer_image`, `explain_image`, `chk`, `event_time`)
                VALUES ('$i', '$answer_id', '$book_type', '$grade', '$semester', '$unit', '$level', '$c_name', '".$section_2[0][$i]."', '".$section_2[1][$i]."', '".$section_2[2][$i]."', 1, CURRENT_TIMESTAMP);";
        if($section_2[0][$i]) mysqli_query($connect_db, $sql);
    }
}

if($section_3[0][0]) {
    if($book_type == "베타") $c_name = "도전문제";
    else $c_name = "서술과코칭";
    for($i=0; $i<$section_size[2]; $i++) {
        $answer_id = rand(44444, 66666).":".date("mds");
        $sql = "INSERT INTO `answer_master`
                (`seq`, `answer_id`, `book_type`, `grade`, `semester`, `unit`, `level`, `c_name`, `item_number`, `answer_image`, `explain_image`, `chk`, `event_time`)
                VALUES ('$i', '$answer_id', '$book_type', '$grade', '$semester', '$unit', '$level', '$c_name', '".$section_3[0][$i]."', '".$section_3[1][$i]."', '".$section_3[2][$i]."', 1, CURRENT_TIMESTAMP);";
        if($section_3[0][$i]) mysqli_query($connect_db, $sql);
    }
}

if($section_4[0][0]) {
    $c_name = "이야기수학";
    for($i=0; $i<$section_size[3]; $i++) {
        $answer_id = rand(66666, 99999).":".date("mds");
        $sql = "INSERT INTO `answer_master`
                (`seq`, `answer_id`, `book_type`, `grade`, `semester`, `unit`, `level`, `c_name`, `item_number`, `answer_image`, `explain_image`, `chk`, `event_time`)
                VALUES ('$i', '$answer_id', '$book_type', '$grade', '$semester', '$unit', '$level', '$c_name', '".$section_4[0][$i]."', '".$section_4[1][$i]."', '".$section_4[2][$i]."', 1, CURRENT_TIMESTAMP);";
        if($section_4[0][$i]) mysqli_query($connect_db, $sql);
    }
}

echo "<script>alert('등록이 완료되었습니다.');</script>";
echo "<script>location.href='./answer_manegement.php';</script>";

?>