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

    $sql = "insert into `alarm` set `content`='정답지를 다시촬영하여 전송해 주세요.', `table_name`='score', `target`='학생', `uid`='$s_id';";
    sql_query($sql);
}
?>