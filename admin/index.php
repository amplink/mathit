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







<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
<!--    <meta charset="utf-8" />-->
<!--    <meta http-equiv="X-UA-Compatible" content="IE=edge">-->
<!--    <title>MathIT Admin</title>-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->

<!--</head>-->
<!--<body>-->
<!--    <div class="header">-->
<!--        <div class="logo_wrap">-->
<!--            <div class="logo"><img src="img/logo.png" alt="logo"></div>-->
<!--            <p>ADMIN</p>-->
<!--        </div>-->
<!--        <nav>-->
<!--            <div class="nav_menu"><a href="index.php" class="on">홈</a></div>-->
<!--            <div class="nav_menu"><a href="notice_home.php">공지사항관리</a></div>-->
<!--            <div class="nav_menu"><a href="academy_option_staff.php">학원별관리</a></div>-->
<!--            <div class="nav_menu"><a href="answer_manegement.php">정답지관리</a></div>-->
<!--        </nav>-->
<!--        <div class="header_right">-->
<!--            <div class="user_img"><img src="img/user.png" alt="user_img"></div>-->
<!--            <p class="user_id">admin</p>-->
<!--            <div class="logout_btn"><a href="login.php">로그아웃</a></div>-->
<!--            <div class="pass_change_btn"><a href="home_pass_change.php">비밀번호변경</a></div>-->
<!--        </div>-->
<!--    </div>-->
    <div class="section">
        <div class="" style="text-align: center;">
            <div class="title_logo_wrap"><img src="img/logo.png" alt="title_logo"></div>
            <p>
                <span>안녕하세요 </span>
                <span>MATH IT Admin</span>
                <span>페이지 입니다.</span>
            </p>
        </div>
    </div>

<?php
include_once('tail.php');
?>