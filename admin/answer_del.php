<?php

include_once ('_common.php');

$chk_list = $_POST['answer_chk'];

for($i=0; $i<count($chk_list); $i++) {
    $sql = "delete from `answer_master` where `event_time` = '$chk_list[$i]';";
    sql_query($sql);
}
echo "<script>alert('삭제가 완료되었습니다.');</script>";
echo "<script>location.href='./answer_manegement.php';</script>";
?>