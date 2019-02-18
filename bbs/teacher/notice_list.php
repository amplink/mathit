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
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/notice_list.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>
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
        <p class="navigation_text">공지사항</p>
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
                <p class="left_text">공지사항</p>
            </div>
            <div class="head_right">
                <div class="write_btn"><a href="notice_write.php">공지사항 등록</a></div>
            </div>
        </div>
    </div>
    <div class="contents_box">
        <div class="l_section">
            <div class="table_option_line">
                <p class="option_title">공지 검색</p>
                <div class="option_contnets">
                    <input type="text" placeholder="공지 제목으로 검색합니다" id="search_val">
                    <div class="search_btn" onclick="search();"><a>검색</a></div>
                </div>
            </div>
            <div class="table_option_line">
                <p class="option_title">공지 목록</p>
                <div class="option_contnets">
<!--                    <p>-->
<!--                        <span>새공지</span>-->
<!--                        <span>9</span>-->
<!--                        <span>개</span>-->
<!--                    </p>-->
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
                    <tbody id="notice_val">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="r_section">

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
<script>
    $.ajax({
        type: "GET",
        url: "notice_search.php?search="+$('#search_val').val(),
        dataType: "html",
        success: function(response){
            $("#notice_val").html(response);
        },
    });
    function call_content(seq) {
        $.ajax({
            type: "GET",
            url: "notice_content.php?seq="+seq,
            dataType: "html",
            success: function(response){
                $(".r_section").html(response);
            }
        });
    }
    function chch() {
        $('#side').val($('#rr').val());
    }

    function search() {
        $.ajax({
            type: "GET",
            url: "notice_search.php?search="+$('#search_val').val(),
            dataType: "html",
            success: function(response){
                $("#notice_val").html(response);
            }
        });
    }
    ClassicEditor
        .create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        });
</script>