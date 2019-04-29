<?php
include_once('_common.php');
if(!$_SESSION['s_uid']) {

    alert_msg('로그인을 먼저 해주세요.');
    location_href("login.php");
}
$alarm = 0;
//alert_msg($_SESSION['s_id']);
$sql = "select `chk` from `alarm` where `uid`='".$_SESSION['s_id']."';";
$result = sql_query($sql);
while($res = mysqli_fetch_array($result)) {
    if(!$res['chk']) $alarm++;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MATH IT - student</title>
    <meta http-equiv="Expires" content="Mon, 06 Jan 1990 00:00:01 GMT">
    <meta http-equiv="Expires" content="-1">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <link rel="icon" type="image/png" sizes="96x96" href="img/f.png">
    <link rel="stylesheet" type="text/css" media="screen" href="css/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/common.css?v=20190423" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
    <script src="js/jquery-ui.js"></script>
</head>
<body>
<!-- 배경 -->
<div class="bg">
    <div class="bg_div"></div>
    <div class="bg_div"></div>
    <div class="bg_div"></div>
</div>

<!-- 메인 헤더 -->
<header>
    <div class="ham_wrap">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="new_alarm_menu"></div>
    <div class="head_logo"><a href="home.php"><img src="img/logo_notext.png" alt="header_logo"></a></div>
    <div class="calender_icon"><img src="img/calendar.png" alt="calendar_icon"></div>
</header>

<!-- 네비게이션 -->
<div class="hamburger_wrap">
    <div class="user_wrap">
        <a href="mypage.php">
            <div class="user_side">
                <div class="user_img"><img src="img/nav/user.png" alt="user_img"></div>
                <div class="user_info">
                    <p class="user_name"><?=$_SESSION['s_name']?></p>
                    <p class="academy_name"><?=$_SESSION['client_name']?></p>
                </div>
            </div>
        </a>
        <div class="alarm">
            <div class="alarm_tri">
                <img src="img/bubble_tri_right.png" width="100%" height="100%">
            </div>

            <div class="alarm_wrap">
                <p class="x_btn">X</p>
                <ul class="alarm_list">
                    <?php
                    $s_id = $_SESSION['s_id'];
                    $thisTime = date("Y-m-d H:i:s");
                    $sql = "select `content`, `datetime` from `alarm` where `uid`='$s_id' order by `seq` desc limit 30;";
                    $result = sql_query($sql);
                    while($res = mysqli_fetch_array($result)){
                        $signdate = $res['datetime'];
                        $someTime=strtotime($thisTime)-strtotime("$signdate GMT");
                        ?>
                        <li>
                            <p><?=$res['content']?><br><span style="margin-left: 85%;"><?php
                                    $cha = ceil($someTime/(60*60*24));
                                    if($cha <= 0) echo "오늘";
                                    else echo $cha."일 전";
                                    ?></span></p>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="add_btn_wrap">
            <a href="logout.php"><div class="close_btn"><img src="img/nav/logout.png" alt="logout_btn_icon"></div></a>
        </div>
        <div class="add_btn_wrap">
            <div class="alarm_btn" onclick="show_alarm()">
                <div class="new_alarm"></div>
                <img src="img/nav/alarm.png" alt="alarm_btn_icon">
            </div>
        </div>
        <div class="add_btn_wrap">
            <a href="setting.php"><div class="close_btn"><img src="img/nav/setting.png" alt="setting_btn_icon"></div></a>
        </div>
        <div class="close_btn_wrap">
            <div class="close_btn"><img src="img/close_btn.png" alt="close_btn_icon"></div>
        </div>
    </div>
    <div class="ham_nav_wrap">
        <div class="ham_nav_menu">
            <a href="notice.php">
                <div class="ham_nav_menu_icon_wrap">
                    <div class="ham_nav_menu_icon">
                        <img src="img/nav/notice.png" alt="notice_icon">
                    </div>
                </div>
                <div class="ham_nav_menu_title_wrap">
                    <p class="ham_nav_menu_title">공지사항</p>
                </div>
            </a>
        </div>
        <div class="ham_nav_menu">
            <a href="homework_ing.php">
                <div class="ham_nav_menu_icon_wrap">
                    <div class="ham_nav_menu_icon">
                        <img src="img/nav/homework.png" alt="homework_icon">
                    </div>
                </div>
                <div class="ham_nav_menu_title_wrap">
                    <p class="ham_nav_menu_title">숙제관리</p>
                </div>
            </a>
        </div>
        <div class="ham_nav_menu">
            <a href="report.php">
                <div class="ham_nav_menu_icon_wrap">
                    <div class="ham_nav_menu_icon">
                        <img src="img/nav/report_icon.png" alt="report_icon">
                    </div>
                </div>
                <div class="ham_nav_menu_title_wrap">
                    <p class="ham_nav_menu_title">성적관리</p>
                </div>
            </a>
        </div>
    </div>
    <div class="alarm_back"></div>
</div>

<!-- 스케줄 -->
<div class="schedule_wrap">
    <div class="schedule_head">
        <div class="schedule_title_wrap">
            <p class="schedule_title">MY SCHEDULE</p>
            <p class="month"><span><?=date('Y')?>. </span><span><?=date('m')?></span></p>
        </div>
        <div class="close_btn_wrap">
            <div class="sc_close_btn"><img src="img/close_btn.png" alt="close_btn_icon"></div>
        </div>
    </div>

    <div class="schedule_section">
        <div class="weekly_schedule_wrap">

            <?php

            $link = "/api/math/class?client_no=".$_SESSION['client_id'];
            $r = api_calls_get($link);

            $d_uid_arr = explode(",",$_SESSION['d_uid']);

            foreach($r as $k => $v){
                if(in_array($d_uid_arr,$v)) {
                    $class_name[] = $v[4];
                    break;
                }
            }

            $weekly = array("월"=>"3","화"=>"6","수"=>"9","목"=>"12","금"=>"15","토"=>"18");
            $weeks = array_keys($weekly);

            foreach($d_uid_arr as $val){
                $link = "/api/math/timetable?client_no=".$_SESSION['client_id']."&d_uid=".trim($val);
                $r2[] = api_calls_get($link);
            }

            $today = date("d");
            $day_of_the_week = date('w') - 1;
            $this_week_ago = date('Y-m-d', strtotime($date." -".$day_of_the_week."days"));


            for($i=0; $i<6; $i++) {
                $this_week_end = date("Y-m-d", strtotime($this_week_ago." +".$i." day"));
                $week_day = substr($this_week_end,-2);
                $add_css = ($week_day == $today)?"on":"";
                ?>
                <div class="weekly_scedule_box <?=$add_css?>">
                    <div class="date_wrap">
                        <p class="day"><?=$week_day?></p>
                        <p class="dow"><?=$weeks[$i]?></p>
                    </div>
                    <div class="class_time_info_wrap">

                        <?php
                        $n = 0;
                        $bus_on = 0;
                        for($j=0; $j<4; $j++) { //4교시까지

                            $x = 0;
                            foreach($d_uid_arr as $val){
                                $count1 = $weekly[$weeks[$i]];

                                if ($r2[$x][$j][$count1] == 1) { //수업이 있으면
                                    $start = $r2[$x][$j][$count1 + 1];
                                    $end = $r2[$x][$j][$count1 + 2];
                                    if($week_day == $today) $bus_on = 1;
                                    ?>
                                    <div class="class_time_info">
                                        <p class="time"><?=$r2[$x][$j][0]?>교시 - <span>PM</span>
                                            <span><?= $start ?></span>
                                            <span> ~ </span>
                                            <span><?= $end ?></span></p>
                                        <p class="class_name">
                                            <span><?=$class_name?></span>
                                        </p>
                                    </div>
                                    <?php
                                    $n++;
                                }

                                $x++;
                            }

                        }

                        if($n == 0){
                            if($week_day == $today) $bus_on = 0;
                            ?>
                            <div class="class_time_info" style="text-align:center;padding-top:10px">
                                수업이 없습니다.
                            </div>

                            <?php

                        }
                        ?>
                    </div>
                </div>
                <?php

            }






            $s_uid = $_SESSION['s_uid'];
            $sql = "select * from `student_table` where `uid`='$s_uid';";
            $result = sql_query($sql);
            $res = mysqli_fetch_array($result);
            $today = date("m/d");
            ?>
        </div>
        <div class="mybus_wrap">
            <div class="bus_head">
                <p class="bus_title">MY BUS</p>
                <div class="onboard_cancel_btn">
                    <p>탑승 취소</p>
                </div>
            </div>
            <div class="bus_content">
                <div class="bus_icon">
                    <img src="img/bus.png" alt="bus_icon">
                </div>
                <div class="bus_info">
                    <p class="bus_place"><span><?=$res['station']?></span><span> 정류장</span></p>
                    <p class="bus_time">
                        <span>PM</span>
                        <span><?=$res['time']?></span>
                        <span> 탑승 예정입니다.</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!--bus_alarm-->
<div class="bus_box">
    <p class="bus_box_title">셔틀버스 탑승 취소</p>
    <div class="bus_box_content">
        <p><span><?=$res['station']?><br>(PM <?=$res['time']?> 탑승 예정)</span></p>
        <p><span><?=$today?></span><span>(오늘)</span></p>
        <p><span>금일 셔틀버스를</span><span>이용하지 않으시겠습니까?</span></p>
        <p><span>담당 기사님께</span> <span>문자가 전송됩니다.</span></p>
    </div>
    <div class="bus_box_btn_wrap">
        <div class="yes_btn">
            <p>네</p>
        </div>
        <div class="no_btn">
            <p>아니오</p>
        </div>
    </div>
</div>

<!--bottom_navigation_bar-->
<div class="main_nav">
    <div class="nav_menu">
        <a href="home.php">
            <div class="nav_menu_icon">
                <img src="img/nav/home.png" alt="home_icon">
            </div>
            <p class="nav_menu_title">HOME</p>
        </a>
    </div>
    <div class="nav_menu">
        <a href="homework_ing.php">
            <div class="nav_menu_icon">
                <img src="img/nav/homework.png" alt="homework_icon">
            </div>
            <p class="nav_menu_title">HOMEWORK</p>
        </a>
    </div>
    <div class="nav_menu">
        <a href="report.php">
            <div class="nav_menu_icon">
                <img src="img/nav/report_icon.png" alt="report_icon">
            </div>
            <p class="nav_menu_title">REPORT</p>
        </a>
    </div>
    <div class="nav_menu">
        <a href="notice.php">
            <div class="nav_menu_icon">
                <img src="img/nav/notice.png" alt="notice_icon">
            </div>
            <p class="nav_menu_title">NOTICE</p>
        </a>
    </div>
    <div class="nav_menu">
        <a href="mypage.php">
            <div class="nav_menu_icon">
                <img src="img/nav/mypage.png" alt="notice_icon">
            </div>
            <p class="nav_menu_title">MYPAGE</p>
        </a>
    </div>
</div>
</body>
<?php
if($alarm > 0) echo "<script>$('.new_alarm, .new_alarm_menu').show();</script>";
?>
<script>
    $('.alarm').toggle();
    $('.alarm_back').toggle();

    function show_alarm() {
        $('.alarm').toggle();
        $('.alarm_back').toggle();
        $.ajax({
            url: "alarm_chk.php",
            success: function (res) {
                $('.new_alarm').hide();
                $('.new_alarm_menu').hide();
            }
        });
    }

    $('.x_btn, .alarm_back').click(function(){
        $('.alarm').toggle();
        $('.alarm_back').toggle();
    });

    $('.yes_btn').click(function () {
        var bus_chk = <?php echo $bus_on;?>;
        var now = new Date();
        var hour = now.getHours();
        if(bus_chk && hour < 15) {
            $.ajax({
                url: 'bus_ntake.php',
                success: function (res) {
                    if(res == "success") {
                        alert('담당 기사님께 정상적으로 문자가 발송 되었습니다.');
                    } else if(res == "time_err") {
                        alert('지금은 서비스를 이용할 수 없는 시간입니다.\n학원으로 연락주시기 바랍니다.');
                    }
                    else {
                        alert(res);
                    }
                    // alert(res);
                }
            });
        }else  alert('지금은 서비스를 이용할 수 없는 시간입니다.\n학원으로 연락주시기 바랍니다.');
    });
</script>
