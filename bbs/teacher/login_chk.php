<?php
include_once ('_common.php');

$id = $_POST['id'];
$pw = $_POST['pw'];
$ac = $_POST['academy_select'];

$link = "/api/math/teacher_list?client_no=".$ac;
$r = api_calls_get($link);

//echo $r[1][1];
$pw = crypt($pw);

$i=0;
$chk = 0;
for($i=0; $i<count($r); $i++) {
    if ($r[$i][2] && $r[$i][1] == $id) {
        $uid = $r[$i][0];
        $task = $r[$i][4];
        $name = $r[$i][3];
        $chk = 1;
    }
}
if($chk) {
    alert_msg("로그인 성공");
    location_href("./home.php");
    session_start();
    $_SESSION['t_id'] = $uid;
    $_SESSION['t_name'] = $name;
    $_SESSION['t_task'] = $task;
}else {
    alert_msg("학원 또는 아이디와 비밀번호를 확인해주세요.");
    location_href("./login.php");
}
?>