<?php
include_once ('./_common.php');
session_start();
if(!$_SESSION['t_id']) {
    alert('로그인을 먼저 해주세요.');
    location_href("./login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MathIt - teacher</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/index.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
</head>

<body>
<header>
    <div class="hamburger_btn">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="home_btn"><a href="home.html"><img src="img/home.png" alt="home_icon"></a></div>
    <div class="logo_section">
        <div class="logo"><a href="home.html"><img src="img/logo_white.png" alt="header_logo"></a></div>
        <p class="navigation_text">HOME</p>
    </div>
    <div class="member_info_wrap">
        <div class="member_img"><img src="img/user.png" alt="member_img"></div>
        <div class="member_info">
            <p class="member_name"><?=$_SESSION['t_name']?></p>
            <p class="member_grade"><?=$_SESSION['t_task']?></p>
        </div>
        <div class="logout_btn"><a href="../logout.php?url=/bbs/teacher'">로그아웃</a></div>
    </div>
</header>
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">학기</p>
                <div class="day_select">
                    <select name="year_select" id="year_select">
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                    </select>
                    <select name="quarter_select" id="quarter_select">
                        <option value="1_quarter">1분기</option>
                        <option value="2_quarter">2분기</option>
                        <option value="3_quarter">3분기</option>
                        <option value="4_quarter">4분기</option>
                    </select>
                </div>
            </div>
            <div class="head_right">
                <div class="hw_make_btn"><a href="homework_manegement_add.html">숙제생성</a></div>
                <div class="scoring_shortcut_btn"><a href="student_manegement_score_all.html">채점바로가기</a></div>
            </div>
        </div>
    </div>
    <div class="class_table_section">
        <table>
            <thead>
            <tr>
                <th class="schedule">교시</th>
                <th class="blank">시간</th>
                <th class="day on">월</th>
                <th class="day">화</th>
                <th class="day">수</th>
                <th class="day">목</th>
                <th class="day">금</th>
                <th class="day">토</th>
                <th class="day">일</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1교시</td>
                <td>pm 3:00 ~ 4:00</td>
                <td class="class_type_1">
                    <!---->
                    <a href="student_manegement_record.html">
                        <div class="class_info">
                            <p class="class_name">루트</p>
                            <p class="class_grade">초6</p>
                            <p class="class_other">
                                <span>(</span>
                                <span>10</span>
                                <span>)</span>
                            </p>
                        </div>
                    </a>
                    <!---->
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>2교시</td>
                <td>pm 4:00 ~ 5:00</td>
                <td></td>
                <td class="class_type_2">
                    <!---->
                    <a href="student_manegement_record.html">
                        <div class="class_info">
                            <p class="class_name">루트</p>
                            <p class="class_grade">초6</p>
                            <p class="class_other">
                                <span>(</span>
                                <span>10</span>
                                <span>)</span>
                            </p>
                        </div>
                    </a>
                    <!---->
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>3교시</td>
                <td>pm 5:00 ~ 6:00</td>
                <td></td>
                <td></td>
                <td class="class_type_3">
                    <!---->
                    <a href="student_manegement_record.html">
                        <div class="class_info">
                            <p class="class_name">루트</p>
                            <p class="class_grade">초6</p>
                            <p class="class_other">
                                <span>(</span>
                                <span>10</span>
                                <span>)</span>
                            </p>
                        </div>
                    </a>
                    <!---->
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>4교시</td>
                <td>pm 6:00 ~ 7:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td class="class_type_4">
                    <!---->
                    <a href="student_manegement_record.html">
                        <div class="class_info">
                            <p class="class_name">루트</p>
                            <p class="class_grade">초6</p>
                            <p class="class_other">
                                <span>(</span>
                                <span>10</span>
                                <span>)</span>
                            </p>
                        </div>
                    </a>
                    <!---->
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>5교시</td>
                <td>pm 7:00 ~ 8:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td class="class_type_5">
                    <!---->
                    <a href="student_manegement_record.html">
                        <div class="class_info">
                            <p class="class_name">루트</p>
                            <p class="class_grade">초6</p>
                            <p class="class_other">
                                <span>(</span>
                                <span>10</span>
                                <span>)</span>
                            </p>
                        </div>
                    </a>
                    <!---->
                </td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="notice_list_wrap">
        <div class="notice_title">
            <p>공지사항</p>
        </div>
        <div class="notice_contents_wrap">
            <div class="notice_content">
                <a href="#none"><span>&#149;</span> 공지사항 제목 또는 미리보기 내용 내용이 길어지면 생략됩니다 길어지면 생략됩니다 길어지면 생략됩니다. 공지사항
                    제목 또는 미리보기 내용 내용이 길어지면 생략됩니다 길어지면 생략됩니다 길어지면 생략됩니다. 공지사항 제목 또는 미리보기 내용 내용이 길어지면 생략됩니다 길어지면
                    생략됩니다 길어지면 생략됩니다.</a>
            </div>
            <div class="notice_content">
                <a href="#none"><span>&#149;</span> 공지사항 제목 또는 미리보기 내용</a>
            </div>
            <div class="notice_content">
                <a href="#none"><span>&#149;</span> 공지사항 제목 또는 미리보기 내용</a>
            </div>
            <div class="notice_content">
                <a href="#none"><span>&#149;</span> 공지사항 제목 또는 미리보기 내용</a>
            </div>
            <div class="notice_content">
                <a href="#none"><span>&#149;</span> 공지사항 제목 또는 미리보기 내용</a>
            </div>
            <div class="notice_content">
                <a href="#none"><span>&#149;</span> 공지사항 미리보기 6개까지 노출a</a>
            </div>
        </div>
    </div>
</section>

<!--hamburger-->

<div class="hamburder_nav">
    <div class="ham_member_info_wrap">
        <div class="close_btn_line">
            <div class="close_btn"><img src="img/close.png" alt="close_icon"></div>
        </div>
        <div class="ham_member_info_line">
            <div class="ham_member_img"><img src="img/user.png" alt="member_img"></div>
            <div class="ham_member_info">
                <p class="ham_member_name">강태민</p>
                <p class="ham_member_grade">전임강사</p>
            </div>
        </div>
        <div class="ham_other_btn_line">
            <div class="setting_btn"><a href="setting.html"><img src="img/setting.png" alt="setting_icon"></a></div>
            <div class="alarm_btn"><a href="#none"><img class="test11" src="img/alarm.png" alt="alarm_icon"></a></div>
        </div>
    </div>
    <div class="hamnav_menu_wrap">
        <div class="hamnav_menu"><a href="#none"><span>학급목록</span></a>
            <div class="hamnav_class_list">
                <div class="hamnav_class"><a href="student_manegement_record.html"><span class="class_title">루트</span><span
                            class="class_grade_">초6</span></a></div>
                <div class="hamnav_class"><a href="student_manegement_record.html"><span class="class_title">파이</span><span
                            class="class_grade_">초6</span></a></div>
                <div class="hamnav_class"><a href="student_manegement_record.html"><span class="class_title">시그마</span><span
                            class="class_grade_">초6</span></a></div>
                <div class="hamnav_class"><a href="student_manegement_record.html"><span class="class_title">루트</span><span
                            class="class_grade_">중1</span></a></div>
            </div>
        </div>
        <div class="hamnav_menu"><a href="homework_manegement_add.html"><span>숙제생성</span></a></div>
        <div class="hamnav_menu"><a href="student_manegement_score_all.html"><span>채점바로가기</span></a></div>
        <div class="hamnav_menu"><a href="class_schedule_list.html"><span>수업계획표/일지</span></a></div>
        <div class="hamnav_menu"><a href="notice_list.html"><span>공지사항</span></a></div>
    </div>
    <div class="alarm_box_wrap_wrap">
        <div class="alarm_box_wrap">
            <div class="alarm_tri"><img src="img/alarm_tri.png" alt="alarm_tri_icon"></div>
            <div class="alarm_box">
                <div>
                    <p id="x_alarm_btn" style="cursor:pointer;font-size:20px;font-weight: bold;text-align: right;">X</p>
                    <div>
                        <ul>
                            <li>
                                <div class="alarm_content">
                                    <p>알림내용이 들어갈자리입니다.</p>
                                </div>
                                <div class="alarm_time">
                                    <p><span>5분</span><span> 전</span></p>
                                </div>
                            </li>
                            <li>
                                <div class="alarm_content">
                                    <p>알림내용이 들어갈자리입니다.</p>
                                </div>
                                <div class="alarm_time">
                                    <p><span>5분</span><span> 전</span></p>
                                </div>
                            </li>
                            <li>
                                <div class="alarm_content">
                                    <p>알림내용이 들어갈자리입니다.</p>
                                </div>
                                <div class="alarm_time">
                                    <p><span>5분</span><span> 전</span></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>
