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
    <link rel="stylesheet" type="text/css" media="screen" href="css/student_manegement_personal_record.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
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
                <p> 성적표</p>
                <p>
                    <span> - </span>
                    <span>엘사</span>
                    <span> 학생</span>
                </p>
            </div>
            <div class="head_right">
            </div>
        </div>
    </div>
    <div class="student_table_section">
        <table>
            <thead>
            <tr>
                <th>순번</th>
                <th>시험명</th>
                <th>응시일</th>
                <th>성적표</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td><span>2018 - 1분기 중간평가</span></td>
                <td><span>2018-04-15</span></td>
                <td>
                    <div class="paper">
                        <a href="student_manegement_personal_mid_record_detail.html">
                            <img src="img/paper.png" alt="paper_icon">
                        </a>
                    </div>
                    <div class="print"><a href=""><img src="img/printer.png" alt="printer_icon"></a></div>
                    <div class="mail"><a href=""><img src="img/mail.png" alt="mail_icon"></a></div>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td><span>2018 - 2분기 기말평가</span></td>
                <td><span>2018-06-17</span></td>
                <td>
                    <div class="paper"><a href="student_manegement_personal_final_record_detail.html"><img src="img/paper.png"
                                                                                                           alt="paper_icon"></a></div>
                    <div class="print"><a href=""><img src="img/printer.png" alt="printer_icon"></a></div>
                    <div class="mail"><a href=""><img src="img/mail.png" alt="mail_icon"></a></div>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td><span>2018 - 3분기 분기테스트</span></td>
                <td><span>2018-09-16</span></td>
                <td>
                    <div class="paper"><a href="student_manegement_personal_quarter_record_detail.html"><img
                                src="img/paper.png" alt="paper_icon"></a></div>
                    <div class="print"><a href=""><img src="img/printer.png" alt="printer_icon"></a></div>
                    <div class="mail"><a href=""><img src="img/mail.png" alt="mail_icon"></a></div>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td><span>2018 - 4분기 입반테스트</span></td>
                <td><span>2018-11-28</span></td>
                <td>
                    <div class="paper"><a href="student_manegement_personal_quarter_record_detail.html"><img src="img/paper.png"
                                                                                                             alt="paper_icon"></a></div>
                    <div class="print"><a href=""><img src="img/printer.png" alt="printer_icon"></a></div>
                    <div class="mail"><a href=""><img src="img/mail.png" alt="mail_icon"></a></div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</section>
</body>

</html>
