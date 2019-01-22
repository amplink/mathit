<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(defined('G5_THEME_PATH')) {
    require_once(G5_THEME_PATH.'/head.php');
    return;
}

if (G5_IS_MOBILE) {
    include_once(G5_MOBILE_PATH.'/head.php');
    return;
}

include_once('head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>
<!-- 상단 시작 { -->
<div class="header">
    <div class="logo_wrap">
        <div class="logo"><img src="img/logo.png" alt="logo"></div>
        <p>ADMIN</p>
    </div>
    <nav>
        <div class="nav_menu"><a href="index.php" class="on">홈</a></div>
        <div class="nav_menu"><a href="notice_home.php">공지사항관리</a></div>
        <div class="nav_menu"><a href="academy_option_staff.php">학원별관리</a></div>
        <div class="nav_menu"><a href="answer_manegement.php">정답지관리</a></div>
    </nav>
    <div class="header_right">
        <div class="user_img"><img src="img/user.png" alt="user_img"></div>
        <p class="user_id">admin</p>
        <div class="logout_btn"><a href="login.php">로그아웃</a></div>
        <div class="pass_change_btn"><a href="home_pass_change.php">비밀번호변경</a></div>
    </div>
</div>
<!-- } 상단 끝 -->

<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <div id="container_wr">
   
    <div id="container">
        <?php if (!defined("_INDEX_")) { ?><h2 id="container_title"><span title="<?php echo get_text($g5['title']); ?>"><?php echo get_head_title($g5['title']); ?></span></h2><?php } ?>

