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
    <link rel="stylesheet" type="text/css" media="screen" href="css/scoring_list.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
</head>

<body>
    <section>
        <div class="head_section">
            <div class="head_section_1400">

                <div class="head_left">
<?
	$sql = "SELECT 
	           class_name, student_name
			FROM 
	          `homework_assign_list`  
	        WHERE 
			  student_id='$_GET[s_id]' AND c_uid='$_GET[c_uid]' AND client_id='$ac'";

	$result = mysqli_query($connect_db, $sql);
	$res = mysqli_fetch_array($result)
?>

                    <p class="left_text">
						<span><?=$res['class_name']?></span>
                    </p>
                    <p>
                        <span> - </span>
                        <span><?=$res['student_name']?></span>
                        <span> 학생</span>
                    </p>
                </div>
                <div class="head_right">
                </div>
            </div>
        </div>

<?
	$sql = "SELECT 
	           A.*, B._from, B._to, B.name, B.grade, B.semester, B.unit FROM 
	          `homework_assign_list` A 
			INNER JOIN 
			  `homework` B
			ON B.seq = A.h_id
	        WHERE 
			  A.student_id='$_GET[s_id]' AND A.c_uid='$_GET[c_uid]' AND A.client_id='$ac'";

	$result2 = mysqli_query($connect_db, $sql);
	$res2 = mysqli_fetch_array($result2)
?>

        <div class="scoring_table_section">
            <table>
                <thead>
                    <tr>
                        <th>시작일</th>
                        <th>숙제명</th>
                        <th>마감일</th>
                        <th>제출상태</th>
                        <th>채점상태</th>
                    </tr>
                </thead>
                <tbody>


                    <tr>
                        <td><span><?=substr($res2['_from'],6,4)?>-<?=substr($res2['_from'],0,2)?>-<?=substr($res2['_from'],3,2)?></span></td>
						<td><span><?=$res2['name']?>
							<br><span><?=$res2['grade']?> - </span><span><?=$res2['semester']?> </span><span>(<?=$res2['unit']?>)</span></td>

						<td>
							<span>~ </span>
							<span><?=substr($res2['_to'],6,4)?>-<?=substr($res2['_to'],0,2)?>-<?=substr($res2['_to'],3,2)?></span><br>
						</td>
                        <td>
<?
	echo status_view($res2['current_status']);
?>
                        </td>
                        <td>
                            <div class="scoring_btn"><a href="scoring.php?id=<?=$res2['id']?>">채점하기</a></div>
                        </td>
                    </tr>
                    <tr>
                        <td><span>2018-09-20</span></td>
                        <td>
                            <span>주교재</span>
                            <span>p10 ~ 11</span>
                        </td>
                        <td>
                            <span>~ </span>
                            <span>09-22</span>
                            <span>일</span>
                            <span>24</span>
                            <span>시 까지</span>
                        </td>
                        <td>
                            <p class="first_submitted" style="color: green; display: none">1차 제출</p>
                            <p class="second_submitted" style="color: blue;">2차 제출</p>
                            <p class="first_scroing_done" style="color: green; display: none">1차 채점 완료</p>
                            <p class="final_scroing_done" style="color: blue; display: none;">숙제 완료</p>
                            <p class="not_submit" style="display: none;">미제출</p>
                            <p class="excess_date" style="color: red; display: none">기한초과제출</p>
                        </td>
                        <td>
                            <div class="scoring_btn"><a href="scoring.html">채점하기</a></div>
                        </td>
                    </tr>
                    <tr>
                        <td><span>2018-09-20</span></td>
                        <td>
                            <span>주교재</span>
                            <span>p10 ~ 11</span>
                        </td>
                        <td>
                            <span>~ </span>
                            <span>09-22</span>
                            <span>일</span>
                            <span>24</span>
                            <span>시 까지</span>
                        </td>
                        <td>
                            <p class="first_submitted" style="color: green; display: none">1차 제출</p>
                            <p class="second_submitted" style="color: blue; display: none">2차 제출</p>
                            <p class="first_scroing_done" style="color: green;">1차 채점 완료</p>
                            <p class="final_scroing_done" style="color: blue; display: none;">숙제 완료</p>
                            <p class="not_submit" style="display: none;">미제출</p>
                            <p class="excess_date" style="color: red; display: none">기한초과제출</p>
                        </td>
                        <td>
                            <div class="scoring_btn"><a href="scoring.html">채점하기</a></div>
                        </td>
                    </tr>
                    <tr>
                        <td><span>2018-09-20</span></td>
                        <td>
                            <span>주교재</span>
                            <span>p10 ~ 11</span>
                        </td>
                        <td>
                            <span>~ </span>
                            <span>09-22</span>
                            <span>일</span>
                            <span>24</span>
                            <span>시 까지</span>
                        </td>
                        <td>
                            <p class="first_submitted" style="color: green; display: none">1차 제출</p>
                            <p class="second_submitted" style="color: blue; display: none">2차 제출</p>
                            <p class="first_scroing_done" style="color: green; display: none">1차 채점 완료</p>
                            <p class="final_scroing_done" style="color: blue;">숙제 완료</p>
                            <p class="not_submit" style="display: none;">미제출</p>
                            <p class="excess_date" style="color: red; display: none">기한초과제출</p>
                        </td>
                        <td>
                            <div class="scoring_btn"><a href="scoring.html">채점하기</a></div>
                        </td>
                    </tr>
                    <tr>
                        <td><span>2018-09-20</span></td>
                        <td>
                            <span>주교재</span>
                            <span>p10 ~ 11</span>
                        </td>
                        <td>
                            <span>~ </span>
                            <span>09-22</span>
                            <span>일</span>
                            <span>24</span>
                            <span>시 까지</span>
                        </td>
                        <td>
                            <p class="first_submitted" style="color: green; display: none">1차 제출</p>
                            <p class="second_submitted" style="color: blue; display: none">2차 제출</p>
                            <p class="first_scroing_done" style="color: green; display: none">1차 채점 완료</p>
                            <p class="final_scroing_done" style="color: blue; display: none;">숙제 완료</p>
                            <p class="not_submit">미제출</p>
                            <p class="excess_date" style="color: red; display: none">기한초과제출</p>
                        </td>
                        <td>
                            <div class="scoring_btn"><a href="scoring.html">채점하기</a></div>
                        </td>
                    </tr>
                    <tr>
                        <td><span>2018-09-20</span></td>
                        <td>
                            <span>주교재</span>
                            <span>p10 ~ 11</span>
                        </td>
                        <td>
                            <span>~ </span>
                            <span>09-22</span>
                            <span>일</span>
                            <span>24</span>
                            <span>시 까지</span>
                        </td>
                        <td>
                            <p class="first_submitted" style="color: green; display: none">1차 제출</p>
                            <p class="second_submitted" style="color: blue; display: none">2차 제출</p>
                            <p class="first_scroing_done" style="color: green; display: none">1차 채점 완료</p>
                            <p class="final_scroing_done" style="color: blue; display: none;">숙제 완료</p>
                            <p class="not_submit" style="display: none;">미제출</p>
                            <p class="excess_date" style="color: red;">기한초과제출</p>
                        </td>
                        <td>
                            <div class="scoring_btn"><a href="scoring.html">채점하기</a></div>
                        </td>
                    </tr>
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