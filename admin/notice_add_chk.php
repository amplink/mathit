<?php
include_once ('_common.php');

//INSERT INTO `notify` (`id`, `client_id`, `target`, `title`, `author`, `type`, `attach_file`, `contents`, `event_time`) VALUES ('eeeee', '125', '0', 'title', 'author', '1', 'awef', 'waefawef', CURRENT_TIMESTAMP);
$r_client_id = $_POST['ac_select'];
$r_target = $_POST['notice_range'];
$title = $_POST['title'];
$author = "admin";
$type = $_POST['notice_div'];
$attach_file = $_POST['file'];
$contents = $_POST['content'];
$id = date("mds").":".rand(1, 200);

foreach($r_target as $r) {
    $target .= $r.",";
}

foreach($r_client_id as $r) {
    $client_id .= $r.",";
}

$sql = "INSERT INTO `notify` (`id`, `client_id`, `target`, `title`, `author`, `type`, `attach_file`, `contents`, `event_time`) 
VALUES ('$id', '$client_id', '$target', '$title', '$author', '$type', '$attach_file', '$contents', CURRENT_TIMESTAMP);";
sql_query($sql);

echo "<script>alert('공지 등록이 완료되었습니다.');</script>";
echo "<script>location.href='./notice_home.php';</script>";

?>