<?php
include_once ('_common.php');
$uid = $_SESSION['t_uid'];

$sql = "update `alarm` set `chk`='1' where `uid`='$uid';";
sql_query($sql);

if($_SESSION['admin']) {
    $sql = "update `alarm` set `chk`='1' where `target`='관리자';";
    sql_query($sql);
}
?>