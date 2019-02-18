<?php
include_once ('_common.php');
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MathIt - teacher</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/class_schedule_list.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/common.js"></script>
    <script>
        $( function() {
            var dateFormat = "mm/dd/yy",
                from = $( "#from" )
                    .datepicker({
                        showOn: "button",
                        buttonImage: "img/calendar.png",
                        buttonImageOnly: true,
                        buttonText: "Select date",
                        nextText: "다음달",
                        prevText: "이전달",
                        changeMonth: true,
                        dayNames: ['월요일', '화요일', '수요일', '목요일', '금요일', '토요일', '일요일'],
                        dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'],
                        monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
                        monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
                        numberOfMonths: 2
                    })
                    .on( "change", function() {
                        to.datepicker( "option", "minDate", getDate( this ) );
                    }),
                to = $( "#to" ).datepicker({
                    showOn: "button",
                    buttonImage: "img/calendar.png",
                    buttonImageOnly: true,
                    buttonText: "Select date",
                    nextText: "다음달",
                    prevText: "이전달",
                    changeMonth: true,
                    dayNames: ['월요일', '화요일', '수요일', '목요일', '금요일', '토요일', '일요일'],
                    dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'],
                    monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
                    monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
                    numberOfMonths: 2
                })
                    .on( "change", function() {
                        from.datepicker( "option", "maxDate", getDate( this ) );
                    });

            function getDate( element ) {
                var date;
                try {
                    date = $.datepicker.parseDate( dateFormat, element.value );
                } catch( error ) {
                    date = null;
                }

                return date;
            }
        } );
    </script>
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
        <p class="navigation_text">수업계획표/일지</p>
    </div>
    <div class="member_info_wrap">
        <div class="member_img"><img src="img/user.png" alt="member_img"></div>
        <div class="member_info">
            <p class="member_name">강태민</p>
            <p class="member_grade">전임강사</p>
        </div>
        <div class="logout_btn"><a href="login.html">로그아웃</a></div>
    </div>
</header>
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">수업계획표/일지</p>
            </div>
            <div class="head_right">
                <div class="class_menu on"><a href="class_schedule_list.html" class="on">조회</a></div>
                <div class="class_menu"><a href="class_schedule_write.html">작성</a></div>
            </div>
        </div>
    </div>
    <div class="contents_box">
        <div class="l_section">
            <div class="table_option_line">
                <p class="option_title">제출유형</p>
                <div class="option_contnets">
                    <div class="type_chk"><input type="checkbox">
                        <p>전체</p>
                    </div>
                    <div class="type_chk"><input type="checkbox">
                        <p>수업계획표</p>
                    </div>
                    <div class="type_chk"><input type="checkbox">
                        <p>수업일지</p>
                    </div>
                </div>
            </div>
            <div class="table_option_line">
                <p class="option_title">강사명</p>
                <div class="option_contnets">
                    <select name="teacher_select" id="teacher_select">
                        <option value="base">선택</option>
                        <option value="teacher_1">퇴계이황</option>
                    </select>
                </div>
            </div>
            <div class="table_option_line">
                <p class="option_title">제목</p>
                <div class="option_contnets">
                    <input type="text" placeholder="제목을 입력하세요">
                </div>
            </div>
            <div class="table_option_line">
                <p class="option_title">날짜</p>
                <div class="option_contnets">
                    <div class="date_range"><input type="text" id="from" name="from">
                    </div>
                    <span>~</span>
                    <div class="date_range"><input type="text" id="to" name="to">
                    </div>
                    <div class="search_btn"><a href="#none">검색</a></div>
                </div>
            </div>
            <div class="class_schedule_table">
                <table>
                    <thead>
                    <tr>
                        <th>번호</th>
                        <th>제목</th>
                        <th>첨부파일</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><span>1</span></td>
                        <td><span>제목이 들어갈자리</span>
                            <div class="new">
                                <p>new</p>
                            </div>
                        </td>
                        <td>
                            <div class="have_sign"></div>
                        </td>
                    </tr>
                    <tr>
                        <td><span>1</span></td>
                        <td><span>제목이 들어갈자리</span>
                            <div class="new">
                                <p>new</p>
                            </div>
                        </td>
                        <td>
                            <div class="have_sign"></div>
                        </td>
                    </tr>
                    <tr>
                        <td><span>1</span></td>
                        <td><span>제목이 들어갈자리</span>
                            <div class="new">
                                <p>new</p>
                            </div>
                        </td>
                        <td>
                            <div class="have_sign"></div>
                        </td>
                    </tr>
                    <tr>
                        <td><span>1</span></td>
                        <td><span>제목이 들어갈자리</span>
                            <div class="new">
                                <p>new</p>
                            </div>
                        </td>
                        <td>
                            <div class="have_sign"></div>
                        </td>
                    </tr>
                    <tr>
                        <td><span>1</span></td>
                        <td><span>제목이 들어갈자리</span>
                            <div class="new">
                                <p>new</p>
                            </div>
                        </td>
                        <td>
                            <div class="have_sign"></div>
                        </td>
                    </tr>
                    <tr>
                        <td><span>1</span></td>
                        <td><span>제목이 들어갈자리</span>
                            <div class="new">
                                <p>new</p>
                            </div>
                        </td>
                        <td>
                            <div class="have_sign"></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="r_section">
            <div class="board_line">
                <div class="title_side">
                    <p>제목</p>
                </div>
                <div class="content_side">
                    <p>3-2학기 정규교재</p>
                </div>
            </div>
            <div class="board_line">
                <div class="title_side">
                    <p>작성일</p>
                </div>
                <div class="content_side">
                    <p>2018-11-15</p>
                </div>
            </div>
            <div class="board_line">
                <div class="title_side">
                    <p>작성자</p>
                </div>
                <div class="content_side">
                    <p>운영자</p>
                </div>
            </div>
            <div class="board_line">
                <div class="title_side">
                    <p>첨부파일</p>
                </div>
                <div class="content_side">
                    <input type="text" placeholder="mathit.jpg">
                </div>
            </div>
            <div class="board_main_text_section">
                <div class="main_text">
                    <p>본문 내용이 들어갈자리</p>
                </div>
            </div>
            <div class="btn_section">
                <div class="l_btn_wrap"></div>
                <div class="r_btn_wrap">
                    <div class="add_file_down_btn">
                        <a href="#none">첨부파일 받기</a>
                    </div>
                </div>
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
            <div class="alarm_btn"><a href="#none"><img src="img/alarm.png" alt="alarm_icon"></a></div>
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
