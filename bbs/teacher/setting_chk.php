<?php
include_once ('_common.php');

$ac = $_SESSION['client_no'];
$link = "/api/math/teacher_list?client_no=".$ac;
$r = api_calls_get($link);

$tid = $_POST['tid'];
$type = $_POST['type'];
$tname = $_POST['t_name'];
$hm_create = explode(",",implode(",", $_POST['hm_create']));
$hm_mg = explode(",",implode(",", $_POST['hm_mg']));
$score_mg = explode(",",implode(",", $_POST['score_mg']));
$consult_mg = explode(",",implode(",", $_POST['consult_mg']));
$grade_card = explode(",",implode(",", $_POST['grade_card']));
$notice = explode(",",implode(",", $_POST['notice']));
$admin_menu = explode(",",implode(",", $_POST['admin_menu']));

$sql = "select * from `academy` where `client_id`='$ac';";
$result = sql_query($sql);
$manager = mysqli_fetch_array($result);
$i=0;

$sql = "delete from `teacher_setting`;";
sql_query($sql);

$sql = "INSERT INTO `teacher_setting` (`seq`, `t_id`, `t_name`, `type`, `hm_create`, `hm_mg`, `score_mg`, `consult_mg`, `grade_card`, `notice`, `admin_menu`, `event_time`)
VALUE (NULL, '".$manager['manager_uid']."', '".$manager['manager_name']."', '전임강사', '1', '1', '1', '1', '1', '1', '1', CURRENT_TIMESTAMP)";
sql_query($sql);

for($i=0;$i<count($tid);$i++){

   $hc = (in_array($tid[$i], $hm_create))?"1":"0";
   $hm = (in_array($tid[$i], $hm_mg))?"1":"0";
   $sm = (in_array($tid[$i], $score_mg))?"1":"0";
   $cm = (in_array($tid[$i], $consult_mg))?"1":"0";
   $gc = (in_array($tid[$i], $grade_card))?"1":"0";
   $nt = (in_array($tid[$i], $notice))?"1":"0";
   $am = (in_array($tid[$i], $admin_menu))?"1":"0";
   if($type[$i]=="채점강사") $cm = "0";

   $sql = "INSERT INTO `teacher_setting` (`seq`, `t_id`, `t_name`, `type`, `hm_create`, `hm_mg`, `score_mg`, `consult_mg`, `grade_card`, `notice`, `admin_menu`, `event_time`) 
VALUES (NULL, '$tid[$i]', '".$tname[$i]."', '$type[$i]', '$hc', '$hm', '$sm', '$cm', '$gc', '$nt', '$am', CURRENT_TIMESTAMP);";

   sql_query($sql);
//	sql_query(
//		"update teacher_setting set
//            type = '$type[$i]',
//			hm_create = $hc,
//			hm_mg = $hm,
//			score_mg = $sm,
//			consult_mg = $cm,
//			grade_card = $gc,
//			notice = $nt,
//			admin_menu = $am
//	     where
//            t_id = '$tid[$i]'"
//	);

}

alert_msg("등록이 완료되었습니다.");
location_href("./setting.php");

?>