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
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/record_manegement_add.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
</head>

<body>
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">성적입력</p>
            </div>
            <div class="head_right">
                <div class="homework_menu"><a href="record_management_list.php">성적조회</a></div>
                <div class="homework_menu on"><a href="record_management_add.php" class="on">성적입력</a></div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="left_box">
            <p class="box_title">출제대상 선택</p>
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
            <div class="grade_select_box select_table content">
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
                        <th>반 이름</th>
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
            <div class="student_list_box select_table">
                <table>
                    <thead>
                    <tr>
                        <th>시험 유형</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><span>중간평가</span></td>
                    </tr>
                    <tr>
                        <td><span>기말평가</span></td>
                    </tr>
                    <tr>
                        <td><span>분기테스트</span></td>
                    </tr>
                    <tr>
                        <td><span>입반테스트</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="right_wrap">
            <div class="right_box">
                <div class="right_box_1">
                    <div class="r_left_box">
                        <div class="division">
                            <p class="l_div_title">대상반</p>
                            <input type="text" placeholder="반 이름을 입력해주세요">
                        </div>
                        <div class="division">
                            <p class="l_div_title">시험일</p>
                            <input type="text">
                            <div class="calendar_img"><img src="img/calendar.png" alt="calendar_icon"></div>
                        </div>
                        <div class="division">
                            <p class="l_div_title">기준만점</p>
                            <input type="text" placeholder="기준점수">
                            <span> 점</span>
                        </div>
                        <div class="division">
                            <p class="l_div_title">영역별 점수</p>
                            <div class="score_input"><input type="text" placeholder="점수"><span> 점</span></div>
                            <div class="score_input"><input type="text" placeholder="점수"><span> 점</span></div>
                        </div>
                    </div>
                    <div class="r_right_box">
                        <div class="division">
                            <p class="l_div_title">시험유형</p><input type="text" placeholder="시험유형을 입력해주세요">
                        </div>
                        <div class="division">
                            <p class="l_div_title">시험명</p><input type="text" placeholder="시험명을 입력해주세요">
                        </div>
                        <div class="division">
                            <p class="l_div_title">학년 선택</p>
                            <select name="grade_select" id="grade_select">
                                <option value="base">선택</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="right_box_2">
                    <div class="student_each_score_table">
                        <table>
                            <thead>
                            <tr>
                                <th>학생명</th>
                                <th>1회</th>
                                <th>2회</th>
                                <th>평균 점수</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><span>파퀴아오</span></td>
                                <td><input type="text" name="score_add"><span>점</span></td>
                                <td><input type="text" name="score_add"><span>점</span></td>
                                <td><span>4</span><span>점</span></td>
                            </tr>
                            <tr>
                                <td><span>박근혜</span></td>
                                <td><input type="text" name="score_add"><span>점</span></td>
                                <td><input type="text" name="score_add"><span>점</span></td>
                                <td><span>1.5</span><span>점</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="add_btn_wrap">
                <div class="l_btn_wrap">
                    <div class="sms_btn"><a href="#none">SMS발송</a></div>
                    <div class="print_btn"><a href="#none">출력</a></div>
                </div>
                <div class="r_btn_wrap">
                    <div class="complete_btn"><a href="#none">평가완료</a></div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
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

        $('.student_list_box table tbody tr').click(function () {
            if ($(this).hasClass('on') === true) {
                $(this).removeClass('on')
            } else {
                $(this).addClass('on');
                $('.student_list_box table tbody tr').not(this).removeClass('on');
            }
        })
    })
</script>
</body>

</html>
