<?php
include_once ('head.php');
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/homework_ing.css" />
<body>
<!--section-->
<section>
    <div class="head_p">
        <p class="head_title">숙제관리</p>
        <div class="back_btn"><a href="home.php"><img src="img/back_btn.png" alt="back_btn_icon"></a></div>
    </div>
    <div class="content_p">
        <div class="content_menu_wrap">
            <div class="content_menu on"><a href="homework_ing.php" class="on">진행 중인 숙제</a></div>
            <div class="content_menu"><a href="homework_all.php">전체 목록</a></div>
        </div>
        <div class="content_list_wrap">

            <?
            // 페이지
            $page_set = 10; // 한페이지 줄수
            $block_set = 10; // 한페이지 블럭수

            $sql = "SELECT
				      COUNT(*)
						FROM `homework` A, `homework_assign_list` B
						WHERE 
							A.seq = B.h_id
						AND B.`client_id`='$_SESSION[client_id]'
						AND B.student_id = '$_SESSION[s_id]'
						AND B.`d_uid`='$_SESSION[d_uid]'
						AND B.current_status NOT IN ('s2','s3')
						ORDER BY A.seq DESC
						";

            $result = sql_query($sql);
            $total = mysqli_fetch_array($result)[0];


            $sql = "SELECT
				         A.seq, A.name, A.d_order, A.grade, A.unit, 
						 A._from, A._to, A.semester, B.submit_date1, B.submit_date2, 
						 (CASE 
						  WHEN (B.current_status = 'a1' OR  B.current_status= 'a2') THEN '제출'
						  WHEN (B.current_status = '') THEN '미제출'
						  WHEN (B.apply_status_2 = 'N' AND current_status = 's1') THEN '미제출'
						  END
						  ) status1,
						 (CASE
						  WHEN (B.current_status = 'a1' OR  B.current_status= 'a2') THEN '채점중'
						  WHEN (B.current_status = '') THEN '-'
						  WHEN (B.apply_status_2 = 'N' AND current_status = 's1') THEN '완료'
						  END
						  ) status2
						FROM `homework` A, `homework_assign_list` B
						WHERE 
							A.seq = B.h_id
						AND B.`client_id`='$_SESSION[client_id]'
						AND B.student_id = '$_SESSION[s_id]'
						AND B.`d_uid`='$_SESSION[d_uid]'
						AND B.current_status NOT IN ('s2','s3')
						ORDER BY A.seq DESC
						";

            $result = sql_query($sql);

            $total_page = ceil ($total / $page_set);
            $total_block = ceil ($total_page / $block_set);

            if (!$page) $page = 1;
            $block = ceil ($page / $block_set);
            $limit_idx = ($page - 1) * $page_set;

            if($total > 0) {
                while ($res = mysqli_fetch_array($result)) {
                    $add_style = ($res['status1'] == '제출')?"green":"red";

                    $submit_date = ($res['submit_date2'])?strtotime(substr($res['submit_date2'],0,10)):strtotime(substr($res['submit_date1'],0,10));
                    $to_date = strtotime($res['_to']);

                    $add_style2 = ($submit_date > $to_date)?"color:red":"";
                    $status1 = ($submit_date > $to_date)?"지각제출":$res['status1'];
                    ?>
                    <div class="content_list">
                        <div class="content_alarm_section" style="width:63px">
                            <a href="homework_submission.php">
                                <!--숙제 제출화면-->
                                <div class="submission">
                                    <div class="submission_sign <?=$add_style?>"><span><?=$status1?></span></div>
                                </div>
                                <div class="scoring">
                                    <div class="scoring_none"><span style="color: white;"><?=$res['status2']?></span></div>
                                    <!-- <div class="scoring_ing_sign" style="display: none;"><img src="img/doing.png" alt="scoring_icon"></div>-->
                                    <!--                                <div class="scoring_ed_sign" style="display: none;"><img src="img/check.png" alt="scoring_icon"></div>-->
                                </div>
                            </a>
                        </div>
                        <div class="content_detail_section" style="width: calc(100% - 95px)">
                            <a href="homework_chat.php?id=<?=$res['id']?>">
                                <!--숙제 확인화면-->
                                <div class="book">
                                    <div class="section_icon"><img src="img/range.png" alt="range_icon"></div>
                                    <div class="section_text">
                                        <p class="book_name"><?= $res['grade'] ?> - <?= $res['semester'] ?></p>
                                        <p class="book_page"><span><?= $res['unit'] ?></span></p>
                                    </div>
                                </div>
                                <div class="limit">
                                    <div class="section_icon"><img src="img/time.png" alt="time_icon"></div>
                                    <div class="section_text" style="vertical-align:top;padding-top:8px">
                                        <p style="<?=$add_style2?>"><?=substr($res['_from'],0,5)?> ~ <?=substr($res['_to'],0,5)?></p>
                                        <!--<p><span>AM</span> <span>00:00</span></p>-->
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?
                }
            }else{
                ?>

                <div style="text-align:center"> 진행 중인 숙제가 없습니다.</div>
                <?
            }
            ?>

        </div>
    </div>
    <div class="page_wrap">
        <div class="page_wrap_wrap">
            <?
            set_paging($page, $block, $block_set, $total_page);
            ?>
        </div>
    </div>
    </div>
</section>
</body>
</html>