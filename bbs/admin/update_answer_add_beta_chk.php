<?php

include_once ('_common.php');
$page = $_GET['page'];

$book_type = $_POST['book_type'];
$grade = $_POST['grade'];
$unit = $_POST['unit'];
$semester = $_POST['semester'];
$level = $_POST['level'];

$section_1[0] = $_POST['a_item_number'];
$section_1[1] = $_FILES['a_answer_images'];
$section_1[2] = $_FILES['a_explain_images'];
$section_1[3] = $_POST['a_idx'];

$section_2[0] = $_POST['b_item_number'];
$section_2[1] = $_FILES['b_answer_images'];
$section_2[2] = $_FILES['b_explain_images'];
$section_2[3] = $_POST['b_idx'];

$section_3[0] = $_POST['c_item_number'];
$section_3[1] = $_FILES['c_answer_images'];
$section_3[2] = $_FILES['c_explain_images'];
$section_3[3] = $_POST['c_idx'];

$section_size[0] = count($section_1[0]);
$section_size[1] = count($section_2[0]);
$section_size[2] = count($section_3[0]);

if($unit == "총정리(1)") $unit = "중간평가";
else if($unit == "총정리(2)") $unit = "기말평가";

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

function arr_del($list_arr, $del_value) {
    $b = array_search($del_value, $list_arr);
    if($b!==FALSE) unset($list_arr[$b]);
    return $list_arr;
}

if($cnt == 0) $section_1[0][0] = ".";

if($section_1[0][0]) {
    $d = 0;
    if($level == "시그마") $c_name = "실력확인";
    else if($level == "파이" || $level == "루트") $c_name = "개념다지기";

    if($unit == "중간평가") $c_name = "중간평가 1회";
    else if($unit == "기말평가") $c_name = "기말평가 1회";

    $save_arr = array();
    $del_arr = array();

    for($i=0; $i<count($section_1[3]); $i++) {
        $save_arr[$i] = $section_1[3][$i];
    }

    $sql = "select `answer_id` from `answer_master` where `book_type`='$book_type' and `grade` = '$grade' and `unit` = '$unit' and `semester` = '$semester' and `level` = '$level' and `c_name`='$c_name';";
    $result = mysqli_query($connect_db, $sql);
    $k=0;
    while($res = mysqli_fetch_array($result)) {
        $del_arr[$k] = $res['answer_id'];
        $k++;
    }

    for($i=0; $i<count($save_arr); $i++) {
        $del_arr = arr_del($del_arr, $save_arr[$i]);
    }
    sort($del_arr);
    for($i=0; $i<count($del_arr); $i++) {
        $sql = "delete from `answer_master` where `answer_id`='$del_arr[$i]';";
        sql_query($sql);
    }

    for($i=0; $i<$section_size[0]; $i++) {
        if($section_1[3][$i]) { // 기존 데이터가 있다면
            $sql = "select * from `answer_master` where `answer_id`='".$section_1[3][$i]."';";
            $result = mysqli_query($connect_db, $sql);
            $res = mysqli_fetch_array($result);

            if($section_1[1]['tmp_name'][$i]) { // answer_img가 변경 됐다면
                $answer_img = "";
                if($section_1[1]['tmp_name'][$i]) {
                    $path = $section_1[1]['tmp_name'][$i];
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = addslashes(file_get_contents($path));
                    $answer_img = $data;
                }
            }else {
                $answer_img = $res['answer_image'];
            }
            if($section_1[2]['tmp_name'][$i]) {
                $explain_img = "";
                if($section_1[2]['tmp_name'][$i]) {
                    $path = $section_1[2]['tmp_name'][$i];
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = addslashes(file_get_contents($path));
                    $explain_img = $data;
                }
            }else {
                $explain_img = $res['explain_image'];
            }
            $answer_id = $section_1[3][$i];

            $sql = "UPDATE `answer_master` set `seq` = '$i', `item_number`='".$section_1[0][$i]."', `answer_image` = '".$answer_img."', `explain_image`='".$explain_img."', `event_time`=CURRENT_TIMESTAMP where `answer_id`='$answer_id';";
            sql_query($sql);
        }else { // 새로운 데이터라면
            $answer_id = rand(1, 22222).":".date("mds");

            if($section_1[0][$i]) {
                $answer_img = "";
                if($section_1[1]['tmp_name'][$i]) {
                    $path = $section_1[1]['tmp_name'][$i];
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = addslashes(file_get_contents($path));
                    $answer_img = $data;
                }

                $explain_img = "";
                if($section_1[2]['tmp_name'][$i]) {
                    $path = $section_1[2]['tmp_name'][$i];
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = addslashes(file_get_contents($path));
                    $explain_img = $data;
                }

                $sql = "INSERT INTO `answer_master`
                (`seq`, `answer_id`, `book_type`, `grade`, `semester`, `unit`, `level`, `c_name`, `item_number`, `answer_image`, `explain_image`, `chk`, `event_time`)
                VALUES ('$i', '$answer_id', '$book_type', '$grade', '$semester', '$unit', '$level', '$c_name', '".$section_1[0][$i]."', '".$answer_img."', '".$explain_img."', 1, CURRENT_TIMESTAMP);";
                mysqli_query($connect_db, $sql);
            }
        }
    }
}

if($section_2[0][0]) {
    if($unit == "중간평가") $c_name = "중간평가 2회";
    else if($unit == "기말평가") $c_name = "기말평가 2회";
    else $c_name = "단원마무리";

    $save_arr = array();
    $del_arr = array();

    for($i=0; $i<count($section_2[3]); $i++) {
        $save_arr[$i] = $section_2[3][$i];
    }

    $sql = "select `answer_id` from `answer_master` where `book_type`='$book_type' and `grade` = '$grade' and `unit` = '$unit' and `semester` = '$semester' and `level` = '$level' and `c_name`='$c_name';";
    $result = mysqli_query($connect_db, $sql);
    $k=0;
    while($res = mysqli_fetch_array($result)) {
        $del_arr[$k] = $res['answer_id'];
        $k++;
    }

    for($i=0; $i<count($save_arr); $i++) {
        $del_arr = arr_del($del_arr, $save_arr[$i]);
    }
    sort($del_arr);
    for($i=0; $i<count($del_arr); $i++) {
        $sql = "delete from `answer_master` where `answer_id`='$del_arr[$i]';";
        sql_query($sql);
    }

    for($i=0; $i<$section_size[1]; $i++) {
        if($section_2[3][$i]) { // 기존 데이터가 있다면
            $sql = "select * from `answer_master` where `answer_id`='".$section_2[3][$i]."';";
            $result = mysqli_query($connect_db, $sql);
            $res = mysqli_fetch_array($result);

            if($section_2[1]['tmp_name'][$i]) { // answer_img가 변경 됐다면
                $answer_img = "";
                if($section_2[1]['tmp_name'][$i]) {
                    $path = $section_2[1]['tmp_name'][$i];
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = addslashes(file_get_contents($path));
                    $answer_img = $data;
                }
            }else {
                $answer_img = $res['answer_image'];
            }
            if($section_2[2]['tmp_name'][$i]) {
                $explain_img = "";
                if($section_2[2]['tmp_name'][$i]) {
                    $path = $section_2[2]['tmp_name'][$i];
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = addslashes(file_get_contents($path));
                    $explain_img = $data;
                }
            }else {
                $explain_img = $res['explain_image'];
            }
            $answer_id = $section_2[3][$i];

            $sql = "UPDATE `answer_master` set `seq` = '$i', `item_number`='".$section_2[0][$i]."', `answer_image` = '".$answer_img."', `explain_image`='".$explain_img."', `event_time`=CURRENT_TIMESTAMP where `answer_id`='$answer_id';";
            sql_query($sql);
        }else { // 새로운 데이터라면
            $answer_id = rand(1, 22222).":".date("mds");

            if($section_2[0][$i]) {
                $answer_img = "";
                if($section_2[1]['tmp_name'][$i]) {
                    $path = $section_2[1]['tmp_name'][$i];
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = addslashes(file_get_contents($path));
                    $answer_img = $data;
                }

                $explain_img = "";
                if($section_2[2]['tmp_name'][$i]) {
                    $path = $section_2[2]['tmp_name'][$i];
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = addslashes(file_get_contents($path));
                    $explain_img = $data;
                }

                $sql = "INSERT INTO `answer_master`
                (`seq`, `answer_id`, `book_type`, `grade`, `semester`, `unit`, `level`, `c_name`, `item_number`, `answer_image`, `explain_image`, `chk`, `event_time`)
                VALUES ('$i', '$answer_id', '$book_type', '$grade', '$semester', '$unit', '$level', '$c_name', '".$section_2[0][$i]."', '".$answer_img."', '".$explain_img."', 1, CURRENT_TIMESTAMP);";
                sql_query($sql);
            }
        }
    }
}

if($section_3[0][0]) {
    $c_name = "도전문제";

    $save_arr = array();
    $del_arr = array();

    for($i=0; $i<count($section_3[3]); $i++) {
        $save_arr[$i] = $section_3[3][$i];
    }

    $sql = "select `answer_id` from `answer_master` where `book_type`='$book_type' and `grade` = '$grade' and `unit` = '$unit' and `semester` = '$semester' and `level` = '$level' and `c_name`='$c_name';";
    $result = sql_query($sql);
    $k=0;
    while($res = mysqli_fetch_array($result)) {
        $del_arr[$k] = $res['answer_id'];
        $k++;
    }

    for($i=0; $i<count($save_arr); $i++) {
        $del_arr = arr_del($del_arr, $save_arr[$i]);
    }
    sort($del_arr);
    for($i=0; $i<count($del_arr); $i++) {
        $sql = "delete from `answer_master` where `answer_id`='$del_arr[$i]';";
        sql_query($sql);
    }

    for($i=0; $i<$section_size[2]; $i++) {
        if($section_3[3][$i]) { // 기존 데이터가 있다면
            $sql = "select * from `answer_master` where `answer_id`='".$section_3[3][$i]."';";
            $result = sql_query($sql);
            $res = mysqli_fetch_array($result);

            if($section_3[1]['tmp_name'][$i]) { // answer_img가 변경 됐다면
                $answer_img = "";
                if($section_3[1]['tmp_name'][$i]) {
                    $path = $section_3[1]['tmp_name'][$i];
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = addslashes(file_get_contents($path));
                    $answer_img = $data;
                }
            }else {
                $answer_img = $res['answer_image'];
            }
            if($section_3[2]['tmp_name'][$i]) {
                $explain_img = "";
                if($section_3[2]['tmp_name'][$i]) {
                    $path = $section_3[2]['tmp_name'][$i];
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = addslashes(file_get_contents($path));
                    $explain_img = $data;
                }
            }else {
                $explain_img = $res['explain_image'];
            }
            $answer_id = $section_3[3][$i];

            $sql = "UPDATE `answer_master` set `seq` = '$i', `item_number`='".$section_3[0][$i]."', `answer_image` = '".$answer_img."', `explain_image`='".$explain_img."', `event_time`=CURRENT_TIMESTAMP where `answer_id`='$answer_id';";
            sql_query($sql);
        }else { // 새로운 데이터라면
            $answer_id = rand(1, 22222).":".date("mds");

            if($section_3[0][$i]) {
                $answer_img = "";
                if($section_3[1]['tmp_name'][$i]) {
                    $path = $section_3[1]['tmp_name'][$i];
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = addslashes(file_get_contents($path));
                    $answer_img = $data;
                }

                $explain_img = "";
                if($section_3[2]['tmp_name'][$i]) {
                    $path = $section_3[2]['tmp_name'][$i];
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = addslashes(file_get_contents($path));
                    $explain_img = $data;
                }

                $sql = "INSERT INTO `answer_master`
                (`seq`, `answer_id`, `book_type`, `grade`, `semester`, `unit`, `level`, `c_name`, `item_number`, `answer_image`, `explain_image`, `chk`, `event_time`)
                VALUES ('$i', '$answer_id', '$book_type', '$grade', '$semester', '$unit', '$level', '$c_name', '".$section_3[0][$i]."', '".$answer_img."', '".$explain_img."', 1, CURRENT_TIMESTAMP);";
                sql_query($sql);
            }
        }
    }
}
//
echo "<script>alert('수정이 완료되었습니다.');</script>";
echo "<script>location.href='./answer_manegement.php?page=".$page."';</script>";

?>