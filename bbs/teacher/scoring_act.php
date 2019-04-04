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
	//$jsonData[$corner] = $cronerData;
	$jsonData[$corner] = $marking;
    $wrong_anwer =  json_encode($jsonData);

	$sql = "UPDATE `homework_assign_list` 
			SET 
			  wrong_anwer_".$count." = '".$wrong_anwer."',
			  current_status = 's".$count."',
			  apply_count = ".$count.",
			  score_status_".$count." = 'Y'
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


alert_msg("채점이 완료되었습니다.");
location_href("./scoring_list.php?s_id=sjkim&d_uid=83152&c_uid=75229");

?>