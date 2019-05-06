<?php
include_once ('_common.php');
include_once ('head.php');

$today_date = date("Y-m-d");
?>
<style>
    #my-dialog {
        display: show;
        position: fixed;
        left: calc( 50% - 160px );
        top: 150px;
        width: 300px; height: 155px;
        background: #fff;
        z-index: 9999;
    }
    #my-dialog-background {
        display: show;
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,.3);
        z-index: 999;
    }
</style>
<link rel="stylesheet" type="text/css" href="css/student_manegement_personal_mid_record_detail.css?v=20190421" />

<section>

    <?
    //$student_name = $r[3];

    /*
        $sql = "SELECT * FROM
                 `teacher_score`
                WHERE
                    `d_uid` = '$_GET[d_uid]'
                    AND `c_uid` = '$_GET[c_uid]'
                    AND `s_uid` = '$_GET[s_uid]'
                    AND `student_id` = '$_GET[s_id]'";
    */

    $sql = "SELECT * FROM 
             `teacher_score` 
            WHERE 
                `seq` = '$_GET[no]' and client_id='$ac'";

    $result = mysqli_query($connect_db, $sql);
    $res = mysqli_fetch_array($result);
    $student_id = $res['student_id'];
    //분기시작일 정보
    if($res['test_genre'] == '중간평가') {
        $date = (date("Y") - 1) . "-12-01";
        $link = "/api/math/class?client_no=" . $_SESSION['client_no'] . "&date=" . $date;
        $r = api_calls_get($link);

        $month = explode("/", $res['date']);

        $flag = getQuarter($r[1][3]);
        $start_day = getPeriod($flag, $month[0]);
    }else{ //기말평가

        $sql6 = "SELECT  date
				 FROM
				  `teacher_score`
				 WHERE 
					 d_uid='$res[d_uid]'
				 AND c_uid='$res[c_uid]'
				 AND s_uid='$res[s_uid]'
				 AND d_order='$res[d_order]'
				 AND test_genre='중간평가'
				 AND client_id='$ac'
		";

        $result6 = mysqli_query($connect_db, $sql6);
        $res6 = mysqli_fetch_array($result6);
        $start_day = date("m/d/Y",strtotime ("+1 days", strtotime($res6['date'])));
    }

    $api_start_date = substr($start_day,6,10)."-".substr($start_day,0,2)."-".substr($start_day,3,2);
    $api_end_date = substr($res['date'],6,10)."-".substr($res['date'],0,2)."-".substr($res['date'],3,2);

    $link = "/api/math/student_att?client_no=".$_SESSION['client_no']."&stu_id=".$res['s_uid']."&d_id=".$res['d_uid']."&c_id=".$res['c_uid']."&from=".$api_start_date."&to=".$api_end_date;

    $r = api_calls_get($link);

    ?>
    <div id="list_content">
        <div class="head_section">
            <div class="head_section_1400">
                <div class="head_left">
                    <p class="left_text"><?=$res['test_genre']?></p>
                    <p class="record_date"><?=$today_date?></p>
                </div>
                <div class="head_right">
                    <?  if($_GET['flag']!='1'){ ?>
                        <div class="print" onclick="javascript: print_send('mid','<?=$res[seq]?>')"><img src="img/printer.png" alt="printer_icon"></div>
                        <div class="mail" onclick=""><img src="img/mail.png" alt="mail_icon"></div>
                    <?  } ?>
                    <div class="sub_close_btn">
                        <a href="javascript:window.close()"><img src="img/close.png" alt="close_icon"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="contents">
        <div class="up_box">
            <div class="l_box">
                <div class="student_info_section" style="height: 100px;">
                    <div class="s_info_left">
                        <div class="s_info_div">
                            <p class="l_div_text">학급</p>
                            <div class="r_div_content">
                                <p>
                                    <span><?=$res['class']?></span>
                                </p>
                            </div>
                        </div>
                        <div class="s_info_div">
                            <p class="l_div_text">강사</p>
                            <div class="r_div_content">
                                <p>
                                    <span><?=$res['teacher']?></span>
                                </p>
                            </div>
                        </div>
                        <div class="s_info_div">
                            <p class="l_div_text">학생</p>
                            <div class="r_div_content">
                                <p>
                                    <span><?=$res['student']?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="s_info_right">
                        <div class="s_info_div">
                            <p class="l_div_text">출석율</p>
                            <div class="r_div_content">
                                <p>
										<span>
								<?
                                $result = @(int)(round(($r[1][0] + $r[1][2] / $r[1][1]) * 100));
                                echo $result;
                                ?>%</span>
                                </p>

                                <p>
                                    <span>(지각: <? echo ($r[1][2])?$r[1][2]:"0"?>, 결석: <? echo ($r[1][0])?$r[1][0]:"0"?>)</span>
                                </p>
                            </div>
                        </div>


                        <?
                        $sql2 = "
		
		SELECT  COUNT(C.seq) N1, SUM(C.tot2) N2 FROM (
				SELECT 
					A.seq,
				   (SELECT COUNT(h_id) FROM `homework_assign_list` WHERE h_id = A.seq AND student_id = '$res[student_id]' AND current_status IN ('s2','s3')) tot2
				FROM 
				  `homework` A
				LEFT JOIN 
				 `homework_assign_list` B  
				ON A.seq = B.h_id 
				WHERE 
					A.d_uid='$res[d_uid]'
				AND A.c_uid='$res[c_uid]'
				AND A.s_uid='$res[s_uid]'
				AND B.student_id='$res[student_id]'
				AND A.client_id='$ac'
				AND B.current_status IN ('s2','s3')
				AND (A._from >= '$start_day' AND A._from <= '$res[date]')
				 ) C
				";
                        //ECHO $sql2;
                        $result2 = mysqli_query($connect_db, $sql2);
                        $res2 = mysqli_fetch_array($result2);
                        if($res2['N1'] > 0) $h_avg = floor(($res2['N2'] / $res2['N1'])*100);
                        else                $h_avg = 0 ;
                        ?>

                        <div class="s_info_div">
                            <p class="l_div_text">숙제</p>
                            <div class="r_div_content">
                                <p>
                                    <span>숙제율 :</span>
                                    <span><?=$h_avg?>%</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?
                $avg =round(($res['score1'] + $res['score2']) / 2,1);

                $sql3 = "SELECT 
				  SUM(A.score1 + A.score2) / (COUNT(A.seq)*2) avg,
				  MAX(if(A.score1 > A.score2, A.score1, A.score2)) max,
				  (SELECT SUM(score1 + score2) / (COUNT(seq)*2) 
				   FROM `teacher_score` 
				   WHERE      d_uid='$res[d_uid]'
				          AND c_uid='$res[c_uid]'
				          AND s_uid='$res[s_uid]'
						  AND test_genre='$res[test_genre]') tot2
				FROM
				  `teacher_score` A
				WHERE 
					    c_uid='$res[c_uid]'
				    AND s_uid='$res[s_uid]'
					AND test_genre='$res[test_genre]'";

                //echo $sql3;
                $result3 = mysqli_query($connect_db, $sql3);
                $res3 = mysqli_fetch_array($result3);

                ?>
                <div class="record_detail_table_section">
                    <p class="l_div_text"><?=$res['test_genre']?></p><span>평균 - <?=$avg?>점</span>
                    <div class="record_detail_table">
                        <table>
                            <thead>
                            <tr>
                                <th>1차</th>
                                <th>2차</th>
                                <th>학급평균</th>
                                <th>동일레벨<br>평균점수</th>
                                <th>동일레벨<br>최고점수</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><span><?=$res['score1']?></span></td>
                                <td><span><?=$res['score2']?></span></td>
                                <td><span><?=sprintf("%.1f",$res3['tot2'])?></span></td>
                                <td><span><?=sprintf("%.1f",$res3['avg'])?></span></td>
                                <td><span><?=round($res3['max'])?></span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>

                <?
                $sql4 = "SELECT 
				   IF (B.wrong_anwer_2 = '', B.wrong_anwer_1, B.wrong_anwer_2) wrong_answer,  
				   B.apply_status_1, B.apply_status_2,
				   B.score_status_1, B.score_status_2, 
				   B.wrong_anwer_1, B.wrong_anwer_2, 
				   B.submit_date1, B.submit_date2, 
				   A.seq, A._from, A._to, A.name, A.grade, A.semester, A.unit,
				   A.Q_number1, A.Q_number2, A.Q_number3, A.Q_number4, A.name 
				FROM 
				  `homework` A
				LEFT JOIN 
				 `homework_assign_list` B  
				ON A.seq = B.h_id 
				WHERE 
				   match(A.student_id) against('*$res[student_id]*' in boolean mode) 
				 -- A.student_id like '%$res[student_id]%'
				AND A.c_uid='$res[c_uid]' 
				AND A.client_id='$ac' 
				AND B.student_id='$res[student_id]'
				AND B.current_status IN ('s2','s3')
				AND (A._from >= '$start_day' AND A._from <= '$res[date]')
				ORDER BY A._from asc";

                $result4 = mysqli_query($connect_db, $sql4);
                ?>

                <p class="l_div_text" style="width:200px;">숙제제출 현황</p>
                <p style="height:10px"></p>
                <div class="student_record_table_section">
                    <table>
                        <thead>
                        <tr>
                            <th width="13%">출제일</th>
                            <th width="40%">숙제명</th>
                            <th width="23%">제출일</th>
                            <th width="12%">1차</th>
                            <th width="12%">2차</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?
                        $j = 0;
                        $x = 0;
                        $score_arr = array();
                        $from_date = array();
                        while($res4 = mysqli_fetch_array($result4)) {
                            $wrong_tot1 = 0;
                            $q_tot1 = 0;
                            for($i=1; $i<4; $i++){
                                if($res4['Q_number'.$i]) $q_tot1 += count(explode(",",$res4['Q_number'.$i]));
                            }

                            $wrong1 = json_decode($res4['wrong_anwer_1'],true);
                            if($wrong1){
                                foreach ($wrong1 as $value) {
                                    $wrong_tot1 += count(explode(",",$value));
                                }
                            }
                            $score1 = round((($q_tot1-$wrong_tot1)/$q_tot1) * 100);

                            $wrong_tot2 = 0;
                            $q_tot2 = 0;
                            for($i=1; $i<4; $i++){
                                if($res4['Q_number'.$i]) $q_tot2 += count(explode(",",$res4['Q_number'.$i]));
                            }
                            $wrong2 = json_decode($res4['wrong_anwer_2'],true);
                            if($wrong2){
                                foreach ($wrong2 as $value) {
                                    $wrong_tot2 += count(explode(",",$value));
                                }
                            }
                            //$score2 = round((($wrong_tot1-$wrong_tot2)/$wrong_tot1) * 100);
                            $from_date[$j] = $res4['_from'];

                            ?>

                            <tr style="border-bottom:1px solid #ccc">
                                <td>
                                    <span><?=substr($res4['_from'],6,10)?>-<?=substr($res4['_from'],0,2)?>-<?=substr($res4['_from'],3,2)?></span>
                                </td>
                                <td>
                                    <span><?=$res4['name']?></span>
                                </td>
                                <td>
                                    <?
                                    $submit_date = ($res4['submit_date2'])?substr($res4['submit_date2'],0,10):substr($res4['submit_date1'],0,10);

                                    $submit_date2 = strtotime($submit_date);
                                    $to_date = strtotime($res4['_to']);
                                    $late_chk = ($submit_date2 > $to_date)?"1":"0";
                                    if($late_chk) $x++;
                                    ?>
                                    <span <?if($late_chk)echo "style='color:red'";?>>
									<?=$submit_date?>
									</span>
                                </td>
                                <td>
                                    <span><?=$wrong_tot1?> / <?=$q_tot1?></span>
                                </td>
                                <td>
                                    <span><?=$wrong_tot2?> / <?=$wrong_tot1?></span>
                                </td>
                            </tr>

                            <?
                            if($res4['wrong_answer']) $m = 0;
                            else                      $m = 1;
                            $wrong_tot = count(explode(",",$res4['wrong_answer']))-$m;
                            $scores = round((($q_tot1-$wrong_tot) / $q_tot1) * 100);
                            $score_arr[$j] = (!is_infinite($scores) and !is_nan($scores))?$scores:"0";
                            $j++;
                        }
                        ?>


                        </tbody>
                    </table>
                </div>
                <? if($x > 0){ ?>
                    <span style='font-size:13px;color:red'>* 제출일의 빨간색 표시는 지각 제출을 의미합니다.</span>
                <? } ?>
            </div>
            <?

            //해당분기의 마지막날 구함
            //$timestamp = strtotime("+4 months", strtotime($start_day));
            //$limit_date = date("m/d/Y", $timestamp);


            $sql5 = "SELECT 
					A.seq, B.student_id, A._from,
					IF (B.wrong_anwer_2 = '', B.wrong_anwer_1, B.wrong_anwer_2) wrong_answer,  
					A.Q_number1, A.Q_number2, A.Q_number3, A.Q_number4
				FROM 
				  `homework` A
				LEFT JOIN 
				 `homework_assign_list` B  
				ON A.seq = B.h_id 
				WHERE 
					match(A.student_id) against('*$res[student_id]*' in boolean mode) 
				 -- A.student_id like '%$res[student_id]%'
				AND A.d_uid='$res[d_uid]' 
				AND A.c_uid='$res[c_uid]' 
				AND A.s_uid='$res[s_uid]' 
				AND A.client_id='$ac' 
				AND B.current_status IN ('s2','s3')
				AND (A._from >= '$start_day' AND A._from <= '$res[date]')
				ORDER BY A._from asc" ;

            $result5 = mysqli_query($connect_db, $sql5);
            $j = 0;

            $score_arr2 = array();
            while($res5 = mysqli_fetch_array($result5)) {
                $all = 0;
                for($i=1; $i<=4; $i++){
                    if($res5['Q_number'.$i]) $all += count(explode(",",$res5['Q_number'.$i]));
                }

                if($res5['wrong_answer']) $m = 0;
                else                      $m = 1;
                $wrong_tot = count(explode(",",$res5['wrong_answer'])) - $m;
                $score_arr2[$res5['seq']][] = round((($all-$wrong_tot) / $all) * 100);
                // $score_arr2[$j] =
                $student_arr[$j] = $res5['student_id'];
                $j++;

            }
            $n = count(array_unique($student_arr));
            $i = 0;
            $avg = array();

            foreach ($score_arr2 as $key => $v) {
                $sum = 0;
                foreach ($score_arr2[$key] as $v2) {
                    $sum += $v2;
                }
                $avgs = round($sum / $n);
                $avg[$i] = (!is_infinite($avgs) and !is_nan($avgs))?round($sum / $n):"0";
                $i++;
            }

            $me_score = implode(",",$score_arr);
            $tot_score = implode(",",$avg);

            // $from_date = implode(",",$from_date);
            $max = count($from_date);
            $w_size = "950px";
            ?>

            <div class="r_box" style="position:absolute;z-index:999;width:<?=$w_size?>;height:500px;margin-left:-10px;">
                <? include "./chart.php";?>
            </div>
        </div>
        <div class="down_box">
            <div class="down_head_section">
                <p class="l_div_text">선생님 코멘트</p>

            </div>
            <form name="commentForm" id="commentForm" action="./score_comment_reg.php" method="post">
                <input type="hidden" name="no" id="no" value="<?=$res['seq']?>">
                <input type="hidden" name="flag" value="mid">
                <input type="hidden" name="s_id" value="<?=$_GET['s_id']?>">
                <input type="hidden" name="d_uid" value="<?=$_GET['d_uid']?>">
                <input type="hidden" name="c_uid" value="<?=$_GET['c_uid']?>">
                <input type="hidden" name="s_uid" value="<?=$_GET['s_uid']?>">
                <div class="comment_input_section">
                    <textarea name="comment" id="comment" cols="30" rows="10" style="height:160px;width:97%;min-height:160px;"><?=$res['comment']?></textarea>
                </div>
            </form>
        </div>

    </div>



</section>
<?php
$ac = $_SESSION['client_no'];
$link = "/api/math/student?client_no=".$ac."&id=".$student_id;
$api_res = api_calls_get($link);
?>
<div id="my-dialog">
    <div style="background-color: rgb(41, 124, 62); width: 100%; height: 30px; text-align: center; padding-top: 5px;">
        <p style="color: white; font-size: 20px; font-weight: bold;">SMS 전송</p>
    </div>
    <div style="padding: 20px;">
        <input type="checkbox" value="<?=$api_res[16]?>" id="parent_phone" name="parent_phone" style="height: auto !important;" checked><span> 학부모 : <?=$api_res[16]?></span>
        <br>
        <input type="checkbox" id="add_phone" name="add_phone" style="height: auto !important;"><span> 추가 : </span><input type="text" placeholder="010-0000-0000" name="add_phone_number" id="add_phone_number">
        <br>
        <div style="text-align: center; padding: 10px;">
            <input type="button" style="width: 100px; background-color: rgb(41, 124, 62); color: white; -webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px; border: 0px; font-size: 15px;" value="전송" onclick="sms_send();">
        </div>
    </div>
</div>
<div id="my-dialog-background"></div>


<script>

    function save() {
        $("#commentForm").submit();
    }

</script>
<script src="./js/es6-promise.auto.js"></script>
<script src="./js/html2canvas.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script>

    $(document).ready(function () {
        window.moveTo(0, 0);

        var w = $(document).width();
        var h = $(document).height();
        window.resizeTo(w, h);

        var mw = window.outerWidth - window.innerWidth;
        var mh = window.outerHeight - window.innerHeight;
        window.resizeBy(mw, mh);

        if (isIEVer() < 9) {
            mw = $(document).outerWidth() - $(window).width();
            mh = $(document).outerHeight() - $(window).height();
            window.resizeBy(mw, mh);
        }
    });

    $('#my-dialog-background, .mail').click(function () {
        $('#my-dialog, #my-dialog-background').toggle();
    });

    var scHeight = $('#comment').prop('scrollHeight');
    scHeight2 = scHeight + 100;

    $('#comment').css("height",scHeight+"px");
    $('.down_box').css("height",scHeight2+"px");

    function sms_send() {
        var windowHeight = $( window ).height();
        html2canvas(document.getElementById("contents"),{
            //html2canvas(document.querySelector("section"), {
            //allowTaint: true,
            //taintTest: false,
            scale:2,
            height:windowHeight,
            useCORS: true,
        }).then(function (canvas) {
            var imgageData = canvas.toDataURL("image/png");
            var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
            var parent = "";
            var add_phone = "";
            var no = $("#no").val();

            if($('#parent_phone').prop('checked')==true) parent = $('#parent_phone').val();
            if($('#add_phone').prop('checked')==true) add_phone = $('#add_phone_number').val();

            $.ajax({
                type: "POST",
                url: "imgdown.php",
                data: "canvasData=" + imgageData + "&no=" +  no + "&parent=" + parent + "&add_phone=" + add_phone,
                dataType: "json",
                success: function (data) {
                    if (data.res == "success") alert('문자가 정상적으로 발송 되었습니다.');
                    else alert('문자 발송에 실패하였습니다.');
                    $('#my-dialog, #my-dialog-background').hide();
                    <? if($_GET['flag']=='2'){?>
                    window.close();
                    <?  }  ?>
                },
                error: function (xhr, status, error) {
                    alert(error);
                }
            });
        });

    }

    function print_send(gubun, no) {
        var url = "student_management_personal_"+gubun+"_record_detail.php?no="+no+"&flag=1";
        window.open(url,"PopupWin", "width=1100,height=850");
    }



</script>
</body>

</html>