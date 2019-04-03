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
    <link rel="stylesheet" type="text/css" media="screen" href="css/scoring_list.css" />
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
        <div class="scoring_table_section">
            <table>
                <thead>
                    <tr>
                        <th>시작일</th>
                        <th>숙제명</th>
                        <th>마감일</th>
                        <th>제출 상태</th>
                        <th>채점 상태</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span>2018-09-20</span></td>
                        <td>
                            <a href="scoring_chat.html">
                                <div>
                                    <span>주교재</span>
                                    <span>p10 ~ 11</span>
                                </div>
                            </a>
                        </td>
                        <td>
                            <span>2018-09-27</span>
                        </td>
                        <td>
                            <p class="first_submitted" style="color: green;">1차 제출</p>
                            <p class="second_submitted" style="color: blue; display: none">2차 제출</p>
                            <p class="first_scroing_done" style="color: green; display: none">1차 채점 완료</p>
                            <p class="final_scroing_done" style="color: blue; display: none;">숙제 완료</p>
                            <p class="not_submit" style="display: none;">미제출</p>
                            <p class="excess_date" style="color: red; display: none">지각 제출</p>
                        </td>
                        <td>
                            <div class="scoring_btn"><a href="scoring.html">채점하기</a></div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </section>
</body>

</html>