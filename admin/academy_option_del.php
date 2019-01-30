<?php
include_once ('_common.php');

$chk_list = $_POST['chk_list'];

for($i=0; $i<count($chk_list); $i++) {
    $sql = "delete from `academy` where `client_id` = '$chk_list[$i]';";
    sql_query($sql);
}
echo "<script>alert('삭제가 완료되었습니다.');</script>";
echo "<script>location.href='./academy_option_add.php';</script>";

?>