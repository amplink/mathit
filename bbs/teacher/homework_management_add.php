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
    <link rel="stylesheet" type="text/css" media="screen" href="css/homework_manegement_add.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/common.js"></script>
    <script>
        $( function() {
            var dateFormat = "yy-mm-dd",
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

<style>
    .container { margin:110px auto; max-width:640px; text-align: start; }
</style>
<!--<script src="js/homework_manegement_add.js"></script>-->
</head>

<body>
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">숙제관리</p>
            </div>
            <div class="head_right">
                <div class="homework_menu on"><a href="homework_manegement_add.html" class="on">숙제생성</a></div>
                <div class="homework_menu"><a href="homework_manegement_list.html">숙제조회</a></div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="left_box">
            <p class="box_title">출제 대상 선택</p>
            <div class="box_menu_wrap">
                <p>학기</p>
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
            <div class="grade_select_box select_table">
                <table>
                    <thead>
                    <tr>
                        <th>수업목록</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><span>초등 3학년</span><span>이산수학</span></td>
                    </tr>
                    <tr>
                        <td><span>중등 1학년</span><span>덧셈</span></td>
                    </tr>
                    <tr>
                        <td><span>중등 2학년</span><span>상미분방정식</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="class_select_box select_table">
                <table>
                    <thead>
                    <tr>
                        <th>번호</th>
                        <th>요일</th>
                        <th>담당 교사</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td><span>월수금</span><span>2</span></td>
                        <td><span>퇴계이황</span></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><span>화목토</span><span>2</span></td>
                        <td><span>가우스</span></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><span>월수금</span><span>2</span></td>
                        <td><span>유클리드</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="student_list_box">
                <table>
                    <thead>
                    <tr>
                        <th>학생목록</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><span>고이즈미</span></td>
                    </tr>
                    <tr>
                        <td><span>킹목사</span></td>
                    </tr>
                    <tr>
                        <td><span>조지부시</span></td>
                    </tr>
                    <tr>
                        <td><span>홍길동</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="right_wrap">
            <form method='post' action='homework_saved_at_db.php' id="all">
                <div class="right_box">
                    <div class="right_box_1">
                        <p class="box_title">숙제 정보 입력</p>
                        <div class="homework_title_input">
                            <p class="l_text">숙제명</p>
                            <input type="text" placeholder="숙제명을 입력해주세요" name ="name">
                        </div>
                        <div class="homework_deadline_wrap">
                            <div class="date_range">
                                <p class="l_text">시작일</p><input type="text" name="from" id="from">
                            </div>
                            <span>~</span>
                            <div class="date_range">
                                <p class="l_text">종료일</p><input type="text" name="to" id="to">
                            </div>
                        </div>
                    </div>
                    <div class="right_box_2">
                        <p class="box_title">교재 선택</p>
                        <div class="book_table">
                            <div class="book_table" style="overflow:scroll;">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>교재구분</th>
                                        <th>학년</th>
                                        <th>학기</th>
                                        <th>레벨</th>
                                        <th>단원명</th>

                                        <th>코너명</th>
                                        <th>문항번호</th>

                                        <th>코너명</th>
                                        <th>문항번호</th>

                                        <th>코너명</th>
                                        <th>문항번호</th>

                                        <th>코너명</th>
                                        <th>문항번호</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><select name="textbook" id="textbook">
                                                <option value="alpha">알파</option>
                                                <option value="beta">베타</option>
                                            </select></td>
                                        <td><select name="grade" id="grade">
                                                <option value="초3">초3</option>
                                                <option value="초4">초4</option>
                                                <option value="초5">초5</option>
                                                <option value="초6">초6</option>
                                                <option value="중1">중1</option>
                                                <option value="중2">중2</option>
                                                <option value="중3">중3</option>
                                            </select></td>
                                        <td><select name="semester" id="semester">
                                                <option value="1학기">1학기</option>
                                                <option value="2학기">2학기</option>
                                            </select></td>
                                        <td><select name="level" id="level">
                                                <option value="루트">루트</option>
                                                <option value="파이">파이</option>
                                                <option value="시그마">시그마</option>
                                            </select></td>
                                        <td><select name="unit" id="unit">
                                                <option value="덧셈과 뺄셈(1)">덧셈과 뺄셈(1)</option>
                                                <option value="덧셈과 뺄셈(2)">덧셈과 뺄셈(2)</option>
                                                <option value="평면도형">평면도형</option>
                                                <option value="나눗셈">나눗셈</option>
                                                <option value="총정리(1)">총정리(1)</option>
                                                <option value="곱셈">곱셈</option>
                                                <option value="길이와 시간">길이와 시간</option>
                                                <option value="분수와 소수(1)">분수와 소수(1)</option>
                                                <option value="분수와 소수(2)">분수와 소수(2)</option>
                                                <option value="총정리(2)">총정리(2)</option>

                                                <option value="곱셈">곱셈</option>
                                                <option value="곱셈,나눗셈">곱셈,나눗셈</option>
                                                <option value="나눗셈">나눗셈</option>
                                                <option value="원">원</option>
                                                <option value="총정리(1)">총정리(1)</option>
                                                <option value="분수(1)">분수(1)</option>
                                                <option value="분수(2)">분수(2)</option>
                                                <option value="들이와 무게">들이와 무게</option>
                                                <option value="자료의 정리">자료의 정리</option>
                                                <option value="총정리(2)">총정리(2)</option>
                                                <option value="큰 수(1)">큰 수(1)</option>
                                                <option value="큰 수(2)">큰 수(2)</option>
                                                <option value="각도">각도</option>
                                                <option value="곱셈과 나눗셈(1)">곱셈과 나눗셈(1)</option>
                                                <option value="총정리(1)">총정리(1)</option>
                                            </select></td>
                                        <td>
                                            <select name="corner1" id="corner">
                                                <option value="개념마스터">개념마스터</option>
                                                <option value="개념확인">개념확인</option>
                                                <option value="서술과 코칭">서술과 코칭</option>
                                                <option value="이야기수학">이야기수학</option>
                                                <option value="개념다지기">개념다지기</option>
                                                <option value="단원마무리">단원마무리</option>
                                                <option value="도전 문제">도전 문제</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="container">
                                                <select name="Q_number1" class="custumdropdown" custumdrop="question">
                                                    <optiongroup >
                                                        <option value="1">1</option>
                                                        <option value="1">2</option>
                                                        <option value="1">3</option>
                                                        <option value="1">4</option>
                                                        <option value="1">5</option>
                                                        <option value="1">6</option>
                                                        <option value="1">7</option>
                                                        <option value="1">8</option>
                                                        <option value="1">9</option>
                                                        <option value="1">10</option>
                                                        <option value="1">11</option>
                                                        <option value="1">12</option>
                                                        <option value="1">13</option>
                                                        <option value="1">14</option>
                                                        <option value="1">15</option>
                                                        <option value="1">16</option>
                                                        <option value="1">17</option>
                                                        <option value="1">18</option>
                                                        <option value="1">19</option>
                                                        <option value="1">20</option>
                                                        <option value="1">21</option>
                                                        <option value="1">22</option>
                                                        <option value="1">23</option>
                                                        <option value="1">24</option>
                                                        <option value="1">25</option>
                                                        <option value="1">26</option>
                                                        <option value="1">27</option>
                                                        <option value="1">28</option>
                                                        <option value="1">29</option>
                                                        <option value="1">30</option>
                                                    </optiongroup>
                                                </select>
                                                <script src="js/homework_manegement_add.js"></script>

                                                <script>
                                                    $(function() {
                                                        $('.custumdropdown').homework_manegement_add();
                                                    });
                                                </script>
                                            </div>
                                        </td>

                                        <td>
                                            <select name="corner2" id="corner2">
                                                <option value="개념마스터">개념마스터</option>
                                                <option value="개념확인">개념확인</option>
                                                <option value="서술과 코칭">서술과 코칭</option>
                                                <option value="이야기수학">이야기수학</option>
                                                <option value="개념다지기">개념다지기</option>
                                                <option value="단원마무리">단원마무리</option>
                                                <option value="도전 문제">도전 문제</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="Q_number2" id="Q_number2">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="1">5</option>
                                                <option value="1">6</option>
                                                <option value="1">7</option>
                                                <option value="1">8</option>
                                                <option value="1">9</option>
                                                <option value="1">10</option>
                                                <option value="1">11</option>
                                                <option value="1">12</option>
                                                <option value="1">13</option>
                                                <option value="1">14</option>
                                                <option value="1">15</option>
                                                <option value="1">16</option>
                                                <option value="1">17</option>
                                                <option value="1">18</option>
                                                <option value="1">19</option>
                                                <option value="1">20</option>
                                                <option value="1">21</option>
                                                <option value="1">22</option>
                                                <option value="1">23</option>
                                                <option value="1">24</option>
                                                <option value="1">25</option>
                                                <option value="1">26</option>
                                                <option value="1">27</option>
                                                <option value="1">28</option>
                                                <option value="1">29</option>
                                                <option value="1">30</option>
                                            </select>
                                        </td>

                                        <td>
                                            <select name="corner3" id="corner3">
                                                <option value="개념마스터">개념마스터</option>
                                                <option value="개념확인">개념확인</option>
                                                <option value="서술과 코칭">서술과 코칭</option>
                                                <option value="이야기수학">이야기수학</option>
                                                <option value="개념다지기">개념다지기</option>
                                                <option value="단원마무리">단원마무리</option>
                                                <option value="도전 문제">도전 문제</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="Q_number3" id="Q_number3">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="1">5</option>
                                                <option value="1">6</option>
                                                <option value="1">7</option>
                                                <option value="1">8</option>
                                                <option value="1">9</option>
                                                <option value="1">10</option>
                                                <option value="1">11</option>
                                                <option value="1">12</option>
                                                <option value="1">13</option>
                                                <option value="1">14</option>
                                                <option value="1">15</option>
                                                <option value="1">16</option>
                                                <option value="1">17</option>
                                                <option value="1">18</option>
                                                <option value="1">19</option>
                                                <option value="1">20</option>
                                                <option value="1">21</option>
                                                <option value="1">22</option>
                                                <option value="1">23</option>
                                                <option value="1">24</option>
                                                <option value="1">25</option>
                                                <option value="1">26</option>
                                                <option value="1">27</option>
                                                <option value="1">28</option>
                                                <option value="1">29</option>
                                                <option value="1">30</option>
                                            </select>
                                        </td>

                                        <td>
                                            <select name="corner4" id="corner4">
                                                <option value="개념마스터">개념마스터</option>
                                                <option value="개념확인">개념확인</option>
                                                <option value="서술과 코칭">서술과 코칭</option>
                                                <option value="이야기수학">이야기수학</option>
                                                <option value="개념다지기">개념다지기</option>
                                                <option value="단원마무리">단원마무리</option>
                                                <option value="도전 문제">도전 문제</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="Q_number4" id="Q_number4">
                                                <option value="1">1</option>
                                                <option value="1">2</option>
                                                <option value="1">3</option>
                                                <option value="1">4</option>
                                                <option value="1">5</option>
                                                <option value="1">6</option>
                                                <option value="1">7</option>
                                                <option value="1">8</option>
                                                <option value="1">9</option>
                                                <option value="1">10</option>
                                                <option value="1">11</option>
                                                <option value="1">12</option>
                                                <option value="1">13</option>
                                                <option value="1">14</option>
                                                <option value="1">15</option>
                                                <option value="1">16</option>
                                                <option value="1">17</option>
                                                <option value="1">18</option>
                                                <option value="1">19</option>
                                                <option value="1">20</option>
                                                <option value="1">21</option>
                                                <option value="1">22</option>
                                                <option value="1">23</option>
                                                <option value="1">24</option>
                                                <option value="1">25</option>
                                                <option value="1">26</option>
                                                <option value="1">27</option>
                                                <option value="1">28</option>
                                                <option value="1">29</option>
                                                <option value="1">30</option>
                                            </select>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="add_btn_wrap">
                <div class="add_btn" onclick="submit();"><a>등록</a></div>
            </div>
        </div> <!-- end <div class="right_wrap"> -->
    </div> <!-- end <div class="wrapper"> -->
</section>
<script>
    $(document).ready(function () {
        $('.grade_select_box table tbody tr').click(function () {
            if ($(this).hasClass('on') === true) {
                $(this).removeClass('on')
            } else {
                $(this).addClass('on');
                $('.grade_select_box table tbody tr').not(this).removeClass('on');
            }
        })
        $('.class_select_box table tbody tr').click(function () {
            if ($(this).hasClass('on') === true) {
                $(this).removeClass('on')
            } else {
                $(this).addClass('on');
                $('.class_select_box table tbody tr').not(this).removeClass('on');
            }
        })
    })
    function submit() {
        var send_array = Array();
        var send_cnt = 0;
        var chkbox = $(".check");

        for(i=0;i<chkbox.length;i++) {
            if (chkbox[i].checked ){
                send_array[send_cnt] = chkbox[i].value;
                send_cnt++;
            }
        }


        $('#all').submit();
    }
</script>
</body>

</html>