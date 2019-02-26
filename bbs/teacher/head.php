<?php
if(!$_SESSION['t_uid']) {
    alert('로그인을 먼저 해주세요.');
    location_href("./login.php");
}
$ac = $_SESSION['client_no'];
$link = "/api/math/class?client_no=".$ac;
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
$link = "/api/math/teacher_class?client_no=126&t_uid=".$_SESSION['t_uid'];
$r = api_calls_get($link);

$d_uid = array();
$chk = 0;
$cnt = 0;
for($i=1; $i<count($r); $i++) {
    $chk = 0;
    for($j=0; $j<count($d_uid); $j++) {
        if($d_uid[$j] == $r[$i][0]) $chk = 1;
    }
    if(!$chk) {
        $d_uid[$cnt] = $r[$i][0];
        $d_name[$cnt] = $r[$i][4];
        $cnt++;
    }
}

$time = array();
$cnt = 0;
for($i=0; $i<count($d_uid); $i++) {
    $link = "/api/math/timetable?client_no=".$ac."&d_uid=".$d_uid[$i];
    $r = api_calls_get($link);
    if(count($r)) {
        for($j=0; $j<count($r); $j++) {
            $cnt = 0;
            if($r[$j][2] == $_SESSION['t_uid']) {
                $time[$i] = $r[$j][0];
                for($k=1; $k<count($r[$j]); $k++) {
                    if($k%3==0) {
                        if($r[$j][$k]) $day[$i][$cnt] = $r[$j][$k];
                        $cnt++;
                    }
                }
            }
        }
    }
}
?>
<header>
    <div class="hamburger_btn">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="home_btn"><a href="home.php"><img src="img/home.png" alt="home_icon"></a></div>
    <div class="logo_section">
        <div class="logo"><a href="home.php"><img src="img/logo_white.png" alt="header_logo"></a></div>
        <p class="navigation_text">HOME</p>
    </div>
    <div class="member_info_wrap">
        <div class="member_img"><img src="img/user.png" alt="member_img"></div>
        <div class="member_info">
            <p class="member_name"><?=$_SESSION['t_name']?></p>
            <p class="member_grade"><?=$_SESSION['t_task']?></p>
        </div>
        <div class="logout_btn"><a href="../logout.php?url=/bbs/teacher/">로그아웃</a></div>
    </div>
</header>
<div class="hamburder_nav" style="z-index: 99;">
    <div class="ham_member_info_wrap">
        <div class="close_btn_line">
            <div class="close_btn"><img src="img/close.png" alt="close_icon"></div>
        </div>
        <div class="ham_member_info_line">
            <div class="ham_member_img"><img src="img/user.png" alt="member_img"></div>
            <div class="ham_member_info">
                <p class="ham_member_name"><?=$_SESSION['t_name']?></p>
                <p class="ham_member_grade"><?=$_SESSION['t_task']?></p>
            </div>
        </div>
        <div class="ham_other_btn_line">
            <div class="setting_btn"><a href="setting.php"><img src="img/setting.png" alt="setting_icon"></a></div>
            <div class="alarm_btn"><a href="#none"><img class="test11" src="img/alarm.png" alt="alarm_icon"></a></div>
        </div>
    </div>
    <div class="hamnav_menu_wrap">
        <div class="hamnav_menu"><a href="#none"><span>학급목록</span></a>
            <div class="hamnav_class_list">
                <!--                <div class="hamnav_class"><a href="student_manegement_record.html"><span class="class_title">루트</span><span-->
                <!--                            class="class_grade_">초6</span></a></div>-->
                <?php
                for($i=0; $i<count($d_name); $i++) {
                    ?>
                    <div class="hamnav_class"><a href="student_management_record.php?d_uid=<?=$d_uid[$i]?>">
                            <span class="class_title"><?=$d_name[$i]?></span>
                        </a>
                    </div>
                    <?php
                }
                ?>

            </div>
        </div>
        <div class="hamnav_menu"><a href="homework_management_add.php"><span>숙제생성</span></a></div>
        <div class="hamnav_menu"><a href="student_management_score_all.php"><span>채점바로가기</span></a></div>
        <div class="hamnav_menu"><a href="class_schedule_list.php"><span>수업계획표/일지</span></a></div>
        <div class="hamnav_menu"><a href="notice_list.php"><span>공지사항</span></a></div>
    </div>
    <div class="alarm_box_wrap_wrap">
        <div class="alarm_box_wrap">
            <div class="alarm_tri"><img src="img/alarm_tri.png" alt="alarm_tri_icon"></div>
            <div class="alarm_box">
                <div>
                    <p id="x_alarm_btn" style="cursor:pointer;font-size:20px;font-weight: bold;text-align: right;">X</p>
                    <div>
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
    </div>
</div>