<!--<!DOCTYPE html>-->
<!--<html>-->
<!---->
<!--<head>-->
<!--    <meta charset="utf-8" />-->
<!--    <meta http-equiv="X-UA-Compatible" content="IE=edge">-->
<!--    <title>MathIT Admin</title>-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
<!--    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />-->
<!--    <link rel="stylesheet" type="text/css" media="screen" href="css/academy_option_add.css" />-->
<!--    <script src="js/jquery-3.3.1.min.js"></script>-->
<!--</head>-->
<!---->
<!--<body>-->
<!--    <div class="header">-->
<!--        <div class="logo_wrap">-->
<!--            <div class="logo"><img src="img/logo.png" alt="logo"></div>-->
<!--            <p>ADMIN</p>-->
<!--        </div>-->
<!--        <nav>-->
<!--            <div class="nav_menu"><a href="index.php">홈</a></div>-->
<!--            <div class="nav_menu"><a href="notice_home.php">공지사항관리</a></div>-->
<!--            <div class="nav_menu"><a href="academy_option_staff.php" class="on">학원별관리</a></div>-->
<!--            <div class="nav_menu"><a href="answer_manegement.php">정답지관리</a></div>-->
<!--        </nav>-->
<!--        <div class="header_right">-->
<!--            <div class="user_img"><img src="img/user.png" alt="user_img"></div>-->
<!--            <p class="user_id">admin</p>-->
<!--            <div class="logout_btn"><a href="login.php">로그아웃</a></div>-->
<!--            <div class="pass_change_btn"><a href="home_pass_change.php">비밀번호변경</a></div>-->
<!--        </div>-->
<!--    </div>-->
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
        <link rel="stylesheet" type="text/css" media="screen" href="css/academy_option_add.css" />
</head>
    <div class="section">
        <div class="head_section">
            <div class="l_nav">
                <div class="l_nav_menu"><a href="academy_option_add.php" class="on">학원등록</a></div>
                <div class="l_nav_menu"><a href="academy_option_staff.php" >관리자 지정</a></div>
            </div>
            <div class="search_box_wrap">
                <div class="search_input_box"><input type="text"></div>
                <div class="search_btn"><a href="#none">검색</a></div>
            </div>
        </div>
        <div class="view_section">
            <table>
                <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>학원아이디</th>
                        <th>학원명</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td><span>Kakao</span></td>
                        <td><span>필승학원</span><span>(서울)</span></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td><span>Kakao</span></td>
                        <td><span>필승학원</span><span>(서울)</span></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td><span>Kakao</span></td>
                        <td><span>필승학원</span><span>(서울)</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="section_footer">
            <div class="list_btn_wrap">
                <div class="prev_btn"><a href="#none"><img src="img/prev.png" alt=""></a></div>
                <ul>
                    <li><a href="#none" class="on">1</a></li>
                    <li><a href="#none">2</a></li>
                    <li><a href="#none">3</a></li>
                    <li><a href="#none">4</a></li>
                    <li><a href="#none">5</a></li>
                </ul>
                <div class="next_btn"><a href="#none"><img src="img/next.png" alt=""></a></div>
            </div>
            <div class="button_wrap">
                <div class="delete_btn"><a href="#none">선택삭제</a></div>
            </div>
        </div>
        <div class="add_section">
            <div class="line">
                <div class="name">
                    <div class="lside">
                        <p>학원아이디</p>
                    </div>
                    <div class="rside">
                        <input type="text" placeholder="학원아이디를 입력해주세요">
                    </div>
                </div>
                <div class="pass">
                    <div class="lside">
                        <p>지정학원</p>
                    </div>
                    <div class="rside">
                        <input type="text" disabled />
                    </div>
                </div>
            </div>
            <div class="line">
                <div class="name">
                    <div class="lside">
                        <p>비밀번호</p>
                    </div>
                    <div class="rside">
                        <input type="password" placeholder="비밀번호를 입력해주세요" />
                        <div class="confirm_btn"><a href="#none">확인</a></div>
                    </div>
                </div>
                <div class="pass">
                    <div class="lside">
                        <p></p>
                    </div>
                    <div class="rside"></div>
                </div>
            </div>
        </div>
        <div class="section_footer">
            <div class="button_wrap">
                <div class="add_btn"><a href="#none">추가</a></div>
            </div>
        </div>
    </div>
<!--</body>-->
<!---->
<!--</html>-->