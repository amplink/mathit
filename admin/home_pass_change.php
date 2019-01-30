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

?>


<head>
    <link rel="stylesheet" type="text/css" media="screen" href="css/home_pass_change.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
</head>
    <form action="home_pass_chk.php" method="post" id="login_form">
    <div class="section">
        <div class="member_login_box">
            <p>비밀번호 재설정</p>
            <div class="logo_section">
                <div class="logo_login"><img src="img/logo.png" alt="login_logo"></div>
            </div>
            <div class="form_section">
                <form action="">
                    <input type="password" placeholder="현재 비밀번호를 입력해주세요" name="current_pw" style="font-family: none !important;">
                    <input type="password" placeholder="새 비밀번호를 입력해주세요" name="new_pw1" id="new_pw1" style="font-family: none !important;;">
                    <input type="password" placeholder="비밀번호를 재입력해주세요" name="new_pw2" id="new_pw2" style="font-family: none !important;;">
                </form>
            </div>
            <div class="ok_btn" onclick="log_in();">
                <a href="#">확인</a>
            </div>
        </div>
    </div>
    </form>
</body>
</html>
<script>
    function log_in() {
        if($('#new_pw1').val() == $('#new_pw2').val()) $('#login_form').submit();
        else alert('비밀번호가 동일한지 확인해주세요.');
    }
</script>