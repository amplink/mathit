<?
include_once ('_common.php');

//$marking = implode(",",$_POST['marking']);


$sql3 = "SELECT 
		  count(id) tot
		FROM 
		  `homework_assign_list`
		WHERE
		  h_id = '$_POST[h_id]'
		AND
		  student_id = '$_POST[s_id]'
		AND
		  current_status IN('a1','a2')
  ";

$result3 = mysqli_query($connect_db, $sql3);
$res3 = mysqli_fetch_array($result3);

if($res3[tot] > 0){

    $i = 1;

    while($i <= $_POST['cornerTot']){
        $marking[$i]= implode(",",$_POST['marking'.$i]);
        $i++;
    }

    if($_POST['current_status'] == 'a1' or $_POST['current_status'] == 'a2'){

        if($_POST['current_status'] == 'a1')      $count = "1";
        else if($_POST['current_status'] == 'a2') $count = "2";


        $sql = "SELECT 
				   A.wrong_anwer_1, A.wrong_anwer_2, A.h_id, A.class_name,
				   B.d_uid, B.c_uid, B.s_uid
				FROM 
				  `homework_assign_list` A,
				  `homework` B 
				WHERE 
				   A.id = '".$_POST['id']."'
				   AND B.seq = A.h_id
				   
				   ";

        $result = sql_query($sql);
        $res = mysqli_fetch_array($result);

        //$cronerData[$_POST['corner_name']] = $marking;
        $jsonData =  json_decode($res['wrong_anwer_'.$count],true);
        //$jsonData[$_POST['corner']] = $cronerData;
        //$jsonData[$_POST['corner']] = $marking;
        $wrong_anwer =  json_encode($marking, JSON_UNESCAPED_UNICODE);

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

        if($j == 0 || $count == 1 || $count == 2){

            $sql2 = "SELECT 
						reg_month
					 FROM 
					   `upload_photo`
					 WHERE
					   id = '".$_POST['id']."'
					 LIMIT 1";
            $result2 = sql_query($sql2);
            $res2 = mysqli_fetch_array($result2);

            $rmdir = '../student/data/photo/'.$res2[reg_month].'/'.$_POST['id'];

            if(is_dir($rmdir)) {
                rm_dir($rmdir);
            }
            sql_query("DELETE FROM upload_photo WHERE id = '".$_POST['id']."'");

        }

        $date = date('Y-m-d');
        /*
        $link = "/api/math/teacher_class?client_no=".$_SESSION['client_no']."&t_uid=".$_SESSION['t_uid']."&date=20190415";
        $r = api_calls_get($link);

        $i = 1 ;
        foreach($r as $v){

            if($r[$i][0] == $res['d_uid'] and $r[$i][1] == $res['c_uid'] and $r[$i][2] == $res['s_uid']){
                $t_uid[0] = $r[$i][6];
                $t_uid[1] = $r[$i][7];
                break;
            }
            $i++;
        }*/

        $link = "/api/math/class_stu?client_no=".$_SESSION['client_no']."&d_uid=".$res['d_uid']."&c_uid=".$res['c_uid'];
        $r = api_calls_get($link);

        for($i=1; $i<count($r); $i++) {

            $sql = "insert into `alarm` set `content`='채점이 완료 되었습니다.', `table_name`='homework', `target`='전임강사', `chk`='0', `uid`='".$r[$i][1]."', `datetime`=CURRENT_TIMESTAMP";
            sql_query($sql);
            /***************************/
            $sql = "select * from `fcm` where `uid`='".$r[$i][1]."'";
            $result = sql_query($sql);
            $tokens = array();
            $i_tokens = array();
            while($res = mysqli_fetch_array($result)) {
                $sql1 = "select `push_alarm` from `student_table` where `id`='".$res['uid']."';";
                $result1 = sql_query($sql1);
                $res1 = mysqli_fetch_array($result1);
                if($res1['push_alarm']) {
                    if($res['iphone']) $i_tokens[] = $res['token'];
                    else $tokens[] = $res['token'];
                }
            }
            $message = "채점을 완료 하였습니다.";
            if(count($tokens) > 0) send_notification($tokens, $message);
            if(count($i_tokens) > 0) send_notification_ios($i_tokens, $message);


            /***************************/

        }

        alert_msg("채점이 완료되었습니다.");
    }else{
        alert_msg("채점대상이 아닙니다.");
    }
}else{
    alert_msg("채점대상이 아닙니다.");
}
location_href("./scoring_list.php?s_id=$_POST[s_id]&d_uid=$_POST[d_uid]&c_uid=$_POST[c_uid]");
