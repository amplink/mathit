<?php
include_once ('_common.php');

$ac = $_SESSION['client_no'];
$link = "/api/math/teacher_list?client_no=".$ac;
$r = api_calls_get($link);

$tid = $_POST['tid'];
$type = $_POST['type'];

$hm_create = explode(",",implode(",", $_POST['hm_create']));
$hm_mg = explode(",",implode(",", $_POST['hm_mg']));
$score_mg = explode(",",implode(",", $_POST['score_mg']));
$consult_mg = explode(",",implode(",", $_POST['consult_mg']));
$grade_card = explode(",",implode(",", $_POST['grade_card']));
$notice = explode(",",implode(",", $_POST['notice']));
$admin_menu = explode(",",implode(",", $_POST['admin_menu']));

$sql = "select * from `academy`;";
$result = sql_query($sql);
$manager = array();
$i=0;


for($i=0;$i<count($tid);$i++){ 

   $hc = (in_array($tid[$i], $hm_create))?"1":"0";
   $hm = (in_array($tid[$i], $hm_mg))?"1":"0";
   $sm = (in_array($tid[$i], $score_mg))?"1":"0";
   $cm = (in_array($tid[$i], $consult_mg))?"1":"0";
   $gc = (in_array($tid[$i], $grade_card))?"1":"0";
   $nt = (in_array($tid[$i], $notice))?"1":"0";
   $am = (in_array($tid[$i], $admin_menu))?"1":"0";

	sql_query(
		"update teacher_setting set 

			hm_create = $hc,
			hm_mg = $hm,
			score_mg = $sm,
			consult_mg = $cm,
			grade_card = $gc,
			notice = $nt,
			admin_menu = $am
	     where 
            t_id = '$tid[$i]'"
	);

}

alert_msg("등록이 완료되었습니다.");
location_href("./setting2.php");

?>