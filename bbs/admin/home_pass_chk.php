<?php
include_once ('_common.php');

$current_pw = get_encrypt_string($_POST['current_pw']);
$new_pw1 = get_encrypt_string($_POST['new_pw1']);
$new_pw2 = get_encrypt_string($_POST['new_pw2']);

$sql = "select * from `g5_member` where `mb_password` = '$current_pw';";
$r = mysqli_query($connect_db, $sql);

$res = mysqli_fetch_array($r);
$sql = "update `g5_member` set `mb_password` = '$new_pw1' where `mb_no` = '".$res['mb_no']."';";
//echo $sql."<br>".$current_pw."<br>".$new_pw1;

if($res["mb_no"]) {
    mysqli_query($connect_db, $sql);
    echo "<script>alert('변경되었습니다.');</script>";
    echo "<script>location.href='./index.php';</script>";
} else {
    echo "<script>alert('비밀번호를 확인해주세요.');</script>";
    echo "<script>location.href='./home_pass_change.php';</script>";
}

?>