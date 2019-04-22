<?php
include_once ('head.php');

if(!$_SESSION['s_uid']) {

    alert_msg('로그인을 먼저 해주세요.');
    location_href("login.php");
}

$grade = substr($_SESSION[s_level],0,3).$_SESSION[s_grade];

$sql = "SELECT seq, name, d_order, grade, unit, _from, _to, semester 
        FROM `homework` 
        WHERE 
		    `client_id`='$_SESSION[client_id]'
		AND student_id LIKE '%$_SESSION[s_id]%'
		-- AND  match(student_id) against('*$_SESSION[s_id]*' in boolean mode) 
		AND `d_uid`='$_SESSION[d_uid]'
		ORDER BY seq DESC 
		";
$result = sql_query($sql);
$num = mysqli_num_rows($result);
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/home.css" />

<body>
    <!--section-->
    <section>
        <div class="homework_wrap">
            <div class="section_title_line">
                <div class="section_title_wrap">
                    <p class="section_title">HOMEWORK</p>
                    <span class="deco_line"></span>
                </div>
                <div class="more_btn_wrap">
                    <a href="homework_ing.php"><img src="img/green_plus.png" alt="more_btn_icon" style="width: 25px; height: 25px;"></a>
                </div>
            </div>
            <div class="homework_content_wrap">
<?php
            if($num > 0) {
                while ($res = mysqli_fetch_array($result)) {
?>
                    <div class="homework_box">
                        <a href="homework_submission.php">
                            <div class="time_view">
                                <div class="homework_content_img" style="margin-left:-2px"><img src="img/time.png"
                                                                                                alt="time_icon"></div>
                                <div class="homework_content_text" style="margin-left:-1px">
                                    <p>
                                        <span><?= substr($res['_from'], 0, 5) ?></span><span>~<?= substr($res['_to'], 0, 5) ?></span>
                                    </p>
                                </div>
                            </div>
                            <div class="range_view">
                                <div class="homework_content_img"><img src="img/nav/book_img.png" alt="homework_icon">
                                </div>
                                <div class="homework_content_text">
                                    <p><span><?= $res['grade'] ?> - <?= $res['semester'] ?></span></p>
                                    <p><span><?= $res['unit'] ?> </span></p>
                                </div>
                            </div>
                        </a>
                    </div>
<?php
                }
            }else{
?>
                <div class="report_content_wrap" style="width:100%">
                    <div class="report_box">
                        <div class="report_content" style="text-align:center">
                            <p class="report_title">
                                <span> 숙제가 존재하지 않습니다. </span>
                            </p>
                        </div>
                    </div>
                </div>
<?php
            }
?>
            </div>
        </div>
        <div class="report_wrap">
            <div class="section_title_line">
                <div class="section_title_wrap">
                    <p class="section_title">REPORT</p>
                    <span class="deco_line"></span>
                </div>
                <div class="more_btn_wrap">
                    <a href="report.php"><img src="img/green_plus.png" alt="more_btn_icon" style="width: 25px; height: 25px;"></a>
                </div>
            </div>
 <?php

            $sql2 = "SELECT  quarter, test_genre, date, year
                    FROM `teacher_score`  
                    WHERE 
                        `client_id`='$_SESSION[client_id]'
                    AND `d_uid`='$_SESSION[d_uid]'
                    AND student_id = '$_SESSION[s_id]'
                    ORDER BY seq DESC ";
            $result2 = sql_query($sql2);
            $num2 = mysqli_num_rows($result2);

            if($num2 > 0) {
                while ($res2 = mysqli_fetch_array($result2)) {
?>

                    <div class="report_content_wrap">
                        <div class="report_box">
                            <div class="date">
                                <p><span><?=substr($res2['date'],-4) ?>-<?=substr($res2['date'],0,2) ?>-<?=substr($res2['date'],3,2) ?></span></p>
                            </div>
                            <div class="report_content">
                                <p class="report_title"><span><?=$res2['year'] ?></span>
                                    <span> - </span>
                                    <span><?=$res2['quarter'] ?>분기</span>
                                    <span> <?=$res2['test_genre'] ?></span></p>
                                <div class="report_icon"><a href="report_detail.php"><img src="img/report.png" alt="report_icon"></a></div>
                            </div>
                        </div>
                    </div>
<?php
                }
            }else {
?>
                <div class="report_content_wrap">
                    <div class="report_box">
                        <div class="report_content" style="text-align:center">
                            <p class="report_title">
                                <span> 시험이 존재하지 않습니다. </span>
                            </p>
                        </div>
                    </div>
                </div>
<?php
            }
?>
        </div>
        <div class="notice_wrap">
            <div class="section_title_line">
                <div class="section_title_wrap">
                    <p class="section_title">NOTICE</p>
                    <span class="deco_line"></span>
                </div>
                <div class="more_btn_wrap">
                    <a href="notice.php"><img src="img/green_plus.png" alt="more_btn_icon" style="width: 25px; height: 25px;"></a>
                </div>
            </div>
            <div class="notice_content_wrap">
                <div class="notice_table">
<?php

                    $sql3 = "SELECT  seq, title, event_time
                             FROM `teacher_notice`  
                             WHERE 
                               `client_id`='$_SESSION[client_id]'
                             ORDER BY seq DESC LIMIT 5";
                    $result3 = sql_query($sql3);
                    $num3 = @mysqli_num_rows($result3);

                    if($num3 > 0) {
                         while ($res3 = mysqli_fetch_array($result3)) {
?>
                    <div class="notice_list">
                        <a href="notice_read.php">
                            <div class="notice_title">
                                <p><?=$res3['title']?></p>
                            </div>
                            <div class="notice_date">
                                <p><?=substr($res3['event_time'],0,10)?></p>
                            </div>
                        </a>
                    </div>
<?php
                         }
                    }else {
?>

                     <div class="report_content" style="text-align:center">
                             <p class="report_title">
                                <span> 공지사항이 존재하지 않습니다. </span>
                             </p>
                     </div>

<?php
                    }
?>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <p class="copyright"><span>copyright ⓒ 2019 PSE corp. All Rights Reserved.</span></p>
    </footer>
</body>
</html>