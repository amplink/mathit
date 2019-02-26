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
    <link rel="stylesheet" type="text/css" media="screen" href="css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/consult_manegement_write.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/common.js"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker({
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
                numberOfMonths: 1
            });
        } );
    </script>
</head>

<body id="x_alarm_btn">
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">
                    <span>초6</span>
                    <span>미적분학</span>
                </p>
                <p>
                    <span>(</span>
                    <span>월수금</span>
                    <span> 반</span>
                    <span>)</span>
                </p>
                <p>
                    <span> - </span>
                    <span>엘사</span>
                    <span> 학생</span>
                </p>
            </div>
            <div class="head_right">
                <div class="consult_list_btn"><a href="consult_manegement_personal.html">상담내역</a></div>
            </div>
        </div>
    </div>
    <div class="consult_board_box">
        <div class="head_line">
            <div class="writer">
                <p>상담자</p>
                <p><span>김대리</span></p>
            </div>
            <div class="write_date">
                <p>상담일자</p>
                <input type="text" id="datepicker">
            </div>
        </div>
        <div class="head_line">
            <div class="consult_detail">
                <p>상담세부설정</p>
            </div>
            <select name="consult_genre" id="consult_genre">
                <option value="base">상담유형</option>
                <option value="consult_genre_1">상담유형1</option>
            </select>
            <select name="consult_topic" id="consult_topic">
                <option value="base">상담주제</option>
                <option value="consult_topic_1">상담주제1</option>
            </select>
        </div>
        <div class="head_line">
            <div class="radio_box">
                <div class="radio_div"><input type="radio" name="object">
                    <p>학부모</p>
                </div>
                <div class="radio_div"><input type="radio" name="object">
                    <p>학생</p>
                </div>
                <div class="radio_div"><input type="radio" name="object">
                    <p>기타</p>
                </div>
            </div>
            <div class="radio_box">
                <div class="radio_div"><input type="radio" name="consult_way">
                    <p>전화</p>
                </div>
                <div class="radio_div"><input type="radio" name="consult_way">
                    <p>대면</p>
                </div>
            </div>
            <div class="radio_box">
                <div class="radio_div"><input type="radio" name="web_open">
                    <p>공개</p>
                </div>
                <div class="radio_div"><input type="radio" name="web_open">
                    <p>비공개</p>
                </div>
            </div>
        </div>
        <div class="textarea_section"><textarea name="" id="" cols="30" rows="10"></textarea></div>
        <div class="btn_section">
            <div class="save_btn"><a href="#none">저장</a></div>
        </div>
        <div class="back_logo"><img src="img/logo_black.png" alt="back_logo"></div>
    </div>
</section>
</body>

</html>