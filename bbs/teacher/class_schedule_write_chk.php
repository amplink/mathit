<?php
include_once ('_common.php');
session_start();

$type = $_POST['type'];
$title = $_POST['title'];
$range = $_POST['read_range'];
$content = $_POST['content'];

$name = $_FILES['bf_file']['tmp_name'][0];
$name_name = $_FILES['bf_file']['name'][0];

$writer = $_SESSION['t_name'];

$base_dir = "schedule";
$dir = time().(double)microtime();
@mkdir("$base_dir/$dir",0777);

move_uploaded_file($name,"$base_dir/$dir/$name_name");

$im_name_in = "$base_dir/$dir/$name_name";

$sql = "INSERT INTO `teacher_schedule` (`seq`, `type`, `s_range`, `title`, `writer`, `file_url`, `file_name`, `content`, `event_time`)
VALUES (NULL, '$type', '$range', '$title', '$writer', '$base_dir/$dir/', '$name_name', '$content', CURRENT_TIMESTAMP);";
sql_query($sql);
//echo $sql;


alert_msg("등록이 완료되었습니다.");
location_href("./class_schedule_list.php");

?>