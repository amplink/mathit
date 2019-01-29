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

$ca_name = "개념마스터";

$sql = "select * from `g5_write_answer_add`";
$result = mysqli_query($connect_db, $sql);
$size = 0;
while($f = mysqli_fetch_array($result)) {
    $size--;
}

$wr_num = $size-1;
//
//$sql = " insert into `g5_write_answer_add`
//                set wr_num = '$wr_num',
//                     wr_reply = '',
//                     wr_comment = 0,
//                     ca_name = '$ca_name',
//                     wr_option = '$html,$secret,$mail',
//                     wr_subject = '$wr_num',
//                     wr_content = '',
//                     wr_link1 = '',
//                     wr_link2 = '',
//                     wr_link1_hit = 0,
//                     wr_link2_hit = 0,
//                     wr_hit = 0,
//                     wr_good = 0,
//                     wr_nogood = 0,
//                     mb_id = '',
//                     wr_password = '',
//                     wr_name = '',
//                     wr_email = '',
//                     wr_homepage = '',
//                     wr_datetime = '".G5_TIME_YMDHIS."',
//                     wr_last = '".G5_TIME_YMDHIS."',
//                     wr_ip = '{$_SERVER['REMOTE_ADDR']}',
//                     wr_1 = '$book_type',
//                     wr_2 = '$grade',
//                     wr_3 = '$unit',
//                     wr_4 = '$semester',
//                     wr_5 = '$level',
//                     wr_6 = '$wr_6',
//                     wr_7 = '$wr_7',
//                     wr_8 = '$wr_8',
//                     wr_9 = '$wr_9',
//                     wr_10 = '$wr_10' ";
//sql_query($sql);
?>