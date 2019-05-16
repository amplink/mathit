<?php
include_once ('_common.php');
include_once ('head.php');

$link = "/api/math/class_stu?client_no=".$_SESSION['client_no']."&d_uid=".$_GET['d_uid']."&c_uid=".$_GET['c_uid'];
$r = api_calls_get($link);

for($i=0; $i<count($d_name); $i++) {
    if($d_uid[$i] == $_GET['d_uid'] && $c_uid[$i] == $_GET['c_uid']) {
        $class_name = $d_name[$i];
        $class_type = $d_yoie[$i];
    }
}
?>


<link rel="stylesheet" type="text/css" media="screen" href="css/homework_manegement_personal.css" />
<script src="js/homework_manegement_personal.js?v=20190415"></script>
<script>
    $( function() {
        $( "#datepicker" ).datepicker({
            //dateFormat: "yy-mm-dd",
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
        });
    } );
</script>
<style>
    .search_btn {
        display: inline-block;
        width: 80px;
        height: 25px;
        line-height: 25px;
        border-radius: 20px;
        background-color: rgb(32, 175, 68);
        margin-left: 10px;
        cursor: pointer;
    }
    .search_btn a {
        display: block;
        width: 100%;
        height: 100%;
        font-size: 14px;
        font-weight: 600;
        color: rgb(255, 255, 255);
        text-align: center;
    }
</style>

<section>
    <form action="<?=$_SERVER['PHP_SELF'];?>" id="searchForm" method="get">
        <input type="hidden" name="s_id" value="<?=$_GET['s_id']?>">
        <input type="hidden" name="d_uid" value="<?=$_GET['d_uid']?>">
        <input type="hidden" name="c_uid" value="<?=$_GET['c_uid']?>">
        <input type="hidden" name="s_uid" value="<?=$_GET['s_uid']?>">
        <input type="hidden" name="class_name" value="<?=$_GET['class_name']?>">
        <input type="hidden" name="student" value="<?=$_GET['student']?>">
        <div class="head_section">
            <div class="head_section_1400">
                <div class="head_left">

                    <p class="left_text">
                        <span><?=$_GET['class_name']?>(<?=$class_type?>)</span>
                    </p>
                    <!-- <p>
                         <span>(</span>
                         <span>월수금</span>
                         <span> 반</span>
                         <span>)</span>
                     </p>-->
                    <p>
                        <span> - </span>
                        <span><?=$_GET['student']?></span>
                        <span> 학생</span>
                    </p>
                </div>
                <div class="head_right" style="margin-top:-5px">
                    <p>시작일 조회</p>
                    <?
                    if(isset($_GET['beginDate'])) $beginDate = $_GET['beginDate'];
                    else					      $beginDate = date('m')."/01/".date('Y');
                    ?>
                    <input type="text" name="beginDate" id="datepicker" class="datepicker2" value="<?=$beginDate?>">
                    <p><div class="search_btn" onclick="search();"><a>검색</a></div></p>
                </div>
            </div>
        </div>
    </form>
    <?
    $sql = "SELECT 
               A.seq, B.id,
	           B.apply_status_1, B.apply_status_2,
	           B.score_status_1, B.score_status_2, 
			   B.wrong_anwer_1, B.wrong_anwer_2,
			   ifnull ( B.current_status, 's0' ) as current_status, 
			   B.submit_date1, B.submit_date2, 
			   A._from, A._to, A.name, A.grade, A.semester, A.unit,
			   A.Q_number1, A.Q_number2, A.Q_number3, A.Q_number4,
			   A.corner1, A.corner2, A.corner3, A.corner4
			FROM 
              `homework` A
			LEFT JOIN 
             `homework_assign_list` B  
			ON A.seq = B.h_id
	        WHERE 
			 match(A.student_id) against('*$_GET[s_id]*' in boolean mode) 
			AND A.d_uid='$_GET[d_uid]'
			AND A.c_uid='$_GET[c_uid]'
			AND A.s_uid='$_GET[s_uid]'
			AND B.student_id= '$_GET[s_id]'
			AND A.client_id='$ac'";
    if($_GET['beginDate']) $sql .= " AND _from >= '".$_GET['beginDate']."'";


    $result2 = mysqli_query($connect_db, $sql);
    ?>

    <div class="homework_table_section">
        <table>
            <thead>
            <tr>
                <th>시작일</th>
                <th>숙제명</th>
                <th>마감일</th>
                <th>1차</th>
                <th>2차</th>
                <th colspan="2">제출 상태</th>
            </tr>
            </thead>
            <tbody>
            <?
            $y = 0;
            while($res2 = mysqli_fetch_array($result2)) {
                ?>
                <tr>
                    <td><span><?=substr($res2['_from'],6,4)?>-<?=substr($res2['_from'],0,2)?>-<?=substr($res2['_from'],3,2)?></span>
                    </td>
                    <td><span><?=$res2['name']?></span>
                        <br>
                        <span><?=$res2['grade']?> - </span><span><?=$res2['semester']?> </span><span>(<?=$res2['unit']?>)</span>
                    </td>
                    <td>
                        <span><?=substr($res2['_to'],6,4)?>-<?=substr($res2['_to'],0,2)?>-<?=substr($res2['_to'],3,2)?></span><br>
                    </td>
                    <td>
                        <?

                        if($res2['score_status_1'] == 'Y'){

                            $wrong_tot1 = 0;
                            $q_tot1 = 0;
                            for($i=1; $i<5; $i++){
                                if($res2['Q_number'.$i]) $q_tot1 += count(explode(",",$res2['Q_number'.$i]));
                            }

                            $wrong1 = json_decode($res2['wrong_anwer_1'],true);
                            if($wrong1){
                                foreach ($wrong1 as $value) {
                                    $wrong_tot1 += count(explode(",",$value));
                                }
                            }
                            $score1 = round((($q_tot1-$wrong_tot1)/$q_tot1) * 100);

                            ?>
                            <span><?=$q_tot1-$wrong_tot1?> / <?=$q_tot1?></span><br>
                            <span><?=$score1?>%</span>
                            <?
                        } else { echo "<span> - </span>"; }
                        ?>
                    </td>
                    <td>
                        <?
                        if($res2['score_status_2'] == 'Y'){

                            $wrong_tot2 = 0;
                            $q_tot2 = 0;
                            for($i=1; $i<5; $i++){
                                if($res2['Q_number'.$i]) $q_tot2 += count(explode(",",$res2['Q_number'.$i]));
                            }
                            $wrong2 = json_decode($res2['wrong_anwer_2'],true);
                            if($wrong2){
                                foreach ($wrong2 as $value) {
                                    $wrong_tot2 += count(explode(",",$value));
                                }
                            }
                            $score2 = round((($wrong_tot1-$wrong_tot2)/$wrong_tot1) * 100);
                            ?>
                            <span><?=$wrong_tot1-$wrong_tot2?> / <?=$wrong_tot1?></span><br>
                            <span><?=$score2?>%</span>

                            <?
                        } else { echo "<span> - </span>"; }
                        ?>
                    <td>
                        <?
                        echo status_view($res2['current_status']);
                        ?>

                    </td>
                    </td>
                    <td>
                        <div class="td_blank"></div>
                        <div class="detail_show_btn" id="<?=$y?>" style="cursor: pointer;"><a>상세보기</a>
                            <!--<? if($res2['apply_status_1'] == 'N') {?>
                                <a href="./submit_test.php?no=<?=$res2['seq']?>&<?=$_SERVER['QUERY_STRING']?>&s=1">1차 제출</a>
                            <? }else if($res2['apply_status_2'] == 'N' and $res2['current_status'] == 's1'){ ?>
                                <a href="./submit_test.php?no=<?=$res2['seq']?>&<?=$_SERVER['QUERY_STRING']?>&s=2">2차 제출</a>
                            <? } ?>-->
                        </div>
                        <!--<div class="detail_show_disable_btn"><a>상세보기</a></div>-->
                    </td>
                </tr>


                <!--modal-->
                <div class="modal_wrap" id="modal_wrap<?=$y?>">
                    <div class="modal_box" style="width:600px">
                        <div class="modal_head">
                            <p>
                                <span><?=$_GET['class_name']?>(<?=$class_type?>)</span>
                            </p>
                            <!--<p>
                                <span>(</span>
                                <span>월수금</span>
                                <span> 반 )</span>
                            </p>-->
                            <p>
                                <span> - </span>
                                <span><?=$_GET['student']?></span>
                                <span> 학생</span>
                            </p>
                            <div class="r_exit_btn" id="<?=$y?>"><img src="img/close.png" alt="close_btn"></div>
                        </div>
                        <div class="modal_div" style="text-align:left;">
                            <p class="modal_subtitle">제출 일시</p>
                            <div class="modal_content">
                                <div class="first">
                                    <p>1차 :</p>
                                    <p>
                                        <?
                                        if($res2['apply_status_1'] == 'Y') {?>
                                            <span>정상제출</span>
                                            <?
                                        }else if($res2['apply_status_1'] == 'N' or empty($res2['apply_status_1'])) {
                                            ?>
                                            <span style="color: red;">미제출</span>
                                            <?
                                        }else{
                                            ?>
                                            <span style="display: none">기간초과제출</span>
                                            <?
                                        }
                                        ?>
                                    </p>

                                    <?
                                    if($res2['apply_status_1'] == 'Y'){
                                        ?>
                                        <p class="year_date" style="padding-left:10px"><?=substr($res2['submit_date1'],"0","10")?></p>
                                        <span> / </span>
                                        <p class="time">
                                            <span><?=substr($res2['submit_date1'],"11","5")?></span>
                                        </p>
                                        <?
                                    }
                                    ?>
                                </div>
                                <div class="second">
                                    <p>2차 :</p>
                                    <p>
                                        <?
                                        if($res2['apply_status_2'] == 'Y') {?>
                                            <span>정상제출</span>
                                            <?
                                        }else if($res2['apply_status_2'] == 'N' or empty($res2['apply_status_2'])) {
                                            ?>
                                            <span style="color: red;">미제출</span>
                                            <?
                                        }else{
                                            ?>
                                            <span style="display: none">기간초과제출</span>
                                            <?
                                        }
                                        ?>
                                    </p>
                                    <?
                                    if($res2['apply_status_2'] == 'Y'){
                                        ?>
                                        <p class="year_date" style="padding-left:10px"><?=substr($res2['submit_date2'],"0","10")?></p>
                                        <span> / </span>
                                        <p class="time">
                                            <span><?=substr($res2['submit_date2'],"11","5")?></span>
                                        </p>
                                        <?
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="modal_div" style="height:400px;text-align:left;overflow:auto;">
                            <p class="modal_subtitle">오답 문항 상세보기</p>
                            <div class="modal_content">
                                <div class="first">

                                    <?
                                    if($res2['score_status_1'] == 'Y'){
                                        ?>
                                        <p style="vertical-align: top">1차 :  <span><? if($wrong_tot1 == 0) echo "만점"; ?> (</span>
                                            <?=$q_tot1-$wrong_tot1?> / <?=$q_tot1?></span>
                                            <span>)</span></p><br><br>
                                        <p><span style="display:inline-block;width:550px">

<?
$j = 1;
foreach ($wrong1 as $key => $v) {
    if($wrong1[$j]){
        echo "<b>(".$res2['corner'.$j].")</b><br>".str_replace(",",",&nbsp;&nbsp;",$wrong1[$j])."<br><br>";
    }
    $j++;
}
?>

                    </span></p>

                                        <?
                                    }
                                    ?>

                                </div>
                                <div class="second">

                                    <?
                                    if($res2['score_status_2'] == 'Y'){
                                        ?>
                                        <p style="vertical-align: top">2차 :  <span><? if($wrong_tot2 == 0) echo "만점"; ?> (</span>
                                            <span><?=$wrong_tot1-$wrong_tot2?> / <?=$wrong_tot1?></span>
                                            <span>)</span></p>
                                        <p><span style="display:inline-block;width:550px">

<?
$j = 1;
foreach ($wrong2 as $key => $v) {
    if($wrong2[$j]){
        echo "<b>(".$res2['corner'.$j].")</b><br>".str_replace(",",",&nbsp;&nbsp;",$wrong2[$j])."<br><br>";
    }
    $j++;
}
?>

					</span></p>
                                        <?
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?
                $y++;
            }
            ?>

            </tbody>
        </table>
    </div>
</section>

</body>

</html>
<script>
    $('.modal_wrap').draggable({
        handle: '.modal_head'
    });

    function search() {
        //var date = $("#datepicker").val();
        $("#searchForm").submit();
    }
</script>