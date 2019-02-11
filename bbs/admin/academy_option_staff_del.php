<?php
include_once ('_common.php');

$chk_list = $_POST['chk_list'];

for($i=0; $i<count($chk_list); $i++) {
    $sql = "UPDATE `academy` SET `manager_id` = '', `manager_name` = '' WHERE `academy`.`client_name` = '".$chk_list[$i]."';";
    sql_query($sql);
}

echo "<script>alert('삭제가 완료되었습니다.');</script>";
echo "<script>location.href='./academy_option_staff.php';</script>";


?>