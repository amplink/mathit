<?php
include_once ('_common.php');
include_once ('head.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MathIt - teacher</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="96x96" href="img/f.png">
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/scoring_chat.css" />
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
</head>

<body>

<?php
$sql = "SELECT 
               A.*, B.*
            FROM 
              `homework_assign_list` A,
              `homework` B
            WHERE 
               B.seq = A.h_id
            AND
		       A.id = '$_GET[id]'
		    AND 
	           A.client_id = '$ac'
		      ";
$result = mysqli_query($connect_db, $sql);
$res = mysqli_fetch_array($result);
?>


<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">
                    <span><?=$res['class_name']?></span>
                </p>
                <p>
                    <span>(</span>
                    <span><?=$res['d_order']?></span>
                    <span>)</span>
                </p>
                <p>
                    <span> - </span>
                    <span><?=$res['student_name']?></span>
                    <span> 학생</span>
                </p>
            </div>
            <div class="head_right">
                <div class="sub_close_btn"><a href="javascript:history.back()"><img src="img/close.png" alt="close_icon"></a></div>
            </div>
        </div>
    </div>
    <div class="scoring_chat_box">
        <div class="chat_head_section">
            <p><span>문제풀기</span></p>
            <p><span><?=$res['grade']?>-<?=$res['semester']?></span>&nbsp;&nbsp;<span><?=$res['unit']?></span></p>
        </div>
        <div class="chat_section content">
            <div class="chat_wrap">
                <ul>

                    <?php
                    if($res['apply_status_1'] == 'Y') {
                        ?>
                        <li>
                            <div class="left_speech_wrap">
                                <div class="l_tri"><img src="img/bubble_tri_left.png" alt=";"></div>
                                <div class="l_speech_bubble">
                                    <p>[정상제출]<br>
                                        1차 제출완료.</p>
                                </div>
                                <div class="time">
                                    <span><?=substr($res['submit_date1'],5,2)?>월</span>
                                    <span><?=substr($res['submit_date1'],8,2)?>일</span>
                                    <span><?=substr($res['submit_date1'],11,5)?></span>
                                </div>
                            </div>
                        </li>
                        <?php
                    }

                    if($res['score_status_1'] == 'Y') {

                        $wrong_tot1 = 0;
                        $wrong_tot2 = 0;
                        $q_tot1 = 0;
                        for($i=1; $i<5; $i++){
                            if($res['Q_number'.$i]) {
                                $q_tot += count(explode(",",$res['Q_number'.$i]));

                                $corner_arr[$i] =  $res['corner'.$i];
                                $Q_number_arr[$i] =  $res['Q_number'.$i];

                            }
                        }

                        $wrong1 = json_decode($res['wrong_anwer_1'],true);
                        $wrong2 = json_decode($res['wrong_anwer_2'],true);

                        if($wrong1){
                            $j=1;
                            foreach ($wrong1 as $key => $v) {
                                if($wrong1[$j]){
                                    $str .= $res['corner'.$j]." : ".str_replace(",",", ",$wrong1[$j])."<br>";
                                    $wrong_tot1 += count(explode(",",$v));
                                }
                                $j++;
                            }
                        }
                        $score1 = round((($q_tot-$wrong_tot1)/$q_tot) * 100);

                        if($wrong2){
                            $j=1;
                            foreach ($wrong2 as $key => $v) {
                                if($wrong2[$j]){
                                    //$str .= $res['corner'.$j]." : ".$wrong2[$j]."<br>";
                                    $wrong_tot2 += count(explode(",",$v));
                                }
                                $j++;
                            }

                            $sql2 = "SELECT 
                                           item_number, answer_image, explain_image, c_name
                                        FROM 
                                          `answer_master`  
                                        WHERE 
                                           book_type='".$res[textbook]."' 
                                           AND grade='".$grade_arr[$res[grade]]."'
                                           AND semester='".$semester_arr[$res[semester]]."'
                                           AND unit = '".$res[unit]."'
                                           AND level = '".$res[level]."'
                                          -- AND c_name = '".$corner_arr[$corner]."'
                                        ORDER BY c_name, item_number ASC";
                            $result2 = mysqli_query($connect_db, $sql2);
                            $group = array();

                            foreach ( $result2 as $value ) {
                                $group[$value['c_name']][] = $value;
                            }
                            $tot = count($group);
                        }
                        ?>
                        <li>
                            <div class="blank"></div>
                            <div class="right_speech_wrap">
                                <div id="hide_wrong_answer1"  style="position:absolute;padding:10px;width:100%;background-color: #FFFFFF;z-index:999;display: none;">
                                    <div class="sub_close_btn" style="padding-right:15px;float:right"><img src="img/close.png" alt="close_icon"></a></div>
                                    <div style="text-align: center;font-size:17px"><b>-오답문항-</b></div>
                                    <div style="text-align: left"><?=$str?></div>
                                </div>
                                <div class="time">
                                    <span><?=substr($res['submit_date1'],5,2)?>월</span>
                                    <span><?=substr($res['submit_date1'],8,2)?>일</span>
                                    <span><?=substr($res['submit_date1'],11,5)?></span>
                                </div>
                                <div class="r_speech_bubble">
                                    <p><?=$res['student_name']?> 학생의 채점 결과,<br>
                                        전체 문항 수 <?=$q_tot?>개 중<br>
                                        오답 수는 <?=$wrong_tot1?>개입니다.<br>
                                        (정답률: <?=$score1?>%)<br>
                                        <?php
                                        if($score1 == 100){
                                            ?>
                                            만점입니다. 축하합니다.<br>
                                            <?
                                        }else{
                                            ?>
                                            오답을 오답 노트에<br>
                                            다시 풀어 제출해 주세요.<br>
                                            <a style="color: red; text-decoration: underline;cursor:pointer" class="show_wrong_answer" id="hide_wrong_answer1">오답문항 보기</a>
                                            <?
                                        }
                                        ?>

                                    </p>
                                </div>

                                <div class="r_tri"><img src="img/bubble_tri_right.png" alt=";"></div>
                            </div>
                        </li>
                        <?php
                    }

                    if($res['apply_status_2'] == 'Y') {
                        ?>
                        <li>
                            <div class="left_speech_wrap">
                                <div class="l_tri"><img src="img/bubble_tri_left.png" alt=";"></div>
                                <div class="l_speech_bubble">
                                    <p>[정상제출]<br>
                                        2차 제출완료</p>
                                </div>

                                <div id="hide_wrong_answer2"  style="position:absolute;top:-230px;padding:10px;width:100%;background-color: #FFFFFF;z-index:999;display: none;">
                                    <div class="sub_close_btn" style="padding-right:15px;float:right"><a><img src="img/close.png" alt="close_icon"></a></div>
                                    <div style="text-align: center;font-size:17px"><b>-오답문항 및 해설-</b></div>
                                    <div style="height:450px;text-align: left;overflow:auto">

                                        <?php
                                        for($i=1; $i<=$tot; $i++) {
                                            if($res['corner'.$i] == '선택' or $res['wrong_anwer_2'] =="") continue;

                                            $chk_wrong_answer = explode(",", $wrong2[$i]);
                                            echo " <br><br><b>".$i.". ".$res['corner'.$i]."</b>";
                                            for($j=0; $j<=count($group[$res['corner'.$i]]); $j++){
                                                if(!in_array($group[$res['corner'.$i]][$j]['item_number'], $chk_wrong_answer)) continue;
                                                $wrongArr =  explode(",",$wrongData[$i]);
                                                ?>
                                                <div>
                                                    <span style="display:inline-block;width:55px;height:30px;vertical-align:top;padding-top:5px;"><?=$group[$res['corner'.$i]][$j]['item_number']?>.</span>
                                                    <span style="display:inline-block;border:1px solid #c3c3c3"><img src="<?=$group[$res['corner'.$i]][$j]['answer_image']?>"></span>
                                                </div>

                                                <? if($group[$res['corner'.$i]][$j]['explain_image']){ ?>
                                                    <div style="width:90%;border:1px solid #c3c3c3">
                                                        <span style="display:inline-block;width:70%;"><img src="<?=$group[$res['corner'.$i]][$j]['explain_image']?>"></span>
                                                    </div>
                                                    <br>
                                                <? } ?>

                                                <?

                                            }
                                        }
                                        ?>

                                    </div>
                                </div>


                                <div class="time">
                                    <span><?=substr($res['submit_date2'],5,2)?>월</span>
                                    <span><?=substr($res['submit_date2'],8,2)?>일</span>
                                    <span><?=substr($res['submit_date2'],11,5)?></span>
                                </div>
                            </div>
                        </li>
                        <?php
                    }

                    if($res['score_status_2'] == 'Y') {
                        ?>
                        <li>
                            <div class="blank"></div>
                            <div class="right_speech_wrap">
                                <div class="time">
                                    <span><?=substr($res['submit_date1'],5,2)?>월</span>
                                    <span><?=substr($res['submit_date1'],8,2)?>일</span>
                                    <span><?=substr($res['submit_date1'],11,5)?></span>
                                </div>
                                <div class="r_speech_bubble">
                                    <p><?=$res['student_name']?> 학생의 채점결과, 오답문항<br>
                                        <?=$wrong_tot1?>개 중 정답은 <?=($wrong_tot1-$wrong_tot2)?>문항입니다.<br>
                                        (전체문항 <?=$q_tot?>개 중 1차 정답: <?=($q_tot-$wrong_tot1)?>개<br>
                                        / 2차정답: <?=($wrong_tot1-$wrong_tot2)?>개 / 문제: <?=($wrong_tot1-($wrong_tot1-$wrong_tot2))?>개)<br>

                                        <?php
                                        if($wrong_tot1-($wrong_tot1-$wrong_tot2) == 0){
                                            ?>
                                            만점입니다.<br>
                                            <?
                                        }else{
                                            ?>
                                            오답문항을 체크해 주세요<br>
                                            <a style="color: red; text-decoration: underline;cursor:pointer" class="show_wrong_answer" id="hide_wrong_answer2">오답문항 및 해설보기</a>
                                            <?
                                        }
                                        ?>



                                    </p>
                                </div>
                                <div class="r_tri"><img src="img/bubble_tri_right.png" alt=";"></div>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>


<!-- Google CDN jQuery with fallback to local -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../js/minified/jquery-1.11.0.min.js"></script>')</script>

<!-- custom scrollbar plugin -->
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

<script>
    (function($){
        $(window).on("load",function(){

            $(".content").mCustomScrollbar({
                snapAmount:40,
                scrollButtons:{enable:true},
                keyboard:{scrollAmount:40},
                mouseWheel:{deltaFactor:40},
                scrollInertia:400
            });

            $(".sub_close_btn").click(function () {
                var id = $(this).parent().attr('id');
                $("#"+id).css("display","none");
            });

            $(".show_wrong_answer").click(function () {
                var id = $(this).attr('id');
                $("#"+id).css("display","block");
            })

        });
    })(jQuery);
</script>
</body>

</html>