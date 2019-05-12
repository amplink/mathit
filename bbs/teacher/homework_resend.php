<?php
include_once ('_common.php');
$seq = $_GET['seq'];

$name = $_POST['title'];
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
$s_ids = $_POST['s_id_list'];
$s_name = $_POST['s_list'];

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

$sql = "update `homework` set 
                         `name`='$name',
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
                         `student`='$s_name',
                         `student_id`='$s_ids',
                         `checked` = '0' where `seq`='$seq';";

$result = sql_query($sql);
$s_ids = explode(',', $s_ids);
if($result == 1) {
    $thisTime=date("m/d/Y");
    $time = $from;
    $someTime=strtotime($thisTime)-strtotime("$time GMT");
    $cha = ceil($someTime/(60*60*24));
    if($cha >= 0) {
        for($i=0; $i<count($s_ids); $i++) {
            $sql = "insert into `alarm` set `seq`='', `content`='숙제가 수정되었습니다.', `table_name`='homework', `target`='학생', `uid`='".$s_ids[$i]."',`chk`='0', `datetime`=CURRENT_TIMESTAMP";
            sql_query($sql);
            $sql = "select * from `fcm` where `uid`='".$s_ids[$i]."';";
            $results = sql_query($sql);
            $tokens = array();
            $i_tokens = array();
            while($res = mysqli_fetch_array($results)) {
                $sql1 = "select `push_alarm` from `student_table` where `id`='".$res['uid']."';";
                $result1 = sql_query($sql1);
                $res1 = mysqli_fetch_array($result1);
                if($res1['push_alarm']) {
                    if($res['iphone']) $i_tokens[] = $res['token'];
                    $tokens[] = $res['token'];
                }
            }
            $message = "숙제가 수정되었습니다.";
            if(count($tokens) > 0) send_notification($tokens, $message);
            if(count($i_tokens) > 0) send_notification_ios($i_tokens, $message);
        }
    }
    $jsonData['message'] = "수정되었습니다.";
    echo json_encode($jsonData);
}
//alert_msg("수정되었습니다.");
//location_href("./homework_management_list.php");
?>