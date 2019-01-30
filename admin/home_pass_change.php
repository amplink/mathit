<?php
include_once('_common.php');
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

//include_once(G5_THEME_PATH.'/head.php');
include_once('head.php');
echo $mb_password;
?>


<head>
    <link rel="stylesheet" type="text/css" media="screen" href="css/home_pass_change.css" />
</head>
    <div class="section">
        <div class="member_login_box">
            <p>비밀번호 재설정</p>
            <div class="logo_section">
                <div class="logo_login"><img src="img/logo.png" alt="login_logo"></div>
            </div>
            <div class="form_section">
                <form action=""><input type="text" placeholder="현재 비밀번호를 입력해주세요"><input type="text" placeholder="새 비밀번호를 입력해주세요"><input type="text" placeholder="비밀번호를 재입력해주세요"></form>
            </div>
            <div class="ok_btn">
                <a href="index.php">확인</a>
            </div>
        </div>
    </div>
</body>

</html>