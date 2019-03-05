<?php
include_once ('_common.php');
include_once ('head.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MathIt - teacher</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="96x96" href="img/f.png">
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/class_schedule_write.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>
</head>

<body>
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">수업계획표/일지</p>
            </div>
            <div class="head_right">
                <div class="class_menu"><a href="class_schedule_list.php">조회</a></div>
                <div class="class_menu on"><a href="class_schedule_write.php" class="on">작성</a></div>
            </div>
        </div>
    </div>
    <form action="class_schedule_write_chk.php" method="post" id="s_form" enctype="multipart/form-data">
    <div class="write_board_section">
        <div class="board_option_line">
            <div class="option_title">
                <p>제출유형</p>
            </div>
            <div class="option_content">
                <div class="type_radio"><input type="radio" name="type" value="수업계획표">
                    <p>수업계획표</p>
                </div>
                <div class="type_radio"><input type="radio" name="type" value="수업일지">
                    <p>수업일지</p>
                </div>
            </div>
        </div>
        <div class="board_option_line">
            <div class="option_title">
                <p>공개범위</p>
            </div>
            <div class="option_content">
                <div class="range_radio"><input type="radio">
                    <p>전체</p>
                </div>
                <div class="range_radio"><input type="radio" name="read_range" value="전임강사">
                    <p>전임강사</p>
                </div>
                <div class="range_radio"><input type="radio" name="read_range" value="관리자">
                    <p>관리자</p>
                </div>
                <div class="range_radio"><input type="radio" name="read_range" value="비공개">
                    <p>비공개</p>
                </div>
            </div>
        </div>
        <div class="board_option_line">
            <div class="option_title">
                <p>제목</p>
            </div>
            <div class="option_content">
                <input type="text" placeholder="제목을 입력하세요" name="title">
            </div>
        </div>
        <div class="board_option_line">
            <div class="option_title">
                <p>첨부파일</p>
            </div>
            <div class="option_content">
                <input type="file" placeholder="첨부파일" name="bf_file[]">
<!--                <div class="file_add_btn"><a href="#none">첨부파일</a></div>-->
            </div>
        </div>
        <div class="">
            <textarea id="content" name="content"></textarea>
        </div>
        <div class="btn_section">
            <div class="btn_wrap">
                <div class="save_btn"><a href="#none">저장</a></div>
                <div class="cancel_btn"><a href="#none">취소</a></div>
            </div>
        </div>
        </form>
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
    ClassicEditor
        .create( document.querySelector( '#content' ) , {
            toolbar: [
                'headings',
                'bold',
                'italic',
                'link',
                'unlink'
            ]
        })
        .catch( error => {
            console.error( error );
        });
    $('.save_btn').on('click', function (e) {
       $("#s_form").submit();
    });
    $('.cancel_btn').on('click', function (e) {
        history.back();
    });
</script>