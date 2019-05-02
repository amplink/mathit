<?php
include_once ('head.php');
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/homework_chat.css" />

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
				   A.client_id = '$_SESSION[client_id]'
				  ";
$result = mysqli_query($connect_db, $sql);
$res = mysqli_fetch_array($result);
?>

<script>

    function resize(img){

        // 원본 이미지 사이즈 저장
        var width = img.width;
        var height = img.height;

        // 가로, 세로 최대 사이즈 설정
        var maxWidth = width * 0.6;   // 원하는대로 설정. 픽셀로 하려면 maxWidth = 100  이런 식으로 입력
        var maxHeight = height * 0.6;   // 원래 사이즈 * 0.5 = 50%

        // 가로나 세로의 길이가 최대 사이즈보다 크면 실행
        if(width > maxWidth || height > maxHeight){

            // 가로가 세로보다 크면 가로는 최대사이즈로, 세로는 비율 맞춰 리사이즈
            if(width > height){
                resizeWidth = maxWidth;
                resizeHeight = Math.round((height * resizeWidth) / width);

                // 세로가 가로보다 크면 세로는 최대사이즈로, 가로는 비율 맞춰 리사이즈
            }else{
                resizeHeight = maxHeight;
                resizeWidth = Math.round((width * resizeHeight) / height);
            }

            // 최대사이즈보다 작으면 원본 그대로
        }else{
            resizeWidth = width;
            resizeHeight = height;
        }

        // 리사이즈한 크기로 이미지 크기 다시 지정
        img.width = resizeWidth;
        img.height = resizeHeight;
    }


</script>

<!--section-->
<section>
    <div class="head_p">
        <p class="head_title">제출 결과 확인</p>
        <div class="back_btn"><a href="javascript:history.back()"><img src="img/back_btn.png" alt="back_btn_icon"></a></div>
    </div>
    <div class="content_p">
        <div class="homework_name_wrap">
            <p class="sub_title">숙제명</p>
            <p class="sub_section_info"><span><?= $res['grade'] ?> - <?= $res['semester'] ?></span>
                <span><?= $res['unit'] ?></span></p>
        </div>
        <div class="homework_limit_wrap">
            <p class="sub_title">마감일</p>
            <p class="sub_section_info">
                <span><?=substr($res['_to'],-4)?>-<?=substr($res['_to'],0,2)?>-<?=substr($res['_to'],3,2)?></span>
            </p>
        </div>
    </div>
    <div class="content_detail_p">
        <div class="chat_wrap">
            <ul>
                <?php
                if($res['apply_status_1'] == 'Y') {
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
                                <p>[정상제출]<br>
                                    1차 제출완료.</p>
                            </div>
                            <div class="r_tri"><img src="img/bubble_tri_right.png" alt=";"></div>
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
                                $str .= "(".$res['corner'.$j].")<br> ".str_replace(",",", ",$wrong1[$j])."<br><br>";
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
                                        ORDER BY c_name, seq ASC";
                        $result2 = mysqli_query($connect_db, $sql2);
                        $group = array();

                        foreach ( $result2 as $value ) {
                            $group[$value['c_name']][] = $value;
                        }
                        $tot = count($group);
                    }
                    ?>
                    <li>
                        <div class="left_speech_wrap">
                            <div id="hide_wrong_answer1"  style="position:absolute;padding:10px;width:95%;background-color: #FFFFFF;z-index:999;display: none;">
                                <div class="sub_close_btn" style="padding-right:15px;float:right;width:5%"><img src="img/close.png" alt="close_icon"></a></div>
                                <div style="text-align: center;font-size:17px"><b>-오답문항-</b></div>
                                <div style="text-align: left;overflow:auto"><?=$str?></div>
                            </div>
                            <div class="l_tri"><img src="img/bubble_tri_left.png" alt=";"></div>
                            <div class="l_speech_bubble">
                                <p><?=$res['student_name']?> 학생의 채점 결과,<br>
                                    전체 문항 수 <?=$q_tot?>개 중<br>
                                    오답 수는 <?=$wrong_tot1?>개입니다.<br>
                                    (정답률: <?=$score1?>%)<br>
                                    <?php
                                    if($score1 == 100){
                                        ?>
                                        <font color='red'>만점입니다. 축하합니다.</font><br>
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
                            <div class="time">
                                <span><?=substr($res['marking_date1'],5,2)?>월</span>
                                <span><?=substr($res['marking_date1'],8,2)?>일</span>
                                <span><?=substr($res['marking_date1'],11,5)?></span>
                            </div>
                        </div>
                    </li>
                    <?php
                }

                if($res['apply_status_2'] == 'Y') {
                    ?>
                    <li>
                        <div class="blank"></div>
                        <div class="right_speech_wrap">
                            <div class="time">
                                <span><?=substr($res['submit_date2'],5,2)?>월</span>
                                <span><?=substr($res['submit_date2'],8,2)?>일</span>
                                <span><?=substr($res['submit_date2'],11,5)?></span>
                            </div>
                            <div class="r_speech_bubble">
                                <p>[정상제출]<br>
                                    2차 제출완료.</p>
                            </div>
                            <div class="r_tri"><img src="img/bubble_tri_right.png" alt=";"></div>
                            <div id="hide_wrong_answer2"  style="position:absolute;top:-230px;padding:10px;width:95%;background-color: #FFFFFF;z-index:999;display: none;">
                                <div class="sub_close_btn" style="padding-right:15px;float:right;width:5%"><a><img src="img/close.png" alt="close_icon"></a></div>
                                <div style="text-align: center;font-size:17px"><b>-오답문항 및 해설-</b></div>
                                <div style="height:350px;text-align: left;overflow:auto">

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
                                                <span style="display:inline-block;border:1px solid #c3c3c3"><img src="<?=$group[$res['corner'.$i]][$j]['answer_image']?>" onload="resize(this)"></span>
                                            </div>

                                            <? if($group[$res['corner'.$i]][$j]['explain_image']){ ?>
                                                <div style="width:90%;border:1px solid #c3c3c3">
                                                    <span style="display:inline-block;width:70%;"><img src="<?=$group[$res['corner'.$i]][$j]['explain_image']?>" onload="resize(this)"></span>
                                                </div>
                                                <br>
                                            <? } ?>

                                            <?

                                        }
                                    }
                                    ?>

                                </div>
                            </div>

                        </div>
                    </li>
                    <?php
                }

                if($res['score_status_2'] == 'Y') {
                    ?>

                    <li>
                        <div class="left_speech_wrap">
                            <div class="l_tri"><img src="img/bubble_tri_left.png" alt=";"></div>
                            <div class="l_speech_bubble">
                                <p><?=$res['student_name']?> 학생의 채점결과, 오답문항<br>
                                    <?=$wrong_tot1?>개 중 정답은 <?=($wrong_tot1-$wrong_tot2)?>문항입니다.<br>
                                    (전체문항 <?=$q_tot?>개 중 1차 정답: <?=($q_tot-$wrong_tot1)?>개<br>
                                    / 2차정답: <?=($wrong_tot1-$wrong_tot2)?>개 / 문제: <?=($wrong_tot1-($wrong_tot1-$wrong_tot2))?>개)<br>

                                    <?php
                                    if($wrong_tot1-($wrong_tot1-$wrong_tot2) == 0){
                                        ?>
                                        <font color='red'>만점입니다.</font><br>
                                        <?
                                    }else{
                                    ?>
                                    오답문항을 체크해 주세요<br>
                                    <a style="color: red; text-decoration: underline;cursor:pointer" class="show_wrong_answer" id="hide_wrong_answer2">오답문항 및 해설보기</a>
                                    <?
                                    }
                                    ?></a>
                                </p>
                            </div>
                            <div class="time">
                                <span><?=substr($res['marking_date2'],5,2)?>월</span>
                                <span><?=substr($res['marking_date2'],8,2)?>일</span>
                                <span><?=substr($res['marking_date2'],11,5)?></span>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <div class="decoration">
            <span class="deco_circle"></span>
            <span class="deco_circle"></span>
            <span class="deco_circle"></span>
            <span class="deco_circle"></span>
            <span class="deco_circle"></span>
            <span class="deco_circle"></span>
            <span class="deco_circle"></span>
            <span class="deco_circle"></span>
            <span class="deco_circle"></span>
            <span class="deco_circle"></span>
        </div>
    </div>
</section>
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