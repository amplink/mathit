<?php
include_once ('_common.php');
$sql = "select `token` from `fcm`;";
$result = sql_query($sql);
$tokens = array();
while($res = mysqli_fetch_array($result)) {
    $tokens[] = $res['token'];
}
$message = "새로운 공지가 등록되었습니다.";
send_notification($tokens, $message);
?>