<?
include_once ('_common.php');


if(isset($_POST['marking'])){

    $marking = implode(",",$_POST['marking']);

	if($_POST['current_status'] == 'a1') $count = "1";
	else								 $count = "2";

    
	$sql = "SELECT 
	           wrong_anwer_1, wrong_anwer_2
			FROM 
	          `homework_assign_list`  
	        WHERE 
			   `id` = '".$_POST['id']."'";

	$result = mysqli_query($connect_db, $sql);
	$res = mysqli_fetch_array($result);

    //$cronerData[$_POST['corner_name']] = $marking;
    $jsonData =  json_decode($res['wrong_anwer_'.$count],true);
	//$jsonData[$_POST['corner']] = $cronerData;
	$jsonData[$_POST['corner']] = $marking;
    $wrong_anwer =  json_encode($jsonData);

	$sql = "UPDATE `homework_assign_list` 
			SET ";

    if($_POST['tempSave'] != 1){
		$sql .= "current_status = 's".$count."',
			     score_status_".$count." = 'Y',";
	}
	$sql .= "apply_count = ".$count.",
		     wrong_anwer_".$count." = '".$wrong_anwer."'
			 WHERE  `id` = '".$_POST['id']."'";

	sql_query($sql);

}else{

	$sql = "UPDATE `homework_assign_list` 
			SET 
			  score_status_".$count." = 'Y',
			  apply_count = ".$count.",
			  current_status = 's3'
			WHERE  `id` = '".$_POST['id']."'";

	sql_query($sql);

}

if($_POST['tempSave'] == 1){
	alert_msg("임시저장 되었습니다.");
	location_href("./scoring.php?id=$_POST[id]&corner=$_POST[corner]");
}else{
	alert_msg("채점이 완료되었습니다.");
	location_href("./scoring_list.php?s_id=$_POST[s_id]&d_uid=$_POST[d_uid]&c_uid=$_POST[c_uid]");
}

?>