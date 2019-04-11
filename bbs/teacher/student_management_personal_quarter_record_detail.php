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
    <link rel="stylesheet" type="text/css" media="screen" href="css/student_manegement_personal_quarter_record_detail.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
</head>

<body>
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">분기성적표</p>
                <p class="quarter_date">
                    <span>2018</span>
                    <span>년도 </span>
                    <span>3</span>
                    <span>분기</span>
                </p>
                <p class="record_date"><?=$today_date?></p>
            </div>
            <div class="head_right">
                <div class="print"><img src="img/printer.png" alt="printer_icon"></div>
                <div class="mail"><img src="img/mail.png" alt="mail_icon"></div>
                <div class="sub_close_btn"><a href="javascript:history.back()"><img src="img/close.png" alt="close_icon"</a></div>
            </div>
        </div>
    </div>
    <div class="up_box">
        <div class="l_box">
            <div class="student_info_section">
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
                </div>
            </div>
            <div class="record_detail_table_section">
                <p class="l_div_text">영역별 점수</p>
                <div class="record_detail_table">
                    <table>
                        <thead>
                        <tr>
                            <th>이름/평균</th>
                            <th>1단계</th>
                            <th>2단계</th>
                            <th>3단계</th>
                            <th>총점</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><span>긴또깡</span></td>
                            <td>
                                <span>35점</span>
                                <span>/</span>
                                <span>40점</span>
                            </td>
                            <td>
                                <span>35점</span>
                                <span>/</span>
                                <span>40점</span>
                            </td>
                            <td>
                                <span>35점</span>
                                <span>/</span>
                                <span>40점</span>
                            </td>
                            <td>
                                <span>35점</span>
                                <span>/</span>
                                <span>40점</span>
                            </td>
                        </tr>
                        <tr>
                            <td>학년 평균</td>
                            <td>
                                <span>35점</span>
                            </td>
                            <td>
                                <span>35점</span>
                            </td>
                            <td>
                                <span>35점</span>
                            </td>
                            <td>
                                <span>35점</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="down_box">
        <div class="down_head_section">
            <p class="l_div_text">학생 수준 진단</p>
            <div class="save_btn"><a href="#none">저장</a></div>
        </div>
        <div class="comment_input_section">
            <textarea name="" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="down_head_section">
            <p class="l_div_text">선생님 코멘트</p>
        </div>
        <div class="comment_input_section">
            <textarea name="" id="" cols="30" rows="10"></textarea>
        </div>
    </div>
</section>
</body>

</html>
