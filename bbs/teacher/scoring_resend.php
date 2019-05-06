<?php
include_once ('_common.php');
$s_id = $_GET['s_id'];
$id = $_GET['id'];

$sql2 = "SELECT 
		   current_status
		 FROM 
		   `homework_assign_list` 
		 WHERE 
		    id = '$id'
		 AND 
		    client_id = '$_SESSION[client_no]'";


//echo $sql;
$result2 = mysqli_query($connect_db, $sql2);
$res2 = mysqli_fetch_array($result2);


if($res2['current_status'] == "a1"){
    $step = "1";
    $status = "";
}
else if($res2['current_status'] == "a2"){
    $step = "2";
    $status = "s1";
}

$sql3 = "UPDATE homework_assign_list SET 
			current_status = '".$status."', 
			apply_status_".$step." = 'N',
			submit_date".$step." = NULL
		 WHERE id = '$id'";
$result3 = sql_query($sql3);

if($result3){

    $sql = "insert into `alarm` set `content`='정답지를 다시 촬영하여 전송해 주세요.', `table_name`='score', `target`='학생', `uid`='$s_id';";
    sql_query($sql);
    $sql = "select * from `fcm` where `uid`='".$s_id."';";
    $result = sql_query($sql);
    $tokens = array();
    while($res = mysqli_fetch_array($result)) {
        $sql1 = "select `push_alarm` from `student_table` where `id`='".$res['uid']."';";
        $result1 = sql_query($sql1);
        $res1 = mysqli_fetch_array($result1);
        if($res1['push_alarm']) $tokens[] = $res['token'];
    }
    send_notification($tokens, $message);
}

$sql4 = "SELECT 
			reg_month
		 FROM 
		   `upload_photo`
		 WHERE
		   id = '".$id."'
		 LIMIT 1";
$result4 = sql_query($sql4);
$res4 = mysqli_fetch_array($result4);

$rmdir = '../student/data/photo/'.$res4[reg_month].'/'.$id;
sql_query("DELETE FROM upload_photo WHERE id = '".$id."'");

if(is_dir($rmdir)) {
    rm_dir($rmdir);
}

?>