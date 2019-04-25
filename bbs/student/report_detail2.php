<?php
include_once ('head.php');
?>
<link rel="stylesheet" type="text/css" media="screen" href="css/report_detail.css" />
<body>
<?php
	$sql = "SELECT * FROM 
	         `teacher_score` 
			WHERE 
				`seq` = '$_GET[no]' 
			AND client_id = '$_SESSION[client_id]' 
			AND student_id = '$_SESSION[s_id]'";
	$result = mysqli_query($connect_db, $sql);
	$res = mysqli_fetch_array($result);
    $student_id = $res['student_id'];

    //분기시작일 정보
    if($res['test_genre'] == '중간평가') {

        $date = (date("Y") - 1) . "-12-01";
        $link = "/api/math/class?client_no=" . $_SESSION['client_no'] . "&date=" . $date;
        $r = api_calls_get($link);

        $month = explode("/", $res['date']);

        $flag = getQuarter($r[1][3]);
        $start_day = getPeriod($flag, $month[0]);

    }else{ //기말평가

        $sql6 = "SELECT  date
				 FROM
				  `teacher_score`
				 WHERE 
					 d_uid='$res[d_uid]'
				 AND c_uid='$res[c_uid]'
				 AND s_uid='$res[s_uid]'
				 AND d_order='$res[d_order]'
				 AND test_genre='중간평가'
				 AND client_id='$ac'
		";

        $result6 = mysqli_query($connect_db, $sql6);
        $res6 = mysqli_fetch_array($result6);
        $start_day = date("m/d/Y",strtotime ("+1 days", strtotime($res6['date'])));
    }

    $api_start_date = substr($start_day,6,10)."-".substr($start_day,0,2)."-".substr($start_day,3,2);
    $api_end_date = substr($res['date'],6,10)."-".substr($res['date'],0,2)."-".substr($res['date'],3,2);

    $link = "/api/math/student_att?client_no=".$_SESSION['client_no']."&stu_id=".$res['s_uid']."&d_id=".$res['d_uid']."&c_id=".$res['c_uid']."&from=".$api_start_date."&to=".$api_end_date;

    $r = api_calls_get($link);

?>
    <!--section-->
    <section>
        <div class="head_p">
            <p class="head_title">성적표</p>
            <p class="title_detail"><span><?=$res['year']?>년</span><span><?=$res['quarter']?>분기</span></p>
            <div class="back_btn"><a href="report.php"><img src="img/back_btn.png" alt="back_btn_icon"></a></div>
        </div>
        <div class="content_p">
            <p class="record_class_name">
                <span><?=$res['class']?></span>
                <span> - </span>
                <span><?=$res['d_order']?></span>
            </p>
            <p class="student_name"><span><?=$res['student']?></span></p>
        </div>
        <div class="content_detail_p">
            <div class="report_detail_section">
			    <p class="detail_title">출결 :
                     <span>
<?
						$result = @(int)(round(($r[1][0] + $r[1][2] / $r[1][1]) * 100));
						echo $result;
?>
                        %
					 </span>
					 <span>(지각: <? echo ($r[1][2])?$r[1][2]:"0"?>, 결석: <? echo ($r[1][0])?$r[1][0]:"0"?>)</span>
				</p>
                <p class="detail_title">숙제</p>
                <div class="detail_content_box" style="margin-top:-7px;">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>출제일</th>
                                <th>숙제명</th>
                                <th>제출일</th>
                                <th>1차</th>
								<th>2차</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tbody>
<?
                $sql4 = "SELECT 
				   IF (B.wrong_anwer_2 = '', B.wrong_anwer_1, B.wrong_anwer_2) wrong_answer,  
				   B.apply_status_1, B.apply_status_2,
				   B.score_status_1, B.score_status_2, 
				   B.wrong_anwer_1, B.wrong_anwer_2, 
				   B.submit_date1, B.submit_date2, 
				   A.seq, A._from, A._to, A.name, A.grade, A.semester, A.unit,
				   A.Q_number1, A.Q_number2, A.Q_number3, A.Q_number4, A.name 
				FROM 
				  `homework` A
				LEFT JOIN 
				 `homework_assign_list` B  
				ON A.seq = B.h_id 
				WHERE 
				   match(A.student_id) against('*$res[student_id]*' in boolean mode) 
				 -- A.student_id like '%$res[student_id]%'
				AND A.c_uid='$res[c_uid]' 
				AND A.client_id='$ac' 
				AND B.student_id='$res[student_id]'
				AND B.apply_status_1 IS NOT NULL
				AND (A._from >= '$start_day' AND A._to < '$res[date]')
				ORDER BY A.seq asc";

                $result4 = mysqli_query($connect_db, $sql4);

				$j = 0;
				$score_arr = array();
				$from_date = array();
				while($res4 = mysqli_fetch_array($result4)) {
					$wrong_tot1 = 0;
					$q_tot1 = 0;
					for($i=1; $i<4; $i++){
						if($res4['Q_number'.$i]) $q_tot1 += count(explode(",",$res4['Q_number'.$i]));
					}

					$wrong1 = json_decode($res4['wrong_anwer_1'],true);
					if($wrong1){
						foreach ($wrong1 as $value) {
							$wrong_tot1 += count(explode(",",$value));
						}
					}
					$score1 = round((($q_tot1-$wrong_tot1)/$q_tot1) * 100);

					$wrong_tot2 = 0;
					$q_tot2 = 0;
					for($i=1; $i<4; $i++){
						if($res4['Q_number'.$i]) $q_tot2 += count(explode(",",$res4['Q_number'.$i]));
					}
					$wrong2 = json_decode($res4['wrong_anwer_2'],true);
					if($wrong2){
						foreach ($wrong2 as $value) {
							$wrong_tot2 += count(explode(",",$value));
						}
					}
					//$score2 = round((($wrong_tot1-$wrong_tot2)/$wrong_tot1) * 100);
					$from_date[$j] = $res4['_from'];

?>
                            <tr>
                                <td>
                                    <span><?=substr($res4['_from'],6,10)?>-<?=substr($res4['_from'],0,2)?>-<?=substr($res4['_from'],3,2)?></span>
                                </td>
                                <td>
                                    <span><?=$res4['name']?></span>
                                </td>
                                <td>
                                    <span><? echo ($res4['submit_date2'])?substr($res4['submit_date2'],0,10):substr($res4['submit_date1'],0,10);?></span>
                                </td>
                                <td>
                                    <span><?=$wrong_tot1?> / <?=$q_tot1?></span>
                                </td>
                                <td>
                                    <span><?=$wrong_tot2?> / <?=$wrong_tot1?></span>
                                </td>
<?
						}
?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?

            //해당분기의 마지막날 구함
            //$timestamp = strtotime("+4 months", strtotime($start_day));
            //$limit_date = date("m/d/Y", $timestamp);


            $sql5 = "SELECT 
					A.seq, B.student_id, A._from,
					IF (B.wrong_anwer_2 = '', B.wrong_anwer_1, B.wrong_anwer_2) wrong_answer,  
					A.Q_number1, A.Q_number2, A.Q_number3, A.Q_number4
				FROM 
				  `homework` A
				LEFT JOIN 
				 `homework_assign_list` B  
				ON A.seq = B.h_id 
				WHERE 
					match(A.student_id) against('*$res[student_id]*' in boolean mode) 
				 -- A.student_id like '%$res[student_id]%'
				AND A.d_uid='$res[d_uid]' 
				AND A.c_uid='$res[c_uid]' 
				AND A.s_uid='$res[s_uid]' 
				AND A.client_id='$ac' 
				AND B.apply_status_1 IS NOT NULL
				AND (A._from >= '$start_day' AND A._to < '$res[date]')
				ORDER BY A.seq asc" ;

            $result5 = mysqli_query($connect_db, $sql5);
            $j = 0;

            $score_arr2 = array();
            while($res5 = mysqli_fetch_array($result5)) {
                $all = 0;
                for($i=1; $i<=4; $i++){
                    if($res5['Q_number'.$i]) $all += count(explode(",",$res5['Q_number'.$i]));
                }

                $wrong_tot = count(explode(",",$res5['wrong_answer']));
                $score_arr2[$res5['seq']][] = round((($all-$wrong_tot) / $all) * 100);
                // $score_arr2[$j] =
                $student_arr[$j] = $res5['student_id'];
                $j++;

            }
            $n = count(array_unique($student_arr));
            $i = 0;
            $avg = array();

            foreach ($score_arr2 as $key => $v) {
                $sum = 0;
                foreach ($score_arr2[$key] as $v2) {
                    $sum += $v2;
                }
                $avg[$i] = round($sum / $n);
                $i++;
            }

            $me_score = implode(",",$score_arr);
            $tot_score = implode(",",$avg);

            // $from_date = implode(",",$from_date);
            $max = count($from_date);

            ?>


            <div class="report_detail_section">
                <p class="detail_title">차트</p>
                <div class="detail_content_box" style="margin-top:-7px;">
                    <p><span><? include "./chart.php";?></span></p>
                </div>

                <?
                $avg =round(($res['score1'] + $res['score2']) / 2);

                $sql3 = "SELECT 
				  SUM(A.score1 + A.score2) / (COUNT(A.seq)*2) avg,
				  MAX((A.score1 + A.score2) / 2) max,
				  (SELECT SUM(score1 + score2) / (COUNT(seq)*2) 
				   FROM `teacher_score` 
				   WHERE  seq = '$_GET[no]') tot2
				FROM
				  `teacher_score` A
				WHERE 
					A.seq = '$_GET[no]'
				
				";

                //echo $sql3;
                $result3 = mysqli_query($connect_db, $sql3);
                $res3 = mysqli_fetch_array($result3);

                ?>

                <br>
                <p class="detail_title"><?=$res['test_genre']?> (평균 : <?=$avg?>점)</p>
                <div class="detail_content_box" style="margin-top:-7px;min-height:70px">
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
                                <td><span><?=$res['score1']?></span></td>
                                <td><span><?=$res['score2']?></span></td>
                                <td><span><?=round($res3['tot2'])?></span></td>
                                <td><span><?=round($res3['avg'])?></span></td>
                                <td><span><?=round($res3['max'])?></span></td>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="report_detail_section">
                <p class="detail_title">선생님 코멘트</p>
                <div class="detail_content_box" style="margin-top:-7px">
                    <p><span><?=$res['comment']?></span></p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>