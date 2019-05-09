<?php
include_once ('head.php');
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/homework_all.css" />
<script>
    $( function() {
        var dateFormat = "mm/dd/yy",
            from = $( "#from" )
                .datepicker({
                    defaultDate: "<?=date('m/d/Y')?>",
                    showOn: "button",
                    buttonImage: "img/calendar.png",
                    buttonImageOnly: true,
                    buttonText: "Select date",
                    nextText: "다음달",
                    prevText: "이전달",
                    changeMonth: true,
                    dayNames: ['월요일', '화요일', '수요일', '목요일', '금요일', '토요일', '일요일'],
                    dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'],
                    monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
                    monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
                    numberOfMonths: 1
                })
                .on( "change", function() {
                    to.datepicker( "option", "minDate", getDate( this ) );
                }),
            to = $( "#to" ).datepicker({
                defaultDate: "<?=date('m/d/Y')?>",
                showOn: "button",
                buttonImage: "img/calendar.png",
                buttonImageOnly: true,
                buttonText: "Select date",
                nextText: "다음달",
                prevText: "이전달",
                changeMonth: true,
                dayNames: ['월요일', '화요일', '수요일', '목요일', '금요일', '토요일', '일요일'],
                dayNamesMin: ['월', '화', '수', '목', '금', '토', '일'],
                monthNamesShort: ['1','2','3','4','5','6','7','8','9','10','11','12'],
                monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
                numberOfMonths: 1
            })
                .on( "change", function() {
                    from.datepicker( "option", "maxDate", getDate( this ) );
                });

        function getDate( element ) {
            var date;
            try {
                date = $.datepicker.parseDate( dateFormat, element.value );
            } catch( error ) {
                date = null;
            }

            return date;
        }
    });
</script>
<body>
<!--section-->
<section style="height:100%; overflow:hidden;margin-top:0px">
    <div class="head_p">
        <p class="head_title">숙제관리</p>
        <div class="back_btn"><a href="home.php"><img src="img/back_btn.png" alt="back_btn_icon"></a></div>
    </div>
    <div class="content_p" style="height:87%; border:0px #fff solid">
        <div class="content_menu_wrap">
            <div class="content_menu"><a href="homework_ing.php">진행 중인 숙제</a></div>
            <div class="content_menu on"><a href="homework_all.php" class="on">전체 목록</a></div>
        </div>
        <div class="content_list_wrap" style="height:100%; border:0px #fff solid">
            <form action="<?=$_SERVER['PHP_SELF']?>" method="get" id="form_search">
                <div class="calendar_wrap">
                    <div class="calendar_section">
                        <input type="text" id="from" name="start" style="width:80px" value="<?=$_GET['start']?>">
                        <span> ~ </span>
                        <input type="text" id="to" name="end" style="width:80px" value="<?=$_GET['end']?>">
                    </div>
                    <div class="search_btn" onclick="search();"><img src="img/search_btn.png" alt="search_btn_icon"></div>
                </div>
            </form>

            <?
            // 페이지
            $page_set = 10; // 한페이지 줄수
            $block_set = 10; // 한페이지 블럭수

            $today = date('m/d/Y');

            if($_GET['start'] && $_GET['end'])  $add_sql = " AND (A._from >= '".$_GET['start']."' AND  A._to <='".$_GET['end']."') ";

            $sql = "SELECT
				         COUNT(*)
						FROM `homework` A, `homework_assign_list` B
						WHERE 
							A.seq = B.h_id
						AND B.`client_id`='$_SESSION[client_id]'
						AND B.student_id = '$_SESSION[s_id]'
						AND B.`d_uid` IN ($_SESSION[d_uid])
						AND A._from <= '$today'";
            $sql .= $add_sql;

            //echo $sql;
            $result = sql_query($sql);
            $total = mysqli_fetch_array($result)[0];

            $total_page = ceil ($total / $page_set);
            $total_block = ceil ($total_page / $block_set);

            if (!$page) $page = 1;
            $block = ceil ($page / $block_set);
            $limit_idx = ($page - 1) * $page_set;

            $sql = "SELECT
				         A.seq, A.name, A.d_order, A.grade, A.unit, 
						 A._from, A._to, A.semester, B.submit_date1, B.submit_date2, B.id,
						 (CASE 
						  WHEN (B.current_status = 's2' OR  B.current_status= 's3') THEN '숙제완료'
						  WHEN (B.current_status = 'a1' OR  B.current_status= 'a2') THEN '제출'
						  WHEN (B.current_status = '') THEN '미제출'
						  WHEN (B.apply_status_2 = 'N' AND current_status = 's1') THEN '미제출'
						  END
						  ) status1,
						 (CASE
						  WHEN (B.current_status = 'a1' OR  B.current_status= 'a2') THEN '채점중'
						  WHEN (B.current_status = '') THEN '-'
						  WHEN (B.apply_status_2 = 'N' AND current_status = 's1') THEN '채점완료'
						  WHEN (B.current_status = 's2' OR  B.current_status= 's3') THEN '채점완료'
						  END
						  ) status2
						FROM `homework` A, `homework_assign_list` B
						WHERE 
							A.seq = B.h_id
						AND B.`client_id`='$_SESSION[client_id]'
						AND B.student_id = '$_SESSION[s_id]'
						AND B.`d_uid` IN ($_SESSION[d_uid])
						AND A._from <= '$today'";
            $sql .= $add_sql;
            $sql .= "ORDER BY A._from, A._to ASC LIMIT $limit_idx, $page_set ";
            //echo $sql;
            $result = sql_query($sql);

            if($total > 0) {
                while ($res = mysqli_fetch_array($result)) {
                    if($res['status1'] == '제출') $add_style = "green";
                    else if($res['status1'] == '미제출') $add_style = "red";
                    else if($res['status1'] == '숙제완료') $add_style = "blue";

                    $submit_date = ($res['submit_date2'])?strtotime(substr($res['submit_date2'],0,10)):strtotime(substr($res['submit_date1'],0,10));
                    $to_date = strtotime($res['_to']);

                    $add_style2 = ($submit_date > $to_date && $res['status1'] == '숙제완료')?"color:red":"";
                    $add_style3 = ($submit_date > $to_date)?"color:red":"";
                    $status1 = ($submit_date > $to_date)?"지각제출":$res['status1'];
                    ?>


                    <div class="content_list" onClick="location.href='homework_submission.php?no=<?=$res['id']?>'"  style="cursor:pointer">
                        <div class="content_alarm_section" style="width:63px">
                            <!--숙제 제출화면-->
                            <div class="submission">
                                <div class="submission_sign <?=$add_style?>" style="<?=$add_style2?>"><?=$status1?></div>
                            </div>
                            <div class="scoring">
                                <div class="scoring_none"><span style="color: white;"><?=$res['status2']?></span></div>
                                <!--                                <div class="scoring_ing_sign" style="display: none;"><img src="img/doing.png" alt="scoring_icon"></div>-->
                                <!--                                <div class="scoring_ed_sign"><img src="img/check.png" alt="scoring_icon"></div>-->
                            </div>
                        </div>
                        <div class="content_detail_section <?echo ($res['status1']=='숙제완료')?'final':'';?>" style="width: calc(100% - 95px)">
                            <a href="homework_chat.php?id=<?=$res['id']?>">
                                <!--숙제 확인화면-->
                                <div class="book" style="width:110px">
                                    <div class="section_icon"><img src="img/range.png" alt="range_icon"></div>
                                    <div class="section_text">
                                        <p class="book_name"><?= $res['grade'] ?> - <?= $res['semester'] ?></p>
                                        <p class="book_page"><span><?= $res['unit'] ?></span></p>
                                    </div>
                                </div>
                                <div class="limit">
                                    <div class="section_icon"><img src="img/time.png" alt="time_icon"></div>
                                    <div class="section_text" style="vertical-align:top;padding-top:8px;padding-left:-20px">
                                        <p style="<?=$add_style3?>"><?=substr($res['_from'],0,5)?>~<?=substr($res['_to'],0,5)?></p>
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

                <div style="text-align:center;padding-top:40%"> 숙제가 없습니다.</div>
                <?
            }
            ?>

            <div class="page_wrap">
                <div class="page_wrap_wrap">

                    <?
                    if($total > 0) {
                        $parms = "start=".$_GET['start']."&end=".$_GET['end'];
                        set_paging($page, $block, $block_set, $total_page, $parms);
                    }
                    ?>

                </div>
            </div>
        </div>
</section>
<script>
    function search(){
        $("#form_search").submit();
    }
</script>
</body>
</html>