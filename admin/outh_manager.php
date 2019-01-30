<?php
include_once ('_common.php');

$manager_id = $_GET['manager_get_id'];
$link = "/api/math/teacher?client_no=126&id=".$manager_id;

$res = api_calls_get($link);

if(count($res) == 0) {
    echo "<script>alert('관리자 아이디를 확인해주세요.');</script>";
}else echo "<script>alert('관리자 아이디 확인되었습니다.');</script>";

echo "<script>location.href='./academy_option_staff.php?manager_get_id=".$res[1]."&manager_get_name=".$res[3]."';</script>";
?>