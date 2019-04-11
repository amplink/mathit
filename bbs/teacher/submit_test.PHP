<?php
include_once('./_common.php');

if($_GET[s] == '1') {
    $sql = "update homework_assign_list set apply_status_1 = 'Y', current_status='a1',submit_date1=now() where h_id='$_GET[no]' and student_id = '$_GET[s_id]'";
}
else if($_GET[s] == '2') {
    $sql = "update homework_assign_list set apply_status_2 = 'Y', current_status='a2',submit_date2=now() where h_id='$_GET[no]' and student_id = '$_GET[s_id]'";
}

//echo $sql;

//exit;
sql_query($sql);


alert_msg("제출완료.");
location_href("homework_management_personal.php?s_id=$_GET[s_id]&d_uid=$_GET[d_uid]&c_uid=$_GET[c_uid]&s_uid=$_GET[s_uid]&class_name=$_GET[class_name]&student=$_GET[student]");