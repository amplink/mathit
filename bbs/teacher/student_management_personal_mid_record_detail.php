<?php
include_once ('_common.php');
include_once ('head.php');

$today_date = date("Y-m-d");
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
    <link rel="stylesheet" type="text/css" media="screen" href="css/student_manegement_personal_mid_record_detail.css" />
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/common.js"></script>
</head>

<body>
<section>

<?
	$link = "/api/math/student_att?client_no=".$_SESSION['client_no']."&stu_id=".$_GET['s_id']."&d_id=".$_GET['d_id']."&c_id=".$_GET['c_id']."&from=".$_GET['d_id']."&to=".$_GET['d_id'];
	$r = api_calls_get($link);
	//$student_name = $r[3];

	$sql = "select * from `teacher_score` where `student` = '$_GET[s_name]' and `student_id` = '$_GET[s_id]';";
	$result = mysqli_query($connect_db, $sql);
	$res = mysqli_fetch_array($result);
?>

    <div class="head_section">
        <div class="head_section_1400">
            <div class="head_left">
                <p class="left_text"><?=$res['test_genre']?></p>
                <p class="record_date"><?=$today_date?></p>
            </div>
            <div class="head_right">
                <div class="print"><img src="img/printer.png" alt="printer_icon"></div>
                <div class="mail"><img src="img/mail.png" alt="mail_icon"></div>
                <div class="sub_close_btn"><img src="img/close.png" alt="close_icon"></div>
            </div>
        </div>
    </div>
    <div class="up_box">
        <div class="l_box">
            <div class="student_info_section" style="height: 100px;">
                <div class="s_info_left">
                    <div class="s_info_div">
                        <p class="l_div_text">학급</p>
                        <div class="r_div_content">
                            <p>
                                <span><?=$res['class']?></span>
                            </p>
                        </div>
                    </div>
                    <div class="s_info_div">
                        <p class="l_div_text">강사</p>
                        <div class="r_div_content">
                            <p>
                                <span><?=$res['teacher']?></span>
                            </p>
                        </div>
                    </div>
                    <div class="s_info_div">
                        <p class="l_div_text">학생</p>
                        <div class="r_div_content">
                            <p>
                                <span><?=$res['student']?></span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="s_info_right">
                    <div class="s_info_div">
                        <p class="l_div_text">출결</p>
                        <div class="r_div_content">
                            <p>
                                <span>출석율 : </span>
                                <span>90%</span>
                            </p>

                            <p>
                                <span>(지각 : 1, 결석 : 1)</span>
                            </p>
                        </div>
                    </div>
                    <div class="s_info_div">
                        <p class="l_div_text">숙제</p>
                        <div class="r_div_content">
                            <p>
                                <span>숙제율 : </span>
                                <span>90%</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="record_detail_table_section">
                <p class="l_div_text">중간평가</p><span>평균 - 80점</span>
                <div class="record_detail_table">
                    <table>
                        <thead>
                        <tr>
                            <th>1차</th>
                            <th>2차</th>
                            <th>학급평균</th>
                            <th>동일레벨<br>평균점수</th>
                            <th>동일레벨<br>최고점수</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><span><?=$res['score1']?></span></td>
                            <td><span><?=$res['score2']?></span></td>
                            <td><span>90</span></td>
                            <td><span>80</span></td>
                            <td><span>100</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>

<?
	$sql = "SELECT 
	           B.apply_status_1, B.apply_status_2,
	           B.score_status_1, B.score_status_2, 
			   B.wrong_anwer_1, B.wrong_anwer_2, 
			   ifnull ( B.current_status, 's0' ) as current_status, 
			   B.submit_date1, B.submit_date2, 
			   A.seq, A._from, A._to, A.name, A.grade, A.semester, A.unit,
			   A.Q_number1, A.Q_number2, A.Q_number3, A.Q_number4, A.name 
			FROM 
              `homework` A
			LEFT JOIN 
             `homework_assign_list` B  
			ON A.seq = B.h_id
	        WHERE 
			   match(A.student_id) against('*$_GET[s_id]*' in boolean mode) 
			AND A.c_uid='$_GET[c_uid]' AND A.client_id='$ac' AND B.apply_status_1 IS NOT NULL";
	$result2 = mysqli_query($connect_db, $sql);
?>

            <p class="l_div_text" style="width:200px;">숙제제출 현황</p>
			<p style="height:10px"></p>
            <div class="student_record_table_section">
                <table>
                    <thead>
                    <tr>
                        <th>출제일</th>
                        <th>숙제명</th>
                        <th>제출일</th>
                        <th>1차</th>
                        <th>2차</th>
                    </tr>
                    </thead>
                    <tbody>
<?
    $i = 0;
	while($res2 = mysqli_fetch_array($result2)) {
	   $wrong_tot1 = 0;
       $q_tot1 = 0;
       for($i=1; $i<4; $i++){
           if($res2['Q_number'.$i]) $q_tot1 += count(explode(",",$res2['Q_number'.$i]));
	   }

	   $wrong1 = json_decode($res2['wrong_anwer_1'],true);
	   if($wrong1){
		   foreach ($wrong1 as $value) {
			 $wrong_tot1 += count(explode(",",$value));
		   }
	   }
       $score1 = round((($q_tot1-$wrong_tot1)/$q_tot1) * 100);

	   $wrong_tot2 = 0;
       $q_tot2 = 0;
       for($i=1; $i<4; $i++){
           if($res2['Q_number'.$i]) $q_tot2 += count(explode(",",$res2['Q_number'.$i]));
	   }
	   $wrong2 = json_decode($res2['wrong_anwer_2'],true);
	   if($wrong2){
		   foreach ($wrong2 as $value) {
			 $wrong_tot2 += count(explode(",",$value));
		   }
	   }
       $score2 = round((($wrong_tot1-$wrong_tot2)/$wrong_tot1) * 100);

?>

                    <tr>
                        <td>
                            <span><?=substr($res2['_from'],6,10)?>-<?=substr($res2['_from'],0,2)?>-<?=substr($res2['_from'],3,2)?></span>
                        </td>
                        <td>
                            <span><?=$res2['name']?></span>
                        </td>
                        <td>
                            <span><? echo ($res2['submit_date2'])?substr($res2['submit_date2'],0,10):substr($res2['submit_date1'],0,10);?></span>
                        </td>
                        <td>
                            <span><?=$q_tot1-$wrong_tot1?> / <?=$q_tot1?></span>
                        </td>
                        <td>
                            <span><?=$wrong_tot1-$wrong_tot2?> / <?=$wrong_tot1?></span>
                        </td>
                    </tr>

<?
	}
?>


                    </tbody>
                </table>
            </div>
        </div>
        <div class="r_box" style="position:absolute;z-index:999;width:900px;height:600px"><? include "./chart.php";?>
        </div>
    </div>
    <div class="down_box">
        <div class="down_head_section">
            <p class="l_div_text">선생님 코멘트</p>
            <div class="save_btn"><a href="#none">저장</a></div>
        </div>
        <div class="comment_input_section">
            <textarea name="" id="" cols="30" rows="10"></textarea>
        </div>
    </div>
</section>
</body>

</html>