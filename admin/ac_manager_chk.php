<?php

include_once ('_common.php');

$manager_id = $_POST['manager_id'];
$manager_name = $_POST['manager_name'];
$ac_name = $_POST['ac_name'];
echo $_POST['ac_name'];
$sql = "UPDATE `academy` SET `manager_id` = '$manager_id', `manager_name` = '$manager_name' WHERE `client_name` = '$ac_name';";
sql_query($sql);

//echo "<script>alert('등록이 완료되었습니다.');</script>";
//echo "<script>location.href='./academy_option_staff.php';</script>";

?>