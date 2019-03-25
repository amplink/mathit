<?php
include_once ('_common.php');

$ac = $_SESSION['client_no'];
$link = "/api/math/teacher_list?client_no=".$ac;
$r = api_calls_get($link);

$type = $_POST['type'];
$hm_create = $_POST['hm_create'];
$hm_mg = $_POST['hm_mg'];
$score_mg = $_POST['score_mg'];
$consult_mg = $_POST['consult_mg'];
$grade_card = $_POST['grade_card'];
$notice = $_POST['notice'];
$admin_menu = $_POST['admin_menu'];

for($i=1; $i<count($r); $i++) {
    $c_hm_create = 0;
    $c_hm_mg = 0;
    $c_score_mg = 0;
    $c_consult_mg = 0;
    $c_grade_card = 0;
    $c_notice = 0;
    $c_admin_menu = 0;

    $sql = "select * from `teacher_setting` where `t_id` = '".$r[$i][0]."';";
    $result = mysqli_query($connect_db, $sql);
    if($result) {
        $sql = "delete from `teacher_setting` where `t_id` = '".$r[$i][0]."'";
        mysqli_query($connect_db, $sql);
        for($j=0; $j<count($r); $j++) {
            if($hm_create[$j] == $r[$i][0]) $c_hm_create = 1;
            if($hm_mg[$j] == $r[$i][0]) $c_hm_mg = 1;
            if($score_mg[$j] == $r[$i][0]) $c_score_mg = 1;
            if($consult_mg[$j] == $r[$i][0]) $c_consult_mg = 1;
            if($grade_card[$j] == $r[$i][0]) $c_grade_card = 1;
            if($notice[$j] == $r[$i][0]) $c_notice = 1;
            if($admin_menu[$j] == $r[$i][0]) $c_admin_menu = 1;
        }
        $sql = "INSERT INTO `teacher_setting` (`seq`, `t_id`, `t_name`, `type`, `hm_create`, `hm_mg`, `score_mg`, `consult_mg`, `grade_card`, `notice`, `admin_menu`, `event_time`) 
VALUES (NULL, '".$r[$i][0]."', '".$r[$i][3]."', '".$type[$i-1]."', '$c_hm_create', '$c_hm_mg', '$c_score_mg', '$c_consult_mg', '$c_grade_card', '$c_notice', '$c_admin_menu', CURRENT_TIMESTAMP);";
        mysqli_query($connect_db, $sql);
    }
}
alert_msg("등록이 완료되었습니다.");
location_href("./setting.php");

?>