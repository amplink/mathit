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
    <link rel="stylesheet" type="text/css" media="screen" href="css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/consult_manegement_personal.css" />
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
                <div class="consult_mane_btn"><a href="consult_manegement_write.html">상담관리</a></div>
            </div>
        </div>
    </div>
    <div class="student_consult_box">
        <div class="head_line">
            <div class="day_input">
                <div class="date_range">
                    <input type="text" id="from">
                </div>
                <span> ~ </span>
                <div class="date_range">
                    <input type="text" id="to">
                </div>
            </div>
            <div class="search_btn"><a href="#none">검색</a></div>
            <div class="month_btn_wrap">
                <div class="month_btn"><a href="#none">1개월</a></div>
                <div class="month_btn"><a href="#none">2개월</a></div>
                <div class="month_btn"><a href="#none">3개월</a></div>
                <div class="month_btn"><a href="#none">전체</a></div>
            </div>

        </div>
        <div class="consult_table">
            <table>
                <thead>
                <tr>
                    <th>상담일</th>
                    <th>학생명</th>
                    <th>상담자</th>
                    <th>대상</th>
                    <th>유형</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><span>2018-05-21</span></td>
                    <td><span>레드벨벳</span></td>
                    <td><span>이수만</span></td>
                    <td><span>학생</span></td>
                    <td><span>정규</span></td>
                </tr>
                <tr>
                    <td><span>2018-05-21</span></td>
                    <td><span>블랙핑크</span></td>
                    <td><span>양현석</span></td>
                    <td><span>학부모</span></td>
                    <td><span>정규</span></td>
                </tr>
                <tr>
                    <td><span>2018-05-21</span></td>
                    <td><span>트와이스</span></td>
                    <td><span>박진영</span></td>
                    <td><span>학생</span></td>
                    <td><span>상시</span></td>
                </tr>
                <tr>
                    <td><span>2018-05-21</span></td>
                    <td><span>아이즈원</span></td>
                    <td><span>국프</span></td>
                    <td><span>학생</span></td>
                    <td><span>정규</span></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="textarea_input_section">
            <p>상담내용</p>
            <textarea name="" id="" cols="30" rows="10"></textarea>
            <div class="btn_section">
                <div class="btn_wrap">
                    <div class="modify_btn"><a href="#none">수정</a></div>
                    <div class="delete_btn"><a href="#none">삭제</a></div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>

</html>