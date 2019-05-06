<?php
include_once ('_common.php');

if(isset($_POST['token'])) {
    $token = $_POST['token'];
    $id = $_POST['uid'];
    $sql = "select * from `fcm` where `uid`='$id';";

    if($result = sql_query($sql)) {
        $count = mysqli_num_rows($result);
    }
    if($count) {
        $sql = "update `fcm` set `token`='$token' where `uid`='$id';";
        sql_query($sql);
    }else {
        $sql = "insert into `fcm` set `token` = '$token', `uid`='$id';";
        sql_query($sql);
    }
}
?>