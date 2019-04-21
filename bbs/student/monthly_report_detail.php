<?php
include_once ('head.php');
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/monthly_report_detail.css" />
<body>
    <!--section-->
    <section>
        <div class="head_p">
            <p class="head_title">월 성적표</p>
            <div class="back_btn"><a href="report.php"><img src="img/back_btn.png" alt="back_btn_icon"></a></div>
        </div>
        <div class="content_p">
            <p class="student_name"><span>김태연</span></p>
            <p class="record_class_name">
                <span>초6</span>
                <span>이산수학</span>
                <span> - </span>
                <span>월수금</span>
            </p>
            <div class="right_info">
                <p class="attendance">
                    <span>출결</span><span>10/12</span>
                </p>
                /
                <p class="attendance_detail">
                    <span>지각</span>
                    <span>1</span>
                    ,
                    <span>결석</span>
                    <span>1</span>
                </p>
            </div>
        </div>
        <div class="content_detail_p">
            <div class="report_detail_section">
                <p class="detail_title">숙제</p>
                <div class="detail_content_box">
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
                                <td><span>9/3</span></td>
                                <td>
                                    <span>주교재</span>
                                    <span>p</span>
                                    <span>2~5</span>
                                </td>
                                <td><span>9/5</span></td>
                                <td>
                                    <span>17</span>
                                    <span>/</span>
                                    <span>20</span>
                                </td>
                                <td>
                                    <span>-</span>
                                    <span></span>
                                    <span></span>
                                </td>
                            </tr>
                            <tr>
                                <td><span>9/3</span></td>
                                <td>
                                    <span>주교재</span>
                                    <span>p</span>
                                    <span>2~5</span>
                                </td>
                                <td><span>9/5</span></td>
                                <td>
                                    <span>17</span>
                                    <span>/</span>
                                    <span>20</span>
                                </td>
                                <td>
                                    <span>-</span>
                                    <span></span>
                                    <span></span>
                                </td>
                            </tr>
                            <tr>
                                <td><span>9/3</span></td>
                                <td>
                                    <span>주교재</span>
                                    <span>p</span>
                                    <span>2~5</span>
                                </td>
                                <td><span>9/5</span></td>
                                <td>
                                    <span>17</span>
                                    <span>/</span>
                                    <span>20</span>
                                </td>
                                <td>
                                    <span>-</span>
                                    <span></span>
                                    <span></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="detail_content_box">
                    <div class="graph_input"></div>
                </div>
            </div>
            <div class="report_detail_section">
                <p class="detail_title">월말 평가</p>
                <div class="detail_content_box">
                    <p><span>95점</span></p>
                    <div class="detail_score">
                        <p><span>평균점수</span><span>60</span><span>점</span></p>
                        <p><span>최고점수</span><span>90</span><span>점</span></p>
                    </div>
                </div>
            </div>
            <div class="report_detail_section">
                <p class="detail_title">선생님 코멘트</p>
                <div class="detail_content_box">
                    <p><span>내용표시</span></p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>