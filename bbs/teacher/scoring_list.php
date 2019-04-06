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
                </tbody>
            </table>
        </div>
    </section>

</body>

</html>