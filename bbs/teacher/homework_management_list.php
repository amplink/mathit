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
    <link rel="stylesheet" type="text/css" media="screen" href="css/homework_manegement_list.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>

    <style>
        .students_checks{
            display: none;
        }
        .checks_names_wrap{
            overflow: hidden;
            margin: 4px;
        }
        .checks_names_values{
            float: right;
            cursor: pointer;
            font-weight: bold;
        }
        .checkNames_span{
            /*padding: 5px;*/
        }
        .red_color_on{
            color:red;
        }
        .orange_color_on{
            color:orange;
        }
        .green_color_on{
            color:green;
        }
    </style>
    <script type="text/javascript">
        var status_complete_onoff = 0;
        $(document).ready(function () {
            $("#status_complete").on("click", function(){
                toggle_status_complete();

            });
            $("#close_x_btn").on("click", function(){
                toggle_status_complete();
            });
        });
        function toggle_status_complete(){
            if(status_complete_onoff == 1){
                $(".students_checks").hide();
                status_complete_onoff = 0;
            }else{
                $(".students_checks").show();
                status_complete_onoff = 1;
            }
        }
    </script>

</head>
<body>
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">숙제관리</p>
            </div>
            <div class="head_right">
                <div class="homework_menu"><a href="homework_manegement_add.html">숙제생성</a></div>
                <div class="homework_menu on"><a href="homework_manegement_list.html" class="on">숙제조회</a></div>
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
            <div class="student_list_box select_table">
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
            <div class="right_box">
                <p class="box_title">숙제목록</p>
                <div class="table_option_wrap">
                    <div class="table_option">
                        <input type="checkbox">
                        <p>완료한 숙제 목록에서 제외</p>
                    </div>
                </div>
                <div class="homework_list_table">
                    <table>
                        <thead>
                        <tr>
                            <th></th>
                            <th>숙제명</th>
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

                            <th>시작일</th>
                            <th>종료일</th>
                            <th>상태</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div class="x_btn"><img src="img/close.png" alt="delete_icon"></div>
                            </td>

                            <td>
                                <span>숙제명</span>
                            </td>

                            <td><select name="textbook" id="textbook">
                                    <option value="base">선택</option>
                                </select></td>

                            <td><select name="grade" id="grade">
                                    <option value="base">선택</option>
                                </select></td>

                            <td><select name="semester" id="semester">
                                    <option value="base">선택</option>
                                </select></td>

                            <td><select name="level" id="level">
                                    <option value="base">선택</option>
                                </select></td>

                            <td><select name="unit" id="unit">
                                    <option value="base">선택</option>
                                </select></td>

                            <!-- 1번 숙제 -->
                            <td><select name="corner" id="corner">
                                    <option value="base">선택</option>
                                </select>
                            </td>
                            <td><select name="Q_number" id="Q_number">
                                    <option value="base">전체</option>
                                </select>
                            </td>
                            <!-- 2번 숙제 -->
                            <td><select name="corner" id="corner">
                                    <option value="base">선택</option>
                                </select>
                            </td>
                            <td><select name="Q_number" id="Q_number">
                                    <option value="base">전체</option>
                                </select>
                            </td>
                            <!-- 3번 숙제 -->
                            <td><select name="corner" id="corner">
                                    <option value="base">선택</option>
                                </select>
                            </td>
                            <td><select name="Q_number" id="Q_number">
                                    <option value="base">전체</option>
                                </select>
                            </td>
                            <!-- 4번 숙제-->
                            <td><select name="corner" id="corner">
                                    <option value="base">선택</option>
                                </select>
                            </td>
                            <td><select name="Q_number" id="Q_number">
                                    <option value="base">전체</option>
                                </select>
                            </td>
                            <td>
                                <span>2018-07-01</span>
                            </td>
                            <td>
                                <span>2018-08-01</span>
                            </td>
                            <td>
                                <p class="complete_text">완료</p>
                                <p class="ing_text" style="display: none; color: blue;">진행중</p>
                                <div class="resend_btn" style="display: none;"><a href="#none">재전송</a></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="x_btn"><img src="img/close.png" alt="delete_icon"></div>
                            </td>
                            <td>
                                <span>숙제명</span>
                            </td>
                            <td><select name="textbook" id="textbook">
                                    <option value="base">선택</option>
                                </select></td>
                            <td><select name="grade" id="grade">
                                    <option value="base">선택</option>
                                </select></td>
                            <td><select name="semester" id="semester">
                                    <option value="base">선택</option>
                                </select></td>
                            <td><select name="level" id="level">
                                    <option value="base">선택</option>
                                </select></td>
                            <td><select name="unit" id="unit">
                                    <option value="base">선택</option>
                                </select></td>
                            <!-- 1번 숙제 -->
                            <td><select name="corner" id="corner">
                                    <option value="base">선택</option>
                                </select>
                            </td>
                            <td><select name="Q_number" id="Q_number">
                                    <option value="base">전체</option>
                                </select>
                            </td>
                            <!-- 2번 숙제 -->
                            <td><select name="corner" id="corner">
                                    <option value="base">선택</option>
                                </select>
                            </td>
                            <td><select name="Q_number" id="Q_number">
                                    <option value="base">전체</option>
                                </select>
                            </td>
                            <!-- 3번 숙제 -->
                            <td><select name="corner" id="corner">
                                    <option value="base">선택</option>
                                </select>
                            </td>
                            <td><select name="Q_number" id="Q_number">
                                    <option value="base">전체</option>
                                </select>
                            </td>
                            <!-- 4번 숙제-->
                            <td><select name="corner" id="corner">
                                    <option value="base">선택</option>
                                </select>
                            </td>
                            <td><select name="Q_number" id="Q_number">
                                    <option value="base">전체</option>
                                </select>
                            </td>

                            <td>
                                <span>2018-07-01</span>
                            </td>
                            <td>
                                <span>2018-08-01</span>
                            </td>
                            <td>

                                <p class="complete_text" style="display: none;">완료</p>
                                <div>
                                    <p class="ing_text" id="status_complete" style="color: blue;cursor: pointer;">진행중</p>
                                    <div class="students_checks" style="background:rgb(255, 228, 73);
                                                                                position: absolute;
                                                                                padding: 10px;width: 97px;right: 80px;">
                                        <div class="checks_names_wrap">
                                            <div style="float:right;cursor: pointer;" id="close_x_btn"><b>X</b></div>
                                        </div>
                                        <div class="checks_names_wrap">
                                            <div class="checks_names" style="float:left;display:block;">고이즈미</div>
                                            <div class="checks_names_values" ><span id="chkNameVal1" class="checkNames_span green_color_on">완료</span></div>
                                        </div>
                                        <div class="checks_names_wrap">
                                            <div class="checks_names" style="float:left;display:block;">킹목사</div>
                                            <div class="checks_names_values" ><span id="chkNameVal2" class="checkNames_span orange_color_on">1차</span></div>
                                        </div>
                                        <div class="checks_names_wrap">
                                            <div class="checks_names" style="float:left;display:block;">조지부시</div>
                                            <div class="checks_names_values" ><span id="chkNameVal3" class="checkNames_span red_color_on">2차</span></div>
                                        </div>
                                        <div class="checks_names_wrap">
                                            <div class="checks_names" style="float:left;display:block;">홍길동</div>
                                            <div class="checks_names_values" ><span id="chkNameVal4" class="checkNames_span green_color_on">완료</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="resend_btn" style="display: none;"><a href="#none">재전송</a></div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="x_btn"><img src="img/close.png" alt="delete_icon"></div>
                            </td>
                            <td>
                                <span>숙제명</span>
                            </td>
                            <td><select name="textbook" id="textbook">
                                    <option value="base">선택</option>
                                </select></td>
                            <td><select name="grade" id="grade">
                                    <option value="base">선택</option>
                                </select></td>
                            <td><select name="semester" id="semester">
                                    <option value="base">선택</option>
                                </select></td>
                            <td><select name="level" id="level">
                                    <option value="base">선택</option>
                                </select></td>
                            <td><select name="unit" id="unit">
                                    <option value="base">선택</option>
                                </select></td>

                            <!-- 1번 숙제 -->
                            <td><select name="corner" id="corner">
                                    <option value="base">선택</option>
                                </select>
                            </td>
                            <td><select name="Q_number" id="Q_number">
                                    <option value="base">전체</option>
                                </select>
                            </td>
                            <!-- 2번 숙제 -->
                            <td><select name="corner" id="corner">
                                    <option value="base">선택</option>
                                </select>
                            </td>
                            <td><select name="Q_number" id="Q_number">
                                    <option value="base">전체</option>
                                </select>
                            </td>
                            <!-- 3번 숙제 -->
                            <td><select name="corner" id="corner">
                                    <option value="base">선택</option>
                                </select>
                            </td>
                            <td><select name="Q_number" id="Q_number">
                                    <option value="base">전체</option>
                                </select>
                            </td>
                            <!-- 4번 숙제-->
                            <td><select name="corner" id="corner">
                                    <option value="base">선택</option>
                                </select>
                            </td>
                            <td><select name="Q_number" id="Q_number">
                                    <option value="base">전체</option>
                                </select>

                            </td>
                            <td>
                                <span>2018-07-01</span>
                            </td>
                            <td>
                                <span>2018-08-01</span>
                            </td>
                            <td>
                                <p class="complete_text" style="display: none;">완료</p>
                                <p class="ing_text" style="display: none; color: blue;">진행중</p>
                                <div class="resend_btn"><a href="#none">재전송</a></div>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- <div class="add_btn_wrap">
                <div class="add_btn"><a href="#none">등록</a></div>
            </div> -->
        </div>
    </div>
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