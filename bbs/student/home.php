<?php
include_once ('head.php');

if(!$_SESSION['s_uid']) {

    alert_msg('로그인을 먼저 해주세요.');
    location_href("login.php");
}
if($_GET['log']) {
    $log = 1;
}else $log = 0;

$grade = substr($_SESSION[s_level],0,3).$_SESSION[s_grade];
$today = date("m/d/Y");

$sql = "SELECT A.seq, A.name, A.d_order, A.grade, A.unit, A._from, A._to, A.semester, B.id, B.current_status  
        FROM `homework` A, `homework_assign_list` B
        WHERE 
            A.seq = B.h_id
        AND A.`_from` <= '$today'
		AND B.`client_id`='$_SESSION[client_id]'
		AND B.student_id = '$_SESSION[s_id]'
		AND B.`d_uid` IN ($_SESSION[d_uid])
		AND B.current_status NOT IN ('s2','s3')
		ORDER BY A._from DESC, A._to ASC LIMIT 3
		";
$result = sql_query($sql);
$num = mysqli_num_rows($result);
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/home.css" />

<body>
<!--section-->
<section>
    <div class="report_wrap" style="padding-top:20px">
        <div class="section_title_line">
            <a href="homework_ing.php">
                <div class="section_title_wrap">
                    <p class="section_title">HOMEWORK</p>
                    <span class="deco_line"></span>
                </div>
                <div class="more_btn_wrap">
<!--                    <span>+</span>-->
                    <a href="homework_ing.php"><img src="img/plus_icon.jpg" alt="more_btn_icon" style="width: 30px; height: 30px; filter: invert(1);"></a>
                </div>
        </div>
        <?php
        if($num > 0) {
            while ($res = mysqli_fetch_array($result)) {
                ?>
                <div class="report_content_wrap">
                    <div class="report_box">
                        <?if($res['current_status'] == "" || $res['current_status'] == "s1"){?>
                        <a href="homework_submission.php?no=<?=$res['id']?>">
                            <? } ?>
                            <div class="date">
                                <div class="homework_content_img"><img src="img/time.png" alt="time_icon"></div>
                                <div class="homework_content_text">
                                    <p>
                                        <span><?= substr($res['_from'], 0, 5) ?></span><span> ~ <?= substr($res['_to'], 0, 5) ?></span>
                                    </p>
                                </div>
                            </div>
                            <div class="range_view">
                                <div class="homework_content_img"><img src="img/nav/book_img.png" alt="homework_icon">
                                </div>
                                <div class="homework_content_text">
                                    <p><span><?= $res['grade'] ?> - <?= $res['semester'] ?></span>
                                        &nbsp;&nbsp;<span><?= $res['unit'] ?> </span></p>
                                </div>
                            </div>
                            <?if($res['current_status'] == "" || $res['current_status'] == "s1"){?>
                        </a>
                    <? } ?>
                    </div>
                </div>
                <?php
            }
        }else{
            ?>
            <div class="report_content_wrap">
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
                <a href="./report.php"><p class="section_title">REPORT</p></a>
                <span class="deco_line"></span>
            </div>
            <div class="more_btn_wrap">
                <a href="report.php"><img src="img/plus_icon.jpg" alt="more_btn_icon" style="width: 30px; height: 30px; filter: invert(1);"></a>
            </div>
        </div>
        <?php

        $sql2 = "SELECT  seq, quarter, test_genre, date, year
                    FROM `teacher_score`  
                    WHERE 
                        `client_id`='$_SESSION[client_id]'
                    AND `d_uid` IN ($_SESSION[d_uid])
                    AND student_id = '$_SESSION[s_id]'
                    ORDER BY date DESC  LIMIT 3";
        $result2 = sql_query($sql2);
        $num2 = mysqli_num_rows($result2);

        if($num2 > 0) {
            while ($res2 = mysqli_fetch_array($result2)) {

                if($res2['test_genre'] == "분기테스트" or $res2['test_genre'] == "입반테스트"){
                    $link = "report_detail";
                    $type= "quarter";
                }
                else if($res2['test_genre'] == "중간평가" || $res2['test_genre'] == "기말평가"){
                    $link = "report_detail2";
                    $type= "mid";
                }

                ?>
                <a href="<?=$link?>.php?no=<?=$res2['seq']?>">
                    <div class="report_content_wrap">
                        <div class="report_box">
                            <div class="date">
                                <p><span><?=substr($res2['date'],-4) ?>-<?=substr($res2['date'],0,2) ?>-<?=substr($res2['date'],3,2) ?></span></p>
                            </div>
                            <div class="report_content">
                                <p class="report_title" style="width:80%" onClick="location.href='<?=$link?>.php?no=<?=$res2['seq']?>'"><span><?=$res2['year'] ?></span>
                                    <span> - </span>
                                    <span><?=$res2['quarter'] ?>분기</span>
                                    <span> <?=$res2['test_genre'] ?></span></p>

                                <div class="report_icon"<? if($is_mobile_chk){ ?> style="width:60px" <? } ?>>
                                    <a href="<?=$link?>.php?no=<?=$res2['seq']?>"><img src="img/report.png" alt="report_icon" style="width:20px"></a>

                                    <? if($is_mobile_chk){?>
                                        &nbsp;<a href="javascript:print_send('<?=$type?>','<?=$res2[seq]?>')"><img src="img/printer.png" alt="report_icon" style="width:20px"></a>
                                    <? } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
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
    <div class="notice_wrap" style="margin-bottom: 100px;">
        <div class="section_title_line">
            <div class="section_title_wrap">
                <a href="./notice.php"><p class="section_title">NOTICE</p></a>
                <span class="deco_line"></span>
            </div>
            <div class="more_btn_wrap">
                <a href="notice.php"><img src="img/plus_icon.jpg" alt="more_btn_icon" style="width: 30px; height: 30px; filter: invert(1);"></a>
            </div>
        </div>
        <div class="notice_content_wrap">
            <div class="notice_table">
                <?php
                $sub_uid = explode(', ', $_SESSION['d_uid']);
                for($i=0; $i<count($sub_uid); $i++) {
                    if(count($sub_uid)-1 == $i) $d_uid .= $sub_uid[$i];
                    else $d_uid .= $sub_uid[$i]."/|";
                }
                $sql3 = "SELECT  seq, title, event_time, writer, `type`, `file_url`
                             FROM `teacher_notice`  
                             WHERE 
                               (`client_id`='$_SESSION[client_id]' AND `n_range` like '%학생%' AND `d_uid` RLIKE '$d_uid') 
                               or 
                               (`client_id`='$_SESSION[client_id]' AND `n_range` like '%학생%')
                               
                             ORDER BY `type` desc, seq DESC LIMIT 5";
                $result3 = sql_query($sql3);
                $num3 = @mysqli_num_rows($result3);

                if($num3 > 0) {
                    while ($res3 = mysqli_fetch_array($result3)) {
                        if(strpos($res3['title'], ":")) {
                            $sql33 = "SELECT * FROM `notify` where `id`='".$res3['title']."';";
                            $result33 = sql_query($sql33);
                            $res33 = mysqli_fetch_array($result33);
                            ?>
                            <div class="notice_list">
                                <a href="notice_read.php?seq=<?=$res3['seq']?>">
                                    <div class="notice_title">
                                        <p><?php if($res3['type'] == "중요공지") echo "[중요]";?> <?=$res33['title']?>
                                            <?php
                                            if($res33['attach_file_url']) {
                                                ?>
                                                <img src="./img/disc.png" style="width: 13px; height: 13px;">
                                                <?php
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <div class="notice_date">
                                        <p><?=substr($res33['event_time'],0,10)?></p>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }else {
                            ?>
                            <div class="notice_list">
                                <a href="notice_read.php?seq=<?=$res3['seq']?>">
                                    <div class="notice_title">
                                        <p><?php if($res3['type'] == "중요공지") echo "[중요]";?> <?=$res3['title']?>
                                            <?php if($res3['file_url']) {
                                                ?>
                                                <img src="./img/disc.png" style="width: 13px; height: 13px;">
                                                <?php
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <div class="notice_date">
                                        <p><?=substr($res3['event_time'],0,10)?></p>
                                    </div>
                                </a>
                            </div>
                            <?php
                        }
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
</body>
</html>
<script>
    var log = <?php echo $log;?>;
    var id = '<?php echo $_SESSION['s_id'];?>';
    if(log == 1) {
        var filter = "win16|win32|win64|mac|macintel";
        if (navigator.platform) {
            if (filter.indexOf(navigator.platform.toLowerCase()) < 0 ) {
                location.href = "mathit://userid="+id;
            }
        }
    }
</script>