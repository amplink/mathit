<?php
include_once ('_common.php');

if(!$_SESSION['t_uid']) {

    alert_msg('로그인을 먼저 해주세요.');
    location_href("login.php");
}

if($_GET['s_year'] && $_GET['s_quarter']) {

    $s_year = $_GET['s_year'];
    $s_quarter = $_GET['s_quarter'];

    if($s_quarter == 1) { $a_quarter = "0101";

    }else if($s_quarter == 2) {$a_quarter = "0301";

    }else if($s_quarter == 3) {$a_quarter = "0601";

    }else if($s_quarter == 4) {$a_quarter = "0901";

    }

}else {

    $s_year = date("Y");
    $a_quarter = date("md");
    $mon = date("m");

    if($mon >= 1 && $mon <= 2) $s_quarter = 1;
    else if($mon >= 3 && $mon <= 5) $s_quarter = 2;
    else if($mon >= 6 && $mon <= 8) $s_quarter = 3;
    else $s_quarter = 4;
}

$date = $s_year.$a_quarter;

$ac = $_SESSION['client_no'];

$link = "/api/math/class?client_no=".$ac."&date=".$date;
$r = api_calls_get($link);


// 학기
$t_year = array();
$chk = 0;
$cnt = 0;
for($i=1; $i<count($r); $i++) {
    $chk = 0;
    for($j=0; $j<count($t_year); $j++) {
        if($t_year[$j] == $r[$i][3]) $chk = 1;
    }
    if(!$chk) {
        $t_year[$cnt] = $r[$i][3];
        $cnt++;
    }
}
$year = array();
$quarter = array();

for($i=0; $i<count($t_year); $i++) {
    $t = explode(" ", $t_year[$i]);
    $year[$i] = $t[0];
    $quarter[$i] = $t[1];
}


// 시간표
$link = "/api/math/teacher_class?client_no=".$ac."&t_uid=".$_SESSION['t_uid']."&date=".$date;
$r = api_calls_get($link);

$d_uid = array();
$c_uid = array();
$s_uid = array();
$chk = 0;
$cnt = 0;
$r = arr_sort($r,4);

for($i=0; $i<count($r)-1; $i++) {
    $chk = 0;
    for($j=0; $j<count($d_uid); $j++) {
        if($d_uid[$j] == $r[$i][0]) $chk = 1;
    }
    if(!$chk) {
        $d_uid[$cnt] = $r[$i][0];
        $c_uid[$cnt] = $r[$i][1];
        $s_uid[$cnt] = $r[$i][2];
        $d_name[$cnt] = $r[$i][4];
        $d_yoie[$cnt] = $r[$i][5];
        $cnt++;
    }
}

$time = array();
$cnt = 0;

for($i=0; $i<count($d_uid); $i++) {

    $link = "/api/math/timetable?client_no=".$ac."&d_uid=".$d_uid[$i];
    $r = api_calls_get($link);
    $kk = 0;

    if(count($r)) {
        for($j=0; $j<count($r); $j++) {

            $cnt = 0;

            if($r[$j][2] == $_SESSION['t_uid']) { //해당 선생(강사)님

//                    $time[$i] = $r[$j][0];
//                    $time1[$i][$kk] = $r[$j][0];
//                    $kk++;
                for($k=1; $k<count($r[$j]); $k++) {

                    if($k%3 == 0) {

                        if($r[$j][$k]) :
                            $day[$i][$cnt] = $r[$j][$k];
                            $time1[$i][$cnt][$kk] = $r[$j][0];
                            $kk++;
                        endif;

                        $cnt++;
                    }
                }
            }

        }

    }
}

//네비게이터

$nav_url = str_replace("/bbs/teacher/","",$_SERVER['PHP_SELF']);
$nav_url = str_replace(".php","",$nav_url);
$nav_url = str_replace(".html","",$nav_url);
$nav_url = str_replace(".htm","",$nav_url);


if($nav_url == "home" || $nav_url == "home_sub"):

    $nav_text = "HOME";

elseif($nav_url == "student_management_record"):

    $nav_text = "원생관리";

elseif($nav_url == "homework_management_personal" || $nav_url == "homework_management_add" || $nav_url == "homework_management_list"):

    $nav_text = "숙제관리";

elseif($nav_url == "consult_management_write" || $nav_url == "consult_management_personal"):

    $nav_text = "상담관리";

elseif($nav_url == "student_management_personal_record" || $nav_url == "student_management_personal_mid_record_detail" ):

    $nav_text = "성적표";


elseif($nav_url == "record_management_list" || $nav_url == "record_management_add"):

    $nav_text = "성적관리";

elseif($nav_url == "student_management_score_all" || $nav_url == "student_management_score_each"):

    $nav_text = "채점하기";

elseif($nav_url == "class_schedule_list" || $nav_url == "class_schedule_write" || $nav_url == "class_schedule_update"):
    $nav_text = "수업계획표/일지";

elseif($nav_url == "notice_list" || $nav_url == "notice_write"):
    $nav_text = "공지사항";

elseif($nav_url == "setting" || $nav_url == "setting_individual"):
    $nav_text = "설정";

else :

    $nav_text = $nav_url;

endif;

$t_uid = $_SESSION['t_uid'];
// 권한 체크
$sql = "select * from `teacher_setting` where `t_id`='$t_uid';";
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
        <link rel="stylesheet" type="text/css" href="css/common.css?v=20190419" />
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/jquery-ui.js"></script>

        <? if(strpos(basename($_SERVER["PHP_SELF"]), "record_management_add") !== false){ ?>
            <link rel="stylesheet" type="text/css" href="css/record_manegement_add.css?v=20190418" />
        <? } else if(strpos(basename($_SERVER["PHP_SELF"]), "record_management_list") !== false){?>
            <link rel="stylesheet" type="text/css" href="css/record_manegement_list.css" />
        <? } ?>
    </head>

<body>
<script>
    function show_alarm() {
        $('#new_span').css('background-color', 'red');
        $('#new_span1').css('background-color', 'red');
    }
</script>

<?  if($_GET['flag']!='1'){ ?>
    <header>
        <div class="hamburger_btn">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <span style="border-radius: 50%; width: 10px; height: 10px; position: absolute; top: 10px; left: 35px;" id="new_span1"></span>

        <div class="home_btn"><a href="home.php" id="home_a1"><img src="img/home.png" alt="home_icon"></a></div>
        <div class="logo_section">
            <div class="logo"><a href="home.php" id="home_a2"><img src="img/main_logo.png" alt="header_logo"></a></div>
            <!--        <p class="navigation_text">--><?php //echo $nav_text;?><!--</p>-->
        </div>
        <div class="member_info_wrap">
            <div class="member_img" style="margin-top:-6px"><a href="setting_individual.php"><img src="<?=$_SESSION['t_img']?>" alt="member_img"></a></div>
            <div class="member_info">
                <a href="setting_individual.php"><p class="member_name"><?=$_SESSION['t_name']?></p></a>
                <a href="setting_individual.php"><p class="member_grade"><?=$res['type']?></p></a>
            </div>
            <div class="logout_btn"><a href="./logout.php">로그아웃</a></div>
        </div>
    </header>

    <div class="hamburder_nav" style="z-index: 99;">
        <div class="ham_member_info_wrap">
            <div class="close_btn_line">
                <div class="close_btn"><img src="img/close.png" alt="close_icon"></div>
            </div>
            <div class="ham_member_info_line">
                <div class="ham_member_img" style="margin-top:-9px"><a href="setting_individual.php"><img src="<?=$_SESSION['t_img']?>" alt="member_img"></a></div>
                <div class="ham_member_info">
                    <a href="setting_individual.php"><p class="ham_member_name"><?=$_SESSION['t_name']?></p></a>
                    <a href="setting_individual.php"><p class="ham_member_grade"><?=$res['type']?></p></a>
                </div>
            </div>
            <div class="ham_other_btn_line">
                <div class="setting_btn"><a href="setting.php"><img src="img/setting.png" alt="setting_icon"></a></div>
                <div class="alarm_btn" onclick="alarm_chk()">
                    <a href="#none"><img class="test11" src="img/alarm.png" alt="alarm_icon">
                        <span style="border-radius: 50%; width: 10px; height: 10px; position: absolute; top: 15px; left: 65px;" id="new_span"></span>
                    </a>
                </div>
            </div>
        </div>

        <div class="hamnav_menu_wrap">
            <div class="hamnav_menu" onclick="class_show()" style="cursor:pointer"><a><span>학급목록</span></a>
                <div class="hamnav_class_list">
                    <!--                <div class="hamnav_class"><a href="student_manegement_record.html"><span class="class_title">루트</span><span-->
                    <!--                            class="class_grade_">초6</span></a></div>-->
                    <?php
                    for($i=0; $i<count($d_name); $i++) {

                        //해당 수업에 학생 정보
                        $link_4 = "/api/math/class_stu?client_no=".$_SESSION['client_no']."&d_uid=".$d_uid[$i]."&c_uid=".$c_uid[$i];
                        $r_4 = api_calls_get($link_4);

                        ?>
                        <div class="hamnav_class" style="cursor: pointer;"><a href="student_management_record.php?d_uid=<?=$d_uid[$i]?>&c_uid=<?=$c_uid[$i]?>&s_uid=<?=$s_uid[$i]?>">
                                <span class="class_title"><?=$d_name[$i]?> ( <?php echo (count($r_4)-1);?> )( <?=$d_yoie[$i]?> )</span>
                            </a>
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>

            <div class="hamnav_menu <?php if(!$res['hm_mg']) echo "dis";?>"><a href="homework_management_add.php"><span>숙제관리</span></a></div>
            <div class="hamnav_menu <?php if(!$res['score_mg']) echo "dis";?>"><a href="record_management_add.php"><span>성적관리</span></a></div>
            <div class="hamnav_menu"><a href="student_management_score_all.php"><span>채점관리</span></a></div>
            <div class="hamnav_menu"><a href="class_schedule_write.php"><span>수업관리</span></a></div>
            <div class="hamnav_menu"><a href="notice_list.php"><span>공지사항</span></a></div>
        </div>
        <?php
        $t_uid = $_SESSION['t_uid'];
        $sql = "select * from `alarm` where `uid`='$t_uid' order by `seq` desc;";
        $a_result = sql_query($sql);
        $a_cnt = 0;
        $thisTime=date("Y-m-d H:i:s");
        ?>
        <div class="alarm_box_wrap_wrap">
            <div class="alarm_box_wrap">
                <div class="alarm_tri"><img src="img/alarm_tri.png" alt="alarm_tri_icon"></div>
                <div class="alarm_box" style="overflow: scroll;">
                    <div>
                        <p id="x_alarm_btn" style="cursor:pointer;font-size:20px;font-weight: bold;text-align: right;">X</p>
                        <div>
                            <ul>
                                <?php
                                while($a_res = mysqli_fetch_array($a_result)) {
                                    $signdate = $a_res['datetime'];
                                    $someTime=strtotime($thisTime)-strtotime("$signdate GMT");
                                    ?>
                                    <li>
                                        <div class="alarm_content">
                                            <p><?=$a_res['content']?></p>
                                        </div>
                                        <div class="alarm_time">
                                            <p><span>
                                                <?php
                                                $cha = ceil($someTime/(60*60*24));
                                                if($cha <= 0) echo "오늘";
                                                else echo $cha."일 전";
                                                ?></span></p>
                                        </div>
                                    </li>
                                    <?php
                                    if($a_res['chk']==0) {
                                        $a_cnt++;
                                    }
                                }
                                if($a_cnt > 0) echo "<script>show_alarm();</script>";
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?  } ?>
<script>
    $('.dis a').prop('href','#');
    $('.hamnav_class_list').hide();
    var chk_class = 0;
    function class_show() {
        if(chk_class == 0) {
            $('.hamnav_class_list').show();
            chk_class = 1;
        }else {
            $('.hamnav_class_list').hide()
            chk_class = 0;
        }
    }
    $('.alarm_box_wrap_wrap').hide();
    var chk_alarm = 0;
    function alarm_chk() {
        $.ajax({
            url: 'alarm_chk.php',
            success: function(response) {
                $('#new_span').css('background-color', 'transparent');
                $('#new_span1').css('background-color', 'transparent');
            }
        });
        if(chk_alarm == 0) {
            $('.alarm_box_wrap_wrap').show();
            chk_alarm = 1;
        }else {
            $('.alarm_box_wrap_wrap').hide();
            chk_alarm = 0;
        }
    }
</script>
<?php
if($_SESSION['admin']) {
    echo "<script>$('#home_a1').attr('href', 'setting.php');</script>";
    echo "<script>$('#home_a2').attr('href', 'setting.php');</script>";
}
?>