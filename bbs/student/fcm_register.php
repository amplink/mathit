<?php
include_once ('_common.php');

if(isset($_POST['token'])) {
    $token = $_POST['token'];
    $id = $_POST['uid'];
    $sql = "insert into `fcm` set `token` = '$token', `uid`='$uid';";
    sql_query($sql);
}
?>