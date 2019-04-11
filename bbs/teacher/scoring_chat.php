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
            <p><span>6-1</span><span>1. 미분방정식</span></p>
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
                           $q_tot1 = 0;
                           for($i=1; $i<4; $i++){
                               if($res['Q_number'.$i]) $q_tot += count(explode(",",$res['Q_number'.$i]));
                           }

                           $wrong1 = json_decode($res['wrong_anwer_1'],true);
                           $wrong2 = json_decode($res['wrong_anwer_2'],true);
                           if($wrong2){
                               $j=1;
                               foreach ($wrong2 as $key => $v) {
                                   if($wrong2[$j]){
                                       $str .= $res['corner'.$j]." : ".$wrong2[$j]."<br>";
                                       $wrong_tot += count(explode(",",$v));
                                   }
                                   $j++;
                               }
                           }else{
                               $j=1;
                               foreach ($wrong1 as $key => $v) {
                                   if($wrong1[$j]){
                                       $str .= $res['corner'.$j]." : ".$wrong1[$j]."<br>";
                                       $wrong_tot += count(explode(",",$v));
                                   }
                                   $j++;
                               }
                           }
                           $score = round((($q_tot-$wrong_tot)/$q_tot) * 100);
                    ?>
                    <li>
                        <div class="blank"></div>
                        <div class="right_speech_wrap">
                            <div id="hide_wrong_answer1"  style="position:absolute;padding:10px;width:100%;background-color: #FFFFFF;z-index:999;display: none;">
                                <div class="sub_close_btn" style="padding-right:15px"><a><img src="img/close.png" alt="close_icon"></a></div>
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
                                    오답 수는 <?=$wrong_tot?>개입니다.<br>
                                    (정답률: <?=$score?>%)<br>
                                    오답을 오답 노트에<br>
                                    다시 풀어 제출해 주세요.<br>
                                    <a style="color: red; text-decoration: underline" class="show_wrong_answer" id="hide_wrong_answer1">오답문항 보기</a>
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
                                    10개 중 정답은 5문항입니다.<br>
                                    (전체문항 20개 중 1차 정답: 10개<br>
                                    / 2차정답: 5개 / 문제: 5개)<br>
                                    오답문항을 체크해주세요.<br>
                                    <a href="#none" style="color: red; text-decoration: underline">오답문항 및 해설보기</a>
                                </p>
                            </div>
                            <div class="r_tri"><img src="img/bubble_tri_right.png" alt=";"></div>
                        </div>
                    </li>
                    <?php
                       }

                       if($res['score_status_1'] == 'Y') {
                    ?>
                    <li>
                        <div class="left_speech_wrap">
                            <div class="l_tri"><img src="img/bubble_tri_left.png" alt=";"></div>
                            <div class="l_speech_bubble">
                                <p>말풍선이 최대로 늘어나는 길이를 표시하기 위한 말풍선입니다. 최대 이만큼 늘어납니다.</p>
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

                    ?>
                    <li>
                        <div class="blank"></div>
                        <div class="right_speech_wrap">
                            <div class="time">
                                <span>8월</span>
                                <span>29일</span>
                                <span>21:00</span>
                            </div>
                            <div class="r_speech_bubble">
                                <p>말풍선이 최대로 늘어나는 길이를 표시하기 위한 말풍선입니다. 최대 이만큼 늘어납니다.
                                </p>
                            </div>
                            <div class="r_tri"><img src="img/bubble_tri_right.png" alt=";"></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!--hamburger-->

<div class="hamburder_nav">
    <div class="ham_member_info_wrap">
        <div class="close_btn_line">
            <div class="close_btn"><img src="img/close.png" alt="close_icon"></div>
        </div>
        <div class="ham_member_info_line">
            <div class="ham_member_img"><img src="img/user.png" alt="member_img"></div>
            <div class="ham_member_info">
                <p class="ham_member_name">강태민</p>
                <p class="ham_member_grade">전임강사</p>
            </div>
        </div>
        <div class="ham_other_btn_line">
            <div class="setting_btn"><a href="setting.html"><img src="img/setting.png" alt="setting_icon"></a></div>
            <div class="alarm_btn"><a href="#none"><img src="img/alarm.png" alt="alarm_icon"></a></div>
        </div>
    </div>
    <div class="hamnav_menu_wrap">
        <div class="hamnav_menu"><a href="#none"><span>학급목록</span></a>
            <div class="hamnav_class_list">
                <div class="hamnav_class"><a href="student_manegement_record.html"><span class="class_title">루트</span><span
                            class="class_grade_">초6</span></a></div>
                <div class="hamnav_class"><a href="student_manegement_record.html"><span class="class_title">파이</span><span
                            class="class_grade_">초6</span></a></div>
                <div class="hamnav_class"><a href="student_manegement_record.html"><span class="class_title">시그마</span><span
                            class="class_grade_">초6</span></a></div>
                <div class="hamnav_class"><a href="student_manegement_record.html"><span class="class_title">루트</span><span
                            class="class_grade_">중1</span></a></div>
            </div>
        </div>
        <div class="hamnav_menu"><a href="homework_manegement_add.html"><span>숙제생성</span></a></div>
        <div class="hamnav_menu"><a href="student_manegement_score_all.html"><span>채점바로가기</span></a></div>
        <div class="hamnav_menu"><a href="class_schedule_list.html"><span>수업계획표/일지</span></a></div>
        <div class="hamnav_menu"><a href="notice_list.html"><span>공지사항</span></a></div>
    </div>
    <div class="alarm_box_wrap_wrap">
        <div class="alarm_box_wrap">
            <div class="alarm_tri"><img src="img/alarm_tri.png" alt="alarm_tri_icon"></div>
            <div class="alarm_box">
                <ul>
                    <li>
                        <div class="alarm_content">
                            <p>알림내용이 들어갈자리입니다.</p>
                        </div>
                        <div class="alarm_time">
                            <p><span>5분</span><span> 전</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="alarm_content">
                            <p>알림내용이 들어갈자리입니다.</p>
                        </div>
                        <div class="alarm_time">
                            <p><span>5분</span><span> 전</span></p>
                        </div>
                    </li>
                    <li>
                        <div class="alarm_content">
                            <p>알림내용이 들어갈자리입니다.</p>
                        </div>
                        <div class="alarm_time">
                            <p><span>5분</span><span> 전</span></p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Google CDN jQuery with fallback to local -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../js/minified/jquery-1.11.0.min.js"><\/script>')</script>

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