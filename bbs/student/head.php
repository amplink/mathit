<?php
include_once('_common.php');
if(!$_SESSION['s_uid']) {

    alert_msg('로그인을 먼저 해주세요.');
    location_href("login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MATH IT - student</title>
    <meta http-equiv="Expires" content="Mon, 06 Jan 1990 00:00:01 GMT">
    <meta http-equiv="Expires" content="-1">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="icon" type="image/png" sizes="96x96" href="img/f.png">
    <link rel="stylesheet" type="text/css" media="screen" href="css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css?v=20190423" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
    <script src="js/jquery-ui.js"></script>
</head>
<body>
    <!-- 배경 -->
    <div class="bg">
        <div class="bg_div"></div>
        <div class="bg_div"></div>
        <div class="bg_div"></div>
    </div>

    <!-- 메인 헤더 -->
    <header>
        <div class="ham_wrap">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="head_logo"><a href="home.php"><img src="img/logo_notext.png" alt="header_logo"></a></div>
        <div class="calender_icon"><img src="img/calendar.png" alt="calendar_icon"></div>
    </header>

    <!-- 네비게이션 -->
    <div class="hamburger_wrap">
        <div class="user_wrap">
            <a href="mypage.php">
            <div class="user_side">
                <div class="user_img"><img src="img/nav/user.png" alt="user_img"></div>
                <div class="user_info">
                    <p class="user_name">김태연</p>
                    <p class="academy_name">수학학원</p>
                </div>
            </div>
            </a>
            <div class="alarm" style="display: none;">
                <div class="alarm_tri">
                    <img src="img/bubble_tri_right.png" width="100%" height="100%">
                </div>
                <div class="alarm_wrap">

                </div>
            </div>
            <div class="add_btn_wrap">
                <a href="login.php"><div class="close_btn"><img src="img/nav/logout.png" alt="logout_btn_icon"></div></a>
            </div>
            <div class="add_btn_wrap">
                <a href="#"><div class="alarm_btn"><img src="img/nav/alarm.png" alt="alarm_btn_icon"></div></a>
            </div>
            <div class="add_btn_wrap">
                <a href="setting.php"><div class="close_btn"><img src="img/nav/setting.png" alt="setting_btn_icon"></div></a>
            </div>
            <div class="close_btn_wrap">
                <div class="close_btn"><img src="img/close_btn.png" alt="close_btn_icon"></div>
            </div>
        </div>
        <div class="ham_nav_wrap">
            <div class="ham_nav_menu">
                <a href="notice.php">
                    <div class="ham_nav_menu_icon_wrap">
                        <div class="ham_nav_menu_icon">
                            <img src="img/nav/notice.png" alt="notice_icon">
                        </div>
                    </div>
                    <div class="ham_nav_menu_title_wrap">
                        <p class="ham_nav_menu_title">공지사항</p>
                    </div>
                </a>
            </div>
            <div class="ham_nav_menu">
                <a href="homework_ing.php">
                    <div class="ham_nav_menu_icon_wrap">
                        <div class="ham_nav_menu_icon">
                            <img src="img/nav/homework.png" alt="homework_icon">
                        </div>
                    </div>
                    <div class="ham_nav_menu_title_wrap">
                        <p class="ham_nav_menu_title">숙제관리</p>
                    </div>
                </a>
            </div>
            <div class="ham_nav_menu">
                <a href="report.php">
                    <div class="ham_nav_menu_icon_wrap">
                        <div class="ham_nav_menu_icon">
                            <img src="img/nav/report_icon.png" alt="report_icon">
                        </div>
                    </div>
                    <div class="ham_nav_menu_title_wrap">
                        <p class="ham_nav_menu_title">성적관리</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- 스케줄 -->
    <div class="schedule_wrap">
        <div class="schedule_head">
            <div class="schedule_title_wrap">
                <p class="schedule_title">MY SCHEDULE</p>
                <p class="month"><span>2019. </span><span>01</span></p>
            </div>
            <div class="close_btn_wrap">
                <div class="sc_close_btn"><img src="img/close_btn.png" alt="close_btn_icon"></div>
            </div>
        </div>
        <div class="schedule_section">
            <div class="weekly_schedule_wrap">
                <div class="weekly_scedule_box on">
                    <div class="date_wrap">
                        <p class="day">15</p>
                        <p class="dow">Mon</p>
                    </div>
                    <div class="class_time_info_wrap">
                        <div class="class_time_info">
                            <p class="time"><span>PM</span>
                                <span>05:00</span>
                                <span> ~ </span>
                                <span>06:00</span></p>
                            <p class="class_name">
                                <span>시그마</span>
                                <span>초등6학년</span>
                            </p>
                        </div>
                        <div class="class_time_info">
                            <p class="time"><span>PM</span>
                                <span>05:00</span>
                                <span> ~ </span>
                                <span>06:00</span></p>
                            <p class="class_name">
                                <span>시그마</span>
                                <span>초등6학년</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="weekly_scedule_box">
                    <div class="date_wrap">
                        <p class="day">16</p>
                        <p class="dow">Tue</p>
                    </div>
                    <div class="class_time_info_wrap">
                        <div class="class_time_info">
                            <p class="time"><span>PM</span>
                                <span>05:00</span>
                                <span> ~ </span>
                                <span>06:00</span></p>
                            <p class="class_name">
                                <span>시그마</span>
                                <span>초등6학년</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="weekly_scedule_box">
                    <div class="date_wrap">
                        <p class="day">17</p>
                        <p class="dow">Wed</p>
                    </div>
                    <div class="class_time_info_wrap">
                        <div class="class_time_info">
                            <p class="time"><span>PM</span>
                                <span>05:00</span>
                                <span> ~ </span>
                                <span>06:00</span></p>
                            <p class="class_name">
                                <span>시그마</span>
                                <span>초등6학년</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="weekly_scedule_box">
                    <div class="date_wrap">
                        <p class="day">18</p>
                        <p class="dow">Thu</p>
                    </div>
                    <div class="class_time_info_wrap">
                        <div class="class_time_info">
                            <p class="time"><span>PM</span>
                                <span>05:00</span>
                                <span> ~ </span>
                                <span>06:00</span></p>
                            <p class="class_name">
                                <span>시그마</span>
                                <span>초등6학년</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="weekly_scedule_box">
                    <div class="date_wrap">
                        <p class="day">19</p>
                        <p class="dow">Fri</p>
                    </div>
                    <div class="class_time_info_wrap">
                        <div class="class_time_info">
                            <p class="time"><span>PM</span>
                                <span>05:00</span>
                                <span> ~ </span>
                                <span>06:00</span></p>
                            <p class="class_name">
                                <span>시그마</span>
                                <span>초등6학년</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="weekly_scedule_box">
                    <div class="date_wrap">
                        <p class="day">20</p>
                        <p class="dow">Sat</p>
                    </div>
                    <div class="class_time_info_wrap">
                        <div class="class_time_info">
                            <p class="time"><span>PM</span>
                                <span>05:00</span>
                                <span> ~ </span>
                                <span>06:00</span></p>
                            <p class="class_name">
                                <span>시그마</span>
                                <span>초등6학년</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mybus_wrap">
                <div class="bus_head">
                    <p class="bus_title">MY BUS</p>
                    <div class="onboard_cancel_btn">
                        <p>탑승 취소</p>
                    </div>
                </div>
                <div class="bus_content">
                    <div class="bus_icon">
                        <img src="img/bus.png" alt="bus_icon">
                    </div>
                    <div class="bus_info">
                        <p class="bus_place"><span>서울고 앞</span><span> 정류장</span></p>
                        <p class="bus_time">
                            <span>PM</span>
                            <span>05:00</span>
                            <span> 탑승 예정입니다.</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--bus_alarm-->
    <div class="bus_box">
        <p class="bus_box_title">셔틀버스 탑승 취소</p>
        <div class="bus_box_content">
            <p><span>서울고 정류장<br>(PM 5:00 탑승 예정)</span></p>
            <p><span>10/18</span><span>(오늘)</span></p>
            <p><span>금일 셔틀버스를</span><span>이용하지 않으시겠습니까?</span></p>
            <p><span>담당 기사님께</span> <span>문자가 전송됩니다.</span></p>
        </div>
        <div class="bus_box_btn_wrap">
            <div class="yes_btn">
                <p>네</p>
            </div>
            <div class="no_btn">
                <p>아니오</p>
            </div>
        </div>
    </div>

    <!--bottom_navigation_bar-->
    <div class="main_nav">
        <div class="nav_menu">
            <a href="home.php">
                <div class="nav_menu_icon">
                    <img src="img/nav/home.png" alt="home_icon">
                </div>
                <p class="nav_menu_title">HOME</p>
            </a>
        </div>
        <div class="nav_menu">
            <a href="homework_ing.php">
                <div class="nav_menu_icon">
                    <img src="img/nav/homework.png" alt="homework_icon">
                </div>
                <p class="nav_menu_title">HOMEWORK</p>
            </a>
        </div>
        <div class="nav_menu">
            <a href="report.php">
                <div class="nav_menu_icon">
                    <img src="img/nav/report_icon.png" alt="report_icon">
                </div>
                <p class="nav_menu_title">REPORT</p>
            </a>
        </div>
        <div class="nav_menu">
            <a href="notice.php">
                <div class="nav_menu_icon">
                    <img src="img/nav/notice.png" alt="notice_icon">
                </div>
                <p class="nav_menu_title">NOTICE</p>
            </a>
        </div>
        <div class="nav_menu">
            <a href="mypage.php">
                <div class="nav_menu_icon">
                    <img src="img/nav/mypage.png" alt="notice_icon">
                </div>
                <p class="nav_menu_title">MYPAGE</p>
            </a>
        </div>
    </div>
</body>