<?php
include_once ('_common.php');
include_once ('head.php');

$link = "/api/math/class_stu?client_no=".$_SESSION['client_no']."&d_uid=".$_GET['d_uid']."&c_uid=".$_GET['c_uid'];
$r = api_calls_get($link);

for($i=0; $i<count($d_name); $i++) {
    if($d_uid[$i] == $_GET['d_uid'] && $c_uid[$i] == $_GET['c_uid']) {
        $class_name = $d_name[$i];
    }
}

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
    <link rel="stylesheet" type="text/css" media="screen" href="css/student_manegement_score_each.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
</head>

<body>

    <section>
        <div class="head_section">
            <div class="head_section_1400">
				<div class="head_left">
					<p class="left_text">미 채점 목록 - <span><?=$class_name?></span></p>
				</div>
                <div class="head_right">
                </div>
            </div>
        </div>
        <div class="student_table_section">
            <table>
                <thead>
                    <tr>
                        <th>학생명</th>
                        <th>범위</th>
                        <th>제출기한</th>
                        <th>제출상태</th>
                        <th>채점상태</th>
                    </tr>
                </thead>



                <tbody>


				<?php
				for($i=1; $i<count($r); $i++) {
					?>
					<tr>
						<td><span><?=$r[$i][2]?></span></td>

						<td><span>문제풀기 6-1</span></td>
						<td><span>2018-09-20</span>
							<span> ~ </span>
							<span>2018-09-21</span></td>
						<td>
							<div class="chk_box on"></div>
							<div class="chk_box"></div>
						</td>
						<td>
							<div class="scoring_btn"><a href="#none">채점하기</a></div>
						</td>

					</tr>
					<?
				}
				?>

	               </tbody>
            </table>
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
</body>

</html>