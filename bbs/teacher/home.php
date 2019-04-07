<?php
include_once ('./_common.php');
include_once ('head.php');

//시간함수 압축본
function hour_24to12 ($date_str){ $result = ""; $zero = ""; $time = explode(":",trim($date_str)); $hour = (int)$time[0]; $minute = (int)$time[1]; if($minute >= 0  && $minute <= 9): $minute = "0".$minute; else : $minute = $minute; endif; /*데이터 출력*/ if($hour == 24): /*24는 00 이므로 강제로 변경*/ $result = "AM 00:".$minute;		elseif($hour == 12): /*12는 PM으로 변환다.*/ $result = "PM ".$hour.":".$minute; elseif($hour > 12): $hour = $hour - 12; if($hour >= 0  && $hour <= 9): $result = "PM 0".$hour.":".$minute; else : $result = "PM ".$hour.":".$minute; endif; else : if($hour >= 0  && $hour <= 9): $result = "AM 0".$hour.":".$minute; else : $result = "AM ".$hour.":".$minute; endif;endif; return $result; }

//월 ~금 까지 교시 표시
$week1_time[1] = hour_24to12 ("16:00")." ~ ".hour_24to12 ("17:30");
$week1_time[2] = hour_24to12 ("17:30")." ~ ".hour_24to12 ("19:00");
$week1_time[3] = hour_24to12 ("19:00")." ~ ".hour_24to12 ("20:30");
$week1_time[4] = hour_24to12 ("20:30")." ~ ".hour_24to12 ("22:00");

//주말(토,일) 교시 표시
$week2_time[1] = hour_24to12 ("10:00")." ~ ".hour_24to12 ("11:30");
$week2_time[2] = hour_24to12 ("11:30")." ~ ".hour_24to12 ("13:00");
$week2_time[3] = hour_24to12 ("13:00")." ~ ".hour_24to12 ("14:30");
$week2_time[4] = hour_24to12 ("14:30")." ~ ".hour_24to12 ("16:00");

$sql = "select * from `teacher_setting` where `t_name`='$t_name';";
$result = sql_query($sql);
$res = mysqli_fetch_array($result);
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
    <link rel="stylesheet" type="text/css" media="screen" href="css/index.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
    <script type="text/javascript" language="javascript">

        $( document ).ready(function() {

            $("#quarter_select").val('<?php echo $s_quarter;?>');
            $("#year_select").val('<?php echo $s_year;?>');

            $('#quarter_select').change(function () {

                var a = $('#quarter_select').val();
                var b = $('#year_select').val();

                location.replace('./home_sub.php?s_year='+b+'&s_quarter='+a);

            });

            $('#year_select').change(function () {

                var a = $('#quarter_select').val();
                var b = $('#year_select').val();

                location.replace('./home_sub.php?s_year='+b+'&s_quarter='+a);

            });


        });
    </script>

</head>

<body>
<section>
    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text">학기</p>
                <div class="day_select">
                    <select name="year_select" id="year_select">
                        <?php
                        for($i=2018; $i< ( date(Y)+10 ); $i++) {
                            echo "<option value='{$i}'>{$i}"."년"."</option>";
                        }
                        ?>
                    </select>

                    <select name="quarter_select" id="quarter_select">
                        <?php for($i=1;$i<=4;$i++) : ?>
                            <option value="<?php echo $i?>"><?php echo $i;?>분기</option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>
            <div class="head_right">
                <div class="hw_make_btn <?php if(!$res['hm_create']) echo "dis";?>"><a href="homework_management_add.php">숙제관리</a></div>
                <div class="scoring_shortcut_btn"><a href="student_management_score_all.php">채점관리</a></div>
            </div>
        </div>
    </div>
    <div class="class_table_section" style="z-index: 1;">
        <table>
            <thead>
            <tr>
                <th class="schedule">교시</th>
                <th class="blank">시간</th>
                <th class="day <?php if(date(w) == "1"):?>on<?php endif?>">월</th>
                <th class="day <?php if(date(w) == "2"):?>on<?php endif?>">화</th>
                <th class="day <?php if(date(w) == "3"):?>on<?php endif?>">수</th>
                <th class="day <?php if(date(w) == "4"):?>on<?php endif?>">목</th>
                <th class="day <?php if(date(w) == "5"):?>on<?php endif?>">금</th>
                <th class="blank">시간</th>
                <th class="day <?php if(date(w) == "6"):?>on<?php endif?>">토</th>
                <th class="day <?php if(date(w) == "0"):?>on<?php endif?>">일</th>
            </tr>
            </thead>
            <tbody>
            <?
            for($s=1; $s<=4; $s++):
                $tt = 0;
                ?>

                <tr>
                    <td><?php echo $s ?>교시</td>
                    <td><?php echo str_replace('~',"<br>~<br>",$week1_time[$s]);?></td>
                    <?php
                    for($i=0; $i<5; $i++) {
                        $kk = $i+1;
                        if($kk == 7) $kk = 0;
                        if($kk == date(w)) echo "<td style='background-color:#9DF0E1;'><div class='class_info'>";
                        else echo "<td><div class='class_info'>";
                        for($j=0; $j<count($day); $j++) {
                            if($day[$j][$i] && ($time[$j] == $s)) {
                                $link_4 = "/api/math/class_stu?client_no=".$_SESSION['client_no']."&d_uid=".$d_uid[$j]."&c_uid=".$c_uid[$j];
                                $r_4 = api_calls_get($link_4);
                                echo "<a href='student_management_record.php?d_uid=".$d_uid[$j]."&c_uid=".$c_uid[$j]."'>".$d_name[$j]."<br>(".(count($r_4)-1).")</a><br>";
                            }
                        }
                        echo "</div></td>";
                    }
                    ?>
                    <td><?php echo str_replace('~',"<br>~<br>",$week2_time[$s]);?></td>

                    <?php
                    for($i=5; $i<7; $i++) {
                        $kk = $i+1;
                        if($kk == 7) $kk = 0;
                        if($kk == date(w)) echo "<td style='background-color:#9DF0E1;'><div class='class_info'>";
                        else echo "<td><div class='class_info'>";
                        for($j=0; $j<count($day); $j++) {
                            if($day[$j][$i] && ($time[$j] == $s)) echo "<a href='student_management_record.php?d_uid=".$d_uid[$j]."&c_uid=".$c_uid[$j]."'>".$d_name[$j]."<br>(".(count($r_4)-1).")</a><br>";
                        }
                        echo "</div></td>";
                    }
                    ?>
                </tr>

            <? endfor; ?>

            </tbody>
        </table>
    </div>
    <div style="width: 100%; max-width: 1400px; margin: auto; margin-top: 30px;">
        <div class="notice_title" style="margin: auto;">
            <p>공지사항</p>
        </div>
    </div>
    <div class="notice_list_wrap">
        <div class="notice_contents_wrap">

            <?php
            $ac = $_SESSION['client_no'];
            $task = $_SESSION['t_task'];
            //            alert_msg($task);
            $sql = "select * from `notify` where `client_id`='$ac' limit 0, 5;";
            $result = sql_query($sql);
            while($res = mysqli_fetch_array($result)) {
                ?>
                <div class="notice_content">
                    <a href="./notice_list.php?seq=<?=$res['id']?>&chk=1"><span>&#149;</span><?=$res['title']?></a>
                </div>
                <?php
            }

            $sql = "select * from `teacher_notice` order by `seq` desc limit 0,5";
            $result = sql_query($sql);
            $i=1;
            while($res = sql_fetch_array($result)) {
                ?>
                <div class="notice_content">
                    <a href="./notice_list.php?seq=<?=$res['seq']?>&chk=0"><span>&#149;</span><?=$res['title']?></a>
                </div>
                <?
                if($i==5) break;
                $i++;
            }

            ?>
        </div>
    </div>
</section>

</body>

</html>
<script>
    $('.dis a').prop('href', '#');
</script>