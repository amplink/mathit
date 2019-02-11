<?php

include_once ('_common.php');

$user_id = $_POST['user_id'];
$user_pw = $_POST['user_pw'];
$chk = $_POST['chk'];

$user_pw = get_encrypt_string($user_pw);

$sql = "select * from `g5_member` where `mb_id` = '$user_id' and `mb_password` = '$user_pw';";
$result = mysqli_query($connect_db, $sql);

$res = mysqli_fetch_array($result);
if(count($res)) {
    echo "<script>alert('로그인 완료');location.href='./index.php';</script>";
    session_start();
    $_SESSION['uid'] = $user_id;
    if($chk) {
            // 3.27
            // 자동로그인 ---------------------------
            // 쿠키 한달간 저장
            $key = md5($_SERVER['SERVER_ADDR'] . $_SERVER['SERVER_SOFTWARE'] . $_SERVER['HTTP_USER_AGENT'] . $user_pw);
            set_cookie('ck_mb_id', $user_id, 86400 * 31);
            set_cookie('ck_auto', $key, 86400 * 31);
            // 자동로그인 end ---------------------------
    } else {
        set_cookie('ck_mb_id', '', 0);
        set_cookie('ck_auto', '', 0);
    }
}else {
    echo "<script>alert('아이디와 비밀번호를 확인해주세요.');location.href='./login.php';</script>";
}
?>