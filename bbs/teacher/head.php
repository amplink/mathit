<?php
	include_once ('_common.php');

//	if(!$_SESSION['t_uid']) {
//
//		alert_msg('로그인을 먼저 해주세요.');
//		location_href("login.php");
//	}

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
	$chk = 0;
	$cnt = 0;
	for($i=1; $i<count($r); $i++) {
		$chk = 0;
		for($j=0; $j<count($d_uid); $j++) {
			if($d_uid[$j] == $r[$i][0]) $chk = 1;
		}
		if(!$chk) {
			$d_uid[$cnt] = $r[$i][0];
			$c_uid[$cnt] = $r[$i][1];
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
		if(count($r)) {

			for($j=0; $j<count($r); $j++) {
			
				$cnt = 0;

				if($r[$j][2] == $_SESSION['t_uid']) { //해당 선생(강사)님
					
					$time[$i] = $r[$j][0];

					for($k=1; $k<count($r[$j]); $k++) {
											
						if($k%3 == 0) {

							if($r[$j][$k]) :

								$day[$i][$cnt] = $r[$j][$k];

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

	$t_name = $_SESSION['t_name'];
	// 권한 체크
    $sql = "select * from `teacher_setting` where `t_name`='$t_name';";
    $result = sql_query($sql);
    $res = mysqli_fetch_array($result);
?>
<script>
    window.onload = function () {
        $.ajax({
            url: "test.php",
            dataType: "text",
            success: function (response) {
                if(response == 1){
                    alert("로그인 후 이용해주세요");
                    location.href = "login.php";
                }
            }
        });
    }
</script>
<head>
    <script src="js/jquery-3.3.1.min.js"></script>
    <link rel="icon" type="image/png" sizes="96x96" href="img/f.png">
</head>
<header>
    <div class="hamburger_btn">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="home_btn"><a href="home.php"><img src="img/home.png" alt="home_icon"></a></div>
    <div class="logo_section">
        <div class="logo"><a href="home.php"><img src="img/logo_white.png" alt="header_logo"></a></div>
        <p class="navigation_text"><?php echo $nav_text;?></p>
    </div>
    <div class="member_info_wrap">
        <div class="member_img"><a href="setting_individual.php"><img src="img/user.png" alt="member_img"></a></div>
        <div class="member_info">
            <a href="setting_individual.php"><p class="member_name"><?=$_SESSION['t_name']?></p></a>
            <a href="setting_individual.php"><p class="member_grade"><?=$_SESSION['t_task']?></p></a>
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
            <div class="ham_member_img"><a href="setting_individual.php"><img src="img/user.png" alt="member_img"></a></div>
            <div class="ham_member_info">
                <a href="setting_individual.php"><p class="ham_member_name"><?=$_SESSION['t_name']?></p></a>
                <a href="setting_individual.php"><p class="ham_member_grade"><?=$_SESSION['t_task']?></p></a>
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

					//해당 수업에 학생 정보
					$link_4 = "/api/math/class_stu?client_no=".$_SESSION['client_no']."&d_uid=".$d_uid[$i]."&c_uid=".$c_uid[$i];
					$r_4 = api_calls_get($link_4);

                ?>
                    <div class="hamnav_class"><a href="student_management_record.php?d_uid=<?=$d_uid[$i]?>&c_uid=<?=$c_uid[$i]?>">
                            <span class="class_title"><?=$d_name[$i]?> ( <?php echo (count($r_4)-1);?> ) </span>
                        </a>
                    </div>
                    <?php
                }
                ?>

            </div>
        </div>

        <div class="hamnav_menu <?php if(!$res['hm_create']) echo "dis";?>"><a href="homework_management_add.php"><span>숙제생성</span></a></div>
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
<script>
    $('.dis a').prop('href','#');
</script>