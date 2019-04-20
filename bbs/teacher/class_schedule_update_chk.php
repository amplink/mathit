<?php
include_once ('_common.php');

$type = $_POST['type'];
$title = $_POST['title'];
$range = $_POST['read_range'];
$content = $_POST['content'];

$name = $_FILES['bf_file']['tmp_name'][0];
$name_name = $_FILES['bf_file']['name'][0];

$writer = $_SESSION['t_name'];

if($name) {
    $base_dir = "schedule";
    $dir = time().(double)microtime();
    @mkdir("$base_dir/$dir",0777);

    move_uploaded_file($name,"$base_dir/$dir/$name_name");

    $name_url = $base_dir."/".$dir."/";
}else {
    $sql = "select * from `teacher_schedule` where `seq`='$seq';";
    $result = sql_query($sql);
    $res = mysqli_fetch_array($result);

    $name_url = $res['file_url'];
    $name_name = $res['file_name'];
}
$sql = "delete from `teacher_schedule` where `seq`='$seq';";
sql_query($sql);

$sql = "INSERT INTO `teacher_schedule` (`seq`, `type`, `s_range`, `title`, `writer`, `file_url`, `file_name`, `content`, `event_time`)
VALUES (NULL, '$type', '$range', '$title', '$writer', '$name_url', '$name_name', '$content', CURRENT_TIMESTAMP);";
sql_query($sql);
//echo $sql;

$sql = "select * from `teacher_setting`;";
$result = sql_query($sql);
while($res = mysqli_fetch_array($result)) {
    if(($range == "전임강사" || $range == "전체") && $res['type']=="전임강사") {
        $t_uid = $res['t_id'];
        $sql = "insert into `alarm` set `seq`='', `content`='수업계획표/일지가 수정되었습니다.', `table_name`='schedule', `target`='$range', `uid`='$t_uid',`chk`='0', `datetime`=CURRENT_TIMESTAMP";
        sql_query($sql);
    }
}

$sql = "insert into `alarm` set `seq`='', `content`='수업계획표/일지가 수정되었습니다.', `table_name`='schedule', `target`='관리자', `chk`='0', `datetime`=CURRENT_TIMESTAMP";
sql_query($sql);


alert_msg("수정이 완료되었습니다.");
location_href("./class_schedule_list.php");

?>