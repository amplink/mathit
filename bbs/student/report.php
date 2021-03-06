<?php
include_once ('head.php');


// 페이지
$page_set = 10; // 한페이지 줄수
$block_set = 10; // 한페이지 블럭수

$sql = "SELECT 
					  COUNT(*)
					FROM 
					  `teacher_score`
					WHERE 
					   d_uid IN ($_SESSION[d_uid])
					AND
					   student_id = '$_SESSION[s_id]'
					AND 
					   client_id = '$_SESSION[client_id]'";

$result = sql_query($sql);
$total = mysqli_fetch_array($result)[0];


$total_page = ceil ($total / $page_set);
$total_block = ceil ($total_page / $block_set);

if (!$page) $page = 1;
$block = ceil ($page / $block_set);
$limit_idx = ($page - 1) * $page_set;


$sql = "SELECT 
					  *
					FROM 
					  `teacher_score`
					WHERE 
					   d_uid IN ($_SESSION[d_uid])
					AND
					   student_id = '$_SESSION[s_id]'
					AND 
					   client_id = '$_SESSION[client_id]'
					ORDER BY date ASC";

$result = sql_query($sql);
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/report.css" />
<body>
<!--section-->
<section style="height:100%; overflow:auto;margin-top:0px">
    <div class="head_p">
        <p class="head_title">성적관리</p>
        <div class="back_btn"><a href="home.php"><img src="img/back_btn.png" alt="back_btn_icon"></a></div>
    </div>
    <div class="content_p">
    </div>
    <div class="content_detail_p" class="content_p" style="height:86%; border:0px #fff solid">
        <div class="report_list_wrap" style="height:93%; border:0px #fff solid">
            <?
            if($total > 0) {
                while ($res = mysqli_fetch_array($result)) {
                    if($res['test_genre'] == "분기테스트" or $res['test_genre'] == "입반테스트"){
                        $color = "#ffff66";
                        $link = "report_detail";
                        $type= "quarter";
                    }
                    else if($res['test_genre'] == "중간평가" || $res['test_genre'] == "기말평가"){
                        $color = "#ffffff";
                        $link = "report_detail2";
                        $type= "mid";
                    }

                    ?>

                    <div class="report_list" style="background:<?=$color?>;cursor:pointer">
                        <div class="report_info" style="width:80%" onClick="location.href='<?=$link?>.php?no=<?=$res['seq']?>'">
                            <p class="date"><span><?=substr($res['date'],-4)?>-<?=substr($res['date'],0,2)?>-<?=substr($res['date'],3,2)?></span></p>
                            <p class="p report_title"><span><?=$res['year']?></span>
                                <span> - </span>
                                <span><?=$res['quarter']?>분기</span>
                                <span><?=$res['test_genre'] ?></span></p>
                        </div>
                        <div class="report_view_btn"<? if($is_mobile_chk){ ?> style="width:60px" <? } ?>>
                            <a href="<?=$link?>.php?no=<?=$res['seq']?>"><img src="img/report.png" alt="report_icon" style="width:20px"></a>
                            <? if($is_mobile_chk){?>
                                &nbsp;<a href="javascript:print_send('<?=$type?>','<?=$res[seq]?>')"><img src="img/printer.png" alt="report_icon" style="width:20px"></a>
                            <? } ?>
                        </div>
                    </div>

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
        </div>
        <div class="page_wrap" style="position:absolute;bottom:-30px">
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