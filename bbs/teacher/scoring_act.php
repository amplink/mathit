<?
include_once ('_common.php');




//$marking = implode(",",$_POST['marking']);

$i = 1;

while($i <= $_POST['cornerTot']){
    $marking[$i]= implode(",",$_POST['marking'.$i]);
    $i++;
}

if($_POST['current_status'] == 'a1' or $_POST['current_status'] == 'a2'){

    if($_POST['current_status'] == 'a1')      $count = "1";
    else if($_POST['current_status'] == 'a2') $count = "2";


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
    //$jsonData[$_POST['corner']] = $marking;
    $wrong_anwer =  json_encode($marking);


    $marking_tot = count($marking);

    $i = 1;
    $j = 0;

    while($i <= $marking_tot){
        if($marking[$i]) $j++;
        $i++;
    }

    if($j > 0){

        $sql = "UPDATE `homework_assign_list` 
				SET  
				   current_status = 's".$count."',
				   score_status_".$count." = 'Y',
				   apply_count = ".$count.",
				   wrong_anwer_".$count." = '".$wrong_anwer."',
				   marking_date".$count." = now()
				 WHERE  `id` = '".$_POST['id']."'";

        sql_query($sql);

    }else{

        $sql = "UPDATE `homework_assign_list` 
				SET 
				  score_status_".$count." = 'Y',
				  apply_count = ".$count.",
				  current_status = 's3',
				  score_result_".$count." = 'A',
				  marking_date".$count." = now()
				WHERE  `id` = '".$_POST['id']."'";

        sql_query($sql);

    }

    $sql = "insert into `alarm` set `content`='새로운 공지가 등록되었습니다.', `table_name`='homework', `target`='학생', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
    sql_query($sql);


    alert_msg("채점이 완료되었습니다.");
}else{
    alert_msg("채점대상이 아닙니다.");
}

location_href("./scoring_list.php?s_id=$_POST[s_id]&d_uid=$_POST[d_uid]&c_uid=$_POST[c_uid]");
?>