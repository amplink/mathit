<?php
include_once ('_common.php');
include_once ('head.php');

$today_date = date("Y-m-d");
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
    <link rel="stylesheet" type="text/css" media="screen" href="css/student_manegement_personal_mid_record_detail.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
</head>

<body>
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">중간성적표</p>
                <p class="record_date"><?=$today_date?></p>
            </div>
            <div class="head_right">
                <div class="print"><img src="img/printer.png" alt="printer_icon"></div>
                <div class="mail"><img src="img/mail.png" alt="mail_icon"></div>
                <div class="sub_close_btn"><img src="img/close.png" alt="close_icon"></div>
            </div>
        </div>
    </div>
    <div class="up_box">
        <div class="l_box">
            <div class="student_info_section" style="height: 100px;">
                <div class="s_info_left">
                    <div class="s_info_div">
                        <p class="l_div_text">학급</p>
                        <div class="r_div_content">
                            <p>
                                <span>초6</span>
                                <span>집합론</span>
                            </p>
                            <p>
                                <span>(</span>
                                <span>월수금</span>
                                <span>)</span>
                            </p>
                        </div>
                    </div>
                    <div class="s_info_div">
                        <p class="l_div_text">강사</p>
                        <div class="r_div_content">
                            <p>
                                <span>탈레스</span>
                            </p>
                        </div>
                    </div>
                    <div class="s_info_div">
                        <p class="l_div_text">학생</p>
                        <div class="r_div_content">
                            <p>
                                <span>최불암</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="s_info_right">
                    <div class="s_info_div">
                        <p class="l_div_text">출결</p>
                        <div class="r_div_content">
                            <p>
                                <span>출석율 : </span>
                                <span>90%</span>
                            </p>

                            <p>
                                <span>(지각 : 1, 결석 : 1)</span>
                            </p>
                        </div>
                    </div>
                    <div class="s_info_div">
                        <p class="l_div_text">숙제</p>
                        <div class="r_div_content">
                            <p>
                                <span>숙제율 : </span>
                                <span>90%</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="record_detail_table_section">
                <p class="l_div_text">기말평가</p><span>평균 - 80점</span>
                <div class="record_detail_table">
                    <table>
                        <thead>
                        <tr>
                            <th>1차</th>
                            <th>2차</th>
                            <th>학급평균</th>
                            <th>동일레벨<br>평균점수</th>
                            <th>동일레벨<br>최고점수</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><span>79</span></td>
                            <td><span>81</span></td>
                            <td><span>90</span></td>
                            <td><span>80</span></td>
                            <td><span>100</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <p class="l_div_text">숙제제출 현황</p>
            <div class="student_record_table_section">
                <table>
                    <thead>
                    <tr>
                        <th>출제일</th>
                        <th>숙제명</th>
                        <th>제출일</th>
                        <th>1차</th>
                        <th>2차</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <span>2018-09-03</span>
                        </td>
                        <td>
                            <span>주교재</span>
                            <span>p2~5</span>
                        </td>
                        <td>
                            <span>2018-09-04</span>
                        </td>
                        <td>
                            <span>11</span>
                            <span>/</span>
                            <span>20</span>
                        </td>
                        <td>
                            <span>3</span>
                            <span>/</span>
                            <span>3</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="r_box">
            <div class="graph_input_section"></div>
        </div>
    </div>
    <div class="down_box">
        <div class="down_head_section">
            <p class="l_div_text">선생님 코멘트</p>
            <div class="save_btn"><a href="#none">저장</a></div>
        </div>
        <div class="comment_input_section">
            <textarea name="" id="" cols="30" rows="10"></textarea>
        </div>
    </div>
</section>
</body>

</html>
