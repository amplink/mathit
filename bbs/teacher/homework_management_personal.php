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
    <link rel="stylesheet" type="text/css" media="screen" href="css/homework_manegement_personal.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/common.js"></script>
    <script src="js/homework_manegement_personal.js"></script>
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
                <p>시작일 조회</p>
                <input type="text" id="datepicker">
            </div>
        </div>
    </div>
    <div class="homework_table_section">
        <table>
            <thead>
            <tr>
                <th>시작일</th>
                <th>숙제명</th>
                <th>마감일</th>
                <th>1차 정답률</th>
                <th>2차 정답률</th>
                <th colspan="2">제출 상태</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><span>2018-09-20</span></td>
                <td><span>주교제</span><span>p 10 ~ 11</span></td>
                <td>
                    <span>~ </span>
                    <span>2018-09-20</span><br>
                    <span>24</span>
                    <span>시 까지</span>
                </td>
                <td>
                    <span>16 / 20</span><br>
                    <span>80%</span>
                </td>
                <td>
                    <span>16 / 20</span><br>
                    <span>80%</span>
                </td>
                <td>
                    <p class="first_submitted show green">1차 제출</p>
                    <p class="second_submitted hide blue">2차 제출</p>
                    <p class="first_scroing_done hide green">1차 채점 완료</p>
                    <p class="final_scroing_done hide blue">숙제 완료</p>
                    <p class="not_submit hide">미제출</p>
                    <p class="excess_date hide red">기한초과제출</p>
                </td>
                <td>
                    <div class="td_blank"></div>
                    <div class="detail_show_btn"><a href="#none">상세보기</a></div>
                    <div class="detail_show_disable_btn" style="display: none;"><a href="#none">상세보기</a></div>
                </td>
            </tr>
            <tr>
                <td><span>2018-09-20</span></td>
                <td><span>주교제</span><span>p 10 ~ 11</span></td>
                <td>
                    <span>~ </span>
                    <span>2018-09-20</span><br>
                    <span>24</span>
                    <span>시 까지</span>
                </td>
                <td>
                    <span>16 / 20</span><br>
                    <span>80%</span>
                </td>
                <td>
                    <span>16 / 20</span><br>
                    <span>80%</span>
                </td>
                <td>
                    <p class="first_submitted hide green">1차 제출</p>
                    <p class="second_submitted show blue">2차 제출</p>
                    <p class="first_scroing_done hide green">1차 채점 완료</p>
                    <p class="final_scroing_done hide blue">숙제 완료</p>
                    <p class="not_submit hide">미제출</p>
                    <p class="excess_date hide red">기한초과제출</p>
                </td>
                <td>
                    <div class="td_blank"></div>
                    <div class="detail_show_btn" style="display: none;"><a href="#none">상세보기</a></div>
                    <div class="detail_show_disable_btn"><a href="#none">상세보기</a></div>
                </td>
            </tr>
            <tr>
                <td><span>2018-09-20</span></td>
                <td><span>주교제</span><span>p 10 ~ 11</span></td>
                <td>
                    <span>~ </span>
                    <span>2018-09-20</span><br>
                    <span>24</span>
                    <span>시 까지</span>
                </td>
                <td>
                    <span>16 / 20</span><br>
                    <span>80%</span>
                </td>
                <td>
                    <span>16 / 20</span><br>
                    <span>80%</span>
                </td>
                <td>
                    <p class="first_submitted hide green">1차 제출</p>
                    <p class="second_submitted hide blue">2차 제출</p>
                    <p class="first_scroing_done show green">1차 채점 완료</p>
                    <p class="final_scroing_done hide blue">숙제 완료</p>
                    <p class="not_submit hide">미제출</p>
                    <p class="excess_date hide red">기한초과제출</p>
                </td>
                <td>
                    <div class="td_blank"></div>
                    <div class="detail_show_btn" style="display: none;"><a href="#none">상세보기</a></div>
                    <div class="detail_show_disable_btn"><a href="#none">상세보기</a></div>
                </td>
            </tr>
            <tr>
                <td><span>2018-09-20</span></td>
                <td><span>주교제</span><span>p 10 ~ 11</span></td>
                <td>
                    <span>~ </span>
                    <span>2018-09-20</span><br>
                    <span>24</span>
                    <span>시 까지</span>
                </td>
                <td>
                    <span>16 / 20</span><br>
                    <span>80%</span>
                </td>
                <td>
                    <span>16 / 20</span><br>
                    <span>80%</span>
                </td>
                <td>
                    <p class="first_submitted hide green">1차 제출</p>
                    <p class="second_submitted hide blue">2차 제출</p>
                    <p class="first_scroing_done hide green">1차 채점 완료</p>
                    <p class="final_scroing_done show blue">숙제 완료</p>
                    <p class="not_submit hide">미제출</p>
                    <p class="excess_date hide red">기한초과제출</p>
                </td>
                <td>
                    <div class="td_blank"></div>
                    <div class="detail_show_btn"><a href="#none">상세보기</a></div>
                    <div class="detail_show_disable_btn" style="display: none;"><a href="#none">상세보기</a></div>
                </td>
            </tr>
            <tr>
                <td><span>2018-09-20</span></td>
                <td><span>주교제</span><span>p 10 ~ 11</span></td>
                <td>
                    <span>~ </span>
                    <span>2018-09-20</span><br>
                    <span>24</span>
                    <span>시 까지</span>
                </td>
                <td>
                    <span>16 / 20</span><br>
                    <span>80%</span>
                </td>
                <td>
                    <span>16 / 20</span><br>
                    <span>80%</span>
                </td>
                <td>
                    <p class="first_submitted hide green">1차 제출</p>
                    <p class="second_submitted hide blue">2차 제출</p>
                    <p class="first_scroing_done hide green">1차 채점 완료</p>
                    <p class="final_scroing_done hide blue">숙제 완료</p>
                    <p class="not_submit show">미제출</p>
                    <p class="excess_date hide red">기한초과제출</p>
                </td>
                <td>
                    <div class="td_blank"></div>
                    <div class="detail_show_btn" style="display: none;"><a href="#none">상세보기</a></div>
                    <div class="detail_show_disable_btn"><a href="#none">상세보기</a></div>
                </td>
            </tr>
            <tr>
                <td><span>2018-09-20</span></td>
                <td><span>주교제</span><span>p 10 ~ 11</span></td>
                <td>
                    <span>~ </span>
                    <span>2018-09-20</span><br>
                    <span>24</span>
                    <span>시 까지</span>
                </td>
                <td>
                    <span>16 / 20</span><br>
                    <span>80%</span>
                </td>
                <td>
                    <span>16 / 20</span><br>
                    <span>80%</span>
                </td>
                <td>
                    <p class="first_submitted hide green">1차 제출</p>
                    <p class="second_submitted hide blue">2차 제출</p>
                    <p class="first_scroing_done hide green">1차 채점 완료</p>
                    <p class="final_scroing_done hide blue">숙제 완료</p>
                    <p class="not_submit hide">미제출</p>
                    <p class="excess_date show red">기한초과제출</p>
                </td>
                <td>
                    <div class="td_blank"></div>
                    <div class="detail_show_btn" style="display: none;"><a href="#none">상세보기</a></div>
                    <div class="detail_show_disable_btn"><a href="#none">상세보기</a></div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</section>

<!--modal-->

<div class="modal_wrap">
    <div class="black_back"></div>
    <div class="modal_box">
        <div class="modal_head">
            <p>
                <span>초6</span>
                <span>회로이론</span>
            </p>
            <p>
                <span>(</span>
                <span>월수금</span>
                <span> 반 )</span>
            </p>
            <p>
                <span> - </span>
                <span>전두환</span>
                <span> 학생</span>
            </p>
            <div class="r_exit_btn"><img src="img/close.png" alt="close_btn"></div>
        </div>
        <div class="modal_div">
            <p class="modal_subtitle">제출 일시</p>
            <div class="modal_content">
                <div class="first">
                    <p>1차 :</p>
                    <p>
                        <span>정상 제출</span>
                        <span style="display: none">기한초과제출</span>
                        <span style="color: red; display: none;">미제출</span>
                    </p>
                    <p class="year_date">2018-09-20</p>
                    <span> / </span>
                    <p class="time">
                        <span>pm</span>
                        <span>17:05</span>
                    </p>
                </div>
                <div class="second">
                    <p>2차 :</p>
                    <p>
                        <span style="display: none;">정상 제출</span>
                        <span style="display: none;">기한초과제출</span>
                        <span style="color: red;">미제출</span>
                    </p>
                    <p class="year_date">2018-09-20</p>
                    <span> / </span>
                    <p class="time">
                        <span>pm</span>
                        <span>17:05</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="modal_div">
            <p class="modal_subtitle">오답문항 상세보기</p>
            <div class="modal_content">
                <div class="first">
                    <p>1차 :</p>
                    <p><span>1, 4, 5, 7, 8</span></p>
                    <p>
                        <span>(</span>
                        <span>5/10</span>
                        <span>)</span>
                    </p>
                </div>
                <div class="second">
                    <p>2차 :</p>
                    <p><span>1, 4, 5, 7, 8</span></p>
                    <p>
                        <span>(</span>
                        <span>5/10</span>
                        <span>)</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>