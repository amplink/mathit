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

if(count($r_target)==0) {
    echo "<script>alert('공지 범위를 선택해 주세요.');history.back('-1');</script>";
}
else {
    foreach($r_target as $r) {
        $target .= $r.",";
    }

    foreach($r_client_id as $r) {
        $client_id .= $r.",";
    }

    if(!$_GET['id']) {
        $sql = "INSERT INTO `notify` (`id`, `client_id`, `target`, `title`, `author`, `type`, `attach_file`, `contents`, `event_time`)
VALUES ('$id', '$client_id', '$target', '$title', '$author', '$type', '$attach_file', '$contents', CURRENT_TIMESTAMP);";
        sql_query($sql);
    }else {
        if($attach_file) {
            $sql = "UPDATE `notify` SET `client_id` = '$client_id', `target` = '$target', `title` = '$title', `author` = '$author', `type` = '$type', `attach_file` = '$attach_file', `contents` = '$contents', `event_time` = CURRENT_TIMESTAMP WHERE  `id` = '".$_GET['id']."';";
        }else {
            $sql = "UPDATE `notify` SET `client_id` = '$client_id', `target` = '$target', `title` = '$title', `author` = '$author', `type` = '$type', `contents` = '$contents', `event_time` = CURRENT_TIMESTAMP WHERE  `id` = '".$_GET['id']."';";
        }
        mysqli_query($connect_db, $sql);
    }

    echo "<script>alert('공지 등록이 완료되었습니다.');</script>";
    echo "<script>location.href='./notice_home.php';</script>";

}

?>