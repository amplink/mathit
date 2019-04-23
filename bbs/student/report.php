<?php
include_once ('head.php');


$sql = "SELECT 
				  COUNT(*)
				FROM 
				  `teacher_score`
				WHERE 
				   d_uid = $_SESSION[d_uid]
				AND
				   student_id = '$_SESSION[s_id]'
				AND 
				   A.client_id = '$_SESSION[client_id]'";

$result = sql_query($sql);
$total = mysqli_fetch_array($result)[0];

$sql = "SELECT 
				  *
				FROM 
				  `teacher_score`
				WHERE 
				   d_uid = $_SESSION[d_uid]
				AND
				   student_id = '$_SESSION[s_id]'
				AND 
				   A.client_id = '$_SESSION[client_id]'";
$result = sql_query($sql);
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/report.css" />
<body>
<!--section-->
<section>
    <div class="head_p">
        <p class="head_title">성적관리</p>
        <div class="back_btn"><a href="home.php"><img src="img/back_btn.png" alt="back_btn_icon"></a></div>
    </div>
    <div class="content_p">
    </div>
    <div class="content_detail_p">
        <div class="report_list_wrap">
            <?
            if($total > 0) {
                while ($res = mysqli_fetch_array($result)) {
                    if($res['test_genre'] == "분기테스트") $add_style = "";
                    else if($res['test_genre'] == "중간평가") $add_style = "";
                    else if($res['test_genre'] == "기말평가") $add_style = "";
                    ?>

                    <a href="report_detail.php">
                        <div class="report_list">
                            <div class="report_info">
                                <p class="date"><span>2017.09.30</span></p>
                                <p class="p report_title"><span>2018</span>
                                    <span> - </span>
                                    <span>1분기</span>
                                    <span>월말평가</span></p>
                            </div>
                            <div class="report_view_btn"><img src="img/report.png" alt="report_view_icon"></div>
                        </div>
                    </a>
                    <?
                }
            }else{
                ?>

                <a>
                    <div class="report_list" style="text-align:center">
                        성적이 존재 하지 없습니다.
                    </div>
                </a>
                <?
            }
            ?>
            <a href="report_detail.php">
                <div class="report_list" style="background-color: rgb(180, 255, 150)">
                    <div class="report_info">
                        <p class="date"><span>2017.09.30</span></p>
                        <p class="p report_title"><span>2018</span>
                            <span> - </span>
                            <span>1분기</span>
                            <span>기말평가</span></p>
                    </div>
                    <div class="report_view_btn"><img src="img/report.png" alt="report_view_icon"></div>
                </div>
            </a>
            <a href="report_detail.php">
                <div class="report_list">
                    <div class="report_info">
                        <p class="date"><span>2017.09.30</span></p>
                        <p class="p report_title"><span>2018</span>
                            <span> - </span>
                            <span>1분기</span>
                            <span>월말평가</span></p>
                    </div>
                    <div class="report_view_btn"><img src="img/report.png" alt="report_view_icon"></div>
                </div>
            </a>
            <a href="report_detail.php">
                <div class="report_list" style="background-color: rgb(255, 200, 150)">
                    <div class="report_info">
                        <p class="date"><span>2017.09.30</span></p>
                        <p class="p report_title"><span>2018</span>
                            <span> - </span>
                            <span>1분기</span>
                            <span>분기테스트</span></p>
                    </div>
                    <div class="report_view_btn"><img src="img/report.png" alt="report_view_icon"></div>
                </div>
            </a>
            <a href="report_detail.php">
                <div class="report_list" style="background-color: rgb(180, 255, 150)">
                    <div class="report_info">
                        <p class="date"><span>2017.09.30</span></p>
                        <p class="p report_title"><span>2018</span>
                            <span> - </span>
                            <span>1분기</span>
                            <span>기말평가</span></p>
                    </div>
                    <div class="report_view_btn"><img src="img/report.png" alt="report_view_icon"></div>
                </div>
            </a>
            <a href="report_detail.php">
                <div class="report_list">
                    <div class="report_info">
                        <p class="date"><span>2017.09.30</span></p>
                        <p class="p report_title"><span>2018</span>
                            <span> - </span>
                            <span>1분기</span>
                            <span>월말평가</span></p>
                    </div>
                    <div class="report_view_btn"><img src="img/report.png" alt="report_view_icon"></div>
                </div>
            </a>
            <a href="report_detail.php">
                <div class="report_list" style="background-color: rgb(255, 200, 150)">
                    <div class="report_info">
                        <p class="date"><span>2017.09.30</span></p>
                        <p class="p report_title"><span>2018</span>
                            <span> - </span>
                            <span>1분기</span>
                            <span>분기테스트</span></p>
                    </div>
                    <div class="report_view_btn"><img src="img/report.png" alt="report_view_icon"></div>
                </div>
            </a>
            <a href="report_detail.php">
                <div class="report_list" style="background-color: rgb(180, 255, 150)">
                    <div class="report_info">
                        <p class="date"><span>2017.09.30</span></p>
                        <p class="p report_title"><span>2018</span>
                            <span> - </span>
                            <span>1분기</span>
                            <span>기말평가</span></p>
                    </div>
                    <div class="report_view_btn"><img src="img/report.png" alt="report_view_icon"></div>
                </div>
            </a>
            <a href="report_detail.php">
                <div class="report_list">
                    <div class="report_info">
                        <p class="date"><span>2017.09.30</span></p>
                        <p class="p report_title"><span>2018</span>
                            <span> - </span>
                            <span>1분기</span>
                            <span>월말평가</span></p>
                    </div>
                    <div class="report_view_btn"><img src="img/report.png" alt="report_view_icon"></div>
                </div>
            </a>
        </div>
        <div class="page_wrap">
            <div class="page_wrap_wrap">
                <div class="left_btn"><a href="#none"><img src="img/prev_btn.png" alt="prev_btn_icon"></a></div>
                <div class="page_btn_wrap">
                    <div class="page_btn"><a href="#none" class="on">1</a></div>
                    <div class="page_btn"><a href="#none">2</a></div>
                    <div class="page_btn"><a href="#none">3</a></div>
                    <div class="page_btn"><a href="#none">4</a></div>
                    <div class="page_btn"><a href="#none">5</a></div>
                    <div class="page_btn"><a href="#none">6</a></div>
                    <div class="page_btn"><a href="#none">7</a></div>
                </div>
                <div class="right_btn"><a href="#none"><img src="img/next_btn.png" alt="next_btn_icon"></a></div>
            </div>
        </div>
    </div>
</section>
</body>
</html>