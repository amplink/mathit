<?php
include_once ('_common.php');

if(isset($_POST['token'])) {
    $token = $_POST['token'];
    $id = $_POST['uid'];
    $ios = $_POST['os'];

    $sql = "select * from `fcm` where `token`='$token';";
    $count = 0;
    if($result = sql_query($sql)) {
        $count = mysqli_num_rows($result);
        $res = mysqli_fetch_array($result);
    }

    if($count == 0) {
        if($ios) $sql = "insert into `fcm` set `token` = '$token', `uid`='$id', `iphone`='1';";
        else $sql = "insert into `fcm` set `token` = '$token', `uid`='$id', `iphone`='0';";
        sql_query($sql);
    }
}
?>