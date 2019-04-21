<?php
include_once ('head.php');
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/report_detail.css" />
<body>
    <!--section-->
    <section>
        <div class="head_p">
            <p class="head_title">성적표</p>
            <p class="title_detail"><span>2019년</span><span>1분기</span></p>
            <div class="back_btn"><a href="report.php"><img src="img/back_btn.png" alt="back_btn_icon"></a></div>
        </div>
        <div class="content_p">
            <p class="record_class_name">
                <span>초6</span>
                <span>이산수학</span>
                <span> - </span>
                <span>월수금</span>
            </p>
            <p class="student_name"><span>김태연</span></p>
        </div>
        <div class="content_detail_p">
            <div class="report_detail_section">
                <p class="detail_title">영역별 점수</p>
                <div class="detail_content_box">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>1단계</th>
                                <th>2단계</th>
                                <th>3단계</th>
                                <th>총점</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span>김태연</span></td>
                                <td>
                                    <span>35</span>
                                    <span>/</span>
                                    <span>40점</span>
                                </td>
                                <td>
                                    <span>35</span>
                                    <span>/</span>
                                    <span>40점</span>
                                </td>
                                <td>
                                    <span>20</span>
                                    <span>/</span>
                                    <span>20점</span>
                                </td>
                                <td>
                                    <span>95</span>
                                    <span>/</span>
                                    <span>100점</span>
                                </td>
                            </tr>
                            <tr>
                                <td><span>학년평균</span></td>
                                <td><span>30점</span></td>
                                <td><span>30점</span></td>
                                <td><span>15점</span></td>
                                <td><span>75점</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="report_detail_section">
                <p class="detail_title">학생 수준 진단</p>
                <div class="detail_content_box">
                    <p><span>내용표시</span></p>
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