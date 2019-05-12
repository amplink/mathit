<?php
include_once('./_common.php');

$name = $_POST['name'];
$from = $_POST['from'];
$to = $_POST['to'];
$textbook = $_POST['textbook'];
$grade = $_POST['grade'];
$semester = $_POST['semester'];
$level = $_POST['level'];
$unit = $_POST['unit'];
$corner1 = $_POST['corner1'];
$Q_number1 = $_POST['Q_number1'];
$corner2 = $_POST['corner2'];
$Q_number2 = $_POST['Q_number2'];
$corner3 = $_POST['corner3'];
$Q_number3 = $_POST['Q_number3'];
$corner4 = $_POST['corner4'];
$Q_number4 = $_POST['Q_number4'];
$student_list = $_POST['student_list'];
$class_name = $_POST['class_name'];
$d_id = $_POST['d_id'];
$c_id = $_POST['c_id'];
$s_id = $_POST['s_id'];
$d_yoie = $_POST['d_yoie'];
$year = $_POST['year_select'];
$quarter = $_POST['quarter_select'];

for($i=0; $i<count($Q_number1); $i++) {
    if($i==count($Q_number1)-1) $q_number1 .= $Q_number1[$i];
    else $q_number1 .= $Q_number1[$i].",";
}
for($i=0; $i<count($Q_number2); $i++) {
    if($i==count($Q_number2)-1) $q_number2 .= $Q_number2[$i];
    else $q_number2 .= $Q_number2[$i].",";
}
for($i=0; $i<count($Q_number3); $i++) {
    if($i==count($Q_number3)-1) $q_number3 .= $Q_number3[$i];
    else $q_number3 .= $Q_number3[$i].",";
}
for($i=0; $i<count($Q_number4); $i++) {
    if($i==count($Q_number4)-1) $q_number4 .= $Q_number4[$i];
    else $q_number4 .= $Q_number4[$i].",";
}

for($i=0; $i<count($student_list); $i++) {
	$student_info = explode("@",$student_list[$i]);
    if($i==count($student_list)-1){
	   $st .= $student_info[0];
       $st2 .= $student_info[1];
	}else{
	   $st .= $student_info[0].",";
	   $st2 .= $student_info[1].",";
	}
}

$query = "INSERT INTO homework SET
						 `client_id`='$_SESSION[client_no]',
						 `d_uid`='$d_id',
						 `c_uid`='$c_id',
						 `s_uid`='$s_id',
                         `name`='$name',
						 `d_order`='$d_yoie',
                         `class_name` = '$class_name',
                         `year` = '$year',
                         `quarter` = '$quarter',
                         `student` = '$st',
						 `student_id` = '$st2',
                         `_from`='$from',
                         `_to`='$to',
                         `textbook`='$textbook',
                         `grade`='$grade',
                         `semester`='$semester',
                         `level`='$level',
                         `unit`='$unit',
                         `corner1`='$corner1',
                         `Q_number1`='$q_number1',
                         `corner2`='$corner2',
                         `Q_number2`='$q_number2',
                         `corner3`='$corner3',
                         `Q_number3`='$q_number3',
                         `corner4`='$corner4',
                         `Q_number4`='$q_number4',
                         `checked` = '0'
                                ";

$result = sql_query($query);

if($result) {

    $last_uid = mysqli_insert_id($connect_db);

    if ($last_uid) {
        for ($i = 0; $i < count($student_list); $i++) {
            $student_info = explode("@", $student_list[$i]);

            $id1 = ($_POST['textbook'] == "알파") ? "A" : "B";
            $id2 = str_replace("초", "", $_POST['grade']);
            $id2 = str_replace("중", "", $id2);
            $id3 = "S" . substr($_POST['semester'], 0, 1);
            $id4 = date('Ymd') . $i;
            $now = date('Y-m-d');
            $no = sprintf("%04d",rand (1,10000));

            $id = $_SESSION[client_no] . $id1 . $id2 . $id3 . $id4 . $no;

            $query2 = "INSERT INTO homework_assign_list SET
                                 `id`='$id',
                                 `client_id`='$_SESSION[client_no]',
                                 `d_uid`='$d_id',
                                 `c_uid`='$c_id',
                                 `h_id`='$last_uid',
                                 `student_id`='$student_info[1]',
                                 `grade` = '$grade',
                                 `class_name` = '$class_name',
                                 `student_name` = '$student_info[0]',
                                 `event_time` = '$now' ";

            //echo $query2;
            sql_query($query2);
        }
    }
}

$stu_id = array();
for($i=0; $i<count($student_list); $i++) {
    $aaa = explode("@", $student_list[$i]);
    $stu_id[] = $aaa[1];
}
$thisTime=date("m/d/Y");
$time = $from;
$someTime=strtotime($thisTime)-strtotime("$time GMT");
$cha = ceil($someTime/(60*60*24));
if($cha >= 0) {
    for($i=0; $i<count($stu_id); $i++) {
        $sql = "insert into `alarm` set `seq`='', `content`='새로운 숙제가 출제되었습니다.', `table_name`='homework', `target`='학생', `uid`='".$stu_id[$i]."',`chk`='0', `datetime`=CURRENT_TIMESTAMP";
        sql_query($sql);
        $sql = "select * from `fcm` where `uid`='".$stu_id[$i]."';";
        $result = sql_query($sql);
        $tokens = array();
        $i_tokens = array();
        while($res = mysqli_fetch_array($result)) {
            $sql1 = "select `push_alarm` from `student_table` where `id`='".$res['uid']."';";
            $result1 = sql_query($sql1);
            $res1 = mysqli_fetch_array($result1);
            if($res1['push_alarm']) {
                if($res['iphone']) $i_tokens[] = $res['token'];
                $tokens[] = $res['token'];
            }
        }
        $message = "새로운 숙제가 등록되었습니다.";
        if(count($tokens) > 0) send_notification($tokens, $message);
        if(count($i_tokens) > 0) send_notification_ios($i_tokens, $message);
    }
}

$sql = "insert into `alarm` set `seq`='', `content`='새로운 숙제가 출제되었습니다.', `table_name`='homework', `target`='관리자', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
sql_query($sql);

alert_msg("등록이 완료되었습니다.");
location_href("homework_management_list.php");
?>